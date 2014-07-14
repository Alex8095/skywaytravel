<?php
class indexController extends aControllerClass {
	public function index($param) {
		return $this->View ( array(
				1,
				1,
				2) );
	}
	public function partners($param) {
		$model = new partnersModelClass ( new partnersProviderClass ( "partner" ) );
		$model->getList ( array(
				"hide" => "show") );
		return $this->View ( array(
				"Data" => $model->list) );
	}
	public function contacts($param) {
		return $this->view ();
	}
	public function mailas($param) {
		$model = new structureModelClass ( new structureProviderClass ( "pages" ) );
		$model->getItemId ( "mailAs" );
		return $this->View ( array(
				"Model" => $model->item) );
	}
	public function sendmail($param) {
		$response['success'] = false;
		if (! isset ( $_POST["email"] ))
			return $this->getJson ( $response );
		if (strpos ( $_POST["textmsq"], "url=http" ))
			return $this->getJson ( $response );
		try {
			$ClFileReader = new fileReaderClass ();
			$ClFileReader->get_file_content ( DOC_ROOT . '/app/includes/language/' . $_COOKIE[lang_code] . '/mail/', 'order.txt', 'cont' );
			$mailData = $ClFileReader->get_email_template ( $_POST );
			$mail = new PHPMailer ();
			$mail->From = "{$_POST["email"]}";
			$mail->CharSet = 'utf-8';
			$mail->FromName = "{$_POST["name"]}";
			$mail->AddAddress ( "info@alfabrok.ua" );
			$mail->IsHTML ( true );
			$mail->Subject = $mailData["subject"]; // тема письма
			$mail->Body = $mailData["msg"];
			// отправляем наше письмо
			if (! $mail->Send ())
				die ( 'Mailer Error: ' . $mail->ErrorInfo );
			$response['success'] = true;
		} catch ( Exception $ex ) {
			$response["error"] = $ex->getMessage ();
		}
		return $this->getJson ( $response );
	}
	public function immovablesinterested($param) {
		$response['success'] = false;
		if (! isset ( $_POST["email"] ))
			return $this->getJson ( $response );
		if ($_POST["nr"] != "y")
			return $this->getJson ( $response );
		if (strpos ( $_POST["textmsq"], "url=http" ))
			return $this->getJson ( $response );
		try {
			$ClFileReader = new fileReaderClass ();
			$ClFileReader->get_file_content ( DOC_ROOT . '/app/includes/language/' . $_COOKIE[lang_code] . '/mail/', 'immovablesinterested.txt', 'cont' );
			$mailData = $ClFileReader->get_email_template ( $_POST );
			$mail = new PHPMailer ();
			$mail->From = "{$_POST["email"]}";
			$mail->CharSet = 'utf-8';
			$mail->FromName = "{$_POST["name"]}";
			$mail->AddAddress ( "a.tsurkin@avtologistika.com" );
			//$mail->AddAddress ( "info@alfabrok.ua" );
			$mail->IsHTML ( true );
			$mail->Subject = ($_POST["titlemsq"] ? $_POST["titlemsq"] . ", " : "") . $_POST["im_code"]; // тема письма
			$mail->Body = $mailData["msg"];
			// отправляем наше письмо
			if (! $mail->Send ())
				die ( 'Mailer Error: ' . $mail->ErrorInfo );
			$response['success'] = true;
		} catch ( Exception $ex ) {
			$response["error"] = $ex->getMessage ();
		}
		return $this->getJson ( $response );
	}
}