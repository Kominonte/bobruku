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
	<title>Bobruk</title>
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
				<span class="exchequer-rebuke">Выговор</span>
			</div>

		<?php 
			$exchequer = R::findAll('user');

			foreach ($exchequer as $exchequerRow) {

				$iter += 1 ;
		 ?>

			<div class="exchequer-list">
				<span class="exchequer-login"><?= $exchequerRow['login'] ?></span>
				<span class="exchequer-contribution">Вклад</span>
				<span class="exchequer-tax">Налог</span>
				<span class="exchequer-weeklynorm">Недельная норма</span>
				<span class="exchequer-rebuke">Выговор</span>
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
