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
	$TemplateList['co_list'] =	array (
												'im_id'				=>'GetDataValue', 
												'ac_id'				=>'GetAgentData',
												'contr_name'		=>'GetDataValue',
												'contr_tel'			=>'GetDataValue',
												'susr_id'			=>'GetDataValue',
												'co_date'			=>'GetDateValue',
												'co_time'			=>'GetDataValue',
												'co_duration'		=>'GetDataValue',
												'org_id'			=>'GetDictValue',
												'4cdc3fe90b481'		=>'GetPropValueOnly',
												'4cdc4028c9231'		=>'GetPropValueOnly',
												'4cdc40356c8a2'		=>'GetPropValueOnly',
												'4cdc4041832b6'		=>'GetPropValueOnly',
												'4cdc4055b1d69'		=>'GetPropValueOnly',
												'4cdc4067d2ce5'		=>'GetPropValueOnly',
												'4ce2954671a56'		=>'GetPropValueOnly');
	
	
	$TemplateList['co_one'] =	array (
												'im_id'				=>'GetDataValue', 
												'ac_id'				=>'GetAgentData',
												'contr_name'		=>'GetDataValue',
												'contr_tel'			=>'GetDataValue',
												'susr_id'			=>'GetDataValue',
												'co_date'			=>'GetDateValue',
												'co_time'			=>'GetDataValue',
												'co_duration'		=>'GetDataValue',
												'org_id'			=>'GetDictValue',
												'PropList'			=>'GetPropListValueTextAd',
												'4cdc4028c9231'		=>'GetPropValueOnly',
												'4cdc40356c8a2'		=>'GetPropValueOnly',
												'4cdc4041832b6'		=>'GetPropValueOnly',
												'4cdc4055b1d69'		=>'GetPropValueOnly',
												'4cdc4067d2ce5'		=>'GetPropValueOnly',
												'4ce2954671a56'		=>'GetPropValueOnly');	
	
	$SettingTemplate['list_print'] = array('cr_date_from'=>array('cr_date_from','date'));
	
?>