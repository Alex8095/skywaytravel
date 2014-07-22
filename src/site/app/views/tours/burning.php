<?php echo appHtmlClass::partial("tours/formsearch", array("Model" => $Model));?>
<div class="columns">
	<div class="column"><?php echo appHtmlClass::partial("tours/filter", array("Model" => $Model));?></div>
	<div class="column"><?php echo appHtmlClass::partial("tours/list", array("Model" => $Model, "type" => "burning"));?></div>
	<div class="clear"></div>
</div>
