/* Author:
 */
$(document).ready( function() {
	buildPageDesing();
	$(window).resize(buildPageDesing);
	if($(".wrapper").height() < $(window).height()) 
		$(".wrapper").height($(window).height());
	$('img').bind("contextmenu", function(e) {
		return false;
	});
	$("body").click(function(e){		
		if($(e.target).attr("class") != "SearchFormLabelList" && $(e.target).attr("class") != "DivSearchPosition" && $(e.target).attr("class") != "bg-icons active"
			&& $(e.target).parent().attr("class") != "DivSearchPosition" 
			&& $(e.target).parent().attr("class") != "SearchFormLabelList"
			&& $(e.target).parent().parent().attr("class") != "DivSearchPosition"
			&& $(e.target).parent().parent().parent().attr("class") != "DivSearchPosition"
			&& $(e.target).parent().parent().attr("class") != "SearchFormLabelList"	
			&& $(e.target).parent().parent().parent().parent().parent().attr("class") != "TableSearchFormTdStandartPropCat") {
				$(".DivSearchPosition").hide();
				$(".TableSearchForm tbody tr:first-child td label span").addClass("ui-icon ui-icon-triangle-1-s");
				$(".search-form .c-metro .bg-icons").removeClass("active");
			}
	});			
	/*	banner	*/
	bannerImmovablesBlockBuild("flat");
	$("#bannerImmovablesBlock .navigation a").click(function () {
		bannerImmovablesBlockBuild($(this).attr("class"));
		return false;
	});
	/* замена фона страницы */
	$("body").backstretch('http://img.alfabrok.ua/files/images/body-bg/'  + bodyBG.active + '.png');
	changeBodyCss(bodyBG.active);
	$(".bgNext").click(function () {
		changeBodyCss(bodyBG.count != bodyBG.active ? bodyBG.active + 1 : 1);
		changeBodybg(bodyBG.count != bodyBG.active ? bodyBG.active + 1 : 1);
		return false;
	});
	$(".bgPrev").click(function () { 
		changeBodyCss(bodyBG.active != 1 ? bodyBG.active - 1 : bodyBG.count);
		changeBodybg(bodyBG.active != 1 ? bodyBG.active - 1 : bodyBG.count);
		return false;
	});
	/*	*/
	$("#appDialog").dialog({
        autoOpen: false,
        modal: true
    });

	

	var offset = 200;
	var duration = 500;
	$(window).scroll(function() {
		if ($(this).scrollTop() > offset) 
			$(".scroll-to-top").fadeIn(duration);
		else 
			$(".scroll-to-top").fadeOut(duration);
	});
	$(".scroll-to-top").click(function(event) {
		event.preventDefault();
		$("html, body").animate({scrollTop: 0}, duration);
		return false;
	});
});