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
	<link rel='stylesheet' type='text/css' href='/css/signup.css'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<title>Регистрация</title>
</head>
<body>
	<img id="fon" src="/assets/background/fon1.jpeg">

	<div id="auth">
		<span id="auth-label"> Регистрация </span><br>
		<form action="../vendor/core.php" method="POST">
			<div class="input-field-div">
				<input id="login" class="input-field" type="text" name="login" required>
				<label class="input-field-placeholder">Логин</label>

			<?php if($_SESSION['errors'] == 10){ ?>
				<label class="errors">Введите логин!</label>
				<style type="text/css">#login{border: 2px solid #fc4747;}</style>
			<?php } 
				  if($_SESSION['errors'] == 14){ ?>
				<label class="errors">Аккаунт с таким логином уже существует!</label>
				<style type="text/css">#login{border: 2px solid #fc4747;}</style>
			<?php } ?>
			</div>

			<div class="input-field-div">
				<input id="password" class="input-field" type="password" name="password" required>
				<label class="input-field-placeholder">Пароль</label>

			<?php if($_SESSION['errors'] == 11){ ?>
				<label class="errors">Введите пароль!</label>
				<style type="text/css">#password{border: 2px solid #fc4747;}</style>
			<?php } ?>
			</div>

			<div class="input-field-div">
				<input id="second-password" class="input-field" type="password" name="secondPassword" required>
				<label class="input-field-placeholder">Подтвердите пароль</label>
			<?php if($_SESSION['errors'] == 12){ ?>
				<label class="errors">Введите проверочный пароль!</label>
				<style type="text/css">#second-password{border: 2px solid #fc4747;}</style>
			<?php } 
				  if($_SESSION['errors'] == 13){ ?>
				<label class="errors">Пароли не совпали!</label>
				<style type="text/css">#second-password{border: 2px solid #fc4747;}</style>
			<?php } ?>
			</div>

			<button id="auth-btn" type="submit" name="signup-btn"> Зарегистрироваться </button><br>
			<span id="redirect-signup"> Уже есть аккаунт ?</span> 
			<a id="redirect-signup-link" href="signin.php">Авторизироваться</a>
		</form>
	</div>
	<script type="text/javascript"  src="/js/main.js"></script>
</body>
</html>
 