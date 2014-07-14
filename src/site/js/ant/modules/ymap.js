// JavaScript Document Module
var map;
var clusterer = null;
var immovablesList = {};
var immovableTypeActive;
var ImageHref = {
	mini : {
		"4c3ec3ec5e9b5" : "http://img.alfabrok.ua/files/images/ymap/icons/flat-mini.png",
		"4c3ec3ec5e9b7" : "http://img.alfabrok.ua/files/images/ymap/icons/commercial-mini.png",
		"4c3ec51d537c0" : "http://img.alfabrok.ua/files/images/ymap/icons/home-mini.png",
		"4c3ec51d537c3" : "http://img.alfabrok.ua/files/images/ymap/icons/land-mini.png"
	},
	big : {
		"4c3ec3ec5e9b5" : "http://img.alfabrok.ua/files/images/ymap/icons/flat.png",
		"4c3ec3ec5e9b7" : "http://img.alfabrok.ua/files/images/ymap/icons/commercial.png",
		"4c3ec51d537c0" : "http://img.alfabrok.ua/files/images/ymap/icons/home.png",
		"4c3ec51d537c3" : "http://img.alfabrok.ua/files/images/ymap/icons/land.png"
	}
};
var isSearchClick = false;

var myGeoObjects = [];
var immovablesListSearched = 0;
var geoObjectState;
var yPolygonIsWork = false;
var yPolygon;
var aPolygonBounds;
var aCoordinates;
var tickEvent;
var endEvent;
var istick = false;
var ymapsettings = {
		"zoom" : 0,
		"bounds" : {
			"es" : 0,
			"ee" : 0,
			"ns" : 0,
			"ne" : 0
		},
		"center" : {
			"e" : "50.442971",
			"n" : "30.521786"
		}
	};
var abounds;
/**
 * ресайз размера карты при изминение размера окна броузера
 */
function yMapBg() {
	$(".wrapper").height($(window).height() - 70);
	var w = $(".div-center-page").width() - 220;
	var h = $(window).height() - 110;
	$(".y-map").css({
		"width" : w,
		"height" : h
	});
	$("#map").css({
		"width" : w,
		"height" : h
	});
}
/**
 * установка указателя типа недвижимости
 * 
 * @param id
 */
function setActiveImmovableType(id) {
	/* очистили чекбоксы */
	var allCheckboxes = $("#accYMapSearchTypeIm input:checkbox:enabled");
	allCheckboxes.not(':checked');
	allCheckboxes.removeAttr('checked');
	/* установили указатель типа недвижимости */
	immovableTypeActive = id;
	$("#im_catalog_id").val(id);
	/* обнуляем значение полей input[text] */
	if (immovableTypeActive != '4c3ec3ec5e9b5') {
		$('#blck-4c3ec3ec5e9b5').children('.fDiv').children('input').val('');
	}
	$(".item-space .lName").text(immovableTypeActive == "4c3ec51d537c3" ? "Размер участка (соток):" : "Общая площадь:");
	
	$(".y-search-filter .params").hide();
	$("#blck-" + id).show();
	return;
}
/**
 * настройка полигона карты
 * @param e
 * @returns {Boolean}
 */
