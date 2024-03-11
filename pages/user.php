<?php 
	require_once("../vendor/connect.php");
	require_once("../vendor/core.php");
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
	<title>User</title>
</head>
<body id="body">
	<!-- <img id="fon" src="../assets/background/fon1.jpeg"> -->
	<?php  require_once("../includs/menu.php");?>
	<div id="background-dark"></div>

	<div id="main">

	<?php 

		$userProfile = R::findOne('user', 'id = ?', array($_GET['id']));
		$armorlistProfile = R::findOne('armorlist', 'user_id = ?', array($_GET['id']));
		$squadProfile = R::findOne('squad', 'member_squad_1 OR member_squad_2 OR member_squad_3 OR member_squad_4 OR member_squad_5 = ?', array($_GET['id']));
		$userExchequer = R::findOne('exchequerlist', 'user_id = ?', array($_GET['id']));
	?>

		<div id="user-warning">
		</div>

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
					<label id="user-info-punishments-warn">Варн | </label>
					<label id="user-info-punishments-pred">Пред |</label>
				</div>
				<label id="user-info-border"></label>
				<label id="user-info-exchequer-label">Общий взнос в казну </label>
				<label id="user-info-exchequer-value"><?= $userExchequer['tax_value'] ?></label>
			</div>
		</div>
		<div id="user-armor-kv">
		<?php 
			$armorProfileGun = R::findOne('equipment', 'id = ?', array($armorlistProfile['main_gun_1']));
			$armorProfileArmor = R::findOne('equipment', 'id = ?', array($armorlistProfile['armor_1']));
		?>
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
				<span style="color:<?= $userArmorRankColor ?>;" id="equipment-gun-name"><?= $armorProfileArmor['armor_name'] ?></span>
				<img id="equipment-armor-img" src="<?= $armorProfileArmor['armomr_img']?>">
			</div>

			<div id="equipment-second-gun-box">
				<span style="color:<?= $userArmorRankColor ?>;" id="equipment-gun-name"><?= $armorProfileGun['armor_name'] ?></span>
				<img id="equipment-second-gun-img" src="<?= $armorProfileGun['armomr_img']?>">
			</div>
		</div>
		<div id="user-armor">
			<label id="user-armor-label">Снаряга</label>
			
		</div>
	<?php
		echo "<pre>";
		print_r($userProfile); 
		print_r($armorlistProfile); 
		print_r($squadProfile); 
	?>


	</div>


	
	<script type="text/javascript"  src="/libs/jquery-3.6.1.min.js"></script>
	<script type="text/javascript"  src="/js/main.js"></script>
</body>
</html>