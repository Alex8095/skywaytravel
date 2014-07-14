<div class="header-page">
	<div class="contact-tel-list colomns">
		<p class="kyivstar colomn"><span>&nbsp;</span><?php echo getLangString("headerContactTelKyivstar")?></p>
		<p class="mtc colomn"><span>&nbsp;</span><?php echo getLangString("headerContactTelMtc")?></p>
		<p class="life colomn"><span>&nbsp;</span><?php echo getLangString("headerContactTelLife")?></p>
		<p class="city colomn"><span>&nbsp;</span><?php echo getLangString("headerContactTelCity")?></p>
		<div class="clear"></div>
	</div>
	<div class="inner colomns">
		<div class="colomn w-33-pro links">
			<a class="user-send-order" href="/index/mailas" title="<?php echo getLangString("userSendOrderTitle")?>"><span class="icon">&nbsp;</span><span class="text"><?php echo getLangString("userSendOrder")?></span></a>
			<a class="user-add-user-im" href="/addobject" title="<?php echo getLangString("user_add_user_im")?>"><span class="icon">&nbsp;</span><span class="text"><?php echo getLangString("user_add_user_im")?></span></a>
		</div>
		<div class="colomn w-33-pro center">
			<a class="logo" href="/" title="Alfabrok®"><img src="<?php echo getLangString("imageDomain")?>/files/images/bg/alfabrok.logo.png" width="220" height="117" alt="Alfabrok®"/></a>
		</div>
		<div class="colomn w-32-pro right">
			<div class="right-icon">
            	<a href="/immovables/novue" title="<?php echo getLangString("rss_channel_title")?>" class="bg-icons immovables-new">&nbsp;</a>
				<a target="_blank" class="bg-icons rss" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/rss" title="<?php echo getLangString("header_rss")?>"><?php echo getLangString("header_rss")?></a>
				<a target="_blank" class="bg-icons facebook" href="http://www.facebook.com/sharer/sharer.php?u=http://<?php echo $_SERVER['HTTP_HOST'];?>/<?php echo $appDataObj->social["fb"]->url;?>"><?php echo getLangString("header_facebook")?></a>
			</div>
   			<div class="clear"></div>
		</div>
   		<div class="clear"></div>
	</div>
</div>