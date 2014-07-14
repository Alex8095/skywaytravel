<?php global $routingObj; ?>
<?php if($Model->list):?>
	<div class="left-menu">
		<a class="<?php echo ($routingObj->getParamItem("im_id") == null ? "active" : $routingObj->getParamItem("active") == "index" ? "active" : "")?>" href="/addobject/index<?php echo ($routingObj->getParamItem("im_id") == null ? "" : "/" . $this->routingObj->getParamItem("im_id"))?>" title="Добавление недвижимости">Добавление недвижимости</a>
		<?php foreach ($Model->list as $key => $value):?>
			<a class="<?php echo ($value["action"] == $routingObj->getParamItem("active") ? "active" : "")?>" href="/addobject/<?php echo $value["action"];?>/<?php echo $routingObj->getParamItem("im_id")?>" title="<?php echo $value["p_w_menu"]?>"><?php echo $value["p_w_menu"]?></a>
		<?php endforeach;?>
	</div>
<?php endif;?>
