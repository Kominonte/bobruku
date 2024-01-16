<?php 

require_once("rb.php");
require_once("connect.php");

$postData = $_POST; //инфа с формы

/*==================================Регистрация===============================================*/

if(isset($postData['signup-btn'])){
	$errors = array();

	if(trim($postData['login']) == ''){
		$_SESSION['errors'] = 10;
		$errors[] = 10;
	}

	if(trim($postData['password']) == ''){
		$_SESSION['errors'] = 11;
		$errors[] = 11;
	}

	if(trim($postData['secondPassword']) == ''){
		$_SESSION['errors'] = 12;
		$errors[] = 12;
	}

	if(trim($postData['secondPassword']) != trim($postData['password']) ){
		$_SESSION['errors'] = 13;
		$errors[] = 13;
	}

	if(R::count('user', 'login = ?', array($postData['login'])) > 0){
		$_SESSION['errors'] = 14;
		$errors[] = 14;
	}

	/*--------------------------------------------------------
	Коды ошибок
		Нету логина = 10
		Нету пароля = 11
		Нету проверочного пароля = 12
		Пароли не совпали = 13
		Пользователь с таким логином уже существует = 14
		Пользователь не найден = 15
	----------------------------------------------------------*/

	if(empty($errors)){
		$user = R::dispense('user');
		$user->login = $postData['login'];
		$user->password = password_hash($postData['password'], PASSWORD_DEFAULT);
		$user->dateRegistration = date("Y-m-d H:i:s");
		R::store($user);

		$_SESSION['complete'] = 10;

	/*--------------------------------------------------------
	Коды успешной операци - complete
		Успешная геристрация = 10
	----------------------------------------------------------*/	

		header("Location: ../pages/signin.php");
	}else{
		header("Location: ../pages/signup.php");
	}
}
/*==================================Авторизация===============================================*/

if(isset($postData['signin-btn'])){
	$errors[] = array();

	if(trim($postData['login']) == ''){
		$_SESSION['errors'] = 10;
		$errors[] = 10;
	}

	if(trim($postData['password']) == ''){
		$_SESSION['errors'] = 11;
		$errors[] = 11;
	}

	$user = R::findOne('user', 'login = ?', array($postData['login']));

	if($user){	
		if(password_verify($postData['password'], $user->password)){
			$_SESSION['user'] = $user;

		}else{
			$_SESSION['errors'] = 13;
			$errors[] = 13;	
		}
	}else{
		$_SESSION['errors'] = 15;
			$errors[] = 15;	
	}

	if(empty($errors)){
		$_SESSION['errors'] = 0;
		header("Location: ../index.php");
	}
}


$user = R::findOne('user', 'id = ?', array($_SESSION['user']->id));

?>