<?php global $routingObj; ?>
<?php if(count($Model->list) > 0): ?>
	<div class="list">
		<?php foreach ($Model->list as $key => $value):?>
			<div class="item">
				<a href="/tours/<?php echo $routingObj->getAction();?>/<?php echo $routingObj->getParamItem("page_id", 1);?>/<?php echo $value["url"]?>" title="<?php echo $value["name"]?>"><?php echo $value["name"]?></a>
			</div>
		<?php endforeach;?>
	</div>
<?php  else: ?>
	no position
<?php endif;?>	
