<?php if($Model->imagesList):?>
	<div class="highslide-gallery">
		<?php foreach ($Model->imagesList as $key => $value):?>
			<a class="highslide" href="<?php echo getLangString("imageDomain");?>/files/images/immovables/<?php echo $value["im_photo_id"];?>.<?php echo $value["im_file_type"];?>" onclick="return hs.expand(this)" ><img src="<?php echo getLangString("imageDomain");?>/files/images/immovables/s_<?php echo $value["im_photo_id"];?>.<?php echo $value["im_file_type"];?>"/></a>
		<?php endforeach;?>
	</div>
<?php endif?>


<div id="pxs_container" class="pxs_container">
	<div class="pxs_bg">
		<div class="pxs_bg1"></div>
		<div class="pxs_bg2"></div>
		<div class="pxs_bg3"></div>
	</div>
	<div class="pxs_loading">Loading images...</div>
	<div class="pxs_slider_wrapper">
		<ul class="pxs_slider">
			<?php foreach ($Model->imagesList as $key => $value):?>
				<li><img src="<?php echo getLangString("imageDomain");?>/files/images/immovables/<?php echo $value["im_photo_id"];?>.<?php echo $value["im_file_type"];?>" alt="" /></li>
			<?php endforeach;?>
		</ul>
		<div class="pxs_navigation">
			<span class="pxs_next"></span>
			<span class="pxs_prev"></span>
		</div>
		<div class="close">x</div>
		<div class="counter"><?php echo getLangString("photoCounter");?> <span class="current">1</span>/<?php echo count($Model->imagesList); ?></div>
		<ul class="pxs_thumbnails">
			<?php $i = 0; ?>
			<?php foreach ($Model->imagesList as $key => $value):?>
				<?php //if($i < 20): ?>
					<li><img src="<?php echo getLangString("imageDomain");?>/files/images/immovables/s_<?php echo $value["im_photo_id"];?>.<?php echo $value["im_file_type"];?>" alt="" /></li>
				<?php //endif; ?>
				<?php $i++; ?>
			<?php endforeach;?>
		</ul>
	</div>
</div>

