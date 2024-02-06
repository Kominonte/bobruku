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
			$squad = R::findAll('squad', 'id = ?', array(1));

			$squadList = R::findAll('user');

			foreach ($squad as $squadRow) {} ?>

			<div class="squad-list">
				<span class="squad-name" style="background-color:<?= $squadRow['color_squad']?>">
					<?= $squadRow['name_squad'] ?>
				</span>
			<div class="squad-user-position-wrapper">
				<?php 
					$squadUser = R::findOne('user', 'id = ?', array($squadRow['member_squad_1']))
				?>
					<div class="squad-user-position" onclick="viewSquaList(1)">
						<span>
							<?php if($squadUser == 0):?>Пусто #1
							<?php else: print_r($squadUser['login'])?>
							<?php endif; ?>
						</span>

					</div>
					<span id="close-list-1" class="close-squad-user-position-list" onclick="closeSquaList(1)">x</span>
					<div id="squad-user-position-list-1" class="squad-user-position-mainpvp-list">
					<?php foreach($squadList as $squadListRow){ ?>
					<form action="/vendor/core.php" method="POST">
						<input type="hidden" name="position-user-squad" value='1'>
						<input type="hidden" name="add-user-squad-id" value="<?= $squadListRow['id']?>">
						<button class="squad-user-position-row" type="submit" name="add-user-squad-btn"
						value="1">
							<?= $squadListRow['login'] ?>
						</button>
					</form>
					<?php } ?>
					</div>
				</div>

				<div class="squad-user-position-wrapper">
				<?php 
					$squadUser = R::findOne('user', 'id = ?', array($squadRow['member_squad_2']))
				?>
					<div class="squad-user-position" onclick="viewSquaList(2)">
						<span>
							<?php if($squadUser == 0):?>Пусто #2
							<?php else: print_r($squadUser['login'])?>
							<?php endif; ?>
						</span>

					</div>
					<span id="close-list-2" class="close-squad-user-position-list" onclick="closeSquaList(2)">x</span>
					<div id="squad-user-position-list-2" class="squad-user-position-mainpvp-list">
					<?php foreach($squadList as $squadListRow){ ?>
					<form action="/vendor/core.php" method="POST">
						<input type="hidden" name="position-user-squad" value='2'>
						<input type="hidden" name="add-user-squad-id" value="<?= $squadListRow['id']?>">
						<button class="squad-user-position-row" type="submit" name="add-user-squad-btn"
						value="1">
							<?= $squadListRow['login'] ?>
						</button>
					</form>
					<?php } ?>
					</div>
				</div>

			<div class="squad-user-position-wrapper">
				<?php 
					$squadUser = R::findOne('user', 'id = ?', array($squadRow['member_squad_3']))
				?>
					<div class="squad-user-position" onclick="viewSquaList(3)">
						<span>
							<?php if($squadUser == 0):?>Пусто #3
							<?php else: print_r($squadUser['login'])?>
							<?php endif; ?>
						</span>

					</div>
					<span id="close-list-3" class="close-squad-user-position-list" onclick="closeSquaList(3)">x</span>
					<div id="squad-user-position-list-3" class="squad-user-position-mainpvp-list">
					<?php foreach($squadList as $squadListRow){ ?>
					<form action="/vendor/core.php" method="POST">
						<input type="hidden" name="position-user-squad" value='3'>
						<input type="hidden" name="add-user-squad-id" value="<?= $squadListRow['id']?>">
						<button class="squad-user-position-row" type="submit" name="add-user-squad-btn"
						value="1">
							<?= $squadListRow['login'] ?>
						</button>
					</form>
					<?php } ?>
					</div>
				</div>
				
				<div class="squad-user-position-wrapper">
				<?php 
					$squadUser = R::findOne('user', 'id = ?', array($squadRow['member_squad_4']))
				?>
					<div class="squad-user-position" onclick="viewSquaList(4)">
						<span>
							<?php if($squadUser == 0):?>Пусто #4
							<?php else: print_r($squadUser['login'])?>
							<?php endif; ?>
						</span>

					</div>
					<span id="close-list-4" class="close-squad-user-position-list" onclick="closeSquaList(4)">x</span>
					<div id="squad-user-position-list-4" class="squad-user-position-mainpvp-list">
					<?php foreach($squadList as $squadListRow){ ?>
					<form action="/vendor/core.php" method="POST">
						<input type="hidden" name="position-user-squad" value='4'>
						<input type="hidden" name="add-user-squad-id" value="<?= $squadListRow['id']?>">
						<button class="squad-user-position-row" type="submit" name="add-user-squad-btn"
						value="1">
							<?= $squadListRow['login'] ?>
						</button>
					</form>
					<?php } ?>
					</div>
				</div>
				
				<div class="squad-user-position-wrapper">
				<?php 
					$squadUser = R::findOne('user', 'id = ?', array($squadRow['member_squad_5']))
				?>
					<div class="squad-user-position" onclick="viewSquaList(5)">
						<span>
							<?php if($squadUser == 0):?>Пусто #5
							<?php else: print_r($squadUser['login'])?>
							<?php endif; ?>
						</span>

					</div>
					<span id="close-list-5" class="close-squad-user-position-list" onclick="closeSquaList(5)">x</span>
					<div id="squad-user-position-list-5" class="squad-user-position-mainpvp-list">
					<?php foreach($squadList as $squadListRow){ ?>
					<form action="/vendor/core.php" method="POST">
						<input type="hidden" name="position-user-squad" value='5'>
						<input type="hidden" name="add-user-squad-id" value="<?= $squadListRow['id']?>">
						<button class="squad-user-position-row" type="submit" name="add-user-squad-btn"
						value="1">
							<?= $squadListRow['login'] ?>
						</button>
					</form>
					<?php } ?>
					</div>
				</div>

				<?php
					foreach ($squad as $squadRow){
					if($squadRow['squad'] == 1){
				?>	
					<span class="squad-user"><?= $squadRow['login']?></span>
				<?php }} ?>	
				<div class="squad-description-wrapper">
					<span class="squad-description">Описание</span>
					<p class="squad-description-text"><?= $squadRow['description_squad']?></p>
				</div>
			</div>

		<?php
			$squad = R::findAll('user', 'squad = ?', array(2));

			foreach ($squad as $squadRow) {} ?>

			<div class="squad-list">
				<span class="squad-name" style="background-color: #06135f;">Def1</span>

				<?php
					foreach ($squad as $squadRow){
					if($squadRow['squad'] == 2){
				?>	
					<span class="squad-user"><?= $squadRow['login']?><</span>
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
				<span class="squad-name" style="background-color: #e74c3c;">Def2</span>

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
				<span class="squad-name" style="background-color: #2da103;">Bio</span>

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