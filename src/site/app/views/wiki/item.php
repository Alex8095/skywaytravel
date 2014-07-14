<?php global $routingObj; ?>
<?php global $arWords;?>
<div class="colomns">
	<div class="colomn white-bg w-200 content m-r-30">
		<?php echo appHtmlClass::partialAction("wiki", "menu", array("active" => $Model->item["id"]))?>
	</div>
	<div class="colomn w-720">
		<div class="wiki-item">
			<?php echo appHtmlClass::partial("wiki/articleslist", array("Model" => $Model)); ?>
			<?php if($Model->immovablesList):?>
				<?php 
					$immovablesModel = new immovablesModelClass(new immovablesProviderClass("immovables"));
					$immovablesModel->buildDictionaries();
					$immovablesModel->list = $Model->immovablesList;
				?>
				<div class="immovables-mini-list white-bg content">
					<?php echo appHtmlClass::partial("immovables/list/listminiinline", array("Model" => $immovablesModel)); ?>
				</div>
			<?php endif;?>
		</div>
	</div>
	<div class="clear"></div>
</div>	