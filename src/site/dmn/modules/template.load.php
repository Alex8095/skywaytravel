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

#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}" );
if ($_GET ['print'] == 'print_module') {
	$ClModCel = new mysql_select ( );
	$ClModCel->select_table_query ( "SELECT m.*  FROM modules m order by m_id", 'm_id' );
	
	if (empty ( $ClModCel->table ))
		die ( "<br><b>По Вашему запросу ничего не найдено!</b>" );
	
	$ClModHad = new catalogClass ( $ClModCel->table, $ClModCel->buld_table, 'm_name', 'm_id', 'parent_id' );
	$ClModHad->get_arr_formation ();
	//echo "<pre>";
	//print_r($ClModHad->ArrFormation);
	//echo "</pre>";
	

	for($i = 0; $i < count ( $ClModHad->ArrFormation ); $i ++) {
		$tRclass = "";
		if ($i % 2 != 0)
			$tRclass = "class=random";
		$paddingLeft = $ClModHad->ArrFormation [$i] [2] * 10 + 5;
		
		$pagesReturn .= "<tr {$tRclass}>";
		$pagesReturn .= "<td><input type=\"radio\" value=\"{$ClModCel->buld_table[$ClModHad->ArrFormation[$i][0]]['m_id']}\" name=\"m_id\"/></td>";
		$pagesReturn .= "<td>{$ClModCel->buld_table[$ClModHad->ArrFormation[$i][0]]['m_id']}</td>";
		$pagesReturn .= "<td style=\"padding-left:{$paddingLeft}px\">{$ClModCel->buld_table[$ClModHad->ArrFormation[$i][0]]['m_name']}</td>";
		$pagesReturn .= "<td>{$ClModCel->buld_table[$ClModHad->ArrFormation[$i][0]]['m_s_name']}</td>";
		$pagesReturn .= "<td>{$dictionaries->buld_table[$ClModCel->buld_table[$ClModHad->ArrFormation[$i][0]]['m_type']]['dict_name']}</td>";
		$pagesReturn .= "<td>{$ClModCel->buld_table[$ClModHad->ArrFormation[$i][1]]['m_name']}</td>";
		$pagesReturn .= "</tr>";
	}
	
	$pagesReturnHeader = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table-list\">
								<tr class=\"headings\">
								    <td width=\"10\"></td>
									<td width=\"10\">Id</td>
									<td width=\"350\">Название модуля</td>
									<td width=\"150\">Системное имя модуля</td>
									<td width=\"100\">Тип модуля</td>
									<td>Родитель</td>
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
    	
        