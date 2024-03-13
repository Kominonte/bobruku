<?php 
	require_once("../vendor/connect.php");
	require_once("../vendor/core.php");

	$userProfile = R::findOne('user', 'id = ?', array($_GET['id']));
	$armorlistProfile = R::findOne('armorlist', 'user_id = ?', array($_GET['id']));
	$exchequerProfile = R::findOne('exchequerlist', 'user_id = ?', array($_GET['id']));
	$squadProfile = R::findOne('squad', 'member_squad_1 OR member_squad_2 OR member_squad_3 OR member_squad_4 OR member_squad_5 = ?', array($_GET['id']));
	$userExchequer = R::findOne('exchequerlist', 'user_id = ?', array($_GET['id']));
	$armorProfileGun = R::findOne('equipment', 'id = ?', array($armorlistProfile['main_gun_1']));
	$armorProfileArmor = R::findOne('equipment', 'id = ?', array($armorlistProfile['armor_1']));
	$armorProfileSecond = R::findOne('equipment', 'id = ?', array($armorlistProfile['main_gun_2']));
	$listEquipment = R::findAll('equipment','armor_type = ?',  array(1));
	$listEquipmentArmor = R::findAll('equipment','armor_type = ?',  array(2));
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" sizes="128x128" href="../assets/logo/logo.jpeg">	
	<link rel='stylesheet' type='text/css' href='../css/menu.css'>
	<link rel='stylesheet' type='text/css' href='../css/user.css'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<title><?= $userProfile['login']?></title>
