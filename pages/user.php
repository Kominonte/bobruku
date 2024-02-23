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
	<link rel='stylesheet' type='text/css' href='../css/menu.css'>
	<link rel='stylesheet' type='text/css' href='../css/user.css'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<title>User</title>
</head>
<body id="body">
	<!-- <img id="fon" src="../assets/background/fon1.jpeg"> -->
	<?php  require_once("../includs/menu.php");?>
	<div id="background-dark"></div>

	<div id="main">

	<?php 

		$userProfile = R::findOne('user', 'id = ?', array($_GET['id']));
		$armorProfile = R::findOne('armorlist', 'user_id = ?', array($_GET['id']));
		$squadProfile = R::findOne('squad', 'member_squad_1 OR member_squad_2 OR member_squad_3 OR member_squad_4 OR member_squad_5 = ?', array($_GET['id']));

	?>

		<div id="user-warning">
		</div>

		<div id="user-info">
			<label id="user-info-login"><?= $userProfile['login']?></label>
		</div>

		<div id="user-armor">
		</div>
	<?php
		echo "<pre>";
		print_r($userProfile); 
		print_r($armorProfile); 
		print_r($squadProfile); 
	?>


	</div>


	
	<script type="text/javascript"  src="/libs/jquery-3.6.1.min.js"></script>
	<script type="text/javascript"  src="/js/main.js"></script>
</body>
</html>