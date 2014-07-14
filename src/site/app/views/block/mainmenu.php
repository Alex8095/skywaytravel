<?php global $routingObj; ?>
<?php global $arWords; ?>
<?php 
	//если категория недвижимости меняем controller, action для отображения в меню
	if(isset($arWords["typeCatImDictOfController"][$routingObj->getParamItem("controller")])) {
		$routingObj->setParamItem("controller", "immovables");
		$routingObj->setParamItem("action", "index");
	}
?>
<?php if($Data):?>
	<div class="main-menu">
		<?php foreach ($Data as $key => $value):?>
			<a class="<?php echo ($routingObj->getParamItem("controller") == $value["controller"] && $routingObj->getParamItem("action") == $value["action"] ?  "active" : "") ?>" id="pl-<?php echo $routingObj->getParamItem("html_block", "h"); ?>-<?php echo $value["controller"]; ?>-<?php echo $value["action"]; ?>" href="<?php echo $value["page_url"];?>" title="<?php echo $value["p_w_menu"];?>"><?php echo $value["p_w_menu"];?></a>
		<?php endforeach;?>
	</div>
<?php endif;?>