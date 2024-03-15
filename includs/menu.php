<nav id="menu">
			<a class="menu-element" href="/pages/profile.php?id=<?= $user->id ?>"><?= $user->login ?></a>
			<span id="account"></span>
			<a href="/pages/mail.php"><img id="menu-mail" src="/assets/icon/icon-mail.png"></a>
			<a class="menu-element" href="/pages/compound.php">Состав и снаряга</a>
			<a class="menu-element" href="/pages/squad.php">Отряды</a>
			<a class="menu-element" href="/pages/exchequer.php">Казна и сборы</a>
		<?php if($user->role == 2): ?>
			<a class="menu-element" href="/pages/add-armor.php">+ Добавить снарягу</a>
		<?php endif ?>
			<a href="/index.php" id="name">King and Clown</a>
</nav>