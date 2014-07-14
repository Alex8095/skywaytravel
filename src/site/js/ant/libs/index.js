// JavaScript Document
$(function() {
	/*	main-slider*/
	if(app.controller == "index" && app.action == "index") {
		/*$(".main-slider .flat").backstretch(["http://img.alfabrok.ua/files/images/slider/flat/0.jpg",
		                  	                 "http://img.alfabrok.ua/files/images/slider/flat/1.jpg",
		                  	                 "http://img.alfabrok.ua/files/images/slider/flat/2.jpg"],
		                  	                 { duration: 3000, fade: 750});	
		$(".main-slider .home").backstretch(["http://img.alfabrok.ua/files/images/slider/home/0.jpg",
			                  	             "http://img.alfabrok.ua/files/images/slider/home/1.jpg",
			                  	             "http://img.alfabrok.ua/files/images/slider/home/2.jpg"],
			                  	             {duration: 3000, fade: 750});
		$(".main-slider .commercial").backstretch(["http://img.alfabrok.ua/files/images/slider/commercial/0.jpg",
		                                           "http://img.alfabrok.ua/files/images/slider/commercial/1.jpg",
		                                           "http://img.alfabrok.ua/files/images/slider/commercial/2.jpg"],
		                                           {duration: 3000, fade: 750});
		$(".main-slider .land").backstretch(["http://img.alfabrok.ua/files/images/slider/land/0.jpg",
			                  	             "http://img.alfabrok.ua/files/images/slider/land/1.jpg",
			                  	             "http://img.alfabrok.ua/files/images/slider/land/2.jpg"],
			                  	             {duration: 3000, fade: 750});*/
	
		$(".main-slider .item").mouseenter(function() {
			$(this).addClass("slider-mouseenter");
			//$(this).animate({ width: "488px", height: "290px", "margin": "-8px 0 10px -8px" }, 750);
		}).mouseleave(function() {
			$(this).removeClass("slider-mouseenter");
			//$(this).animate({ width: "447px", height: "266px", "margin": "0 0 10px" }, -1);
		});
	}
	
	
});