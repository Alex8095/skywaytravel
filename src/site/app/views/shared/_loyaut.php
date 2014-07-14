<?php 
global $routingObj;
global $renderHtmlLinkObj;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $appDataObj->getTitle();?></title>
    <meta name="keywords" content="<?php echo $appDataObj->getKeyw();?>" /> 
    <meta name="description" content="<?php echo $appDataObj->getDesc();?>" /> 
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="sitemap" content="INDEX,FOLLOW" />
    <meta name="author" content="Alex Tsurkin www.webroom.in.ua" />
    <meta name="revisit-after" content="10 day" />
	<meta name="viewport" content="width=device-width"/>
 	<link rel="stylesheet" href="/css/style.css?v=2">
 	<link rel="shortcut icon" href="<?php echo getLangString("imageDomain")?>/files/images/bg/favicon.ico" />
	<?php echo appHtmlClass::partial("shared/partial/facebookmeta", array("appDataObj" => $appDataObj));?>
	<?php echo $renderHtmlLinkObj->renderCss();?>
	<script type="text/javascript" src="/js/ant/libs/jquery.1.7.2.min.js"></script>
	<script type="text/javascript" src="/js/libs/jquery.backstretch.min.js"></script>
	<?php echo $renderHtmlLinkObj->renderJsFull();?>
	<script type="text/javascript" src="/js/ant/libs/jquery-ui-1.8.18.custom.min.js"></script>
 	<!-- scripts concatenated and minified via ant build script-->
	<script type="text/javascript" src="/js/ant/functions.js"></script>
	<script type="text/javascript" src="/js/ant/modules/jquery.form.js"></script>
	<script type="text/javascript" src="/js/ant/modules/jquery.treeview.js"></script>
	<script type="text/javascript" src="/js/ant/modules/common.js"></script>
	<script type="text/javascript" src="/js/ant/modules/immovablesearch.js"></script>
	<script type="text/javascript" src="/js/ant/modules/ymap.js"></script>
	<script type="text/javascript" src="/js/ant/modules/roundies.js"></script>
	<script type="text/javascript" src="/js/ant/modules/round.js"></script>
	<script type="text/javascript" src="/js/ant/modules/fixpng.js"></script>
	<script type="text/javascript" src="/js/ant/comparing.js"></script>
	<script type="text/javascript" src="/js/ant/script.js"></script>
	<!-- end scripts-->
	<?php echo $renderHtmlLinkObj->renderJs();?>
	<?php echo $renderHtmlLinkObj->renderRel();?>
	<link rel="alternate" type="application/rss+xml" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/rss" title="" />
	<?php echo appHtmlClass::partial("shared/partial/appjavascript");?>	
</head>
<body style="background-image: url(http://img.alfabrok.ua/files/images/body-bg/<?php echo (!empty($_COOKIE["wrapperCssClass"]) ? $_COOKIE["wrapperCssClass"] : $routingObj->getParamItem("COOKIE_wrapperCssClass", "1") )?>.png)">
<?php //echo appHtmlClass::partial("shared/partial/googletagmanager");?>
<div class="wrapper w-<?php echo (!empty($_COOKIE["wrapperCssClass"]) ? $_COOKIE["wrapperCssClass"] : $routingObj->getParamItem("COOKIE_wrapperCssClass", "1"))?>" id="<?php echo sprintf("page-%s-%s", $routingObj->getController(), $routingObj->getAction()); ?>">
	<?php echo appHtmlClass::partial ( "block/header", array("appDataObj" => $appDataObj)); ?>
	<?php echo appHtmlClass::partialAction ( "block", "mainmenu", array ("hide" => "1", "p_type" => "p_index", "html_block" => "h", "controller"=> $routingObj->getController(), "action" => $routingObj->getAction() ) ); ?>
	<?php echo appHtmlClass::partial ( "block/middle" ); ?>
	<?php echo appHtmlClass::partialAction ( "block", "stringnavigation", array ("controller"=> $routingObj->getController(), "action" => $routingObj->getAction(), "h"=> $appDataObj->getH(), "string_navigation" => $appDataObj->getStringNavigation (), "parent_controller" => $appDataObj->getPController (), "parent_action" => $appDataObj->getPAction (), "param" => $routingObj->getParamToString(), "is_cache" => true) ); ?>
	<div class="div-center-page"><?php echo $body;?></div>
	<div class="div-footer">
		<?php echo appHtmlClass::partialAction ( "block", "mainmenu", array ("hide" => "1", "p_type" => "p_index", "html_block" => "f", "controller"=> $routingObj->getController(), "action" => $routingObj->getAction() ) ); ?>
	   	<div class="colomns">
			<div class="colomn w-50-pro"><p class="copy">© Торговая Марка «АЛЬФАБРОК» All rights reserved</p></div>
			<div class="colomn w-49-pro m-t-5"><divxmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="http://alfabrok.ua/" rel="v:url" property="v:title">Альфаброк</a>›</span><span typeof="v:Breadcrumb"><a href="http://alfabrok.ua/#login" rel="v:url" property="v:title">Агентство недвижимости№1</a></span></div></div>
		</div>
		<div class="clear"></div>
		<a href="" rel="nofollow" class="bgPrev bg-icons" title="<?php echo getLangString("prev_design")?>"><?php echo getLangString("prev_design")?></a>
		<a href="" rel="nofollow" class="bgNext bg-icons" title="<?php echo getLangString("next_design")?>"><?php echo getLangString("next_design")?></a>
	</div>
	<div id="div-request"></div>
	<div class="shadow-0-0-10-1 radius-3 " id="log">
		<h4>Javascript log</h4>
	</div>
    <div id="scrollUp" class="scroll-to-top bg-icons">&nbsp;</div>
    <div id="appDialog" title=""></div>
	<div id="appLoader" title="<?php echo getLangString("pleaseWait");?>"></div>
	<div id="appMessage"><span class="shadow-0-0-10-1"></span></div>
	<?php echo appHtmlClass::partial("shared/partial/analytics");?>
</body>
</html>