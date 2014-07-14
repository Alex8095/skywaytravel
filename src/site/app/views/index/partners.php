<div class="colomns">
	<div class="colomn white-bg w-650 content">
		<h1 class="TitleStandartPage">Партнеры</h1>
		<table class="TableStandartCenterPage" cellpadding="0" cellspacing="0">
			<tr>
				<td class="SCPTdCenter">
					<?php if($Data):?>
						<?php foreach ($Data as $key => $value):?>
							<table cellpadding="0" cellspacing="0" border="0" class="">
								<tr>
									<td class="PartnerListImage"><img src="<?php echo getLangString("imageDomain")?>/files/partner/<?php echo $value['partner_logo']?>" alt="<?php echo $value['partner_name']?>"/></td>
									<td class="PartnerListText"><p class="PPName"><?php echo $value['partner_name']?></p><?php echo $value['partner_text']?></td>
								</tr>
							</table>
						<?php endforeach;?>
					<?php endif;?>
				</td>
			</tr>
		</table>
	</div>
	<div class="colomn white-bg w-240 content m-l-30">
		<?php echo appHtmlClass::partialAction("immovables", "partialListHot", array( "cashe" => 1 )); ?>
	</div>
	<div class="clear"></div>
</div>
