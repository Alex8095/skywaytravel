<?php if($Model->list): ?>
	<div class="colomns">
		<div class="colomn">
			<?php echo appHtmlClass::partial("/service/visa/menu", array("Model" => $Model)); ?>
		</div>
		<div class="colomn">
			<div class="list">
				<?php foreach ($Model->list as $key => $value):?>
					<div class="item">
						<a href="/service/visa/<?php echo $value["ct_url"]?>" title="/<?php echo $value["ct_title"]?>"><?php echo $value["ct_name"]?></a>
					</div>
				<?php endforeach;?>
			</div>	
		</div>
	</div>	
<?php else: ?>
	no date
<?php endif;?>