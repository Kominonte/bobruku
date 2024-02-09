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
<body id="body">
	<img id="fon" src="../assets/background/fon1.jpeg">

	<div id="background-dark"></div>

	<?php if($user): require_once("../includs/menu.php");?>


		<div id="main">
			<span class="squad-label">Отряды</span>
			<span class="add-squad" onclick="viewAddSquad()">+ Добавить отряд</span>
			<div id="main-wrapper">
		<?php

			$squad = R::findAll('squad'); // Получаем список отрядов

			$squadList = R::findAll('user'); // Получаем список членов клана

			// Перебераем спиок отрядов
			foreach ($squad as $squadRow) {
				$squadIt += 1 ?>

			<!-- Блок для отряда -->
			<div id="squad-list-<?= $squadIt?>" class="squad-list">
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
					<img id="open-setting-<?= $squadIt?>" class="open-setting" src="/assets/icon/icon-pencil.png"
					 onclick="viewSquadSetting(<?= $squadIt ?>)">
					 <img id="close-setting-<?= $squadIt?>" class="close-setting" src="/assets/icon/icon-close.png"
					 onclick="closeSquadSetting(<?= $squadIt ?>)">
				</span>

				<?php
					$squadListIt = 0;
					while ($squadListIt <= 4) {
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
					<?php if($squadUser == 0):?>
					<?php else: ?>
						<a class="squad-user-position-row-link" > Инфа о <?= $squadUser['login'] ?> </a>
					<?php endif; ?>
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
					<?php } ?>	
					
				<?php
					foreach ($squad as $squadSecondRow){
					if($squadSecondRow['squad'] == $squadIt){
				?>	
					<span class="squad-user"><?= $squadSecondRow['login']?></span>
				<?php }} ?>	
				<div class="squad-description-wrapper">
					<span class="squad-description">Описание</span>
					<p class="squad-description-text"><?= $squadRow['description_squad']?></p>
				</div>

				<form action="/vendor/core.php" method="POST" id="squad-setting-<?= $squadIt?>" class="squad-setting">
					<?php
						$squadSod = R::findOne('squad', 'id = ?', array($squadRow['id']));
					?>
					<label class="squad-setting-label">Настройка отряда</label>
					<label class="squad-setting-name">Название отряда</label>
					<input class="squad-setting-name-input" type="text" name="squad-name" 
					 value="<?= $squadSod['name_squad']?>">
					<label class="squad-setting-color-label">Цвет отряда</label>
					<input class="squad-setting-color" type="color" name="squad-color"
					 value="<?= $squadSod['color_squad']?>">
					<label class="squad-setting-type-label">Тип отряда:</label>
					<select class="squad-setting-type" name="squad-type">
						<option value="1">Атакующий</option>
						<option value="2">Дефф точки</option>
						<option value="3">Дефф палатки</option>
						<option value="4">Разведка</option>
						<option value="5">Био</option>
					</select><br>
					<label class="squad-setting-description">Описание отряда</label>
					<textarea class="squad-setting-description-input" type="textarea" name="squad-description"><?= $squadSod['description_squad']?>
					</textarea>
					<button class="squad-setting-btn" name="squad-setting-btn" value="<?= $squadRow['id']?>">Сохранить</button>
					<button class="squad-setting-del" name="squad-setting-del" value="<?= $squadRow['id']?>">Удалить отряд</button>
				</form>
			</div>
		<?php } ?>
		</div>	
		</div>

		<form action="/vendor/core.php" method="POST" id="squad-add" class="squad-add">
			<label class="squad-setting-label">Добавить отряд</label>
			<span class="add-squad-close" onclick="closeAddSquad()">x</span>
			<label class="squad-setting-name">Название отряда</label>
			<input class="squad-setting-name-input" type="text" name="squad-name">
			<label class="squad-setting-color-label">Цвет отряда</label>
			<input class="squad-setting-color" type="color" name="squad-color">
			<label class="squad-setting-type-label">Тип отряда:</label>
			<select class="squad-setting-type" name="squad-type">
				<option value="1">Атакующий</option>
				<option value="2">Дефф точки</option>
				<option value="3">Дефф палатки</option>
				<option value="4">Разведка</option>
				<option value="5">Био</option>
			</select><br>
			<label class="squad-setting-description">Описание отряда</label>
			<textarea class="squad-setting-description-input" type="textarea" name="squad-description">
			</textarea>
			<button class="squad-setting-btn" name="squad-add-btn">Сохранить</button>
		</form>

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