function yPolygonBinding(e) {
	if(yPolygonIsWork) {
		$("#yPolygonIsWork-btn").text("Выделить область поиска");
		yPolygonIsWork = false;
		ymap.geoObjects.remove(yPolygon);
		return false;
	}
	$("#yPolygonIsWork-btn").text("Удалить область поиска");
	// Создаем многоугольник без вершин.
    yPolygon = new ymaps.Polygon([], {}, {
        // Курсор в режиме добавления новых вершин.
        editorDrawingCursor: "crosshair",
        // Максимально допустимое количество вершин.
        editorMaxPoints: 5,
        // Цвет обводки.
        strokeColor: '#9B9B9B',
        // Ширина обводки.
        strokeWidth: 4
    });
    // Добавляем многоугольник на карту.
    ymap.geoObjects.add(yPolygon);

    // В режиме добавления новых вершин меняем цвет обводки многоугольника.
    var stateMonitor = new ymaps.Monitor(yPolygon.editor.state);
    stateMonitor.add("drawing", function (newValue) {
    	yPolygon.options.set("strokeColor", newValue ? '#999999' : '#9B9B9B');
    });
    // Включаем режим редактирования с возможностью добавления новых вершин.
    yPolygon.editor.startDrawing();
    /*	добавление вершины*/
    yPolygon.editor.events.add(['beforevertexadd'], function (event) {
    	var vertexInver = event.get("vertexIndex");
    	if(vertexInver == 4) {
    		getImmovablesListToPolygon();
    	}
    });
    /*	перетаскивание вершины*/
    yPolygon.editor.events.add(['vertexdragend'], function (event) {
    	getImmovablesListToPolygon();
    });
    yPolygonIsWork = true;
}
/**
 * поиск недвижимости для полигона
 */
function getImmovablesListToPolygon() {
	/* очистка информации */
	loadingstart();
	immovablesList = {};
	if (clusterer !== null) {
		clusterer.removeAll();
	}
	
	var yPolygonBounds = yPolygon.geometry.getBounds();
	aPolygonBounds = yPolygonBounds;
	aCoordinates = yPolygon.geometry.getCoordinates();
    setZoomCenterBounds(null, null, yPolygonBounds);
    $.ajax({
		url : "/immovables/getimmovableslistymap?cashe=true&im_geopos_es=" + ymapsettings.bounds.es + "&im_geopos_ee=" + ymapsettings.bounds.ee + "&im_geopos_ns=" + ymapsettings.bounds.ns + "&im_geopos_ne=" + ymapsettings.bounds.ne,
		type : "GET",
		data : $("#formYMapSearch").serialize(),
		success : function(data) {
				var l = $.parseJSON(data);
				if (l.length > 0) {
					var j = 0;
					var immovablesListInPolygon = [];
					for ( var i = 0; i < l.length; i++) {
						//проверка на вхождение в полигон
						if(yPolygon.geometry.contains([ l[i]["im_geopos_e"] , l[i]["im_geopos_n"]])) {
							immovablesListInPolygon[j] = l[i];
							j++;
						}
					}
					if(immovablesListInPolygon.length > 0) {
						immovablesList = immovablesListInPolygon;	
						buildImmovablesOnYMap();
					}
					else
						ymFinish();
					
				}
				else 
					ymFinish();
			}
		});
}
/**
 * 
 */
function ymInit() {
	ymap = new ymaps.Map("map", {
		center : [ 50.442971, 30.521786 ],
		zoom : 12,
		behaviors:['default', 'scrollZoom']
	});
	ymap.controls.add("mapTools").add("zoomControl").add("typeSelector");
	ymap.action.events.add('tick', function(e) {
		tickEvent = e.get('tick');
	});
	ymap.action.events.add('end', function(e) {
		if (!isSearchClick) {
			endEvent = e.get('end');
			if(tickEvent.timingFunction != "ease-in-out") {
				getImmovablesListWithOutSearch();
			}
		}
	});
	//кпока ломанной
	ButtonLayout = ymaps.templateLayoutFactory.createClass("<div id='yPolygonIsWork-btn' class='btn [if state.selected]my-button-selected[endif]'>$[data.content]</div>");
    var button = new ymaps.control.Button({ data: { content: "Выделить область поиска" } }, { layout: ButtonLayout, selectOnClick: true });
    button.events.add('click', yPolygonBinding);
    ymap.controls.add(button, { right: 90, top: 7 });
    getImmovablesListWithOutSearch();
}
/**
 * получение недвижимости без поиска после изминение позиции карты
 */
