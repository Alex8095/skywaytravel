<?php
/*
 * Класс обработчик характеристик недвижимости @version class.catalog.php,v 1.0 2010/07/20 @author <AlexTsurkin/> @license GNU GPLv3
 */
class ImPropAdvaced {
	public $ClassPropList; // класс выборки характеристик каталога
	public $ClassDict; // класс справочника
	public $ClassPropInfo; // класс выборки характеристик выбранной недвижимости
	public $Form; // сформированные поля формы
	public $IsDmn; // флаг - формировать ли в админке
	public $HtmlClass; // класс css
	public $HtmlClassInput; // класс css
	public $NoSelectedValue; // значение не выбранного пункта в выпадающем списке
	public $saleStr;
	public $metro;
	public $printFieldsArray;
	public function __construct($ClassPropList = NULL, $ClassDict = NULL, $ClassPropInfo = NULL, $Form = NULL, $IsDmn = 1, $HtmlClass = 'zpForm', $HtmlClassInput = 'zpForm', $NoSelectedValue = '--select--') {
		$this->ClassPropList = $ClassPropList;
		$this->ClassDict = $ClassDict;
		$this->ClassPropInfo = $ClassPropInfo;
		
		$this->Form = $Form;
		$this->IsDmn = $IsDmn;
		$this->HtmlClass = $HtmlClass;
		$this->HtmlClassInput = $HtmlClassInput;
		$this->NoSelectedValue = $NoSelectedValue;
	}
	
