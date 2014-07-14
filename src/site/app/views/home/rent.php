<?php global $routingObj; ?>
<?php global $exchangeRateObj; ?>
<?php echo appHtmlClass::partialActionFormat("immovables", "partialAdvancedSearchForm", $routingObj->getParam()); ?>
<div class="colomns">
	<div class="colomn w-782">
		<?php if($Model->list):?>
			<?php echo appHtmlClass::partial("immovables/positiononpage"); ?>
			<?php echo appHtmlClass::partial("home/rentlist", array("Model"=> $Model));?>		
		<?php else:?>
			<?php echo appHtmlClass::partial("immovables/immovablesnoposition"); ?>
			<!-- поиск возможных вариантов для вывода пользователю -->
			<?php $Model->getMayByList($routingObj->getParam (), "1",  "/home/rent"); ?>
			<?php if($Model->list):?>
				<?php echo getLangString("mayByYouMine");?>
				<?php echo appHtmlClass::partial("home/rentlist", array("Model"=> $Model));?>
			<?php endif;?>
		<?php endif;?>
	</div>
	<div class="colomn w-198"><?php echo appHtmlClass::partialActionFormat("immovables", "partialFilterSearchForm", $routingObj->getParam()); ?></div>
	<div class="clear"></div>
</div>
<script type="text/javascript">app["immovables"] = { "count" :  <?php echo $Model->provider->pager->total?>};</script>	
		