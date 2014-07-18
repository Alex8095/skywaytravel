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
	<?php foreach ($Data as $key => $value):?>
		<?php if($value["p_type"] == "p_index") :?>
			<div class="itemBlock">
				<a class="<?php echo ($routingObj->getParamItem("controller") == $value["controller"] && $routingObj->getParamItem("action") == $value["action"] ?  "active" : "") ?>" id="pl-<?php echo $routingObj->getParamItem("html_block", "h"); ?>-<?php echo $value["controller"]; ?>-<?php echo $value["action"]; ?>" href="<?php echo $value["page_url"];?>" title="<?php echo $value["p_w_menu"];?>"><?php echo $value["p_w_menu"];?></a>
				<?php echo appHtmlClass::partial("block/innermenu", array("Data" => $Data, "parent_id" => $value ["page_id"]));?>
			</div>
		<?php endif;?>
	<?php endforeach;?>
<?php endif;?>