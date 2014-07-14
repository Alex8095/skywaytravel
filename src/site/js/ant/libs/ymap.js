// JavaScript Document Lib
$(function() {
	//$("#accYMapSearchTypeIm").accordion();
	$("#accYMapSearchTypeIm h3").click(function () {
		var a = $(this).children("a").attr("class");
		setActiveImmovableType(a.replace(/a-/g, ""));
		return false;
	});
	setActiveImmovableType('4c3ec51d537c0');
	/**
	 * формирование размера карты
	 */
	yMapBg();
	$(window).resize(function() {
		yMapBg();
	});
	/**
	 * regional block
	 */
	$(".regionalBlock .reginalTree").hover(function() {
	}, function() {
		$(this).hide();
	});
	$(".regionalTextInput").click(function() {
		$(".reginalTree").toggle();
	});
	$(".rlist .plus").click(function() {
		var input_name = $(this).attr("id").substring(10, 23);
		if ($(".checkbox-item-" + input_name).attr("checked")) {
			$("#plus-item-" + input_name).html("+");
			$(".parent-element-" + input_name).hide();
			// removeFromRegionalTextInput(input_name);
			$(".checkbox-item-" + input_name).attr({
				"checked" : ""
			});
		} else {
			$("#plus-item-" + input_name).html("-");
			$(".parent-element-" + input_name).show();
			// appendToRegionalTextInput(input_name);
			$(".checkbox-item-" + input_name).attr({
				"checked" : "checked"
			});
		}
	});
	$(".rlist input").click(function() {
		var input_name = $(this).attr("name").substring(0, 13);
		if ($(this).attr("checked")) {
			$("#plus-item-" + input_name).html("-");
			$(".parent-element-" + input_name).show();
			// appendToRegionalTextInput(input_name);
		} else {
			$("#plus-item-" + input_name).html("+");
			$(".parent-element-" + input_name).hide();
			// removeFromRegionalTextInput(input_name);
		}
	});
	/**
	 * нажатие кнопки "поиск"
	 */
	$("#btmYMapSearch").click(function() {
		isSearchClick = true;
		loadingstart();
		ymStartSearch();
		getImmovablesList();
		//ymClusterer();
		return false;
	});
	
	$("#region-auto-search-btn").click(regionAutoSearch);
	/**
	 * region autocomplete
	 */
	$("#region-auto-search-text").bind(
		"keydown",
		function(event) {
			if (event.keyCode === $.ui.keyCode.TAB && $(this).data("ui-autocomplete").menu.active) {
				event.preventDefault();
			}
		}).autocomplete({
		source : function(request, response) {
			$.getJSON("/dictionaries/getdictyvaluelist?ld_ids='11','12','13','14','15','20'&limit=10", {
				term : extractLast(request.term)
			}, response);
		},
		search : function() {
			// custom minLength
			var term = extractLast(this.value);
			if (term.length < 2) {
				return false;
			}
		},
		focus : function() {
			// prevent value inserted on focus
			return false;
		},
		select : function(event, ui) {
			regionSearchObj[regionSearchObj.length] = ui.item;
			var terms = split(this.value);
			// remove the current input
			terms.pop();
			// add the selected item
			terms.push(ui.item.value);
			// add placeholder to get the comma-and-space at the end
			terms.push("");
			this.value = terms.join(",");
			return false;
		}
	});
	loadingstart();
});
var regionSearchObj = [];

var aUI = {};
var aEvent = {};
/**
 * инициализация яндекс карты
 */
ymaps.ready(ymInit);

/*
 * var map = new ymaps.Map ("map", { center: [55.76, 37.64], zoom: 7 });
 */
