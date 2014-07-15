<?php
error_reporting ( E_ALL & ~ E_NOTICE );
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );

// Устанавливаем соединение с базой данных
require_once (DOC_ROOT . "/config/config.php");
require_once (DOC_ROOT . "/dmn/utils/db_tables.inc");

// Подключаем блок авторизации
//require_once("../utils/security_mod.php");
// Подключаем SoftTime FrameWork
require_once (DOC_ROOT . "/config/class.inc");
define ( 'SLASH', '../../' );

function PrintTemplateModule($data) {
	$ret = '';
	for($i = 0; $i < count ( $data ); $i ++) {
		$ret [$data [$i] ['temp_id']] .= $data [$i] ['m_name'] . "<br>";
	}
	return $ret;
}

#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}" );
if ($_GET ['print'] == 'print_temp') {
	$ClTempCel = new mysql_select ( );
	$ClTempCel->select_table_query ( "SELECT m.*  FROM {$tbl_temp} m order by temp_id", 'temp_id' );
	
	if (empty ( $ClTempCel->table ))
		die ( "<br><b>По Вашему запросу ничего не найдено!</b>" );
	
	$ClTempHad = new catalogClass ( $ClTempCel->table, $ClTempCel->buld_table, 'temp_name', 'temp_id', 'parent_id' );
	$ClTempHad->get_arr_formation ();
	//echo "<pre>";
	//print_r($ClModHad->ArrFormation);
	//echo "</pre>";
	$ClTempModCel = new mysql_select ( );
	$ClTempModCel->select_table_query ( "SELECT tm.*, m.m_name  FROM {$tbl_temp_module} tm 
	  										left join {$tbl_modules} m on tm.m_id = m.m_id", 'tm_id' );
	
	$TempMod = PrintTemplateModule ( $ClTempModCel->table );
	for($i = 0; $i < count ( $ClTempHad->ArrFormation ); $i ++) {
		$tRclass = "";
		if ($i % 2 != 0)
			$tRclass = "class=random";
		$paddingLeft = $ClTempHad->ArrFormation [$i] [2] * 10 + 5;
		
		$pagesReturn .= "<tr {$tRclass}>";
		$pagesReturn .= "<td><input type=\"radio\" value=\"{$ClTempCel->buld_table[$ClTempHad->ArrFormation[$i][0]]['temp_id']}\" name=\"temp_id\"/></td>";
		$pagesReturn .= "<td>{$ClTempCel->buld_table[$ClTempHad->ArrFormation[$i][0]]['temp_id']}</td>";
		$pagesReturn .= "<td style=\"padding-left:{$paddingLeft}px\">{$ClTempCel->buld_table[$ClTempHad->ArrFormation[$i][0]]['temp_name']}</td>";
		$pagesReturn .= "<td>{$ClTempCel->buld_table[$ClTempHad->ArrFormation[$i][0]]['temp_s_name']}</td>";
		$pagesReturn .= "<td>{$ClTempCel->buld_table[$ClTempHad->ArrFormation[$i][0]]['temp_s_code']}</td>";
		$pagesReturn .= "<td>{$dictionaries->buld_table[$ClTempCel->buld_table[$ClTempHad->ArrFormation[$i][0]]['temp_type']]['dict_name']}</td>";
		$pagesReturn .= "<td>{$ClTempCel->buld_table[$ClTempHad->ArrFormation[$i][1]]['temp_name']}</td>";
		$pagesReturn .= "<td>{$TempMod[$ClTempHad->ArrFormation[$i][0]]}</td>";
		
		$pagesReturn .= "</tr>";
	}
	
	$pagesReturnHeader = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table-list\">
								<tr class=\"headings\">
								    <td width=\"10\"></td>
									<td width=\"10\">Id</td>
									<td width=\"250\">Название шаблона</td>
									<td width=\"\">Системное имя шаблона</td>
									<td width=\"150\">Код для вставки</td>
									<td width=\"100\">Тип модуля</td>
									<td>Родитель</td>
									<td>Подключаемые модули</td>
								</tr>";
	$pagesReturnBottom = "</table>";
	
	echo $pagesReturnHeader . $pagesReturn . $pagesReturnBottom;
	/*echo "<pre>";
		print_r($ClCertifPQ);
		echo "</pre>";
		$ModCerPropP = new ModuleSite($ModuleTemplate);
		$ModCerPropP -> SetValueToPrivateField('model_data', $ModelDataBT);
		$ImPagesContent = $ModCerPropP -> Handler_Template_Html('list_certificate', $ClCertifPQ->table, $SettingTemplate['list_print']);
		*/

}
?>
    	
        