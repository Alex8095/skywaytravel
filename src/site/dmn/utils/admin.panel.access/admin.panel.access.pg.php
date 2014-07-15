<?php
class admin_panel_acess_pg
{
	public $userData;
	public $errorWords;
	public $location;
	public $errorRequery;
	
	public function __construct($userData 	= NULL,
 								$errorWords	= array('error_user_login'		=> 'Неверное имя пользователя.',
 													'error_user_pass'		=> 'Неверный пароль.',
 													'error_user_lp'			=> 'Не все поля заполнены.'
 								),
 								$location 	= array('address_input' => '"Location: {$_SERVER[HTTP_HOST]}"', 
 													'transition_direction'	=> 'Location: ../dmn/pages/'),
 								$errorRequery = array('fieldErrors' => ''))
	{
		$this->userData		= $userData;
		$this->errorWords	= $errorWords;
		$this->location		= $location;	
		$this->errorRequery	= $errorRequery;		
	}		
	
	#выборка с БД
	public function pg_query($requeryWhere)
	{
		$query 		= "SELECT * FROM web_accounts {$requeryWhere}";
		$sql_query 	= pg_query($query);
		if(!$sql_query) die(pg_last_error()."".$query."Ошибка select system_accounts");
		return pg_fetch_array($sql_query);
	}
	
	#вход в админ панель
		public function enter_admin_panel($postData)
		{
			#проверка существования всех данных
				if(empty($postData['admin_login']) and empty($postData['admin_password'])) $this->errorRequery['fieldErrors']['admin_login'] = $this->errorWords['error_user_lp'];
				else 
				{
					$UserData = $this->pg_query("WHERE login='{$postData['admin_login']}'");
				
					#выполняем проверку имени пользователя, если не существует пользователя выводим сообщение
					if(!$UserData)	$this->errorRequery['fieldErrors']['admin_login'] = $this->errorWords['error_user_login'].$UserData['login'];
					else 
					{
						#выполняем проверку пароля данного пользователя, если имя пользователя не соответствует паролю выводим сообщение
						if(trim ($UserData['password']) != md5($postData['admin_password'])) $this->errorRequery['fieldErrors']['admin_password'] = $this->errorWords['error_user_pass'];
						else 
						{
							#даем положительный ответ обработчику, записываем кукис
								$this->errorRequery['success'] = true;
								$postData['id_account'] = $UserData['id_account'];
								$postData['rool'] = $UserData['rool'];
								$postData['org_id'] = $UserData['org_id'];
								$this->set_admin_cookie($postData);	
						}
					}
				}
				return;
		}
	
	#записываем кукис
	public function set_admin_cookie($userData) {
		setcookie('admin_login', $userData['admin_login'], 0, '/');							
		setcookie('admin_password', $userData['admin_password'], 0, '/');
		setcookie('id_account', $userData['id_account'], 0, '/');
		setcookie('rool', $userData['rool'], 0, '/');	
		setcookie('org_id', $userData['org_id'], 0, '/');		
	}
	
	#проверка записаних кукис, и перенаправление на дерикторию в панели управления
	public function location_enter($cookieData) {
		
		if(isset($cookieData['admin_password']) and isset($cookieData['admin_password']))  {
			$cookieData['admin_password'] = md5($cookieData['admin_password']);
			if($this->pg_query("WHERE login='{$cookieData['admin_login']}' AND password='{$cookieData['admin_password']}'")) return header($this->location['transition_direction']);
		}
		return;
	}
	
	#функция проверки доступности к панели управления
	public function protection_admin_panel($cookieData)
	{
		if(isset($cookieData['admin_password']) and isset($cookieData['admin_password']))  {
			$cookieData['admin_password'] = md5($cookieData['admin_password']);
			if(!$this->pg_query("WHERE login='{$cookieData['admin_login']}' AND password='{$cookieData['admin_password']}'")) return header("Location: http://".$_SERVER[HTTP_HOST]."");
			else return;
		}
		else {
			header("Location: http://".$_SERVER[HTTP_HOST]."");
		}
	}
	
}
?>