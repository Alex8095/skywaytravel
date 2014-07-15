<?php
include_once '../config/config.php';
include_once 'utils/admin.panel.access/admin.panel.access.php';

$AdminAccess = new admin_panel_acess ( );

$enterData = $AdminAccess->enter_admin_panel ( $_POST );

$AdminAccess->location_enter ( $_COOKIE );
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Авторизация</title>
<link media="screen" href="utils/css/enterDmn.css" rel="stylesheet"
	type="text/css">

<script type="text/javascript" src="utils/js/jquery-1.3.2.js"></script>
<script type="text/JavaScript" src="utils/js/DD_roundies.js"></script>
<!-- ZAPATEC -->
<script type='text/javascript'
	src="utils/js/js-zapatec/utils/zapatec.js"></script>
<script type="text/javascript" src="utils/js/js-zapatec/lang/ru-utf8.js"></script>
<script type='text/javascript' src='utils/js/js-zapatec/src/form.js'></script>
<script type='text/javascript' src='utils/js/js-zapatec/form.js'></script>
<link href="utils/css/css.zapatec/zpcal.css" rel="stylesheet"
	type="text/css">
<link href="utils/css/css.zapatec/template.css" rel="stylesheet"
	type="text/css">
<link href="utils/css/css.zapatec/winxp.css" rel="stylesheet"
	type="text/css">

<script type="text/javascript">
//	ROUNDIES	
	DD_roundies.addRule('#EnterSubmit', '2px', true);
	DD_roundies.addRule('form', '2px', true);
	DD_roundies.addRule('.errOutput', '2px', true);
</script>

</head>
<body>
<div id="header"></div>
<div id="login">
<div class="acms"><img src="utils/images/bg/cms_bg.png" width="70"
	height="65"><span>A</span>CMS</div>
<div id='errOutput' class="errOutput"></div>
<form action="enterDmn/login.check.php" id='userForm'
	class="zpFormWinXP" method="POST">

<fieldset><label class='zpFormLabel'>Имя пользователя</label> <input
	class='zpFormRequired zpFormRequiredError="Введите\ пожалуйста\ логин!"'
	value="" size="40" name="admin_login" type="text"> <br />
<label class='zpFormLabel'>Пароль</label> <input
	class='zpFormRequired zpFormRequiredError="Введите\ пожалуйста\ пароль!"'
	value="" size="40" name="admin_password" type="password"> <br />
</fieldset>

<input value="Войти" id="EnterSubmit" name="Submit" onClick=""
	type="submit" class="button" /></form>
</div>
<div id="footer"></div>

<script type="text/javascript">
//	ZAPATEC
	Zapatec.Form.setupAll({
		showErrors: 'afterField',
		showErrorsOnSubmit: true,
		statusImgPos: null,
		submitErrorFunc: testErrOutput,
		asyncSubmitFunc: myOnFunctionAdd,
		busyConfig: {
			busyContainer: "userForm"
		}
		
	});
	checkIfLoadedFromHDD();
	function myOnFunctionAdd()
	{
		window.location = "/dmn/index.php"; 
	}
</script>
</body>
</html>
