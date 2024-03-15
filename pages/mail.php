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
	<link rel='stylesheet' type='text/css' href='/css/mail.css'>
	<link rel='stylesheet' type='text/css' href='/css/menu.css'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<title>Почта</title>
</head>
<body>

	<?php if($user): require_once("../includs/menu.php");?>

	<div id="wrapper">

		<div id="main">
			
		</div>
	</div>
	<?php else: ?>
	<div id="auth">
		<p id="welcome-text">Прежде чем увидить снарягу клана вам надо</p><br>
		<a id="link-auth" href="pages/signin.php">авторизоваться</a>
	</div>
	<?php endif; ?>
	<script type="text/javascript"  src="/js/main.js"></script>
</body>
</html>
