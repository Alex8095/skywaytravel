<?php
  error_reporting(E_ALL & ~E_NOTICE);

  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
  require_once("../../config/class.config.dmn.php");
  
  require_once("language/set.cookie.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $title_web;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link media="screen" href="../utils/css/index.css" rel="stylesheet" type="text/css">
<link media="screen" href="../utils/css/jquery-ui-1.8.7.custom.css" rel="stylesheet" type="text/css">

<!-- dialog.windows.css -->
<link type="text/css" href="../utils/css/dialog.windows.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" media="screen" href="../utils/js/jquery.ui.potato.menu.css" />


<script type="text/javascript" src="../utils/js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="../utils/js/jquery-ui.js"></script>
<script type="text/javascript" src="../utils/js/jquery.form.js"></script>
<script type="text/javascript" src="../utils/js/jquery.jalert.packed.js"></script>

<script type="text/javascript" src="../utils/js/ui/ui.core.js"></script>
<script type="text/javascript" src="../utils/js/ui/ui.tabs.js"></script>


<!--	dialog windows-->
<script type="text/javascript" src="../utils/js/jquery-impromptu.js"></script>
<script type="text/javascript" src="../utils/js/common.js"></script>

<!--	roundies-->
<script type="text/JavaScript" src="../utils/js/DD_roundies.js"></script>

<script type="text/javascript" src="../utils/js/jquery.ui.potato.menu.js"></script>
<script type="text/javascript" src="../utils/js/order.js"></script>

    
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
    
<script type="text/javascript">
(function($) {
    $(document).ready(function(){
        $('#menu1').ptMenu();
    });
})(jQuery);
</script>

<script type="text/javascript" src="../utils/js/niftycube.js"></script>

<!-- TinyMCE -->
<script type="text/javascript" src="../utils/js/tiny_mce/tiny_mce.js"></script>
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
<!-- /TinyMCE -->
</head>
<body >
    <div class="header">
        <table class="t-header" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="d-text">
                	Панель управления
                </td>
                <td class="d-acm">
                	(ACMS 1.0.0.18)
                </td>
                <td class="d-lang">
                    <?php require_once("language/form.language.php"); ?>
                </td>
                <td class="d-exit">
                 <a href="../../index.php"     title='Выход'>Выход</a>
                </td>
            </tr>
        </table>    
    </div>


<div class="div_menu_top">
</div>
<div class="middle">

<!-- Page Info-->

<table style="background:none;" width="100%" cellpadding="0" cellspacing="0">
	<tr class="tr-bg-center">
		<td class="td-table-menu">
        	<div class="d-menu-conteiner">
				 <?php include "menu.php"; ?>
            </div>
		</td>
  		<td class="main" height=100%>
			
            <div class="content-header">
            	<h3><?php echo $title;?></h3>
            	<?php echo $pageinfo; ?>
         	</div>
   
