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
			<div id="main-wrapper">
		<?php

			$squad = R::findAll('squad'); // Получаем список отрядов

			$squadList = R::findAll('user'); // Получаем список членов клана

			// Перебераем спиок отрядов
			foreach ($squad as $squadRow) {
				$squadIt += 1 ?>

			<!-- Блок для отряда -->
			<div class="squad-list">
				<?php
					switch ($squadRow['id']) {
						case 1:
							$userSquadImg = '/assets/icon/icon-attack.png';
							break;

						case 2:
							$userSquadImg = '/assets/icon/icon-tent.png';
							break;

						case 3:
							$userSquadImg = '/assets/icon/icon-tent.png';
							break;

						case 4:
							$userSquadImg = '/assets/icon/icon-bio.png';
							break;

						case 5:
							$userSquadImg = '';
							break;
						}
					?>
				<span id="squad-name-<?= $squadIt?>" class="squad-name" style="background-color:<?= $squadRow['color_squad']?>;background-image: url(<?= $userSquadImg ?>);">
					<?= $squadRow['name_squad'] ?>
				</span>

				<?php
					$squadListIt = 0;
					do {
    				$squadListIt += 1 ;

					$squadUser = R::findOne('user', 'id = ?', array($squadRow['member_squad_'.$squadListIt]));
				?>

				<div class="squad-user-position-wrapper"> <!--  Подложка под позицию в отряде -->
				<div class="squad-user-position" onclick="viewSquaList(<?= $squadIt.$squadListIt ?>)"> <!--  Позиция в отряе -->
					<span class="squad-user-position-label">
						<?php if($squadUser == 0):?>Пусто #<?= $squadListIt ?>
						<?php else: print_r($squadUser['login'])?>
						<?php endif; ?>
					</span>
				</div>

					<span id="close-list-<?= $squadIt.$squadListIt ?>" class="close-squad-user-position-list" onclick="closeSquaList(<?= $squadIt.$squadListIt ?>)">x</span> 

					<div id="squad-user-position-list-<?= $squadIt.$squadListIt ?>" class="squad-user-position-mainpvp-list">
					<?php /*Перебераем всех челенов клана*/
					foreach($squadList as $squadListRow){ ?>
					<form action="/vendor/core.php" method="POST">
						<input type="hidden" name="position-user-squad" value='<?= $squadListIt ?>'>
						<input type="hidden" name="add-user-squad-id" value="<?= $squadListRow['id']?>">
						<button class="squad-user-position-row" type="submit" name="add-user-squad-btn"
						value="<?= $squadIt ?>">
							<?= $squadListRow['login'] ?>
						</button>
					</form>
				<?php } ?>
					<form action="/vendor/core.php" method="POST">
						<input type="hidden" name="position-user-squad" value='<?= $squadListIt ?>'>
						<input type="hidden" name="add-user-squad-id" value="<?= $squadListRow['id']?>">
						<button class="squad-user-position-row-del" type="submit" name="del-user-squad-btn"
						value="<?= $squadIt ?>">
							Удалить
						</button>
					</form>
					</div>
				</div>
					<?php } while ($squadListIt <= 4) ?>	
					
				<?php
					foreach ($squad as $squadRow){
					if($squadRow['squad'] == $squadIt){
				?>	
					<span class="squad-user"><?= $squadRow['login']?></span>
				<?php }} ?>	
				<div class="squad-description-wrapper">
					<span class="squad-description">Описание</span>
					<p class="squad-description-text"><?= $squadRow['description_squad']?></p>
				</div>

				<form id="squad-setting-<?= $squadListIt?>" class="squad-setting">
					<label class="squad-setting-label">Настройки отряда</label>
					<label class="squad-setting-name">Название отряда</label><br>
					<input type="text" name=""><br>
					<label class="squad-setting-type-label">Тип отряда</label><br>
					<select class="squad-setting-type">
						<option value="1">Атакующий</option>
						<option value="2">Дефф точки</option>
						<option value="3">Дефф палатки</option>
						<option value="4">Разведка</option>
						<option value="5">Био</option>
					</select><br>
					<label class="squad-setting-description">Описание отряда</label><br>
					<input type="text" name=""><br>
					<label class="squad-setting-color-label">Цвет отряда</label><br>
					<input class="squad-setting-color" type="color" name=""><br>
					<button class="squad-setting-btn" name="squad-setting-btn" value="<?= $squadListIt?>">Сохранить</button>
				</form>
			</div>
		<?php } ?>
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