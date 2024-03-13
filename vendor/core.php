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
	$user->status = 1;
	$user->squad = $postData['user-squad'];

	R::store($user);

	$userGetId = R::findOne('user', 'login = ?', array($postData['user-login']));

	print_r($userGetId['id']);

	$userArmorList = R::dispense('armorlist');

	$userArmorList->user_id = $userGetId['id']; 

	$userArmorList->armor_1 = $postData['user-armor-1'];
	$userArmorList->armor_2 = $postData['user-armor-2'];
	$userArmorList->armor_3 = $postData['user-armor-3'];

	$userArmorList->main_gun_1 = $postData['user-main-gun-1'];
	$userArmorList->main_gun_2 = $postData['user-main-gun-2'];
	$userArmorList->main_gun_3 = $postData['user-main-gun-3'];
	$userArmorList->main_gun_4 = $postData['user-main-gun-4'];
	$userArmorList->main_gun_5 = $postData['user-main-gun-5'];

	$userArmorList->second_gun_1 = $postData['user-second-gun-1'];
	$userArmorList->second_gun_2 = $postData['user-second-gun-2'];
	$userArmorList->second_gun_3 = $postData['user-second-gun-3'];

	R::store($userArmorList);

	header("Location: /pages/compound.php");

}

/*=======================================Посещаемость================================================*/

/*---------------------------------------Присутствовал-----------------------------------------------*/

if(isset($postData['attendance-was-btn'])){
	$user = R::findOne('user', 'id = ?', array($postData['attendance-userid']));
	$user->was += 1 ;
	R::store($user);

	header("Location: /pages/compound.php");
}

/*---------------------------------------Отсутствовал------------------------------------------------*/

if(isset($postData['attendance-wasnot-btn'])){
	$user = R::findOne('user', 'id = ?', array($postData['attendance-userid']));
	$user->wasnot += 1 ;
	R::store($user);

	header("Location: /pages/compound.php");
}

/*------------------------------------------Прогул---------------------------------------------------*/

if(isset($postData['attendance-hooky-btn'])){
	$user = R::findOne('user', 'id = ?', array($postData['attendance-userid']));
	$user->hooky += 1 ;
	$user->date_hooky = date("Y-m-d H:i:s");
	R::store($user);

	header("Location: /pages/compound.php");
}

/*-----------------------------------------Кикнуть---------------------------------------------------*/

if(isset($postData['attendance-delete-btn'])){
	$user = R::findOne('user', 'id = ?', array($postData['attendance-userid']));
	R::trash($user);

	header("Location: /pages/compound.php");
}

/*----------------------------------------В резерв---------------------------------------------------*/

if(isset($postData['attendance-reserve-btn'])){
	$user = R::findOne('user', 'id = ?', array($postData['attendance-userid']));
	$user->status = 2 ;
	$user->date_reserve = date("Y-m-d H:i:s");
	R::store($user);

	header("Location: /pages/compound.php");
}

/*--------------------------------------Вернуть с резерва---------------------------------------------*/

if(isset($postData['reserve-return-btn'])){
	$user = R::findOne('user', 'id = ?', array($postData['attendance-userid']));
	$user->status = 1;
	$user->date_reserve = date("Y-m-d H:i:s");
	R::store($user);

	header("Location: /pages/compound.php");
}

/*===========================================Сборы====================================================*/

/*-------------------------------------------Вклад----------------------------------------------------*/

if(isset($postData['tax-passed'])){

	$exchequer = R::findOne('exchequerlist', 'user_id = ?', array($postData['exchequer-id']));

	if($exchequer){
		$exchequer->user_id = $postData['exchequer-id'];
		$exchequer->tax_value += $postData['contribution-value']; 
		$exchequer->tax = 1;
		R::store($exchequer);	
	}else{

		$exchequer = R::dispense('exchequerlist');

		$exchequer->user_id = $postData['exchequer-id'];
		$exchequer->tax_value += $postData['contribution-value']; 
		$exchequer->tax = 1;
		R::store($exchequer);
	}

	header("Location: /pages/exchequer.php");
}

if(isset($postData['tax-failed'])){

	$exchequer = R::findOne('exchequerlist', 'user_id = ?', array($postData['exchequer-id']));

	if($exchequer){
		$exchequer->user_id = $postData['exchequer-id'];
		$exchequer->tax = 0; 
		R::store($exchequer);
	}else{

		$exchequer = R::dispense('exchequerlist');

		$exchequer->user_id = $postData['exchequer-id'];
		$exchequer->tax = 0; 
		R::store($exchequer);
	}

	header("Location: /pages/exchequer.php");
}

/*-------------------------------------------Норма----------------------------------------------------*/

