<nav id="menu">
			<a class="menu-element"><?= $user->login ?></a>
			<span id="account"></span>
			<a class="menu-element" href="/pages/compound.php">Состав и снаряга</a>
			<a class="menu-element" href="/pages/squad.php">Отряды</a>
			<a class="menu-element" href="/pages/treasury.php">Казна и коммисия</a>
		<?php if($user->role == 2): ?>
			<a class="menu-element" href="/pages/add-armor.php">+ Добавить снарягу</a>
		<?php endif ?>
			<a href="/index.php" id="name">Bobruku</a>
</nav>