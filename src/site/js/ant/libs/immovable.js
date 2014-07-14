/**
 * галлерея
 */

var isShowYmapFull = false;
var bodyScrollTop = 0;
$(function() {
	/**
	 * меня заинтересовало форма
	 */
	$(".interested-btm").click(function() {
		$(".interested-form").toggle();
		return false;
	});
	$(".hide-form").click(function() {
		$(".interested-form").hide();
		return false;
	});
	$(".highslide").click(function() {
		$("body").css("overflow", "hidden");
	});
	$("#accordionVideo").accordion();
	$("#tabs").tabs();

	$(".immovable-view .advised-properties-view").hover(function() {
		$(".advised-properties-view .block").show();
	}, function() {
		$(".advised-properties-view .block").hide();
	});
	$(".immovable-view .advised-properties-view .btm").click(function() {
		return false;
	});
	$(".send-to-friend").click(function () {
		var title = $(this).attr("alt");
		$("#appDialog").load("/report/mailform");
		$("#appDialog").dialog({
			title: title,							   
			width: 380,				   
			modal:false,
	        buttons: {
	            "Отправить": function () {
	                $(this).dialog("close");
	                sendImmovableToEmail(immovable.im_id, $(".mail-form .email").val(), $(".mail-form .subject").val());
	            }
	        }
	    });
	    $("#appDialog").dialog("open");
		return false;
	});
	/*
	 * увеличение карты 
	 */
	$("#hideFullOneMap").click(function () {
		if(!isShowYmapFull) {
			var wh = $(window).height();
			$("html:not(:animated),body:not(:animated)").animate({ scrollTop: 0 }, 500 );
			$("#divYScreen").addClass("full-map");
			$("#divYScreen").css('height', wh);
			$("#map").css('height', wh - 19);
			$("#hideFullOneMap").html("<span class='bg-icons'>&nbsp;</span>Свернуть карту");
			$('body').css('overflow','hidden');
		}
		else {
			$("#divYScreen").removeClass("full-map");
			$("#divYScreen").css('height', 420);
			$("#map").css('width', 475);
			$("#map").css('height', 400);
			$("#hideFullOneMap").html("<span class='bg-icons'>&nbsp;</span>Развернуть карту во весь экран");
			$("html:not(:animated),body:not(:animated)").animate({ scrollTop: 400 }, 500 );
			$('body').css('overflow','scroll');
		}
		ymap.container.fitToViewport();
		isShowYmapFull = (isShowYmapFull ? false : true);
		return false;
	});
});
/**
 * печать объекта
 */
$(document).keydown(function(objEvent) {
	if (objEvent.ctrlKey) {
		if (objEvent.keyCode == 80) {
			objEvent.preventDefault();
			objEvent.stopPropagation();
			location.href = '/report/printpage/' + app.get.im_id;
			return false;
		}
	}
});