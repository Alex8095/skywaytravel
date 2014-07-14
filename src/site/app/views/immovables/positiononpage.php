<?php global $routingObj; ?>
<?php $im_where_sort_and_order = sprintf("%s %s", $_COOKIE["im_where_sort"], $_COOKIE["im_where_sort_order"]);?>
<div class="immovables-list-settings">
	<ul class="sort bg-buttons">
	    <?php if ($im_where_sort_and_order == "im_prace asc"):?><li class="current"><a class="im_prace asc" rel='nofollow' href="" title="<?php echo getLangString("Fromcheapertomoreexpensive")?>"><?php echo getLangString("Fromcheapertomoreexpensive")?></a></li><?php endif;?>
	    <?php if ($im_where_sort_and_order == "im_prace desc"):?><li class="current"><a class="im_prace desc" rel='nofollow' href="" title="<?php echo getLangString("Frommoreexpensivetocheaper")?>"><?php echo getLangString("Frommoreexpensivetocheaper")?></a></li><?php endif;?>
	    <?php if ($im_where_sort_and_order == "im_space asc"):?><li class="current"><a class="im_space asc" rel='nofollow' href="" title="<?php echo getLangString("Fromlowtohigharea")?>"><?php echo getLangString("Fromlowtohigharea")?></a></li><?php endif;?>
	    <?php if ($im_where_sort_and_order == "im_space desc"):?><li class="current"><a class="im_space desc"  rel='nofollow' href="" title="<?php echo getLangString("Fromhightolowareas")?>"><?php echo getLangString("Fromhightolowareas")?></a></li><?php endif;?>
	    <?php if ($im_where_sort_and_order != "im_prace asc"):?><li class=""><a class="im_prace asc" rel='nofollow' href="" title="<?php echo getLangString("Fromcheapertomoreexpensive")?>"><?php echo getLangString("Fromcheapertomoreexpensive")?></a></li><?php endif;?>
	    <?php if ($im_where_sort_and_order != "im_prace desc"):?><li class=""><a class="im_prace desc" rel='nofollow' href="" title="<?php echo getLangString("Frommoreexpensivetocheaper")?>"><?php echo getLangString("Frommoreexpensivetocheaper")?></a></li><?php endif;?>
	    <?php if ($im_where_sort_and_order != "im_space asc"):?><li class=""><a class="im_space asc" rel='nofollow' href="" title="<?php echo getLangString("Fromlowtohigharea")?>"><?php echo getLangString("Fromlowtohigharea")?></a></li><?php endif;?>
	    <?php if ($im_where_sort_and_order != "im_space desc"):?><li class=""><a class="im_space desc"  rel='nofollow' href="" title="<?php echo getLangString("Fromhightolowareas")?>"><?php echo getLangString("Fromhightolowareas")?></a></li><?php endif;?>
	</ul>
	<ul class="count-on-page bg-buttons">
		<?php if ($_COOKIE["im_f_show_pnumber"] == "30"):?><li class="current"><a rel='nofollow' href="" title="30">30</a></li><?php endif;?>
		<?php if ($_COOKIE["im_f_show_pnumber"] == "50"):?><li class="current"><a rel='nofollow' href="" title="50">50</a></li><?php endif;?>
		<?php if ($_COOKIE["im_f_show_pnumber"] == "100"):?><li class="current"><a rel='nofollow' href="" title="100">100</a></li><?php endif;?>
		<?php if ($_COOKIE["im_f_show_pnumber"] != "30"):?><li class=""><a rel='nofollow' href="" title="30">30</a></li><?php endif;?>
		<?php if ($_COOKIE["im_f_show_pnumber"] != "50"):?><li class=""><a rel='nofollow' href="" title="50">50</a></li><?php endif;?>
		<?php if ($_COOKIE["im_f_show_pnumber"] != "100"):?><li class=""><a rel='nofollow' href="" title="100">100</a></li><?php endif;?>
	</ul>
	<a href="/<?php echo $routingObj->getController()?>/<?php echo $routingObj->getAction()?>" title="<?php echo getLangString("removeAllSettings")?>" class="remove-all-settings bg-buttons"><?php echo getLangString("removeAllSettings")?></a>
	<?php if(!empty($_COOKIE["comparing"])):?>
		<a href="/immovables/sravnenie" title="<?php echo getLangString("goToComparingList")?>" class="to-comparing-list bg-buttons"><?php echo getLangString("goToComparingList")?>: <span class="count"><?php echo count(json_decode($_COOKIE["comparing"], true)) ?></span></a>
	<?php endif;?>
	<div class="clear"></div>
</div>

<?php //devLogs::_printr($_COOKIE)?>
<!-- [im_where_sort] => im_prace
[im_where_sort_order] => desc
[im_f_show_pnumber] => 30
<li class=""><a rel='nofollow' href="" title="<?php echo getLangString("Fromcheapertomoreexpensivepersqm")?>"><?php echo getLangString("Fromcheapertomoreexpensivepersqm")?></a></li>
	    <li class=""><a rel='nofollow' href="" title="<?php echo getLangString("Frommoreexpensivetocheaperpersqm")?>"><?php echo getLangString("Frommoreexpensivetocheaperpersqm")?></a></li>
	    
    -->
<!-- 
<form class="FormImShow" action="" name="im_show" enctype="application/x-www-form-urlencoded">
	<label style="margin-left:20px;"><?php echo getLangString('ImTableListPnumberHeader');?></label>
	<input type="radio" name="im_f_show_pnumber" onchange="javascript:setStylePnumber('im_f_show_pnumber', 30);" <?php echo IsCookieCheck("im_f_show_pnumber", 30); ?> value="30"/><label>30</label>
	<input type="radio" name="im_f_show_pnumber" onchange="javascript:setStylePnumber('im_f_show_pnumber', 50);" <?php echo IsCookieCheck("im_f_show_pnumber", 50); ?> value="50"/><label>50</label>
	<input type="radio" name="im_f_show_pnumber" onchange="javascript:setStylePnumber('im_f_show_pnumber', 100);" <?php echo IsCookieCheck("im_f_show_pnumber", 100); ?> value="100"/><label>100</label>
	<a href="/index/mailas" class="ALinkSendOrder" title="<?php echo getLangString('user_send_order');?>"><span></span><?php echo getLangString('user_send_order');?></a>
	<a rel='nofollow' href="javascript:AddImPosition();" class="ALinkAddImIndex" title="<?php echo getLangString('user_add_im');?>"><span></span><?php echo getLangString('user_add_im');?></a>
</form>
 -->