	/*
	 * Функция: формирует поля формы, осуществляет обход по всем записям "выборки характеристик каталога" и вызывает функцию построение полей формы @param $this->ClassPropList - класс выборки характеристик каталога @param $this->ClassDict - класс справочника
	 */
	function ImPropListPrintField() {
		if (! $this->ClassPropList)
			return $this->Form = "<hr>ERROR! - no Prop List Class</hr>";
		if (! $this->ClassDict)
			return $this->Form = "<hr>ERROR! - no dictionaries class</hr>";
			// if()
		
		for($i = 0; $i < count ( $this->ClassPropList->table ); $i ++) {
			// азделение формирование формы от админ зоны, и сайта
			if ($this->IsDmn == 1) {
				$this->Form .= "<label class=\"{$this->HtmlClass}Label\">{$this->ClassPropList->table[$i]['im_prop_name']}</label>";
				$this->Form .= $this->BuildField ( $this->ClassPropList->table[$i] );
			} else {
				if ($this->ClassPropList->table[$i]['im_prop_style_id'] == '4c3ec331811b7') {
					if ($this->ClassPropList->table[$i]["im_prop_id"] != "4c400e6ac4be0") { // 4c455b949da66 4c4044f741d0a
						$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= "<div class=\"{$this->HtmlClass}DivFloat dropdown item-{$this->ClassPropList->table[$i]['im_prop_id']}\">";
						$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= "<label class=\"SearchFormLabelList\" onclick=\"javascript:FieldsetClickHideShowListCheckbox('#dlcm_{$this->ClassPropList->table[$i]['im_prop_id']}');\">{$this->ClassPropList->table[$i]['im_prop_name']}";
						$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= "<span class=\"ui-icon ui-icon-triangle-1-s\" id=\"dlcm_{$this->ClassPropList->table[$i]['im_prop_id']}_span\"></span>";
						$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= "</label>";
						$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= $this->BuildFieldSite ( $this->ClassPropList->table[$i] );
						$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= "</div>";
						$this->Form .= $this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]];
					} else {
						$this->metro = "<div class=\"{$this->HtmlClass}DivFloat dropdown item-{$this->ClassPropList->table[$i]['im_prop_id']}\">";
						$this->metro .= "<label class=\"SearchFormLabelList\" onclick=\"javascript:FieldsetClickHideShowListCheckbox('#dlcm_{$this->ClassPropList->table[$i]['im_prop_id']}');\">{$this->ClassPropList->table[$i]['im_prop_name']}";
						$this->metro .= "<span class=\"ui-icon ui-icon-triangle-1-s\" id=\"dlcm_{$this->ClassPropList->table[$i]['im_prop_id']}_span\"></span>";
						$this->metro .= "</label>";
						$this->metro .= $this->BuildFieldSiteColumnForParent ( $this->ClassPropList->table[$i] );
						$this->metro .= "</div>";
					}
				} elseif ($this->ClassPropList->table[$i]['im_prop_style_id'] == "4c3ec1f67fe11") {
					// флаг
					$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= "<div class=\"{$this->HtmlClass}DivFloat style-{$this->ClassPropList->table[$i]['im_prop_style_id']} item-{$this->ClassPropList->table[$i]['im_prop_id']}\">";
					$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= $this->BuildFieldSite ( $this->ClassPropList->table[$i] );
					$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= "<label class=\"{$this->HtmlClass}Label\">{$this->ClassPropList->table[$i]['im_prop_name']}</label>";
					$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= "</div>";
					$this->Form .= $this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]];
				} else {
					$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= "<div class=\"{$this->HtmlClass}DivFloat style-{$this->ClassPropList->table[$i]['im_prop_style_id']} item-{$this->ClassPropList->table[$i]['im_prop_id']}\">";
					$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= "<label class=\"{$this->HtmlClass}Label\">{$this->ClassPropList->table[$i]['im_prop_name']}</label>";
					$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= $this->BuildFieldSite ( $this->ClassPropList->table[$i] );
					$this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]] .= "</div>";
					$this->Form .= $this->printFieldsArray[$this->ClassPropList->table[$i]["im_prop_id"]];
				}
			}
		}
		return;
	}
	
	/*
	 * Функция: фунция исходя из стиля характеристики строит поля формы, если существует ее значения, подставляет их @param $ImPLid - данные характеристики @return
	 */
	function BuildField($ImPLid) {
		switch ($ImPLid['im_prop_style_id']) {
			// ыпадающий список
			case '4c3ec1f67fe1b' :
				{
					$inputTextValue = "";
					if ($this->ClassPropInfo->buld_table[$ImPLid['im_prop_id']]['im_prop_value_dict_id'])
						$inputTextValue = $this->ClassPropInfo->buld_table[$ImPLid['im_prop_id']]['im_prop_value_dict_id'];
					$this->ClassDict->do_dictionaries ( $ImPLid['ld_id'] );
					$ValueLdId = $this->ClassDict->my_dct;
					$this->Form .= "<select name=\"s_{$ImPLid['im_prop_id']}\" class=\"{$this->HtmlClass}\"><option value=\"\">{$this->NoSelectedValue}</option>";
					$this->Form .= $this->DictDropList ( $ValueLdId, $inputTextValue, 'dict_id', 'dict_name' );
					$this->Form .= "</select><br>";
					break;
				}
			// лаг
			case '4c3ec1f67fe11' :
				{
					$inputCheckbox = "";
					if ($this->ClassPropInfo->buld_table[$ImPLid['im_prop_id']])
						if ($this->ClassPropInfo->buld_table[$ImPLid['im_prop_id']]['im_prop_value'] == 'on')
							$inputCheckbox = "checked=\"checked\"";
					$this->Form .= "<input value=\"on\" name=\"c_{$ImPLid['im_prop_id']}\"  type=\"checkbox\" {$inputCheckbox} class=\"{$this->HtmlClass}\"/><br/><br/>";
					break;
				}
			// адио-кнопки
			case '4c3ec1f67fe12' :
				{
					
					break;
				}
			// егунок
			case '4c3ec331811b8' :
			case '4c3ec331811b6' :
				{
					$inputTextValue = "";
					if ($this->ClassPropInfo->buld_table[$ImPLid['im_prop_id']]['im_prop_value'])
						$inputTextValue = $this->ClassPropInfo->buld_table[$ImPLid['im_prop_id']]['im_prop_value'];
					$this->Form .= "<input class=\"{$this->HtmlClass}\" value=\"{$inputTextValue}\" size=\"40\" name=\"t_{$ImPLid['im_prop_id']}\" type=\"text\" /><br/>";
					break;
				}
			// ыпадающий блок
			case '4c3ec331811b7' :
				{
					$ImPropValue = "";
					if ($this->ClassPropInfo->buld_table[$ImPLid['im_prop_id']]['im_prop_value_dict_list'])
						$ImPropValue = $this->ClassPropInfo->buld_table[$ImPLid['im_prop_id']]['im_prop_value_dict_list'];
					$this->ClassDict->do_dictionaries ( $ImPLid['ld_id'] );
					$ValueLdId = $this->ClassDict->my_dct;
					$this->Form .= "<select name=\"m_{$ImPLid['im_prop_id']}[]\" size=\"5\" class=\"{$this->HtmlClass} zpFormWinxp_multiple\"  multiple=\"multiple\"><option value=\"\">{$this->NoSelectedValue}</option>";
					$this->Form .= $this->DictDropListBlock ( $ValueLdId, $ImPropValue, 'dict_id', 'dict_name' );
					$this->Form .= "</select><br>";
					break;
				}
			// оле ввода
			case '4c3ec3ad35af9' :
				{
					$inputTextValue = "";
					if ($this->ClassPropInfo->buld_table[$ImPLid['im_prop_id']]['im_prop_value'])
						$inputTextValue = $this->ClassPropInfo->buld_table[$ImPLid['im_prop_id']]['im_prop_value'];
					$this->Form .= "<input class=\"{$this->HtmlClass}\" value=\"{$inputTextValue}\" size=\"40\" name=\"t_{$ImPLid['im_prop_id']}\" type=\"text\" /><br/>";
					break;
				}
			default :
				die ( "NO VALUE STYLE FIELD STYLE" );
				break;
		}
	}
	function BuildFieldSiteColumnForParent($ImPLid) {
		switch ($ImPLid['im_prop_style_id']) {
			// ыпадающий список
			case '4c3ec331811b7' : {
				$name_id = 'm_' . $ImPLid['im_prop_id'];
				$ImPropValue = "";
				if (isset ( $this->ClassPropInfo[$name_id] )) {
					$ImPropValue = implode ( ' ', $this->ClassPropInfo[$name_id] );
				}
					
				$this->ClassDict->do_dictionaries ( $ImPLid['ld_id'] );
				$ValueLdId = $this->ClassDict->my_dct;
				if ($ImPLid["im_prop_id"] != "4c400e6ac4be0") {
					$tval .= $this->DictDropListCheckbox ( $ValueLdId, $ImPropValue, 'dict_id', 'dict_name', $name_id );
				} else {
					$this->metro .= $this->DictDropListCheckboxForColumnParent ( $ValueLdId, $ImPropValue, 'dict_id', 'dict_name', $name_id );
				}
				$this->printFieldsArray[$ImPLid["im_prop_id"]] .= $tval;
			}
		}
			
		return;
	}
	/*
	 * Функция: фунция исходя из стиля характеристики строит поля формы, если существует ее значения, подставляет их @param $ImPLid - данные характеристики @return
	 */
	function BuildFieldSite($ImPLid) {
		switch ($ImPLid['im_prop_style_id']) {
			// ыпадающий список
			case '4c3ec1f67fe1b' :
				{
					$name_id = 's_' . $ImPLid['im_prop_id'];
					$inputTextValue = "";
					if (isset ( $this->ClassPropInfo[$name_id] ))
						$inputTextValue = $this->ClassPropInfo[$name_id];
					$this->ClassDict->do_dictionaries ( $ImPLid['ld_id'] );
					$ValueLdId = $this->ClassDict->my_dct;
					$tval .= "<select name=\"s_{$ImPLid['im_prop_id']}\" class=\"{$this->HtmlClassInput}\"><option value=\"\">{$this->NoSelectedValue}</option>";
					$tval .= $this->DictDropList ( $ValueLdId, $inputTextValue, 'dict_id', 'dict_name' );
					$tval .= "</select>";
					$this->printFieldsArray[$ImPLid["im_prop_id"]] .= $tval;
					// $this->Form .= $tval;
					break;
				}
			// лаг
			case '4c3ec1f67fe11' :
				{
					$name_id = 'c_' . $ImPLid['im_prop_id'];
					$inputCheckbox = "";
					if (isset ( $this->ClassPropInfo[$name_id] ))
						$inputCheckbox = "checked=\"checked\"";
					$tval .= "<input value=\"on\" id=\"c_{$ImPLid['im_prop_id']}\" name=\"c_{$ImPLid['im_prop_id']}\"  type=\"checkbox\" {$inputCheckbox}/>";
					$this->printFieldsArray[$ImPLid["im_prop_id"]] .= $tval;
					// $this->Form .= $tval;
					break;
				}
			// адио-кнопки
			case '4c3ec1f67fe12' :
				{
					
					break;
				}
			// егунок
			case '4c3ec331811b6' :
				{
					$inputTextValue = "";
					$name_id = 'b_' . $ImPLid['im_prop_id'];
					if (isset ( $this->ClassPropInfo[$name_id] ))
						$inputTextValue = $this->ClassPropInfo[$name_id];
					$tval .= "<input class=\"{$this->HtmlClassInput}\" id=\"b_{$ImPLid['im_prop_id']}\" value=\"{$inputTextValue}\" size=\"40\" name=\"b_{$ImPLid['im_prop_id']}\" type=\"hidden\"/>";
					$tval .= $this->GetPropInputSlide ( $name_id, $ImPLid, $inputTextValue );
					
					$this->printFieldsArray[$ImPLid["im_prop_id"]] .= $tval;
					// $this->Form .= $tval;
					break;
				}
			// писок чекбоксов
			case '4c3ec331811b8' :
				{
					$name_id = 'l_' . $ImPLid['im_prop_id'];
					if (isset ( $this->ClassPropInfo[$name_id] )) {
						$inputValue = $this->ClassPropInfo[$name_id];
					}
					$messages = array(
							"1",
							"2",
							"3",
							"4+");
					for($k = 1; $k <= 4; $k ++) {
						$checked = "";
						if (! empty ( $inputValue ) && in_array ( "" . $k, $inputValue ))
							$checked = "checked='checked'";
						$tval .= "<label for='{$name_id}_$k' class='label-list-checkbox'>{$messages[$k - 1]}</label><input class='input-list-checkbox' id=\"{$name_id}_$k\" $checked value=\"$k\" name=\"{$name_id}[]\" type=\"checkbox\" />";
					}
					// $this->printFieldsArray[$ImPLid["im_prop_id"]] .= $tval;
					// $this->Form .= $tval;
				}
			// ыпадающий блок
			case '4c3ec331811b7' :
				{
					$name_id = 'm_' . $ImPLid['im_prop_id'];
					$ImPropValue = "";
					if (isset ( $this->ClassPropInfo[$name_id] )) {
						$ImPropValue = implode ( ' ', $this->ClassPropInfo[$name_id] );
					}
					
					$this->ClassDict->do_dictionaries ( $ImPLid['ld_id'] );
					$ValueLdId = $this->ClassDict->my_dct;
					if ($ImPLid["im_prop_id"] != "4c400e6ac4be0") {
						$tval .= $this->DictDropListCheckbox ( $ValueLdId, $ImPropValue, 'dict_id', 'dict_name', $name_id );
					} else {
						$this->metro .= $this->DictDropListCheckbox ( $ValueLdId, $ImPropValue, 'dict_id', 'dict_name', $name_id );
					}
					$this->printFieldsArray[$ImPLid["im_prop_id"]] .= $tval;
					// $this->Form .= $tval;
					// $this->Form .= "<select name=\"m_{$ImPLid['im_prop_id']}[]\" size=\"5\" class=\"{$this->HtmlClassInput}\" multiple=\"multiple\"><option value=\"\">{$this->NoSelectedValue}</option>";
					// $this->Form .= $this->DictDropListBlock($ValueLdId, $ImPropValue, 'dict_id', 'dict_name');
					// $this->Form .= "</select><br>";
					break;
				}
			// оле ввода
			case '4c3ec3ad35af9' :
				{
					$name_id = 't_' . $ImPLid['im_prop_id'];
					$inputTextValue = "";
					if (isset ( $this->ClassPropInfo[$name_id] ))
						$inputTextValue = $this->ClassPropInfo[$name_id];
					$tval .= "<input class=\"{$this->HtmlClassInput}\" value=\"{$inputTextValue}\" size=\"40\" name=\"t_{$ImPLid['im_prop_id']}\" type=\"text\"/>";
					$this->printFieldsArray[$ImPLid["im_prop_id"]] .= $tval;
					// $this->Form .= $tval;
					break;
				}
			default :
				die ( "NO VALUE STYLE FIELD STYLE" );
				break;
		}
	}
	
	/*
	 * Функция: фунция формирует список значений выпадающего списка, если существует ее значения, подставляет их @param $arr - @param $sel - @param $name_id - @param $echo_id - @return
	 */
	static function DictDropList($arr, $sel = 'NULL', $name_id = 'sc_id', $echo_id = 'menu_words') {
		$str = NULL;
		for($i = 0; $i < count ( $arr ); $i ++) {
			$selecteOption = NULL;
			if ($sel)
				if ($sel == $arr[$i][$name_id])
					$selecteOption = "selected=\"selected\"";
			$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
		}
		return $str;
	}
	
	/*
	 * Функция: фунция формирует список значений выпадающего блока, возможность выбора нескольких значений, если существует ее значения, подставляет их @param $arr - @param $sel - @param $name_id - @param $echo_id - @return
	 */
	function DictDropListBlock($arr, $ImPropValue, $name_id = 'sc_id', $echo_id = 'menu_words') {
		$ImPropValue = explode ( " ", $ImPropValue );
		$str = NULL;
		for($i = 0; $i < count ( $arr ); $i ++) {
			$selecteOption = NULL;
			if (! empty ( $ImPropValue )) {
				if (in_array ( $arr[$i][$name_id], $ImPropValue ))
					$selecteOption = "selected=\"selected\"";
			}
			
			$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
		}
		return $str;
	}
	function DictDropListCheckbox($arr, $ImPropValue, $name_id = 'sc_id', $echo_id = 'menu_words', $PropFatherId) {
		$ImPropValue = explode ( " ", $ImPropValue );
		$str = "<div class=\"DivSearchPosition\" id=\"dlc{$PropFatherId}\"><ul class=\"UlListCheckbox\">";
		for($i = 0; $i < count ( $arr ); $i ++) {
			$selecteOption = NULL;
			if (! empty ( $ImPropValue )) {
				if (in_array ( $arr[$i][$name_id], $ImPropValue ))
					$selecteOption = "checked=\"checked\"";
			}
			$str .= "<li><input type=\"checkbox\" name=\"{$PropFatherId}#{$i}#\" id=\"{$PropFatherId}-{$i}\" {$selecteOption} value=\"{$arr[$i][$name_id]}\"/><label for=\"{$PropFatherId}-{$i}\">{$arr[$i][$echo_id]}</label></li>";
		}
		$str .= "</ul></div>";
		return $str;
	}
	function DictDropListCheckboxForColumnParent($arr, $ImPropValue, $name_id = 'sc_id', $echo_id = 'menu_words', $PropFatherId) {
		$ImPropValue = explode ( " ", $ImPropValue );
		$str = "<div class=\"DivSearchPosition\" id=\"dlc{$PropFatherId}\">";
		$columns = array();
		for($i = 0; $i < count ( $arr ); $i ++) {
			$selecteOption = NULL;
			if (! empty ( $ImPropValue )) {
				if (in_array ( $arr[$i][$name_id], $ImPropValue ))
					$selecteOption = "checked=\"checked\"";
			}
			$columns[$arr[$i]["parent_id"]][] = "<li><input type=\"checkbox\" name=\"{$PropFatherId}#{$i}#\" id=\"{$PropFatherId}-{$i}\" {$selecteOption} value=\"{$arr[$i][$name_id]}\"/><label for=\"{$PropFatherId}-{$i}\">{$arr[$i][$echo_id]}</label></li>";
		}
		
		foreach ($columns as $key => $value) {
			$str .= "<ul class=\"UlListCheckbox ui-list-checkbox-parent-" . $key . "\">";
				foreach ($value as $ikey => $ivalue) {
					$str .= $ivalue;
				}
			$str .= "</ul>";
		}
		
		
		$str .= "<div class=\"clear\"></div></div>";
		return $str;
	}
	
	function GetPropInputSlide($nameId, $ImPLid, $ImPropValue) {
		$this->ClassDict->do_dictionaries ( $ImPLid['ld_id'] );
		$ValueLdId = $this->ClassDict->my_dct;
		if (empty ( $ValueLdId ))
			return;
		$SlideValueOne = $ValueLdId[0][dict_name];
		$SlideValueTwo = $ValueLdId[count ( $ValueLdId ) - 1][dict_name];
		// пересавляем значение если позиции не правильные
		if ($SlideValueOne > $SlideValueTwo) {
			$a = $SlideValueTwo;
			$SlideValueTwo = $SlideValueOne;
			$SlideValueOne = $a;
			$ValueLdId[0][dict_name] = $SlideValueOne;
			$ValueLdId[count ( $ValueLdId ) - 1][dict_name] = $SlideValueTwo;
		}
		if ($ImPropValue) {
			$ValueOne = substr ( $ImPropValue, 0, (strpos ( $ImPropValue, '-' ) - 1) );
			$ValueTwo = substr ( $ImPropValue, (strpos ( $ImPropValue, '-' ) + 1), strlen ( $ImPropValue ) );
		}
		
		$ret = sprintf ( '<label class="label-from">%s</label>
				<input class="input-from" id="from-%s" placeholder="%s" type="text" value="%s"/>
				<label class="label-to">%s</label>
				<input class="input-to" name="input" id="to-%s" placeholder="%s" type="text" value="%s"/>', getLangString ( "from" ), $nameId, $SlideValueOne, $ValueOne, getLangString ( "to" ), $nameId, $SlideValueTwo, $ValueTwo );
		return $ret;
		
		$return .= "<div class=\"SliderWidthAdvased\" id=\"slider-{$nameId}\"></div>";
		$return .= "<script type=\"text/javascript\">
						$(function() {
						$(\"#slider-{$nameId}\").slider({
							range: true,
							min: {$ValueLdId[0][dict_name]},
							max: {$ValueLdId[count($ValueLdId)-1][dict_name]},
							values: [{$SlideValueOne}, {$SlideValueTwo}],
							slide: function(event, ui) {
								precountfound();
								$(\"#{$nameId}\").val(ui.values[0] + ' - ' + ui.values[1]);
							}
						});
						$(\"#{$nameId}\").val($(\"#slider-{$nameId}\").slider(\"values\", 0) + ' - ' + $(\"#slider-{$nameId}\").slider(\"values\", 1));
						});
						</script>";
		return $return;
	}
}
?>