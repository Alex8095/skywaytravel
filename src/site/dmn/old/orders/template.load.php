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
require_once("../utils/cms.images.php"); 

#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}" );
if ($_GET ['print'] == 'print_order') {
	
	$where = "where o.status_id='4cff74fe92f10'";
	if ($_GET['status_id']) {
		$where = "where o.status_id='{$_GET['status_id']}'";
	}
	
	# 	Получаем содержимое текущей страницы
   		$cl_sel_pages = new mysql_select($tbl_order,
									   	 $where,
									     "ORDER BY date_add DESC");
		$cl_sel_pages -> select_table_query("select o.*, u.user_id, u.user_email, u.user_fio, u.user_phone_mobile
							  				from {$tbl['order']['name']} o
							  				left join users_site u on o.user_id = u.user_id
							  				{$where}
							  				order by date_add desc");
	# 	Получаем содержимое текущей страницы
   		$page = $cl_sel_pages -> table;	
	
	if (empty ( $page ))
		die ( "<br><b>По Вашему запросу ничего не найдено!</b>" );
	
		$Data = new dateClass();
	for($i = 0; $i < count ( $page ); $i ++) {
		$tRclass = "";
		if ($i % 2 != 0)
			$tRclass = "class=random";
		
		$dateStatus = '';
		if ($page[$i]['date_status'])
			$dateStatus = $Data->GetPeapleDateView($page[$i]['date_status']);
			$pagesReturn .= "<tr {$tRclass}>";
			$pagesReturn .= "<td><input type=\"radio\" value=\"{$page[$i]['order_id']}\" name=\"order_id\"/></td>";
			$pagesReturn .= "<td>{$page[$i]['order_id']}</td>";
			$pagesReturn .= "<td>{$page[$i]['user_fio']} | {$page[$i]['user_phone_mobile']}</td>";
			$pagesReturn .= "<td>{$page[$i]['user_email']}</td>";
			$pagesReturn .= "<td>{$page[$i]['user_adress']}</td>";
			$pagesReturn .= "<td>{$dictionaries->buld_table[$page[$i]['status_id']]['dict_name']}</td>";
			$pagesReturn .= "<td>".$Data->GetPeapleDateView($page[$i]['date_add'])."</td>";
			$pagesReturn .= "<td>".$dateStatus."</td>";
			$pagesReturn .= "<td>{$page[$i]['order_g_count']}</td>";
			$pagesReturn .= "<td>{$page[$i]['order_sum']}€</td>";
			$pagesReturn .= "</tr>";
	}
	
	$pagesReturnHeader = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table-list\">
								<tr class=\"headings\">
								    <td width=\"10\"></td>
									<td width=\"10\">№</td>
									<td width=\"150\">Name, telephone customer</td>
									<td width=\"150\">Email</td>
									<td width=\"200\">Delivery address</td>
									<td width=\"100\">Status order</td>
									<td width=\"100\">Date Added</td>
									<td width=\"100\">Date last status</td>
									<td width=\"100\">Quantity of tickets</td>
									<td width=\"100\">Sum</td>
								</tr>";
	$pagesReturnBottom = "</table>";
	
	$pagesReturn .=	"<input value=\"".substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?')+1, strlen($_SERVER['REQUEST_URI']))."\" name=\"requery_id\" type=\"hidden\" >";
	
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
    	
        