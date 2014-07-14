<?php
global $routingObj;
global $arWords;
global $renderHtmlLinkObj;
$renderHtmlLinkObj->addJsFull ( "http://api-maps.yandex.ru/2.0/?load=package.full&mode=debug&lang=ru-RU" );
?>
<script type="text/javascript">
	ymaps.ready(ymInitImmovableOnMap);
</script>
<div id="divYScreen">
	<div id="map" style="width: 475px; height: 400px"></div>
	<div class="clear"></div>
	<div class="b bg-blocks">
		<a id="aShowPanorama" target="_blank" href="http://maps.yandex.ru/?text=<?php echo $Model->dictionaries->getItemValue($Model->item["im_city_id"]);?>, <?php echo $Model->dictionaries->getItemValue($Model->item["im_adress_id"]);?> <?php echo $Model->item["im_adress_house"]?>&ol=stv&oll=<?php echo $Model->item["im_geopos"];?>&ll=<?php echo $Model->item["im_geopos"];?>&l=map%2Cstv" class="AYPanorama"><span class="bg-icons">&nbsp;</span><?php echo getLangString("viewImYPanorama");?></a>
        <div class="border">&nbsp;</div>
        <a href="" rel="nofollow" id="hideFullOneMap"><span class="bg-icons">&nbsp;</span><?php echo getLangString("formYMapSearchFullScreenTitle");?></a>
		<div class="clear"></div>
	</div>
</div>
<!-- var linkPanorama = "http://maps.yandex.ru/?text=" + value +" &ol=stv&oll=" + this.get(0).getGeoPoint() +"&ll=" + this.get(0).getGeoPoint() + "&l=map%2Cstv"; -->