function getImmovablesListWithOutSearch() {
	var tickMap = isTickMap();
	if(tickMap) {
		ymStartSearch();
		$.ajax({
			url : "/immovables/getimmovableslistymap?cashe=true&limit=50&im_geopos_es=" + ymapsettings.bounds.es + "&im_geopos_ee=" + ymapsettings.bounds.ee + "&im_geopos_ns=" + ymapsettings.bounds.ns + "&im_geopos_ne=" + ymapsettings.bounds.ne,
			type : "GET",
			data : $("#formYMapSearch").serialize(),
			success : function(data) {
				immovablesList = $.parseJSON(data);
				if (immovablesList.length > 0)
					buildImmovablesOnYMap();
				else
					ymFinish();
				}
			});
	}
}
/*
 * запись Zoom, Center, Bounds данных карты
 */
function setZoomCenterBounds(zoom, center, bounds) {
	abounds = bounds;
	if(zoom) {
		ymapsettings.zoom = zoom;
	}
	if(center) {
		ymapsettings.center.e = center[0];
		ymapsettings.center.n = center[1];
	}
	if (bounds) {
		ymapsettings.bounds.es = bounds[0][0];
		ymapsettings.bounds.ee = bounds[1][0];
		ymapsettings.bounds.ns = bounds[0][1];
		ymapsettings.bounds.ne = bounds[1][1];
	}
}
/*
 * проверка на сдвиг, увеличение карты
 */
function isTickMap() {
	var res = false;
	if(yPolygonIsWork)
		return false;
	var bounds = ymap.getBounds();
	setZoomCenterBounds(ymap._zoom, null, bounds);
	return true;
	log(ymap._zoom + "  " + ymapsettings.zoom);
	if (parseInt(ymap._zoom) != parseInt(ymapsettings.zoom)) {
		setZoomCenterBounds(ymap._zoom, null, bounds);
		return true;
	}
	return res;
	var center = ymap.getCenter();
	var centerES = center[0] + $("#im_priceb").val()/ymapsettings.zoom;
	var centerEE = center[0] - $("#im_priceb").val()/ymapsettings.zoom;
	//var centerNS = center[1] + $("#im_priceb").val()/ymapsettings.zoom;
	//var centerNE = center[1] - $("#im_priceb").val()/ymapsettings.zoom;
	if(centerES > ymapsettings.center.e || centerEE < ymapsettings.center.e) {
		setZoomCenterBounds(null, center, bounds);
		return true;
	}
	return res;
}
/**
 * 
 */
function buildImmovablesOnYMap() {
	myGeoObjects = [];
	immovablesListSearched = 0;
	for ( var i = 0; i < immovablesList.length; i++) {
		var h = "";
		var w = "";
		if (immovablesList[i]["im_geopos"]) {
			if (immovablesList[i]["rent_template"]) {
				var point = immovablesList[i]["im_geopos"].indexOf(",", 0);
				h = immovablesList[i]["im_geopos"].substr(0, point);
				w = immovablesList[i]["im_geopos"].substr(point + 1,
						immovablesList[i]["im_geopos"].length);
				myGeoObjects[immovablesListSearched] = new ymaps.GeoObject(
						{
							geometry : {
								type : "Point",
								coordinates : [ w, h ]
							},
							properties : {
								balloonContentBody : immovablesList[i]["rent_template"],
								balloonContentFooter : 'Код: '
										+ immovablesList[i]["im_code"]
							}
						},
						{
							iconImageHref : ImageHref.mini[immovablesList[i]["im_catalog_id"]],
							iconImageSize : [ 28, 38 ]
						});
				immovablesListSearched++;
			}
			if (immovablesList[i]["sale_template"]) {
				var point = immovablesList[i]["im_geopos"].indexOf(",", 0);
				h = immovablesList[i]["im_geopos"].substr(0, point);
				w = immovablesList[i]["im_geopos"].substr(point + 1,
						immovablesList[i]["im_geopos"].length);
				myGeoObjects[immovablesListSearched] = new ymaps.GeoObject(
						{
							geometry : {
								type : "Point",
								coordinates : [ w, h ]
							},
							properties : {
								balloonContentBody : immovablesList[i]["sale_template"],
								balloonContentFooter : 'Код: '
										+ immovablesList[i]["im_code"]
							}
						},
						{
							iconImageHref : ImageHref.mini[immovablesList[i]["im_catalog_id"]],
							iconImageSize : [ 28, 38 ]
						});
				immovablesListSearched++;
			}
		}
	}
	// создадим кластеризатор и запретим приближать карту при клике на кластеры
	clusterer = new ymaps.Clusterer({
		clusterDisableClickZoom : true,
		// Используем макет "карусель"
		clusterBalloonContentBodyLayout : "cluster#balloonCarouselContent",
		// Запрещаем зацикливание списка при постраничной навигации
		clusterBalloonCycling : false,
		// Настройка внешнего вида панели навигации. Элементами панели навигации
		// будут маркеры.
		clusterBalloonPagerType : "marker",
		// Количество элементов в панели навигации
		// clusterBalloonPagerSize : 6
		balloonHeight : 420
	});
	clusterer.add(myGeoObjects);
	ymap.geoObjects.add(clusterer);
	ymFinish();
	
}

