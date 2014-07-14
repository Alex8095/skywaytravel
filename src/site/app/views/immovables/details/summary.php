<?php if($Model->summary):?>
	<div id="summary-view"><?php echo wikiReplaceTextWordsToLink($Model->summary["im_su_text"])?></div>
<?php endif;?>