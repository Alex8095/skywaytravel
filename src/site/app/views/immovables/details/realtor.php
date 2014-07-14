<?php $realtor_id = (int) substr($Model->item["im_id"], strlen($Model->item["im_id"]) - 3, strlen($Model->item["im_id"]));?>
<?php $realtor_id = (int) ($realtor_id > getLangString("countRealtorImages") ? substr($realtor_id, 1, 2) : $realtor_id); ?>
<?php $realtor_id = ($realtor_id > 0 ? $realtor_id : 1); ?>
<div class="realtor">
	<div class="colomns">
		<div class="colomn w-130">
			<h4><?php echo getLangString("callToRealtor")?>:</h4>
			<p><?php echo getLangString("headerContactTelKyivstar")?></p>
			<p><?php echo getLangString("headerContactTelMtc")?></p>
			<p><?php echo getLangString("headerContactTelLife")?></p>
			<p><?php echo getLangString("headerContactTelCity")?></p>
			<h4 class="b"><?php echo getLangString("goToAgency")?>:</h4>
			<p><?php echo getLangString("agencyAdress")?></p>
		</div>
		<div class="colomn w-120"><img class="realtor-photo" src="<?php echo getLangString("imageDomain");?>/files/images/realtors/<?php echo $realtor_id;?>.png" alt="<?php echo getLangString("callToRealtor")?>" width="135"/></div>
		<div class="clear"></div>
	</div>
</div>