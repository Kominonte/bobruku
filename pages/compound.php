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
	<link rel='stylesheet' type='text/css' href='../css/compound.css'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<title>Состав</title>
</head>
<body id="body">
	<img id="fon" src="../assets/background/fon1.jpeg">

	<div id="background-dark"></div>

		<?php if($user): require_once("../includs/menu.php");?>

		<div id="main">
			<?php if($user->role == 2): ?>
			<div id="top-control">
				<a class="top-control-element" href="add-user.php">+ Добавить человека</a>
			</div>
			<?php endif ?>

			<div id="main-compound-box">
				<span id="main-compound-label">Состав</span>
			</div>

			<div id="compound-box">
				<?php
					$compound = R::findAll('user', 'status = ?', array(1));

					foreach ($compound as $compoundRow) {

						$iter += 1 ;
						
				?>
			<div id="wrapper-main">

			<a href="/pages/user.php?id=<?= $compoundRow['id'] ?>" class="user-link">
				<div class="compound-list">
					<span class="compound-login"><?= $compoundRow['login'] ?></span><br>
					<span class="compound-rank">
						<?php
							switch ($compoundRow['rank']) {
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
					</span>
					<span class="compound-date"><?= mb_strimwidth($compoundRow['date_registration'], 0, 10) ?></span>

					<?php 

							$sql = "SELECT * 
									FROM armorlist ar
	 									 LEFT JOIN equipment e ON e.id = ar.armor_1 
									WHERE ar.user_id =" . $compoundRow['id'];

 							$rows = R::getAll( $sql );

 							$userEquipmentArmor = R::convertToBeans( 'armorlist', $rows );
 							
 							foreach ($userEquipmentArmor as $userEquipmentArmorRow){
 							}
							
							switch ($userEquipmentArmorRow['armomr_rank']) {
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

					<div id="compound-squad-box-<?= $iter ?>" class="compound-squad-box">
						<span id="compound-squad-name<?= $iter ?>" class="compound-squad-name">
							<?php

								switch ($compoundRow['squad']) {
									case 0:
										$userSquadColor = '#1c1c1c';
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
								print_r($userSquadName);
							?>
						</span>
						<style type="text/css"> #compound-squad-box-<?= $iter ?> { 
													background-color: <?=  $userSquadColor; ?>;
													 background-image: url('<?= $userSquadImg; ?>');}
						</style>
					</div>
					
					<div class="compound-armor-img-box">
						<span class="compound-armor-name" style="color:<?= $userArmorRankColor ?>;"><?= ($userEquipmentArmorRow['armor_name']);?></span>
						<img class="compound-armor-img" src="<?php print_r($userEquipmentArmorRow['armomr_img']); ?>">
					</div>

					<div class="attendance-box">
						<span class="attendance-label">Участие на КВ</span>
						<div class="attendance-was">
							<span >Был | <?= $compoundRow['was'] ?></span>
						</div>
						<div class="attendance-wasnot">
							<span > Не был | <?= $compoundRow['wasnot'] ?></span>
						</div>
					</div>

					<div class="gun-box">

						<?php 

							$sql = "SELECT * 
									FROM armorlist ar
	 									 LEFT JOIN equipment e ON e.id = ar.main_gun_1 
									WHERE ar.user_id =" . $compoundRow['id'];

 							$rows = R::getAll( $sql );

 							$userEquipmentGun = R::convertToBeans( 'armorlist', $rows );

 							foreach ($userEquipmentGun as $userEquipmentGunRow){
 							}
							
							switch ($userEquipmentGunRow['armomr_rank']) {
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
						<div class="main-gun">
							<div class="compound-gun-img-box">
								<span class="compound-gun-name" style="color:<?= $userGunRankColor ?>;"><?= ($userEquipmentGunRow['armor_name']);?></span>
								<img class="compound-gun-img" src="<?= $userEquipmentGunRow['armomr_img'] ?>">
							</div>
						</div>
						<div class="compound-second-box"></div>
					</div>

					<div id="attendance-control-box">
						<form action="../vendor/core.php" method="POST">
							<input type="hidden" name="attendance-userid" value="<?= $compoundRow['id'] ?>">
							<button class="attendance-btn" type="submit" name="attendance-was-btn"> Присутствовал</button>
							<button class="attendance-btn" type="submit" name="attendance-wasnot-btn"> Отсутствовал</button>
							<button class="attendance-btn-end" type="submit" name="attendance-reserve-btn"> В резерв</button>
						</form>
							<button id="hooky-user" class="attendance-btn" type="submit" name="attendance-hooky-btn"  onclick="viewHooky()">  Прогул</button> 
							<button id="blacklist-user" class="attendance-btn" type="submit" name="attendance-blacklist-btn"> В ЧС</button>
						<form action="../vendor/core.php" method="POST">
							<button id="delete-user" class="attendance-btn" type="submit" name="attendance-delete-btn"> Кикнуть</button>  
						</form>
						
					</div>

				</div>
				</a>
				<?php } ?>


			</div>

			<div id="reserve-box">
				<span id="reserve-label">Резерв</span>
				<div class="reserve-list">
					<span class="reserve-login"> Ник </span>
					<span class="reserve-rank"> Звание </span>
					<span class="reserve-was">Участвие в КВ</span>
					<span class="reserve-wasnot"> Пропущено КВ</span>
					<span class="reserve-date"> В резерве </span>
				</div>
				<?php
					$reserve = R::findAll('user', 'status = ?', array(2));

					foreach ($reserve as $reserveRow) {

						$iter += 1 ;
						
				?>

				<div class="reserve-list">
					<span class="reserve-login"> <?= $reserveRow['login'] ?>	</span>
					<span class="reserve-rank">
						<?php
							switch ($reserveRow['rank']) {
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
					</span>

					<span class="reserve-was">Был | <?= $reserveRow['was'] ?></span>
					<span class="reserve-wasnot">Не был | <?= $reserveRow['wasnot'] ?></span>
					<span class="reserve-date"> c <?=  mb_strimwidth($reserveRow['date_reserve'], 0, 10) ?> </span>
					<form  action="../vendor/core.php" method="POST">
						<input type="hidden" name="attendance-userid" value="<?= $reserveRow['id'] ?>">
						<button class="reserve-return-btn" type="submit" name="reserve-return-btn">вернуть в состав</button>
					</form>
				</div>
				<?php } ?>
			</div>

			<div id="blacklist-box">
				<span id="blacklist-label">Черный список</span>
			</div>
			
		</div>


		<form action="../vendor/core.php" method="POST">
			<button id="auth-btn" type="submit" name="logout-btn"> Выйти </button><br>
		</form>

		<form id="hooky-add-box" action="../vendor/core.php" method="POST">
				<label id="hooky-сause-label">Причина</label>
				<label id="hooky-сause-close" onclick="closeHooky()">x</label>
				<input type="hidden" name="attendance-userid" value="<?= $compoundRow['id'] ?>">
				<textarea id="hooky-сause-text" type="textarea" name="hooky-сause"> </textarea>
				<button id="hooky-user" class="attendance-btn" type="submit" name="attendance-hooky-btn"> Прогул</button>
		</form>

	<?php else: ?>
	<div id="auth">
		<p id="welcome-text">Прежде чем увидить снарягу клана вам надо</p><br>
		<a id="link-auth" href="../pages/signin.php">авторизоваться</a>
	</div>
	<?php endif; ?>

	<script type="text/javascript"  src="/js/main.js"></script>
</body>
</html>