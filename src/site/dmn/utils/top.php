<?php
  error_reporting(E_ALL & ~E_NOTICE);

  require_once("language/set.cookie.php");

  //$clUserInfo = new pg_select($tbl_accounts);
  //$UserInfoData = $clUserInfo ->select_table_id(" WHERE id_account = {$_COOKIE[id_account]}");

	if(isset($ArrPageInfo)) {
		$title = $ArrPageInfo[$_GET['temp']]['title'];
		$pageInfo = "<div class=\"content-header\">".$ArrPageInfo[$_GET['temp']]['pageInfo']."</div>";
		$back = $ArrPageInfo[$_GET['temp']]['back'];
	}
	
	$ClUSERDMN = new mysql_select("system_accounts");
	$UserInfoData = $ClUSERDMN -> select_table_id(" where id_account = {$_COOKIE['id_account']}");
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
<!-- event a-->
<link type="text/css" href="../utils/css/bottom.event.css" rel="stylesheet" />
<link href="css/dialog.page.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../utils/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="../utils/js/jquery-ui-1.8.4.custom.min.js"></script>

<script type="text/javascript" src="../utils/js/jquery.form.js"></script>
<!--	roundies-->
<script type="text/JavaScript" src="../utils/js/DD_roundies.js"></script>
<!-- Common JS files -->
<script type='text/javascript' src="../utils/js/js-zapatec/utils/zapatec.js"></script>
<script type="text/javascript" src="../utils/js/js-zapatec/lang/ru-utf8.js"></script>
<!--	dialog windows-->
<script type="text/javascript" src="../utils/js/jquery-impromptu.js"></script>
<script type="text/javascript" src="../utils/js/common.js"></script>
<!-- Custom includes -->
<script type='text/javascript' src='../utils/js/js-zapatec/src/form.js'></script>
<script type='text/javascript' src='../utils/js/js-zapatec/form.js'></script>
<!-- ALL demos need these css -->
<link href="../utils/css/css.zapatec/zpcal.css" rel="stylesheet" type="text/css">
<link href="../utils/css/css.zapatec/template.css" rel="stylesheet" type="text/css">
<link href="../utils/css/css.zapatec/winxp.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../utils/js/niftycube.js"></script>
<!-- TinyMCE -->
<script type="text/javascript" src="../utils/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="../utils/js/dmn-controllers.js"></script>
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
<script type="text/javascript">
$(function() {
	$("#DivDialogHelp").hide();
	$("#DivDialogHelp").dialog({
			autoOpen: false,
			minWidth: 600,
			modal: true
	});
	$('#CarterHelp').click(function() {
		$("#DivDialogHelp").show();
		$('#DivDialogHelp').dialog('open');
	})
});

</script>
<!-- /TinyMCE -->
</head>
<body>
<div id="loading"></div>
<div id="InterestingBg"></div>
<div class="DivHeader">
<div class="DivHeaderNameProduct">Панель управления сайтом</div>
    <div class="DivHeaderFR">
   	  <div class="DivHeaderNameAdmin">Пользователь: <?php echo $UserInfoData['login'];?></div>
   	  <div class="DivHeaderHelp"><a href="../help/" title='Справка'>Справка</a></div>
   	  <div class="DivHeaderExit"><a href="../enterDmn/exit.php" title='Выход из системы'>Выход</a></div>
    </div>
  <div class="clear"></div>
</div>
<?php require_once 'language/form.language.php';?>

<table width="100%" class="TableLogoInfo" cellpadding="0" cellspacing="0">
    <tr>
    	<td class="TdLogo"></td>
    	<td class="TdInfo"><div class="DivInfo"><?php echo $title;?></div></td>
    </tr>
</table>

<div class="middle">
<table class="TableMainCenter" width="100%" cellpadding="0" cellspacing="0">
<tr class="tr-bg-center">
 		<td class="td-table-menu">
          	<div class="d-menu-conteiner">
              	<?php include "menu.php"; ?>
            </div>
        </td>
  <td class="TableMainCenterTdContent" height="100%">
        	<div class="DivCenterTop"><?php echo $search;?></div>
            	<div class="DivCenterBg">
<div class="DivCenterContent">
<div id="t-page">
<div id="t-page-inner">