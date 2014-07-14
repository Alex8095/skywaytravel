<div class="colomns">
	<div class="colomn white-bg w-650 content">
		<h1 class="TitleStandartPage">Услуги</h1>
		<table class="TableStandartCenterPage" cellpadding="0" cellspacing="0">
			<tr>
				<td class="SCPTdCenter">
					<?php if($Data):?>
						<div class="DivTableCP">
						<table class="TableInfo service-list" border="0" cellpadding="0" cellspacing="0">
							<?php foreach ($Data as $key => $value):?>
								<tr>
									<td class="TableInfoTdImage">
										<a class="ALinkInfo" href="/service/details/<?php echo $value['sc_id']?>" title="<?php echo $value['title']?>"><img src="<?php echo getLangString("imageDomain")?>/files/images/service/<?php echo $value['img']?>" width="140" alt="<?php echo $value['title']?>"/></a>
									</td>
									<td class="TableInfoTdDescription">
										<h4 class="link"><a class="ALinkInfo" href="/service/details/<?php echo $value['sc_id']?>" title="<?php echo $value['title']?>"><?php echo $value['title']?></a></h4>
										<?php echo $value['description']?></td>
								</tr>
							<?php endforeach;?>	
						</table>
						</div>
					<?php endif;?>
				</td>
			</tr>
		</table>
	</div>
	<div class="colomn white-bg w-240 content m-l-30">
		<?php echo appHtmlClass::partialAction("immovables", "partialListHot", array( "cashe" => 1, "itemWidth" => "w-240" )); ?>
	</div>
	<div class="clear"></div>
</div>