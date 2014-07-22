<?php if($Model->list): ?>
	<div class="visa-menu">
		<?php foreach ($Model->list as $key => $value):?>
			<a href="/service/visa/<?php echo $value["ct_url"]?>" title="/<?php echo $value["ct_title"]?>"><?php echo $value["ct_name"]?></a>
		<?php endforeach;?>
	</div>	
<?php endif;?>