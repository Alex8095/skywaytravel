<?php global $routingObj; ?>
<?php 
	if($param["string_navigation"]) {
		$param["string_navigation"] = str_replace("~", " ", $param["string_navigation"]); 
		$param["string_navigation"] = str_replace("Z", "&", $param["string_navigation"]); 
		$param["string_navigation"] = str_replace("O", "?", $param["string_navigation"]); 
	}
	if($param["h"])
		$param["h"] = str_replace("~", " ", $param["h"]);
	$flag = true; 
	$active = $Model->item;
	$ret = "";
	if($param["string_navigation"])
		$ret = $param["string_navigation"];
	if(!empty($active)) {
		while($flag) {
			if(empty($ret))
				$link = sprintf('<span class="last">%s</span>', $active["p_title"]);
			else
				$link = sprintf('<a href="%s" class="sn-%s" title="%s">%s</a><span class="next">&nbsp;>&nbsp;</span>', $active["page_url"], str_replace("/", "", $active["page_url"]), $active["p_title"], $active["p_title"]);
			$ret = $link . $ret;
			if($active["page_id"] == "1000000000000") 
				$flag = false;	
			if($active["parent_id"])
				$active = $Model->listData[$active["parent_id"]];	
		}
	}
?>
<div class="string-navigation">
	<div class="str"><?php echo $ret;?></div>
	<?php if($param["h"]):?>
		<h1><?php echo $param["h"];?></h1>
	<?php endif;?>
	<div class="clear"></div>
</div>