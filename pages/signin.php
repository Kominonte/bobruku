<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" sizes="128x128" href="assets/logo/logo.jpeg">	
	<link rel='stylesheet' type='text/css' href='/css/signin.css'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<title>Авторизация</title>
</head>
<body>
	<img id="fon" src="/assets/background/fon1.jpeg">

	<div id="auth">
		<form>
			<span id="auth-label"> Авторизация </span><br>
			<input id="login" type="text" name="login"><br>
			<label id="login-label"> Логин </label>
			<input  class="input" type="password" name="password"><br>
			<label class="label"> Пароль </label>
			<button id="auth-btn"> Войти </button><br>
			<span> Нету аккаунта ?</span> <a href="signup.php">Зарегистрироваться</a>
		</form>
	</div>
</body>
</html>
