<?php global $routingObj; ?>
<?php global $arWords;?>
<div class="colomns">
	<div class="colomn white-bg w-200 content m-r-30">
		<?php echo appHtmlClass::partial("vakansii/menu", array("Model"=>$Model))?>
	</div>
	<div class="colomn w-690 white-bg content">
		<div class="vakansii-item sci">
			<h1 class="title-page"><?php echo $Model->item["title"]?></h1>
			<div class="summary"><?php echo $Model->item["text"]?></div>
			<div class="more">
				<span class="date"><?php echo date("d.m.Y", strtotime($value["date"]))?></span>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>	

