<?php
/*
 * $Articles ['страница'] 				= array('номер' => 'имя элемента гет')
 * $PageGetArticles ['press'] 			= array( 3 => 'dict_id', 4 => 'page', 5 => 'news_id' );
 */
/*
$PageGetArticles ['search'] 			= array( 3 => 'page' );
$PageGetArticles ['novosti'] 			= array( 3 => 'page', 4 => 'news_id' );
$PageGetArticles ['sovetu'] 			= array( 3 => 'page', 4 => 'news_id' );
$PageGetArticles ['yslygi'] 			= array( 3 => 'ct_id' );
$PageGetArticles ['stati'] 				= array( 3 => 'page', 4 => 'news_id' );
$PageGetArticles ['rss'] 				= array( 3 => 'type_rss', 4 => 'id');
*/
//$PageGetArticles ['account'] 			= array( 3 => 'active_page' );
//$PageGetArticles ['predpriyatie'] 		= array( 3 => 'active_page' );
//$PageGetArticles ['sovetchik'] 			= array( 3 => 'active_page' );
//$PageGetArticles ['my-cart'] 			= array( 3 => 'active_page' );


$routes ['home'] ['index'] = array (3 => 'page_id' );
$routes ['service'] ['details'] = array (3 => 'sc_id' );
$routes ['immovables'] ['details'] = array (3 => 'im_id' );
$routes ['immovables'] ['detailsbycode'] = array (3 => "category", 4 => 'im_code' );

$routes ['flat'] ['rent'] = array (3 => 'page_id', 4 => 'im_id' );
$routes ['flat'] ['sale'] = array (3 => 'page_id', 4 => 'im_id' );
$routes ['home'] ['rent'] = array (3 => 'page_id', 4 => 'im_id' );
$routes ['home'] ['sale'] = array (3 => 'page_id', 4 => 'im_id' );
$routes ['commercial'] ['rent'] = array (3 => 'page_id', 4 => 'im_id' );
$routes ['commercial'] ['sale'] = array (3 => 'page_id', 4 => 'im_id' );
$routes ['home'] ['rent'] = array (3 => 'page_id', 4 => 'im_id' );
$routes ['home'] ['sale'] = array (3 => 'page_id', 4 => 'im_id' );
$routes ['land'] ['rent'] = array (3 => 'page_id', 4 => 'im_id' );
$routes ['land'] ['sale'] = array (3 => 'page_id', 4 => 'im_id' );
$routes ['buildings'] ['rent'] = array (3 => 'page_id', 4 => 'im_id' );
$routes ['buildings'] ['sale'] = array (3 => 'page_id', 4 => 'im_id' );

$routes ['report'] ['printpage'] = array (3 => 'im_id' );
$routes ['report'] ['word'] = array (3 => 'im_id' );
$routes ['report'] ['pdf'] = array (3 => 'im_id' );
$routes ['report'] ['sendtofriend'] = array (3 => 'im_id' );
$routes ['images'] ['bg'] = array (3 => 'folder', 4 => 'img' );

$routes ['wiki'] ['item'] = array (3 => 'id' );
$routes ['vakansii'] ['index'] = array (3 => 'type_id' );
$routes ['vakansii'] ['item'] = array (3 => 'url' );

$routes ['addobject'] ['index'] = array (3 => 'im_id' );
$routes ['addobject'] ['harakteristiki'] = array (3 => 'im_id' );
$routes ['addobject'] ['izobrazheniya'] = array (3 => 'im_id' );
$routes ['addobject'] ['opisanie'] = array (3 => 'im_id' );

$routes ['imageservice'] ['getimagecolor'] = array (3 => 'image_id' );