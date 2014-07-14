<?php 
global $routingObj;
?>
<!-- //<![CDATA //]]>bodyBG.active = <?php echo (!empty($_COOKIE["wrapperCssClass"]) ? $_COOKIE["wrapperCssClass"] : $routingObj->getParamItem("COOKIE_wrapperCssClass", "1"))?>; -->
<script type="text/javascript">
var app = <?php echo json_encode($routingObj);?>;
var bodyBG = { "count" : <?php echo getLangString("countBodyBGImages");?>, "active" : <?php echo (!empty($_COOKIE["wrapperCssClass"]) ? $_COOKIE["wrapperCssClass"] : $routingObj->getParamItem("COOKIE_wrapperCssClass", "1"))?>	};
</script>	