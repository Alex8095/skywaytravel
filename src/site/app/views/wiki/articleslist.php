<?php if($Model->articlesList):?>
	<div class="articles-list white-bg content m-b-20 ">
		<?php foreach ($Model->articlesList as $key => $value):?>
			<div class="item sci">
				<h2 class="title"><?php echo $value["wa_title"]?></h2>
				<div class="summary"><?php echo $value["wa_summary"]?></div>
			</div>
		<?php endforeach;?>
	</div>
<?php endif;?>