if(isset($postData['weeklynorm-passed'])){

	$exchequer = R::findOne('exchequerlist', 'user_id = ?', array($postData['exchequer-id']));

	if($exchequer){
		$exchequer->user_id = $postData['exchequer-id'];
		$exchequer->weeklynorm = 1; 
		R::store($exchequer);
	}else{

		$exchequer = R::dispense('exchequerlist');

		$exchequer->user_id = $postData['exchequer-id'];
		$exchequer->weeklynorm = 1; 
		R::store($exchequer);
	}

	header("Location: /pages/exchequer.php");
}

if(isset($postData['weeklynorm-failed'])){

	$exchequer = R::findOne('exchequerlist', 'user_id = ?', array($postData['exchequer-id']));

	if($exchequer){
		$exchequer->user_id = $postData['exchequer-id'];
		$exchequer->weeklynorm = 0; 
		R::store($exchequer);
	}else{

		$exchequer = R::dispense('exchequerlist');

		$exchequer->user_id = $postData['exchequer-id'];
		$exchequer->weeklynorm = 0; 
		R::store($exchequer);
	}

	header("Location: /pages/exchequer.php");
}

/*------------------------------------------Варн---------------------------------------------------*/
if(isset($postData['rebuke-passed'])){

	$exchequer = R::findOne('exchequerlist', 'user_id = ?', array($postData['exchequer-id']));

	if($exchequer){
		$exchequer->user_id = $postData['exchequer-id'];
		$exchequer->rebuke += 1; 
		R::store($exchequer);
	}else{

		$exchequer = R::dispense('exchequerlist');

		$exchequer->user_id = $postData['exchequer-id'];
		$exchequer->rebuke += 1; 
		R::store($exchequer);
	}

	header("Location: /pages/exchequer.php");
}

/*------------------------------------------Перд---------------------------------------------------*/
if(isset($postData['pred-passed'])){

	$exchequer = R::findOne('exchequerlist', 'user_id = ?', array($postData['exchequer-id']));

	if($exchequer){
		$exchequer->user_id = $postData['exchequer-id'];
		$exchequer->pred += 1; 
		R::store($exchequer);
	}else{

		$exchequer = R::dispense('exchequerlist');

		$exchequer->user_id = $postData['exchequer-id'];
		$exchequer->pred += 1; 
		R::store($exchequer);
	}

	header("Location: /pages/exchequer.php");
}

/*===========================================Отряды==================================================*/

/*---------------------------------------Добавить в отряд--------------------------------------------*/
if(isset($postData['add-user-squad-btn'])){

	switch ($postData['position-user-squad']){
		case 1:
			$requestSquad = 'member_squad_1';
		break;

		case 2:
			$requestSquad = 'member_squad_2';
		break;

		case 3:
			$requestSquad = 'member_squad_3';
		break;

		case 4:
			$requestSquad = 'member_squad_4';
		break;

		case 5:
			$requestSquad = 'member_squad_5';
		break;
	}


		$squadRem = R::findOne( 'squad', 'member_squad_1 OR member_squad_2 OR member_squad_3 OR member_squad_4 OR member_squad_5 = ?', array($postData['add-user-squad-id']));

	foreach($squadRem as $squadRemRow){
	}

		if($squadRem['member_squad_1'] == $postData['add-user-squad-id']){
			echo "Юзера снесет с таблицы: member_squad_1";
			$squadRem->member_squad_1 = 0;
			R::store($squadRem);
		}elseif($squadRem['member_squad_2'] == $postData['add-user-squad-id']){
			echo "Юзера снесет с таблицы: member_squad_2";
			$squadRem->member_squad_2 = 0;
			R::store($squadRem);
		}elseif($squadRem['member_squad_3'] == $postData['add-user-squad-id']){
			echo "Юзера снесет с таблицы: member_squad_3";
			$squadRem->member_squad_3 = 0;
			R::store($squadRem);
		}elseif($squadRem['member_squad_4'] == $postData['add-user-squad-id']){
			echo "Юзера снесет с таблицы: member_squad_4";
			$squadRem->member_squad_4 = 0;
			R::store($squadRem);
		}elseif($squadRem['member_squad_5'] == $postData['add-user-squad-id']){
			echo "Юзера снесет с таблицы: member_squad_5";
			$squadRem->member_squad_5 = 0;
			R::store($squadRem);
		}else{
			
		}

	$squadAddUser = R::findOne('squad', 'id = ?', array($postData['add-user-squad-btn']));

	$squadAddUser->$requestSquad = $postData['add-user-squad-id'];

	R::store($squadAddUser);

	$userAddSquad = R::findOne('user', 'id = ?', array($postData['add-user-squad-id']));

	$userAddSquad->squad = $postData['add-user-squad-btn'];
	R::store($userAddSquad);
	
	header("Location: /pages/squad.php");
}

/*---------------------------------------Удалить с отряда--------------------------------------------*/

