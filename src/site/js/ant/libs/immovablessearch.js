// JavaScript Document Lib
var position;
$(function() {
	//scroll
	if($(".immovables-list-settings").offset() == "null") 
		var yOffsetT = $(".immovables-list-settings").offset().top;
	else 
		var yOffsetT = $(".search-filter").offset().top;
	$(window).scroll(function () {
		if ($(window).scrollTop() > yOffsetT) {
            $(".immovables-list-settings").addClass("top-fixed-position");
            $(".search-filter").addClass("top-fixed-position");
        } else {
        	$(".immovables-list-settings").removeClass("top-fixed-position");
        	$(".search-filter").removeClass("top-fixed-position");
            
        }
    });

	// images
	$(".immovables-list .img img").hover(function() {
		var id = $(this).parent("a").parent("div").parent("div").attr("class");
		id = id.replace(/item colomns i-/g, "");
		getImmovableImages(id);
	}, function() {
		var id = $(this).parent("a").parent("div").parent("div").attr("class");
		id = id.replace(/item colomns i-/g, "");
		$(".i-" + id + " .images").hide();
	});
	/**
	 * list settings
	 */
	$(".immovables-list-settings .sort a").click(function() {
		log( $(this).attr("class"));
		$.getJSON("/immovables/setSortTable?value=" + $(this).attr("class"), function(data) {
			location.href = location.href;
		});
		return false;
	});
	$(".immovables-list-settings .count-on-page a").click(
			function() {
				$.getJSON("/immovables/setCookie?key=im_f_show_pnumber&value="
						+ $(this).text(), function(data) {
					location.href = location.href;
				});
				return false;
			});
	$(".search-form .c-exchange-list span").click(function() {
		$(".search-form .c-exchange-list span").removeClass("active");
		var css = $(this).attr("class");
		log(css);
		$(this).addClass("active");
		$("#exchange_select").val(css);
		precountfound();
	});
	/* copy input value on change from filter to searchform */
	$(".search-filter .submit").click(function () {
		$("#SearchSbtIm").click();
		return false;
	});
	
	/*	kiev */
	/*$(".c-kyiv a").click(function() {
		$(".regionalBlock .reginalTree").show();
		$("#plus-item-4c3eb33182810").click();
		$("#id_4c3eb839f144e_2").click();
		return false;
	});*/
	$(".c-kyiv a.bg-buttons").click(function () {
		$("#kiev-box .reginalTree").toggle();
		if($(".c-kyiv a.bg-buttons").hasClass("active")) 
			$(".c-kyiv a.bg-buttons").removeClass("active");
		else
			$(".c-kyiv a.bg-buttons").addClass("active");
		return false;
	});
	$(".regionalBlock .reginalTree .i-4c3eb839f144e").clone().appendTo("#kiev-box .reginalTree .parent-element-4c3eb33182810");
	$(".regionalBlock .reginalTree .i-4c3eb839f144e").remove();
	$("#kiev-box .reginalTree #plus-item-4c3eb839f144e").hide();
	$("#kiev-box .reginalTree #id_4c3eb839f144e_2").hide();
	$("#kiev-box .reginalTree .r-name-item-4c3eb839f144e").hide();
	$("#kiev-box .reginalTree .parent-element-4c3eb839f144e").show();
	$("#kiev-box .reginalTree").hover(function() {
	}, function() {
		$(this).hide();
		$(".c-kyiv a.bg-buttons").removeClass("active");
	});
	
	$("#searchFilterForm input").change(
			function() {
				var name = $(this).attr("id");
				$("#SearchIsAdvasedChecked").val("1");
				if ($(this).attr("type") == "checkbox") {
					$("#SearchFormIm #" + name.replace(/filter-/g, "") + "")
							.click();
				}
				if ($(this).attr("type") == "text") {
					/* бегунки блять */
					var id = $(this).attr("id");
					if (id.indexOf("filter-") != -1 ) {
						if ($(this).hasClass("input-from")) 
							id = id.replace(/filter-from-b_/g, "");
						if ($(this).hasClass("input-to")) 
							id = id.replace(/filter-to-b_/g, "");
						var b_from = ($("#filter-from-b_" + id).val() != "" ? $("#filter-from-b_" + id).val() : $("#filter-from-b_" + id).attr("placeholder"));
						var b_to = ($("#filter-to-b_" + id).val() != "" ? $("#filter-to-b_" + id).val() : $("#filter-to-b_" + id).attr("placeholder"));
						$("#b_" + id).val(b_from + " - " + b_to);
					}
				}
				$("#SearchFormIm #" + name.replace(/filter-/g, "") + "").val($(this).val());
				precountfound();
			});
	/* regional block */
	$(".regionalBlock .reginalTree").hover(function() {
	}, function() {
		$(this).hide();
	});
	$(".regionalTextInput").click(function() {
		$(".regionalBlock .reginalTree").toggle();
	});
	$(".rlist .plus").click(function() {
		var input_name = $(this).attr("id").substring(10, 23);
		log("click" + input_name);
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
		$("#kiev-box .parent-element-" + input_name).show();
	});
	$(".rlist input").click(function() {
		var input_name = $(this).attr("name").substring(0, 13);
		log("click" + input_name);
		if ($(this).attr("checked")) {
			$("#plus-item-" + input_name).html("-");
			$(".parent-element-" + input_name).show();
			// appendToRegionalTextInput(input_name);
		} else {
			$("#plus-item-" + input_name).html("+");
			$(".parent-element-" + input_name).hide();
			// removeFromRegionalTextInput(input_name);
		}
		$("#kiev-box .parent-element-" + input_name).show();
	});
	/**
	 * street autocomplete
	 */
	$("#im_adress_id").bind(
			"keydown",
			function(event) {
				if (event.keyCode === $.ui.keyCode.TAB
						&& $(this).data("ui-autocomplete").menu.active) {
					event.preventDefault();
				}
			}).autocomplete({
		source : function(request, response) {
			$.getJSON("/dictionaries/getdictvaluelist?ld_id=14&limit=10", {
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
			var terms = split(this.value);
			// remove the current input
			terms.pop();
			// add the selected item
			terms.push(ui.item.value);
			// add placeholder to get the comma-and-space at the end
			terms.push("");
			this.value = terms.join(", ");
			return false;
		}
	});
	/**
	 * precountfound
	 */
	$(".pre-count-found .count").html(app.immovables.count);
	$("#SearchFormIm input").change(precountfound);
	
	/* separator	*/
	separatorInputNumber("#im_spaceb");
	separatorInputNumber("#im_spacee");
	separatorInputNumber("#im_praceb");
	separatorInputNumber("#im_pracee");
	
	/*	metro	*/
	$(".search-form .c-metro .bg-icons").click(function () {
		if($(this).hasClass("active")) 
			$(this).removeClass("active");
		else 
			$(this).addClass("active");
		$("#dlcm_4c400e6ac4be0").toggle();
	});
	$(".search-form .c-metro .dropdown label").click(function () {
		if($(".search-form .c-metro .bg-icons").hasClass("active")) 
			$(".search-form .c-metro .bg-icons").removeClass("active");
		else 
			$(".search-form .c-metro .bg-icons").addClass("active");
	});
});

/*
 * var map = new ymaps.Map ("map", { center: [55.76, 37.64], zoom: 7 });
 */
