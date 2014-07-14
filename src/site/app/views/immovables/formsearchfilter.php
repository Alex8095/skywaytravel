<?php global $routingObj; ?>
<?php global $arWords; ?>
<?php 
	global $renderHtmlLinkObj; 
	global $formSearchModel;
	$filter = $formSearchModel->PrintPropFormSt->Form . $formSearchModel->PrintPropFormAd->Form;
	$filter = str_replace('name="', 'name="filter-', $filter);
	$filter = str_replace('id="', 'id="filter-', $filter);
	$filter = str_replace('#dlcm_', '#filter-dlcm_', $filter);
	$filter = str_replace("id='", "id='filter-", $filter);
?>
<div class="search-filter">
	<div class="h bg-blocks">&nbsp;</div>
	<div class="c">
		<form action="" name="searchFilterForm" id="searchFilterForm">
			<?php echo $filter;?>
			<a href="" class="submit bg-buttons" rel="nofollow" title="<?php echo getLangString("подобрать")?>"><?php echo getLangString("подобрать")?></a>
		</form>
		<div class="clear"></div>
	</div>
	<div class="f bg-blocks">&nbsp;</div>
	<div class="clear"></div>
</div>
