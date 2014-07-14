<?php
global $renderHtmlLinkObj;
$renderHtmlLinkObj->addJs("js/ant/libs/index");
?>
<div class="main-slider colomns">
	<div class="item colomn flat">
		<a href="/flat" class="link" title="<?php echo getLangString("flat_title")?>"><span class="code im_icon_flat">&nbsp;</span></a>
		<h1>
			<a href="/flat" class="type" title="<?php echo getLangString("flat_title")?>"><?php echo getLangString("flat")?></a>
			<a href="/flat/sale" class="sale" title="<?php echo getLangString("flat_title")?>"><?php echo getLangString("ImSale")?></a>
			<a href="/flat/rent" class="rent" title="<?php echo getLangString("flat_title")?>"><?php echo getLangString("ImRent")?></a>
		</h1>
	</div>
	<div class="item colomn home">
		<a href="/home" class="link" title="<?php echo getLangString("home_title")?>"><span class="code im_icon_home">&nbsp;</span></a>
		<h1>
			<a href="/home" class="type" title="<?php echo getLangString("home_title")?>"><?php echo getLangString("home")?></a>
			<a href="/home/sale" class="sale" title="<?php echo getLangString("home_title")?>"><?php echo getLangString("ImSale")?></a>
			<a href="/home/rent" class="rent" title="<?php echo getLangString("home_title")?>"><?php echo getLangString("ImRent")?></a>
		</h1>
	</div>
	<div class="clear"></div>
	<div class="item colomn commercial">
		<a href="/commercial" class="link" title="<?php echo getLangString("commercial_title")?>"><span class="code im_icon_commercial">&nbsp;</span></a>
		<h1>
			<a href="/commercial" class="type" title="<?php echo getLangString("commercial_title")?>"><?php echo getLangString("commercial")?></a>
			<a href="/commercial/sale" class="sale" title="<?php echo getLangString("commercial_title")?>"><?php echo getLangString("ImSale")?></a>
			<a href="/commercial/rent" class="rent" title="<?php echo getLangString("commercial_title")?>"><?php echo getLangString("ImRent")?></a>
		</h1>
	</div>
	<div class="item colomn land">
		<a href="/land" class="link" title="<?php echo getLangString("land_title")?>"><span class="code im_icon_land">&nbsp;</span></a>
		<h1>
			<a href="/land" class="type" title="<?php echo getLangString("land_title")?>"><?php echo getLangString("land")?></a>
			<a href="/land/sale" class="sale" title="<?php echo getLangString("land_title")?>"><?php echo getLangString("ImSale")?></a>
			<a href="/land/rent" class="rent" title="<?php echo getLangString("land_title")?>"><?php echo getLangString("ImRent")?></a>
		</h1>
	</div>
	<div class="clear"></div>
</div>