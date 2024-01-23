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
	<link rel='stylesheet' type='text/css' href='../css/compound.css'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<title>Bobruk</title>
</head>
<body>
	<img id="fon" src="../assets/background/fon1.jpeg">

		<?php if($user): require_once("../includs/menu.php");?>

		<div id="main">
			<?php if($user->role == 2): ?>
			<div id="top-control">
				<a class="top-control-element" href="add-user.php">+ Добавить человека</a>
				<a class="top-control-element" href="compound.php">+ Посещаемость</a>	
			</div>
			<?php endif ?>

			<div id="compound-box">
				<?php
					$compound = R::findAll('user');

					foreach ($compound as $compoundRow) {

						$iter += 1 ;
						
				?>

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
						$userEquipmentArmor = R::findOne('equipment', 'id = ?', array($compoundRow['armor_1']));

						switch ($userEquipmentArmor['armomr_rank']) {
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

					<div id="compound-squad-box-<?= $iter ?>" class="compound-squad-box">
						<span id="compound-squad-name<?= $iter ?>" class="compound-squad-name">
							<?php
								switch ($compoundRow['squad']) {
									case 1:
										$userSquadColor = '#8b0808';
										$userSquadName = 'Корусанская Гвардия';
										$userSquadImg = '';
										break;

									case 2:
										$userSquadColor = '#06135f';
										$userSquadName = '501-й легион';
										$userSquadImg = '/assets/icon/icon-attack.png';
										break;

									case 3:
										$userSquadColor = '#e74c3c';
										$userSquadName = '212-й штурмовой батальон';
										$userSquadImg = '/assets/icon/icon-tent.png';
										break;

									case 4:
										$userSquadColor = '#073609';
										$userSquadName = '41-й элитный корпус';
										$userSquadImg = '/assets/icon/icon-scouting.png';
										break;

									case 5:
										$userSquadColor = '#546e7a';
										$userSquadName = '104-й батальон';
										$userSquadImg = '/assets/icon/icon-attack.png';
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
						<span class="compound-armor-name" style="color:<?= $userGunRankColor ?>;"><?= ($userEquipmentArmor['armor_name']);?></span>
						<img class="compound-armor-img" src="<?php print_r($userEquipmentArmor['armomr_img']); ?>">
					</div>
				</div>

				<?php } ?>


			</div>
			
		</div>

		<form action="../vendor/core.php" method="POST">
			<button id="auth-btn" type="submit" name="logout-btn"> Выйти </button><br>
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
