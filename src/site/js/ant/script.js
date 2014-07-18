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
	/*	banner	*/
	bannerImmovablesBlockBuild("flat");
	$("#bannerImmovablesBlock .navigation a").click(function () {
		bannerImmovablesBlockBuild($(this).attr("class"));
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