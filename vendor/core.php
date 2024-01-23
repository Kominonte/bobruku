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
		$user->role = 1;
		$user->rank = 1;
		$user->squad = 0;

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
	$errors = array();

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
		header("Location: ../index.php");
	}else{
		header("Location: ../pages/signin.php");
	}
}
// Заносим объект user в сессию 

$user = R::findOne('user', 'id = ?', array($_SESSION['user']->id));


/*==================================Выход из профиля===============================================*/

if(isset($postData['logout-btn'])){
	unset($_SESSION['user']);
	header("Location: /");
}

/*===============================Проверка изображения армора========================================*/

function armorImgSecurity($armorImg){
	$name = $armorImg['name'];
	$type = $armorImg['type'];
	$size = $armorImg['size'];
	$blackList = array(".php",".js", ".html");

	foreach($blackList as $row){
		if(preg_match("/$row\$/i", $name)) return false;
	}

	if(($type != "image/png") && ($type != "image/jpg") &&  ($type != "image/jpeg")) return false;

	if($size > 5 * 1024 * 1024) return false;

	return true;
}

/*=============================Загрузка изображения армора=========================================*/

function loadArmorImg($armorImg, $armorDevName, $armorDir){
	$type = $armorImg['type'];
	$name = $armorDevName. '.' .substr($type, strlen("image/"));
	$uploadFile = $armorDir.$name;

	return $uploadFile;
}

/*==================================Загрузка армора================================================*/

if(isset($postData['armor-btn'])){

	$armorImg = $_FILES['armor-img'];
	$armorDevName = $postData['armor-dev-name'];

	if($postData['armor-type'] == 1){
		$armorDir = '../assets/gun/';
	}else{
		$armorDir = '../assets/armor/';
	}


	$equipment = R::dispense('equipment');
	$equipment->armor_type = $postData['armor-type'];
	$equipment->armor_name = $postData['armor-name'];
	$equipment->armor_dev_name = $postData['armor-dev-name'];
	$equipment->armomr_rank = $postData['armor-rank'];

	if(armorImgSecurity($armorImg)) {

		if(move_uploaded_file($armorImg['tmp_name'], loadArmorImg($armorImg, $armorDevName, $armorDir))){
			$equipment->armomr_img = loadArmorImg($armorImg, $armorDevName, $armorDir);
		}else{
			return false;
		}
	}

	$equipment->armor_did = $postData['armor-did'];
	$equipment->date = date("Y-m-d H:i:s");
	R::store($equipment);

	header("Location: /pages/add-armor.php");

}

/*==================================Добовления юзера================================================*/

if(isset($postData['add-user-btn'])){
	$user = R::dispense('user');
	$user->login = $postData['user-login'];
	$user->password = password_hash(111, PASSWORD_DEFAULT);
	$user->dateRegistration = date("Y-m-d H:i:s");
	$user->role = $postData['user-role'];
	$user->rank = $postData['user-rank'];

	$user->armor_1 = $postData['user-armor-1'];
	$user->armor_2 = $postData['user-armor-2'];
	$user->armor_3 = $postData['user-armor-3'];

	$user->main_gun_1 = $postData['user-main-gun-1'];
	$user->main_gun_2 = $postData['user-main-gun-2'];
	$user->main_gun_3 = $postData['user-main-gun-3'];
	$user->main_gun_4 = $postData['user-main-gun-4'];
	$user->main_gun_5 = $postData['user-main-gun-5'];

	$user->second_gun_1 = $postData['user-second-gun-1'];
	$user->second_gun_2 = $postData['user-second-gun-2'];
	$user->second_gun_3 = $postData['user-second-gun-3'];

	$user->squad = $postData['user-squad'];

	R::store($user);

	header("Location: /pages/add-user.php");

}

?>