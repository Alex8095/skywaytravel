<?php 
  define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);
  require_once("../../config/config.php");
  define('SLASH', '../../');
  // Подключаем SoftTime FrameWork
  require_once("../../config/class.inc");
  require_once ( "../../dmn/utils/db_tables.inc");
  
 // echo $_GET['form'];
  //require_once("JSON.php");
  ?>

<!-- 	ZAPATEC FORM	-->
    <!-- Common JS files -->
    <script type='text/javascript' src="../utils/js/js-zapatec/utils/zapatec.js"></script>
    <script type="text/javascript" src="../utils/js/js-zapatec/lang/ru-utf8.js"></script>
    <!-- Custom includes -->	
    <script type='text/javascript' src='../utils/js/js-zapatec/src/form.js'></script>
    <script type='text/javascript' src='../utils/js/js-zapatec/form.js'></script>
    <!-- ALL demos need these css -->
    <link href="../utils/css/css.zapatec/zpcal.css" rel="stylesheet" type="text/css">
    <link href="../utils/css/css.zapatec/template.css" rel="stylesheet" type="text/css">
    <link href="../utils/css/css.zapatec/winxp.css" rel="stylesheet" type="text/css">
    <link href="../utils/css/css.zapatec/winxp.css" rel="stylesheet" type="text/css">
<!-- 	ZAPATEC FORM	-->   
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		language : "ru",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>