/**
 * инициализация поиска на карте
 */
function ymStartSearch() {
	immovablesList = {};
	if (clusterer !== null) {
		//log("clusterer.removeAll");
		clusterer.removeAll();
	}
	if (yPolygonIsWork == true) {
		yPolygonIsWork = false;
		ymap.geoObjects.remove(yPolygon);
	}
}
/**
 * завершение поиска на карте
 */
function ymFinish() {
	$("#CountSearchIm span").html(immovablesListSearched);
	$("#CountSearchIm").show();
	loadingend();
}
/**
 * получение объектов соответсвующие параметрам поиска
 */
function getImmovablesList() {
	$.ajax({
		url : "/immovables/getimmovableslistymap?cashe=true&action=ymap",
		type : "GET",
		data : $("#formYMapSearch").serialize(),
		success : function(data) {
			immovablesList = $.parseJSON(data);
			if (immovablesList.length > 0)
				buildImmovablesOnYMap();
			else
				ymFinish();
		}
	});
}
/**
 * отображение объекта на карте при подробном просмотре
 */
function ymInitImmovableOnMap() {
	immovable.h = 0;
	immovable.w = 0;
	if (immovable.im_geopos) {
		var point = immovable.im_geopos.indexOf(",", 0);
		immovable.h = immovable.im_geopos.substr(0, point);
		immovable.w = immovable.im_geopos.substr(point + 1,
				immovable.im_geopos.length);
	}
	if (immovable.w) {
		ymap = new ymaps.Map("map", {
			center : [ immovable.w, immovable.h ],
			zoom : 14
		});
		ymap.controls.add("mapTools").add("zoomControl").add("typeSelector");
		immovablePlacemark = new ymaps.Placemark([ immovable.w, immovable.h ],
				{
					hintContent : immovable.im_code
				}, {
					iconImageHref : ImageHref.big[immovable.im_catalog_id],
					iconImageSize : [ 49, 63 ]
				});
		ymap.geoObjects.add(immovablePlacemark);
	}
}

function regionAutoSearch() {
	$("#region_param").val("");
	var m = 1;
	var regionParamVal = "";
	var streets = "";
	if($("#region-auto-search-text").val() != "") {
		var sp = $("#region-auto-search-text").val().split(",");
		for(var i = 0; i< sp.length; i++){
			var item = "";
			if(sp[i] != "") {
				for(var j = 0; j< regionSearchObj.length; j++){
					if(sp[i] == regionSearchObj[j]["dict"]["dict_name"]) {
						item = regionSearchObj[j];
					}
				}
				if(item != "") {
					switch(item["dict"]["ld_id"]) {
						case '14' :{
							//street 
							streets += item["dict"]["dict_name"];
							break;
						}
						case '20' : {
							//metro
							regionParamVal += "&" + item.accessory + "#" + m + "#:" + item["dict"]["dict_id"];
							m++;
							break;
						}
						default: {
							regionParamVal += "&" + item.accessory + ":on";
							break;
						}
					}
				}
			}
		}
		if(streets != "")
			regionParamVal += "&im_adress_id:" + streets;
	}
	$("#region_param").val(regionParamVal);
	$("#btmYMapSearch").click();
}