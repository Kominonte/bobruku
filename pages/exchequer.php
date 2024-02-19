<?php 
	require_once("../vendor/connect.php");
	require_once("../vendor/core.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" sizes="128x128" href="assets/logo/logo.jpeg">	
	<link rel='stylesheet' type='text/css' href='../css/exchequer.css'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<title>Сборы</title>
</head>
<body>
	<img id="fon" src="../assets/background/fon1.jpeg">

	<?php if($user): require_once("../includs/menu.php");?>


		<div id="main">

			<div id="exchequer-label">
				<span class="exchequer-login">Ник</span>
				<span class="exchequer-contribution">Вклад</span>
				<span class="exchequer-tax">Налог</span>
				<span class="exchequer-weeklynorm">Недельная норма</span>
				<span class="exchequer-rebuke">Варн</span>
				<span class="exchequer-warning">Предупреждение</span>
			</div>

		<?php 
			
			$userExchequer = R::findAll('user');

			foreach ($userExchequer as $userExchequerRow) {
				$iter += 1 ;

			$userExchequerSod = R::findOne('exchequerlist', 'user_id = ?', array($userExchequerRow['id']));
		 ?>
	
			<div class="exchequer-list" style="background-color: <?php if($userExchequerRow['id'] == $user->id){
		 		echo "#323232";
		 	} ?>;">
				<div>
					<span class="exchequer-login"><?= $userExchequerRow['login'] ?></span>
					<span class="exchequer-contribution"><?= $userExchequerSod['tax_value'] ?></span>
				<?php if($userExchequerSod['tax'] == 1):?>
					<span class="exchequer-tax" style="background-color: #129c00; color: #c1f7c8;">
						Сдал
					</span>
				<?php elseif($userExchequerSod['tax'] == 0):?>
					<span class="exchequer-tax" style="background-color: #9c0a00; color: #f7c1c1;">
						Не сдал
					</span>
				<?php else:?>
					<span class="exchequer-tax">
						Освобожден
					</span>
				<?php endif; ?>

				<?php if($userExchequerSod['weeklynorm'] == 1):?>
					<span class="exchequer-weeklynorm" style="background-color: #129c00; color: #c1f7c8;">
						Сдал
					</span>
				<?php elseif($userExchequerSod['weeklynorm'] == 0):?>
					<span class="exchequer-weeklynorm" style="background-color: #9c0a00; color: #f7c1c1;">
						Не сдал
					</span>
				<?php else:?>
					<span class="exchequer-weeklynorm">
						Освобожден
					</span>
				<?php endif; ?>

					<span class="exchequer-rebuke"><?= $userExchequerSod['rebuke'] ?>/3</span>
				</div>

				<div class="exchequer-list-control">
					<form class="exchequer-form" action="../vendor/core.php" method="POST">
						<input class="contribution-value" list="contribution-value" name="contribution-value">
  							<datalist id="contribution-value">
    							<option value="25000">
    							<option value="75000">
							</datalist>
						<input type="hidden" name="exchequer-id" value="<?= $userExchequerRow['id']?>">
						<button class="exchequer-tax-passed" name="tax-passed">Сдал</button>
					</form>

					<form class="exchequer-form" action="../vendor/core.php" method="POST">
						<input type="hidden" name="exchequer-id" value="<?= $userExchequerRow['id']?>">
						<button class="exchequer-tax-failed" name="tax-failed">Не сдал</button>
					</form>

					<form class="exchequer-form" action="../vendor/core.php" method="POST">
						<input type="hidden" name="exchequer-id" value="<?= $userExchequerRow['id']?>">
						<button class="exchequer-weeklynorm-passed" name="weeklynorm-passed">Сдал</button>
						<button class="exchequer-weeklynorm-failed" name="weeklynorm-failed">Не сдал</button>
					</form>

					<form class="exchequer-form" action="../vendor/core.php" method="POST">
						<input type="hidden" name="exchequer-id" value="<?= $userExchequerRow['id']?>">
						<button class="exchequer-rebuke-passed" name="rebuke-passed">Варн</button>
					</form>

					<form class="exchequer-form" action="../vendor/core.php" method="POST">
						<input type="hidden" name="exchequer-id" value="<?= $userExchequerRow['id']?>">
						<button class="exchequer-rebuke-passed" name="rebuke-passed">Пред</button>
					</form>
					
				</div>
			</div>

		<?php } ?>
			
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
	<script type="text/javascript"  src="../js/main.js"></script>
</body>
</html>
