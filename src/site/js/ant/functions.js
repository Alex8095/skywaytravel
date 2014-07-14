var bodyBG = {
	"count" : 6,
	"active" : 1
};
var pageSize = {
	window : {
		width : null,
		height : null
	},
	wrapper : {
		width : null,
		height : null
	}
};
/**
 * замена фона страницы
 * 
 * @param item
 */
function changeBodybg(item) {
	// меняем фон
	$("body").backstretch(
			'http://img.alfabrok.ua/files/images/body-bg/' + item + '.png', {
				duration : 3000,
				fade : 750
			});
	// отправляем данные на хостинг
	$.getJSON("/common/setCookie?key=wrapperCssClass&value=" + item);
	// меняем стиль wrapper
	$(".wrapper").removeClass("w-" + bodyBG.active);
	$(".wrapper").addClass("w-" + item);
	bodyBG.active = item;
}

function changeBodyCss(item) {
	//меняем стиль шрифтов
	var activeBodyClass = "body-dark";
	var newBodyClass = "body-light";
	$.getJSON("/imageService/getImageColor/" + item, function(data) {
		if(data.tone == "dark") {
			activeBodyClass = "body-light";
			newBodyClass = "body-dark";
		} 
		$("body").removeClass(activeBodyClass).addClass(newBodyClass);
	});
	
}
/**
 * логирование
 * 
 * @param message
 */
function log(message) {
	$("<div>").text(message).prependTo("#log");
	$("#log").scrollTop(0);
}
/**
 * уведомления пользователя о каком-то действие
 * 
 * @param message
 */
function systemalert(message) {
	$("#appMessage span").html(message);
	$("#appMessage").show("blind");
	setTimeout(function() {
		$("#appMessage").hide("blind")
	}, 3000);
}

function loadingstart(message) {
	$("#appLoader").show();
}
function loadingend(message) {
	$("#appLoader").hide();
}
/**
 * формирование баннеров недвижисомти
 * 
 * @param type_immovable
 */
function bannerImmovablesBlockBuild(type_immovable) {
	$("#bannerImmovablesBlock .navigation a").removeClass("active");
	$("#bannerImmovablesBlock .navigation ." + type_immovable).addClass(
			"active");
	$("#bannerImmovablesBlock .list .item").hide();
	$("#bannerImmovablesBlock .list .type-im-" + type_immovable).show();
}
/**
 * формирование размеров страницы
 */
function buildPageSize() {
	pageSize.window.width = $(window).width();
	pageSize.window.height = $(window).height();
	pageSize.wrapper.width = $(".wrapper").width();
	pageSize.wrapper.height = $(".wrapper").height();
};
/**
 * формирование дизайна страницы в зависимости от ее размера
 */
function buildPageDesing() {
	buildPageSize();
	var l = (pageSize.window.width - pageSize.wrapper.width) / 2 - 40;
	var r = (pageSize.window.width - pageSize.wrapper.width) / 2 - 40;
	if(app.controller == "poisk" && app.action == "nakarte") {
		l = 30;
		r = 30;
	}
	$(".bgPrev").css("left", l);
	$(".bgNext").css("right", r);
}
/**
 * отправка письма с недвижимостью на почту
 * 
 * @param im_id
 * @param email
 */
function sendImmovableToEmail(im_id, email, subject) {
	$.getJSON(
			"http://admin.alfabrok.ua/report_center.php?action=set_friend_im&im_id="
					+ im_id + "&email=" + email + "&name=" + email + "&subject=" + subject, function(data) {
				//systemalert("Письмо отправлено");
			});
	systemalert("Письмо отправлено");
}
