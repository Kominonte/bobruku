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
	<link rel='stylesheet' type='text/css' href='../css/add-user.css'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<title>Добавить члена клана</title>
</head>
<body>
	<img id="fon" src="../assets/background/fon1.jpeg">

		<?php require_once("../includs/menu.php");?>

		<div id="main">

			<span id="add-label">Добавление нового члена клана</span>
			<form id="add-user-form" action="" method="POST" >

				<span class="add-user-label">Ник</span><br>
				<input class="add-user-input" type="text" name="user-login"> <br>

				<div id="box-armor">
				<span class="add-user-label">Броня</span><br>
					<select class="add-user-select" name="user-armor-1">
					<?php 
						$equipment = R::findAll('equipment', 'armor_type = 2');

						foreach ($equipment as $equipmentRow) {
							$equipmentRow['armor_name']
						?>	

						<option value="<?= $equipmentRow['id'] ?>"><?= $equipmentRow['armor_name'] ?></option>
					<?php } ?>
					</select><br>
				</div>
				<a id="add-user-armor" class="add-box">+</a>

				<div id="box-main-gun">
				<span class="add-user-label">Основное оружие</span><br>
					<select class="add-user-select" name="user-main-gun-1">
					<?php 
						$equipment = R::findAll('equipment', 'armor_type = 1');

						foreach ($equipment as $equipmentRow) {
							$equipmentRow['armor_name']
						?>	

						<option value="<?=$equipmentRow['id'] ?>"><?= $equipmentRow['armor_name'] ?></option>
					<?php } ?>
					</select><br>
				</div>
				<a id="add-user-main-gun" class="add-box">+</a>

				<div id="box-second-gun">
				<span class="add-user-label">Вторичное оружие</span><br>
					<select class="add-user-select" name="user-second-gun-1">
					<?php 
						$equipment = R::findAll('equipment', 'armor_type = 1');

						foreach ($equipment as $equipmentRow) {
							$equipmentRow['armor_name']
						?>	

						<option value="<?= $equipmentRow['id'] ?>"><?= $equipmentRow['armor_name'] ?></option>
					<?php } ?>
					</select><br>
				</div>
				<a id="add-user-second-gun" class="add-box">+</a>

				<span class="add-user-label">Звание</span><br>
					<select class="add-user-select" name="user-rank">
						<option class="user-option"  value="1">Новобранец</option>
						<option class="user-option"  value="2">Рядовой</option>
					 	<option class="user-option"  value="3">Сержант</option>
					  	<option class="user-option"  value="4">Офицер</option>
					  	<option class="user-option"  value="5">Глава</option>
					</select><br>

				<span class="add-user-label">Отряд</span><br>
					<select class="add-user-select" name="user-squad">
						<option class="user-option" style="color: #8b0808;" value="1">Корусанская Гвардия</option>
						<option class="user-option" style="color: #06135f;" value="2">501-й легион</option>
					 	<option class="user-option" style="color: #e74c3c;" value="3">212-й штурмовой батальон</option>
					  	<option class="user-option" style="color: #073609;" value="4">41-й элитный корпус</option>
					  	<option class="user-option" style="color: #546e7a;" value="5">104-й батальон</option>
					</select><br>

				<span class="add-user-label">Роль</span><br>
					<select class="add-user-select" name="user-role">
						<option class="user-option"  value="1">Пользователь</option>
						<option class="user-option"  value="2">Администратор</option>

					</select><br>

				<input type="hidden" name="user-did" value="<?= $user->id ?>">

				<button id="add-user-btn" type="submit" name="add-user-btn">Добавить</button>
			
		</div>

	<script type="text/javascript"  src="/libs/jquery-3.6.1.min.js"></script>
	<script type="text/javascript"  src="/js/main.js"></script>
</body>
</html>
