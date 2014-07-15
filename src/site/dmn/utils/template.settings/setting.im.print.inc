<?php
/* Обработчики построения Html	
 * 
 * GetDataValue		-	значение поля
 * GetIndexImage	-	главное изображение
 * GetDictValue		-	значение справочника
 * GetPropValue		-	значение характеристики
 * GetPropListValue	-	значение списка характеристик
 * GetCurrentPrice	-	обработчик изминения цены
 * GetDateValue		-	преобразования даты
 * GetMap			-	карта 
 */
	$TemplateImList['flat']['sale'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'susr_id'			=>'GetDataValue',
												'im_prace'			=>'GetDataValue',
												'im_prace_sq'		=>'GetDataValue',
												'im_title'			=>'GetTitleValue',
												'im_space'			=>'GetDataValue',
												'im_rooms'			=>'GetDataValue',
												'4cb40c01a0dc7'		=>'GetPropValue',
												'4cb40c168e994'		=>'GetPropValue',
												'4cb40ca0a48be'		=>'GetPropValue',
												'4cb40c86e2714'		=>'GetPropValue');
	$TemplateImList['flat']['rent'] =	array  (
												'im_id'				=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'susr_id'			=>'GetDataValue',
												'im_prace_manth'	=>'GetDataValue',
												'im_title'			=>'GetTitleValue',
												'im_space'			=>'GetDataValue',
												'im_rooms'			=>'GetDataValue',
												'4cb40c01a0dc7'		=>'GetPropValue',
												'4cb40c168e994'		=>'GetPropValue',
												'4cb40ca0a48be'		=>'GetPropValue',
												'4cb40c86e2714'		=>'GetPropValue');						
	
	
	$TemplateImList['search'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prices'			=>'GetCurrentPrice',
												'im_prices_ni'		=>'GetCurrentPriceNoImage',
												'im_prace_sq'		=>'GetDataValue',
												'im_space'			=>'GetDataValue',
												'im_date_add'		=>'GetDateValue',
												'im_map'			=>'GetMap',
												'im_adress_flat'	=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'im_catalog_id'		=>'GetCatIm',
												'im_link' 			=>'GetLinkIm',
												'is_rent' 			=>'GetRentIm',
												'is_sale' 			=>'GetSaleIm',
												'im_region_id' 		=>'GetDictValue',
												'im_a_region_id' 	=>'GetDictValue',
												'im_space_value_id' =>'GetDictValue'
												);
																							
												
												
	$TemplateImOneData['im_Data']['rent'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_area_id'		=>'GetDictValue',
												'im_photo'			=>'GetDataValue',
												'im_price_table'	=>'GetCurrentManthPriceNoImage',
												'im_title'			=>'GetTitleValue',
												'im_space'			=>'GetDataValue', 
												'im_rooms'			=>'GetDataValue', 
												
												'4cb40ca0a48be'		=>'GetPropValue',
												'4cb40c86e2714'		=>'GetPropValue',

												'4cb40c01a0dc7'		=>'GetPropValue',
												'4cb40c168e994'		=>'GetPropValue',
												
												'im_prop_advaced'	=>'GetPropListTextS',
												'im_prop_standart'	=>'GetPropListValueText',
												'im_title'			=>'GetDataValue');												
	$TemplateImOneData['im_Data']['sale'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue',
												'im_area_id'		=>'GetDictValue',
												'im_photo'			=>'GetDataValue',
												'im_price_table'	=>'GetCurrentPriceNoImage',
												'im_title'			=>'GetTitleValue',
												'im_prace_sq'		=>'GetDataValue', 
												'im_space'			=>'GetDataValue', 
												'im_rooms'			=>'GetDataValue', 
												
												'4cb40ca0a48be'		=>'GetPropValue',
												'4cb40c86e2714'		=>'GetPropValue',

												'4cb40c01a0dc7'		=>'GetPropValue',
												'4cb40c168e994'		=>'GetPropValue',
													
												'im_prop_advaced'	=>'GetPropListTextS',
												'im_title'			=>'GetDataValue');	
												
	$TemplateImOneData['im_Data_map'] =	array ('im_city_id'			=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDataValue');	
												
	$TemplateImOneData['im_Data_mail'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_photo'			=>'GetDataValue',
												
												'im_adress_table'	=>'GetAdressTable',
												
												'im_price_table'	=>'GetCurrentPriceOne',
												'im_last_data'		=>'GetStandartTable',
												'im_prop_advaced'	=>'GetPropListWord',
												'im_prop_standart'	=>'GetPropListValueText');		
		
	$TemplateImList['favorites'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_photo'			=>'GetIndexImage',
												'im_city_id'		=>'GetDictValue',
												'im_adress_id'		=>'GetDictValue',
												'im_adress_house'	=>'GetDictValue',
												'im_prop_list'		=>'GetPropListValue',
												'im_prices'			=>'GetCurrentPrice',
												'im_prace_sq'		=>'GetDataValue',
												'im_space'			=>'GetDataValue',
												'im_date_add'		=>'GetDateValue',
												'im_map'			=>'GetMap',
												'is_rent' 			=>'GetRentIm',
												'is_sale' 			=>'GetSaleIm',
												);		
	$TemplateImList['DivListMinPrice'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_photo'			=>'GetDataValue',
												'im_title'			=>'GetDataValue', 
												'im_prace'			=>'GetDataValue',
												'im_link' 			=>'GetLinkIm',
												'im_title' 			=>'GetDataValue'
												);													
	$TemplateImList['DivListHotRent'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_photo'			=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'im_rooms'			=>'GetDataValue',
												'im_space'			=>'GetDataValue', 
												'im_prace_manth'	=>'GetDataValue',
												'im_link' 			=>'GetLinkIm',
												'im_title' 			=>'GetDataValue'
												);	
	
	$TemplateImList['DivListHotSale'] =	array (
												'im_id'				=>'GetDataValue', 
												'im_photo'			=>'GetDataValue',
												'im_title'			=>'GetDataValue',
												'im_rooms'			=>'GetDataValue',
												'im_space'			=>'GetDataValue', 
												'im_prace'			=>'GetDataValue',
												'im_link' 			=>'GetLinkIm',
												'im_title' 			=>'GetDataValue'
												);												
												
?>