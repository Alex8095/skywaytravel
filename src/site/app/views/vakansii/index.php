<?php global $routingObj; ?>
<div class="colomns">
	<div class="colomn white-bg w-200 content m-r-30">
		<?php echo appHtmlClass::partial("vakansii/menu", array("Model"=>$Model))?>
	</div>
	<div class="colomn w-690 white-bg content">
		<?php if($Model->list):?>
			<div class="vakansii-list sci">
				<?php foreach ($Model->list as $key => $value):?>
					<div class="item">
						<h2 class="title"><a href="/vakansii/item/<?php echo $value["url"]?>" title="<?php echo $value["title"]?>"><?php echo $value["title"]?></a></h2>
						<div class="desc"><?php echo $value["description"]?></div>
						<div class="more">
							<span class="date"><?php echo date("d.m.Y", strtotime($value["date"]))?></span>
							<a class="read-more" href="/vakansii/item/<?php echo $value["url"]?>" title="<?php echo $value["title"]?>"><?php echo getLangString("ReadMore");?></a>
							<div class="clear"></div>
						</div>
					</div>
				<?php endforeach;?>
			</div>
		<?php endif;?>
	</div>
	<div class="clear"></div>
</div>	