</head>
<body id="body">
	<!-- <img id="fon" src="../assets/background/fon1.jpeg"> -->
	<?php  require_once("../includs/menu.php");?>
	<div id="background-dark"></div>

	<div id="main">

	<?php
		$calcNalog = calcNalog(50000, 100, $exchequerProfile['rebuke'], 50, $exchequerProfile['pred']);
		$calcNorma = calcNorma($armorProfileGun['armomr_rank'], $armorProfileArmor['armomr_rank'], 100, $exchequerProfile['rebuke'], 50, $exchequerProfile['pred']);
	?>

	<?php if($exchequerProfile['tax'] == 0 && $exchequerProfile['weeklynorm'] == 0): ?>
		<div id="user-warning">
			<p id="user-warning-text">Необходимо сдать налог в количестве <b><?= $calcNalog ?></b> валюты и <b><?= $calcNorma ?></b> ноочастиц</p>
		</div>
	<?php elseif($exchequerProfile['tax'] == 0): ?>
		<div id="user-warning">
			<p id="user-warning-text">Необходимо сдать налог в количестве <b><?= $calcNalog ?></b> валюты</p>
		</div>
	<?php elseif($exchequerProfile['weeklynorm'] == 0): ?>
		<div id="user-warning">
			<p id="user-warning-text">Необходимо сдать налог в количестве <b><?= $calcNorma ?></b> ноочастиц</p>
		</div>
	<?php endif; ?>

		<div id="user-info">
			<label id="user-info-login"><?= $userProfile['login']?></label>
			<label id="user-info-rank-label">Звание</label>
			<label id="user-info-rank">
				<?php
					switch ($userProfile['rank']) {
						case 1:
							$userRank = 'Новобранец';
							break;
						case 2:
							$userRank = 'Рядовой';
							break;
						case 3:
							$userRank = 'Сержант';
							break;
						case 4:
							$userRank = 'Офицер';
							break;
						case 5:
							$userRank = 'Глава';
							break;	
					}

					print_r($userRank);
				?>
			</label>
			<label id="user-info-in-klan-date">В клане с <?= substr($userProfile['date_registration'], 0, -9)?></label>

			<label id="user-info-squad-label">Отряд</label>
				<?php
					switch ($userProfile['squad']) {
						case 0:
							$userSquadColor = '#162347';
							$userSquadName = 'Не распределен';
							$userSquadImg = '';
							break;

						case 1:
							$userSquadColor = '#db0000';
							$userSquadName = 'Main PVP';
							$userSquadImg = '/assets/icon/icon-attack.png';
							break;

						case 2:
							$userSquadColor = '#06135f';
							$userSquadName = 'Def 1';
							$userSquadImg = '/assets/icon/icon-tent.png';
							break;

						case 3:
							$userSquadColor = '#e74c3c';
							$userSquadName = 'Def 2';
							$userSquadImg = '/assets/icon/icon-tent.png';
							break;

						case 4:
							$userSquadColor = '#2da103';
							$userSquadName = 'Bio';
							$userSquadImg = '/assets/icon/icon-bio.png';
							break;
						}
			?>
			<label id="user-info-squad" style="background-color: <?= $squadProfile['color_squad']?>;background-image: url(<?= $userSquadImg ?>);"><?php print_r($userSquadName); ?></label>
			<label id="user-info-border"></label>

			<div>
				<div id="user-info-attendance-box">
					<label id="user-info-attendance-label">Участие на КВ</label>
					<label id="user-info-attendance-was">Был | <?= $userProfile['was'] ?></label>
					<label id="user-info-attendance-wasnot">Не был | <?= $userProfile['wasnot'] ?></label>
				</div>
				<div id="user-info-punishments-box">
					<label id="user-info-punishments-label">Наказания</label>
					<label id="user-info-punishments-warn">Варн | <?= $exchequerProfile['rebuke'] ?> из 3</label>
					<label id="user-info-punishments-pred">Пред | <?= $exchequerProfile['pred'] ?> из 3</label>
				</div>
				<label id="user-info-border"></label>
				<label id="user-info-exchequer-label">Общий взнос в казну </label>
				<label id="user-info-exchequer-value"><?= $userExchequer['tax_value'] ?></label>
			</div>
		</div>
		<div id="user-armor-kv">
			<label id="user-armor-kv-label">Армор для КВ</label>
			<div id="equipment-gun-box">
				<?php
					switch ($armorProfileGun['armomr_rank']) {
								case 3:
									$userGunRankColor = '#8d8dff';
									break;
								case 4:
									$userGunRankColor = '#d968c4';
									break;
								case 5:
									$userGunRankColor = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $userGunRankColor ?>;" id="equipment-gun-name"><?= $armorProfileGun['armor_name'] ?></span>
				<img id="equipment-gun-img" src="<?= $armorProfileGun['armomr_img']?>">
				
			</div>
			<div id="equipment-armor-box">
				<?php
					switch ($armorProfileArmor['armomr_rank']) {
								case 3:
									$userSecondGunRankColor = '#8d8dff';
									break;
								case 4:
									$userSecondGunRankColor = '#d968c4';
									break;
								case 5:
									$userSecondGunRankColor = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $userSecondGunRankColor ?>;" id="equipment-gun-name"><?= $armorProfileArmor['armor_name'] ?></span>
				<img id="equipment-armor-img" src="<?= $armorProfileArmor['armomr_img']?>">
			</div>

			<div id="equipment-second-gun-box">
				<?php
					switch ($armorProfileSecond['armomr_rank']) {
								case 3:
									$userArmorRankColor = '#8d8dff';
									break;
								case 4:
									$userArmorRankColor = '#d968c4';
									break;
								case 5:
									$userArmorRankColor = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $userArmorRankColor ?>;" id="equipment-gun-name"><?= $armorProfileSecond['armor_name'] ?></span>
				<img id="equipment-second-gun-img" src="<?= $armorProfileSecond['armomr_img']?>">
			</div>
		</div>

		<div id="user-armor">
			<label id="user-armor-label">Снаряга</label>
			<?php $armorProfileGun1 = R::findOne('equipment', 'id = ?', array($armorlistProfile['main_gun_1'])); ?>

			<div class="user-gun-box" id="gun-box-number-1" onclick="viewGun(1)">
				<?php
					switch ($armorProfileGun1['armomr_rank']) {
								case 3:
									$armorProfileGun1Color = '#8d8dff';
									break;
								case 4:
									$armorProfileGun1Color = '#d968c4';
									break;
								case 5:
									$armorProfileGun1Color = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $armorProfileGun1Color ?>;" class="user-gun-name"><?= $armorProfileGun1['armor_name'] ?></span>
				<img class="user-gun-img" src="<?= $armorProfileGun1['armomr_img'] ?>">
			</div>

			<div class="change-user-gun-box" id="change-user-gun-box-number-1">
			<?php
				foreach ($listEquipment as $listEquipmentRow) {

				switch ($listEquipmentRow['armomr_rank']) {
						case 3:
							$listEquipmentRowColor = '#8d8dff';
							break;
						case 4:
							$listEquipmentRowColor = '#d968c4';
							break;
						case 5:
							$listEquipmentRowColor = '#ff5767';
							break;	
					}	
		    ?>
		    <form action="/vendor/core.php" method="POST">
		    	<input type="hidden" name="change-user-id" value="<?= $_GET['id'] ?>">
		    	<input type="hidden" name="change-gun-pos" value="1">
			    <button type="submit" class="change-user-gun-button" 
			     style="color:<?= $listEquipmentRowColor ?>;" name="change-gun" 
			     value="<?= $listEquipmentRow['id'] ?>">   
			     	<?= $listEquipmentRow['armor_name']?>	
			    </button>
			</form>
			<?php } ?>
				
			</div>

			<?php $armorProfileGun2 = R::findOne('equipment', 'id = ?', array($armorlistProfile['main_gun_2'])); ?>

			<div class="user-gun-box" id="gun-box-number-2" onclick="viewGun(2)">
				<?php
					switch ($armorProfileGun2['armomr_rank']) {
								case 3:
									$armorProfileGun2Color = '#8d8dff';
									break;
								case 4:
									$armorProfileGun2Color = '#d968c4';
									break;
								case 5:
									$armorProfileGun2Color = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $armorProfileGun2Color ?>;" class="user-gun-name"><?= $armorProfileGun2['armor_name'] ?></span>
				<img class="user-gun-img" src="<?= $armorProfileGun2['armomr_img'] ?>">
			</div>

			<div class="change-user-gun-box" id="change-user-gun-box-number-2">
			<?php
				foreach ($listEquipment as $listEquipmentRow) {

				switch ($listEquipmentRow['armomr_rank']) {
						case 3:
							$listEquipmentRowColor = '#8d8dff';
							break;
						case 4:
							$listEquipmentRowColor = '#d968c4';
							break;
						case 5:
							$listEquipmentRowColor = '#ff5767';
							break;	
					}	
		    ?>
		    <form action="/vendor/core.php" method="POST">
		    	<input type="hidden" name="change-user-id" value="<?= $_GET['id'] ?>">
		    	<input type="hidden" name="change-gun-pos" value="2">
			    <button type="submit" class="change-user-gun-button" 
			     style="color:<?= $listEquipmentRowColor ?>;" name="change-gun" 
			     value="<?= $listEquipmentRow['id'] ?>">   
			     	<?= $listEquipmentRow['armor_name']?>	
			    </button>
			</form>
			<?php } ?>				
			</div>

			<?php $armorProfileGun3 = R::findOne('equipment', 'id = ?', array($armorlistProfile['main_gun_3'])); ?>

			<div class="user-gun-box" id="gun-box-number-3" onclick="viewGun(3)">
				<?php
					switch ($armorProfileGun3['armomr_rank']) {
								case 3:
									$armorProfileGun3Color = '#8d8dff';
									break;
								case 4:
									$armorProfileGun3Color = '#d968c4';
									break;
								case 5:
									$armorProfileGun3Color = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $armorProfileGun3Color ?>;" class="user-gun-name"><?= $armorProfileGun3['armor_name'] ?></span>
				<img class="user-gun-img" src="<?= $armorProfileGun3['armomr_img'] ?>">
			</div>

			<div class="change-user-gun-box" id="change-user-gun-box-number-3">
			<?php
				foreach ($listEquipment as $listEquipmentRow) {

				switch ($listEquipmentRow['armomr_rank']) {
						case 3:
							$listEquipmentRowColor = '#8d8dff';
							break;
						case 4:
							$listEquipmentRowColor = '#d968c4';
							break;
						case 5:
							$listEquipmentRowColor = '#ff5767';
							break;	
					}	
		    ?>
		    <form action="/vendor/core.php" method="POST">
		    	<input type="hidden" name="change-user-id" value="<?= $_GET['id'] ?>">
		    	<input type="hidden" name="change-gun-pos" value="3">
			    <button type="submit" class="change-user-gun-button" 
			     style="color:<?= $listEquipmentRowColor ?>;" name="change-gun" 
			     value="<?= $listEquipmentRow['id'] ?>">   
			     	<?= $listEquipmentRow['armor_name']?>	
			    </button>
			</form>
			<?php } ?>				
			</div>

			<?php $armorProfileGun4 = R::findOne('equipment', 'id = ?', array($armorlistProfile['main_gun_4'])); ?>

			<div class="user-gun-box" id="gun-box-number-4" onclick="viewGun(4)">
				<?php
					switch ($armorProfileGun4['armomr_rank']) {
								case 3:
									$armorProfileGun4Color = '#8d8dff';
									break;
								case 4:
									$armorProfileGun4Color = '#d968c4';
									break;
								case 5:
									$armorProfileGun4Color = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $armorProfileGun4Color ?>;" class="user-gun-name"><?= $armorProfileGun4['armor_name'] ?></span>
				<img class="user-gun-img" src="<?= $armorProfileGun4['armomr_img'] ?>">
			</div>

			<div class="change-user-gun-box" id="change-user-gun-box-number-4">
			<?php
				foreach ($listEquipment as $listEquipmentRow) {

				switch ($listEquipmentRow['armomr_rank']) {
						case 3:
							$listEquipmentRowColor = '#8d8dff';
							break;
						case 4:
							$listEquipmentRowColor = '#d968c4';
							break;
						case 5:
							$listEquipmentRowColor = '#ff5767';
							break;	
					}	
		    ?>
		    <form action="/vendor/core.php" method="POST">
		    	<input type="hidden" name="change-user-id" value="<?= $_GET['id'] ?>">
		    	<input type="hidden" name="change-gun-pos" value="4">
			    <button type="submit" class="change-user-gun-button" 
			     style="color:<?= $listEquipmentRowColor ?>;" name="change-gun" 
			     value="<?= $listEquipmentRow['id'] ?>">   
			     	<?= $listEquipmentRow['armor_name']?>	
			    </button>
			</form>
			<?php } ?>				
			</div>

			<?php $armorProfileGun5 = R::findOne('equipment', 'id = ?', array($armorlistProfile['main_gun_5'])); ?>

			<div class="user-gun-box" id="gun-box-number-5" onclick="viewGun(5)">
				<?php
					switch ($armorProfileGun5['armomr_rank']) {
								case 3:
									$armorProfileGun5Color = '#8d8dff';
									break;
								case 4:
									$armorProfileGun5Color = '#d968c4';
									break;
								case 5:
									$armorProfileGun5Color = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $armorProfileGun5Color ?>;" class="user-gun-name"><?= $armorProfileGun5['armor_name'] ?></span>
				<img class="user-gun-img" src="<?= $armorProfileGun5['armomr_img'] ?>">
			</div>

			<div class="change-user-gun-box" id="change-user-gun-box-number-5">
			<?php
				foreach ($listEquipment as $listEquipmentRow) {

				switch ($listEquipmentRow['armomr_rank']) {
						case 3:
							$listEquipmentRowColor = '#8d8dff';
							break;
						case 4:
							$listEquipmentRowColor = '#d968c4';
							break;
						case 5:
							$listEquipmentRowColor = '#ff5767';
							break;	
					}	
		    ?>
		    <form action="/vendor/core.php" method="POST">
		    	<input type="hidden" name="change-user-id" value="<?= $_GET['id'] ?>">
		    	<input type="hidden" name="change-gun-pos" value="5">
			    <button type="submit" class="change-user-gun-button" 
			     style="color:<?= $listEquipmentRowColor ?>;" name="change-gun" 
			     value="<?= $listEquipmentRow['id'] ?>">   
			     	<?= $listEquipmentRow['armor_name']?>	
			    </button>
			</form>
			<?php } ?>				
			</div>

			<label id="user-armor-armor-label"> Броня </label>
			<label id="user-second-gun-label"> Вторичка </label>

			<?php $armorProfileArmor1 = R::findOne('equipment', 'id = ?', array($armorlistProfile['armor_1'])); ?>

			<div class="user-armor-box" onclick="viewArmor(1)">
				<?php
					switch ($armorProfileArmor1['armomr_rank']) {
								case 3:
									$armorProfileArmor1Color = '#8d8dff';
									break;
								case 4:
									$armorProfileArmor1Color = '#d968c4';
									break;
								case 5:
									$armorProfileArmor1Color = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $armorProfileArmor1Color ?>;" class="user-armor-name"><?= $armorProfileArmor1['armor_name'] ?></span>
				<img class="user-armor-img" src="<?= $armorProfileArmor1['armomr_img'] ?>">
			</div>

			<div class="change-user-gun-box" id="change-user-armor-box-number-1">
			<?php
				foreach ($listEquipmentArmor as $listEquipmentArmorRow) {

				switch ($listEquipmentArmorRow['armomr_rank']) {
						case 3:
							$listEquipmentArmorRowColor = '#8d8dff';
							break;
						case 4:
							$listEquipmentArmorRowColor = '#d968c4';
							break;
						case 5:
							$listEquipmentArmorRowColor = '#ff5767';
							break;	
					}	
		    ?>
		    <form action="/vendor/core.php" method="POST">
		    	<input type="hidden" name="change-user-id" value="<?= $_GET['id'] ?>">
		    	<input type="hidden" name="change-armor-pos" value="1">
			    <button type="submit" class="change-user-gun-button" 
			     style="color:<?= $listEquipmentArmorRowColor ?>;" name="change-armor" 
			     value="<?= $listEquipmentArmorRow['id'] ?>">   
			     	<?= $listEquipmentArmorRow['armor_name']?>	
			    </button>
			</form>
			<?php } ?>				
			</div>

			<?php $armorProfileArmor2 = R::findOne('equipment', 'id = ?', array($armorlistProfile['armor_2'])); ?>

			<div class="user-armor-box" onclick="viewArmor(2)">
				<?php
					switch ($armorProfileArmor2['armomr_rank']) {
								case 3:
									$armorProfileArmor2Color = '#8d8dff';
									break;
								case 4:
									$armorProfileArmor2Color = '#d968c4';
									break;
								case 5:
									$armorProfileArmor2Color = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $armorProfileArmor2Color ?>;" class="user-armor-name"><?= $armorProfileArmor2['armor_name'] ?></span>
				<img class="user-armor-img" src="<?= $armorProfileArmor2['armomr_img'] ?>">
			</div>

			<div class="change-user-gun-box" id="change-user-armor-box-number-2">
			<?php
				foreach ($listEquipmentArmor as $listEquipmentArmorRow) {

				switch ($listEquipmentArmorRow['armomr_rank']) {
						case 3:
							$listEquipmentArmorRowColor = '#8d8dff';
							break;
						case 4:
							$listEquipmentArmorRowColor = '#d968c4';
							break;
						case 5:
							$listEquipmentArmorRowColor = '#ff5767';
							break;	
					}	
		    ?>
		    <form action="/vendor/core.php" method="POST">
		    	<input type="hidden" name="change-user-id" value="<?= $_GET['id'] ?>">
		    	<input type="hidden" name="change-armor-pos" value="2">
			    <button type="submit" class="change-user-gun-button" 
			     style="color:<?= $listEquipmentArmorRowColor ?>;" name="change-armor" 
			     value="<?= $listEquipmentArmorRow['id'] ?>">   
			     	<?= $listEquipmentArmorRow['armor_name']?>	
			    </button>
			</form>
			<?php } ?>				
			</div>

			<?php $armorProfileArmor3 = R::findOne('equipment', 'id = ?', array($armorlistProfile['armor_3'])); ?>

			<div class="user-armor-box" onclick="viewArmor(3)">
				<?php
					switch ($armorProfileArmor3['armomr_rank']) {
								case 3:
									$armorProfileArmor3Color = '#8d8dff';
									break;
								case 4:
									$armorProfileArmor3Color = '#d968c4';
									break;
								case 5:
									$armorProfileArmor3Color = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $armorProfileArmor1Color ?>;" class="user-armor-name"><?= $armorProfileArmor3['armor_name'] ?></span>
				<img class="user-armor-img" src="<?= $armorProfileArmor3['armomr_img'] ?>">
			</div>

			<div class="change-user-gun-box" id="change-user-armor-box-number-3">
			<?php
				foreach ($listEquipmentArmor as $listEquipmentArmorRow) {

				switch ($listEquipmentArmorRow['armomr_rank']) {
						case 3:
							$listEquipmentArmorRowColor = '#8d8dff';
							break;
						case 4:
							$listEquipmentArmorRowColor = '#d968c4';
							break;
						case 5:
							$listEquipmentArmorRowColor = '#ff5767';
							break;	
					}	
		    ?>
		    <form action="/vendor/core.php" method="POST">
		    	<input type="hidden" name="change-user-id" value="<?= $_GET['id'] ?>">
		    	<input type="hidden" name="change-armor-pos" value="3">
			    <button type="submit" class="change-user-gun-button" 
			     style="color:<?= $listEquipmentArmorRowColor ?>;" name="change-armor" 
			     value="<?= $listEquipmentArmorRow['id'] ?>">   
			     	<?= $listEquipmentArmorRow['armor_name']?>	
			    </button>
			</form>
			<?php } ?>				
			</div>

			<?php $armorProfileSecondGun1 = R::findOne('equipment', 'id = ?', array($armorlistProfile['main_gun_1'])); ?>

			<div class="user-second-gun-box">
				<?php
					switch ($armorProfileSecondGun1['armomr_rank']) {
								case 3:
									$armorProfileSecondGun1Color = '#8d8dff';
									break;
								case 4:
									$armorProfileSecondGun1Color = '#d968c4';
									break;
								case 5:
									$armorProfileSecondGun1Color = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $armorProfileSecondGun1Color ?>;" class="user-second-gun-name"><?= $armorProfileSecondGun1['armor_name'] ?></span>
				<img class="user-second-gun-img" src="<?= $armorProfileSecondGun1['armomr_img'] ?>">
			</div>

			<?php $armorProfileSecondGun1 = R::findOne('equipment', 'id = ?', array($armorlistProfile['main_gun_1'])); ?>

			<div class="user-second-gun-box">
				<?php
					switch ($armorProfileSecondGun1['armomr_rank']) {
								case 3:
									$armorProfileSecondGun1Color = '#8d8dff';
									break;
								case 4:
									$armorProfileSecondGun1Color = '#d968c4';
									break;
								case 5:
									$armorProfileSecondGun1Color = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $armorProfileSecondGun1Color ?>;" class="user-second-gun-name"><?= $armorProfileSecondGun1['armor_name'] ?></span>
				<img class="user-second-gun-img" src="<?= $armorProfileSecondGun1['armomr_img'] ?>">
			</div>

			<div class="user-second-gun-box">
				<?php
					switch ($armorProfileSecondGun1['armomr_rank']) {
								case 3:
									$armorProfileSecondGun1Color = '#8d8dff';
									break;
								case 4:
									$armorProfileSecondGun1Color = '#d968c4';
									break;
								case 5:
									$armorProfileSecondGun1Color = '#ff5767';
									break;	
							}
				?>
				<span style="color:<?= $armorProfileSecondGun1Color ?>;" class="user-second-gun-name"><?= $armorProfileSecondGun1['armor_name'] ?></span>
				<img class="user-second-gun-img" src="<?= $armorProfileSecondGun1['armomr_img'] ?>">
			</div>
			
		</div>
	<?php
		echo "<pre>";
		print_r($userProfile); 
		print_r($armorlistProfile); 
		print_r($squadProfile);
		print_r($armorProfileGun1); 
	?>


	</div>


	
	<script type="text/javascript"  src="/libs/jquery-3.6.1.min.js"></script>
	<script type="text/javascript"  src="/js/main.js"></script>
</body>
</html>