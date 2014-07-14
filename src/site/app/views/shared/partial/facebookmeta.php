<?php 
global $routingObj;
?>
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php echo $appDataObj->getTitle();?>" />
<meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'];?>/<?php echo $appDataObj->social["fb"]->url;?>" />
<meta property="og:image" content="<?php echo $appDataObj->social["fb"]->image;?>" />
<meta property="og:site_name" content="<?php echo getLangString("site_name")?>" />
<meta property="fb:admins" content="<?php echo $appDataObj->social["fb"]->id;?>" />
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&appId=875291065817780&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>
<script type="text/javascript">
  VK.init({apiId: 4443812, onlyWidgets: true});
</script>