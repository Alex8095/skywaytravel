<?php
global $renderHtmlLinkObj;
$renderHtmlLinkObj->addJs ( "js/libs/jquery.bxslider.min" );
$renderHtmlLinkObj->addJs ( "js/ant/libs/comparing" );
?>
<?php if(!empty($Model->list)): ?>
<div class="comparing-list">
	<div class="param-list">
		<div class="header"></div>
	</div>
   <div class="item-list">
		<ul id="comparing-sort" class="comparison-slider">
			<?php foreach ($Model->list as $key => $value) :?>
			 	<li class="slide ui-state-default" id="comparing-item-<?php echo $value["im_id"]?>">
			 		<a href="" id="comparing-remove-item-<?php echo $value["im_id"]?>" class="colp" tilte="<?php echo getLangString("comparingRemoveItemtitle");?>"><?php echo $value["im_id"]?> <?php echo getLangString("comparingRemoveItem");?></a>
			 	</li>
 			<?php endforeach;?>
		</ul>
	</div>
	<div class="clear"></div>
</div>
<?php else:?>
	<?php echo getLangString("comparingNoSelectedItems")?>
<?php endif;?>
