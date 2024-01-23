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
	<link rel='stylesheet' type='text/css' href='../css/add-armor.css'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<title>Добавить члена клана</title>
</head>
<body>
	<img id="fon" src="../assets/background/fon1.jpeg">

		<?php require_once("../includs/menu.php");?>

		<div id="main">
			<span id="add-label">Добовление снаряги</span>
			<form id="add-armor-form" action="/vendor/core.php" method="POST" enctype="multipart/form-data">
				<span class="add-armor-label">Тип</span><br>
					<select class="add-armor-select" name="armor-type">
					  <option class="armor-option" value="1">Ствол</option>
					  <option class="armor-option" value="2">Броня</option>
					</select><br>

				<span class="add-armor-label">Название (SIG SG 550)</span><br>
				<input class="add-armor-input" type="text" name="armor-name"> <br>

				<span class="add-armor-label">Техническое название (sig_sg_550)</span><br>
				<input class="add-armor-input" type="text" name="armor-dev-name"><br>

				<span class="add-armor-label">Ранг</span><br>
					<select class="add-armor-select" name="armor-rank">
					  <option class="armor-option" style="color: #8d8dff;" value="3">Сталерская</option>
					  <option class="armor-option" style="color: #d968c4;" value="4">Ветеранка</option>
					  <option class="armor-option" style="color: #ff5767;" value="5">Мастерка</option>
					</select><br>

				<span class="add-armor-label">Изображение</span><br>
				<input class="add-armor-file" type="file" name="armor-img"><br>
				<input type="hidden" name="armor-did" value="<?= $user->id ?>">

				<button id="add-armor-btn" type="submit" name="armor-btn">Добавить</button>
			<form>
			
		</div>

	<script type="text/javascript"  src="/js/main.js"></script>
</body>
</html>