if(isset($postData['del-user-squad-btn'])){

	switch ($postData['position-user-squad']){
		case 1:
			$requestSquad = 'member_squad_1';
		break;

		case 2:
			$requestSquad = 'member_squad_2';
		break;

		case 3:
			$requestSquad = 'member_squad_3';
		break;

		case 4:
			$requestSquad = 'member_squad_4';
		break;

		case 5:
			$requestSquad = 'member_squad_5';
		break;
	}

	$squadDel = R::findOne('squad', 'id = ?', array($postData['del-user-squad-btn']));

	$squadDel->$requestSquad = 0;

	R::store($squadDel);

	$userDeleteSquad = R::findOne('user', 'id = ?', array($postData['add-user-squad-id']));

	$userDeleteSquad->squad = 0;
	R::store($userDeleteSquad);
	
	header("Location: /pages/squad.php");
}

/*--------------------------------------Настройка отряда--------------------------------------------*/

if(isset($postData['squad-setting-btn'])){
	$squadSetting = R::findOne('squad', 'id = ?', array($postData['squad-setting-btn']));

	$squadSetting->name_squad = $postData['squad-name'];
	$squadSetting->color_squad = $postData['squad-color'];
	$squadSetting->type_squad = $postData['squad-type'];
	$squadSetting->description_squad = $postData['squad-description'];

	R::store($squadSetting);

	header("Location: /pages/squad.php");
}

/*---------------------------------------Добавить отряд---------------------------------------------*/

if(isset($postData['squad-add-btn'])){

	$squadAdd = R::dispense('squad');

	$squadAdd->name_squad = $postData['squad-name'];
	$squadAdd->color_squad = $postData['squad-color'];
	$squadAdd->type_squad = $postData['squad-type'];
	$squadAdd->description_squad = $postData['squad-description'];

	$squadAdd->member_squad_1 = 0;
	$squadAdd->member_squad_2 = 0;
	$squadAdd->member_squad_3 = 0;
	$squadAdd->member_squad_4 = 0;
	$squadAdd->member_squad_5 = 0;

	R::store($squadAdd);
}

/*---------------------------------------Удалить отряд---------------------------------------------*/

if(isset($postData['squad-setting-del'])){

	$squadDelelte = R::findOne('squad', 'id = ?', array($postData['squad-setting-del']));

	R::trash($squadDelelte);

	header("Location: /pages/squad.php");
}

/*========================================Налог==========================================*/

	function calcNalog($n, $vp, $vk, $pp, $pk){
		$nalog = $n;		//налог $n
		$varnPrc = $vp;		//процент варна $vp
		$varnKol = $vk;		//колечество варнов $vk
		$PredPrc = $pp;		//процент преда $pp
		$PredKol = $pk;		//количество предов $pk
		$summNallog = 0;		//итого

		$summNallog = $nalog * (1 + ((($varnPrc * $varnKol) + ($PredPrc * $PredKol)) / 100));
		return $summNallog;
	}

	function calcNorma($ar, $g, $vp, $vk, $pp, $pk){
		$armor = $ar;		//армор $ar
		$gun = $g;          //ствол $g
		$nalog = 0;			//налог
		$varnPrc = $vp;		//процент варна $vp
		$varnKol = $vk;		//колечество варнов $vk
		$PredPrc = $pp;		//процент преда $pp
		$PredKol = $pk;		//количество предов $pk
		$summNallog = 0;		//итого

		$index = $ar + $g;

		if($index == 10){
			$nalog = 3000;
		}

		if($index == 9){
			$nalog = 1500;
		}

		if($index == 8){
			$nalog = 1500;
		}

		$summNallog = $nalog * (1 + ((($varnPrc * $varnKol) + ($PredPrc * $PredKol)) / 100));
		return $summNallog;
	}

/*=================================================Смена снаряги в профиле================================================*/

if(isset($postData['change-gun'])){
	switch($postData['change-gun-pos']){
		case 1:
			$recordСhangeGun = "main_gun_1";
			break;
		case 2:
			$recordСhangeGun = "main_gun_2";
			break;
		case 3:
			$recordСhangeGun = "main_gun_3";
			break;
		case 4:
			$recordСhangeGun = "main_gun_4";
			break;
		case 5:
			$recordСhangeGun = "main_gun_5";
			break;
	}
	$changeGun = R::findOne('armorlist', 'user_id = ?', array($postData['change-user-id']));
	$changeGun->$recordСhangeGun = $postData['change-gun'];
	R::store($changeGun);

	header("Location: /pages/user.php?id=".$postData['change-user-id']);
}

if(isset($postData['change-armor'])){
	switch($postData['change-armor-pos']){
		case 1:
			$recordСhangeGun = "armor_1";
			break;
		case 2:
			$recordСhangeGun = "armor_2";
			break;
		case 3:
			$recordСhangeGun = "armor_3";
			break;
	}
	$changeGun = R::findOne('armorlist', 'user_id = ?', array($postData['change-user-id']));
	$changeGun->$recordСhangeGun = $postData['change-armor'];
	R::store($changeGun);

	header("Location: /pages/user.php?id=".$postData['change-user-id']);
}
	
?>

