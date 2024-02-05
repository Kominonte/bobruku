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
	<link rel='stylesheet' type='text/css' href='../css/squad.css'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<title>King and Clown</title>
</head>
<body>

	<img id="fon" src="../assets/background/fon1.jpeg">

	<?php if($user): require_once("../includs/menu.php");?>


		<div id="main">
		<?php
			$squad = R::findAll('user', 'squad = ?', array(1));

			foreach ($squad as $squadRow) {} ?>

			<div class="squad-list">
				<span class="squad-name" style="background-color: #db0000;">
				<?php
					switch ($squadRow['squad']){
						case 1:
							echo "MainPvp";
						break;

						case 2:
							echo "Def1";
						break;
						case 3:
							echo "Def2";
						break;

						case 4:
							echo "Bio";
						break;
					}
				?> 
				</span>

				<?php
					foreach ($squad as $squadRow){
					if($squadRow['squad'] == 1){
				?>	
					<span class="squad-user"><?= $squadRow['login']?></span>
				<?php }} ?>	
				<div class="squad-description-wrapper">
					<span class="squad-description">Описание</span>
					<p class="squad-description-text">Тут чет должно быть про отряд</p>
				</div>
			</div>

		<?php
			$squad = R::findAll('user', 'squad = ?', array(2));

			foreach ($squad as $squadRow) {} ?>

			<div class="squad-list">
				<span class="squad-name" style="background-color: #06135f;">
				<?php
					switch ($squadRow['squad']){
						case 1:
							echo "MainPvp";
						break;

						case 2:
							echo "Def1";
						break;
						case 3:
							echo "Def2";
						break;

						case 4:
							echo "Bio";
						break;
					}
				?> 
				</span>

				<?php
					foreach ($squad as $squadRow){
					if($squadRow['squad'] == 2){
				?>	
					<span class="squad-user"><?= $squadRow['login']?></span>
				<?php }} ?>

				<div class="squad-description-wrapper">
					<span class="squad-description">Описание</span>
					<p class="squad-description-text">Тут чет должно быть про отряд</p>
				</div>
				
			</div>

		<?php
			$squad = R::findAll('user', 'squad = ?', array(3));

			foreach ($squad as $squadRow) {} ?>

			<div class="squad-list">
				<span class="squad-name" style="background-color: #e74c3c;">
				<?php
					switch ($squadRow['squad']){
						case 1:
							echo "MainPvp";
						break;

						case 2:
							echo "Def1";
						break;
						case 3:
							echo "Def2";
						break;

						case 4:
							echo "Bio";
						break;
					}
				?> 
				</span>

				<?php
					foreach ($squad as $squadRow){
					if($squadRow['squad'] == 3){
				?>	
					<span class="squad-user"><?= $squadRow['login']?></span>
				<?php }} ?>

				<div class="squad-description-wrapper">
					<span class="squad-description">Описание</span>
					<p class="squad-description-text">Тут чет должно быть про отряд</p>
				</div>
				
			</div>

			<?php
			$squad = R::findAll('user', 'squad = ?', array(4));

			foreach ($squad as $squadRow) {} ?>

			<div class="squad-list">
				<span class="squad-name" style="background-color: #2da103;">
				<?php
					switch ($squadRow['squad']){
						case 1:
							echo "MainPvp";
						break;

						case 2:
							echo "Def1";
						break;
						case 3:
							echo "Def2";
						break;

						case 4:
							echo "Bio";
						break;
					}
				?> 
				</span>

				<?php
					foreach ($squad as $squadRow){
					if($squadRow['squad'] == 4){
				?>	
					<span class="squad-user"><?= $squadRow['login']?></span>
				<?php }} ?>

				<div class="squad-description-wrapper">
					<span class="squad-description">Описание</span>
					<p class="squad-description-text">Тут чет должно быть про отряд</p>
				</div>
				
			</div>
			
		</div>

		<form action="vendor/core.php" method="POST">
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