<?php
class imageServiceController extends aControllerClass {
	public function getImageColor($param) {
		$result["tone"] = "light";
		$pathToImage = "http://img.alfabrok.ua/files/images/body-bg/jpg/" . $param["image_id"] . ".jpg";
		
		$img = new GeneratorImageColorPalette ();
		$result["colors"] = $img->getImageColor ( $pathToImage, 10, $image_granularity = 5 );
		
		$i = 0;
		foreach ( $result["colors"] as $key => $value ) {
			if (is_int ( $key )) {
				if (($key < 600000) && ($i < 2))
					$result["tone"] = "dark";
			}
			$i ++;
		}
		
		return $this->getJson ( $result );
	}
}