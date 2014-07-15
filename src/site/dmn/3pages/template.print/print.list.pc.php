<?php
	$CLDate = new dateClass ( );
	$page 	= $selPageContentData->table;
	
	for($i = 0; $i < count ( $page ); $i ++) {
		$tRclass = "";
		if ($i % 2 != 0)
			$tRclass = "class=random";

		if($page[$i]['cp_image']) 
			$img = "<img src=\"/files/images/cp/{$page[$i]['cp_image']} width=\"70px\"/>\"";
		
		$pagesReturn .= "<tr {$tRclass}>";
			$pagesReturn .= "<td><input type=\"radio\" value=\"{$page[$i]['pc_id']}\" name=\"pc_id\"/></td>";
			$pagesReturn .= "<td>{$page[$i]['pc_id']}</td>";
			$pagesReturn .= "<td>{$page[$i]['p_w_menu']}</td>";
			$pagesReturn .= "<td>".substr(strip_tags($page[$i]['pc_text']), 0, 300)."</td>";
		$pagesReturn .= "</tr>";
	}
	
	$pagesReturnHeader = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table-list\">
								<tr class=\"headings\">
								    <td width=\"10\"></td>
								    <td width=\"10\">айди</td>
									<td width=\"150\">страница</td>
									<td width=\"\">текст</td>
								</tr>";
	$pagesReturnBottom = "</table>";
	
	$pagesReturn .=	"<input value=\"".substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?')+1, strlen($_SERVER['REQUEST_URI']))."\" name=\"requery_id\" type=\"hidden\" >";
	
	echo $pagesReturnHeader . $pagesReturn . $pagesReturnBottom;
	?>

