<div class="colomns">
	<div class="colomn white-bg w-650 content">
		<h1 class="TitleStandartPage"><?php echo $Data ["title"]?></h1>
		<table class="TableStandartCenterPage" cellpadding="0" cellspacing="0">
			<tr>
				<td class="SCPTdCenter">
					<table class="TableInfo" border="0" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td class="TableInfoTdImage"><img src="<?php echo getLangString ( "imageDomain" )?>/files/images/service/<?php echo $Data ['img']?>" alt="<?php echo $Data ['title']?>"/></td>
								<td class="TableInfoTdDescription">
								<div class="DivTableCP">
								<div><?php
								echo $Data ["summary"]?></div>
								</div>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</table>
	</div>
	<div class="colomn white-bg w-240 content m-l-30">
		<?php echo appHtmlClass::partialAction("immovables", "partialListHot", array( "cashe" => 1, "itemWidth" => "w-240" )); ?>
	</div>
	<div class="clear"></div>
</div>