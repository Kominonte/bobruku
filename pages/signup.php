<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" sizes="128x128" href="assets/logo/logo.jpeg">	
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
		<form>
			<input id="login" type="text" name="login"><br>
			<label id="login-label"> Логин </label>
			<input id="password" type="password" name="password"><br>
			<label id="password-label"> Пароль </label>
			<input id="second-password" type="password" name="secondPassword"><br>
			<label id="second-password-label"> Подтвердите пароль </label>
			<button id="auth-btn"> Зарегистрироваться </button><br>
			<span id="redirect-signup"> Уже есть аккаунт ?</span> 
			<a id="redirect-signup-link" href="signup.php">Авторизироваться</a>
		</form>
	</div>
	<script type="text/javascript"  src="/js/main.js"></script>
</body>
</html>
 