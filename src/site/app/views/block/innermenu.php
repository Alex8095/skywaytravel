<?php global $routingObj; ?>
<?php global $arWords; ?>
<?php if($Data):?>
	<?php echo $parent_id;?>
	<div class="inner-menu">
		<?php foreach ($Data as $key => $value):?>
			<?php if($value["p_type"] == "p_inner" && $value["parent_id"] == $parent_id) :?>
				<a class="<?php echo ($routingObj->getParamItem("controller") == $value["controller"] && $routingObj->getParamItem("action") == $value["action"] ?  "active" : "") ?>" id="pl-<?php echo $routingObj->getParamItem("html_block", "h"); ?>-<?php echo $value["controller"]; ?>-<?php echo $value["action"]; ?>" href="<?php echo $value["page_url"];?>" title="<?php echo $value["p_w_menu"];?>"><?php echo $value["p_w_menu"];?></a>
			<?php endif;?>
		<?php endforeach;?>
	</div>
<?php endif;?>