<?php
require_once '../utils/template.ajax/js.css.php';

#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}" );
#задаем айди значение справочника меню
$dictionaries->do_dictionaries ( 20 );
#перечень значение словаря новостей
$status_order_dct = $dictionaries->my_dct;

$selOrderPos = new mysql_select ( );
$selOrderPos->select_table_query ( "select o.*, u.user_id, u.user_email, u.user_fio, u.user_phone_mobile as user_tel
							  		from {$tbl['order']['name']} o
							  		left join users_site u on o.user_id = u.user_id
							  		where o.order_id = {$_POST['order_id']}" );
$OrderData = $selOrderPos->table [0];

$GoodsData = new mysql_select ( );
$GoodsData->select_table_query ( "select t.gt_id, t.gt_price, og.g_count as g_count, t.gt_price*og.g_count as g_prices, s.s_code, p.p_name as place, ca.cc_name as country, ci.cc_name as city, ga.ga_name, ga.ga_date, ga.ga_time
					  					 from goods_tickets t
					  					 left join sectors s on t.sectors_id = s.s_id
					  					 left join goods_action ga on ga.ga_id = t.ga_id
					  					 left join places p on ga.places_id	 = p.p_id
					  					 left join places_cc ca on ca.cc_id = p.p_country
					  					 left join places_cc ci on ci.cc_id = p.p_city 
					  					 join orders_goods og on og.cp_id = t.gt_id
					  					 join orders o on o.order_id = og.order_id
					  					 where o.order_id = {$OrderData['order_id']}" );

//
$gReturnH = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table-list\">
<tr class=\"headings\">
<td width=\"10\">ID</td>
<td width=\"200\">Action</td>
<td>Action Date(Time)</td>
<td width=\"200\">Place</td>
<td>Sector</td>
<td>Price</td>
<td width=\"70\">Sum</td>
<td width=\"70\">Count</td>
</tr>";
$gReturnB = "</table>";

foreach ( $GoodsData->table as $key => $value ) {
	$gReturn .= "<tr>";
		$gReturn .= "<td>{$value['gt_id']}</td>";
		$gReturn .= "<td>{$value['ga_name']}</td>";
		$gReturn .= "<td>{$value["ga_date"]} ({$value["ga_time"]})</td>";
		$gReturn .= "<td>{$value['place']} ({$value["country"]} | {$value["city"]})</td>";
		$gReturn .= "<td>{$value["s_code"]}</td>";
		$gReturn .= "<td>{$value['gt_price']}€</td>";
		$gReturn .= "<td>{$value['g_count']}</td>";
		$gReturn .= "<td>{$value['g_prices']}€</td>";
	$gReturn .= "</tr>";
}

$gReturn = $gReturnH.$gReturn.$gReturnB;

function sel_parent_id($arr, $sel = 'NULL', $name_id = 'pc_id', $echo_id = 'menu_words') {
	$str = NULL;
	for($i = 0; $i < count ( $arr ); $i ++) {
		$selecteOption = NULL;
		if ($sel)
			if ($sel == $arr [$i] [$name_id])
				$selecteOption = "selected=\"selected\"";
		$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
	}
	return $str;
}
?>
<div id="d-overflow">
<?php
#	подключение формы для редактирования
include_once 'template.edit/form.order.php';
?>
</div>
