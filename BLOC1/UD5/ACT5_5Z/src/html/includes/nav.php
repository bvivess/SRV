<?php require_once dirname(__DIR__, 3) . '/src/config/config.php'; ?>

<nav id="menu" aria-label="Main navigation">
	<ul>
		<!-- 'href' no abreviat -->
		<li><a href="<?php echo BASE_URL; ?>/index.php">Home</a></li>
		<li>
			HR
			<ul>
				<!-- 'href' abreviat -->
				<li><a href="<?= BASE_URL ?>/src/html/Employees/employees_list.php">Employees</a></li>
			</ul>
		</li>
	</ul>
</nav>
