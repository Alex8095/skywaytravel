<?php
global $routingObj;
?>
<?php echo appHtmlClass::partialAction("immovables", "search", array("id" => str_replace(" ", "", $routingObj->getParamItem("text")), "canRedirect" => "none"));?>
<!-- results -->
<div id="ya-site-results" onclick="return {'tld': 'ru', 'language': 'ru', 'encoding': 'utf-8', 'htmlcss': '1.x', 'updatehash': true}"></div><script type="text/javascript">(function(w,d,c){var s=d.createElement('script'),h=d.getElementsByTagName('script')[0];s.type='text/javascript';s.async=true;s.charset='utf-8';s.src='http://site.yandex.net/v2.0/js/all.js';h.parentNode.insertBefore(s,h);(w[c]||(w[c]=[])).push(function(){Ya.Site.Results.init()})})(window,document,'yandex_site_callbacks');</script>