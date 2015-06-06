<?php
	$relative_base_path = '../';
	require_once $relative_base_path . 'global.php';

	DB_Connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_NAME);
	
	$isDBinit = false;
	
	if (!isDBInit()) {
		$isDBinit = DBInit();
	}
?><!DOCTYPE html>
<html>
	<head>
		<title>Initialize database | SARAH</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="../css/responsive.css" />
		<script src="../js/jquery-1.6.2.min.js"></script>
	</head>
	<body class="init">
		<header>
			<a href="../" class="back">&lt; SARAH</a>
			<h1>Initialize database</h1>
		</header>
		<div class="content">
			<?php if ($isDBinit) { ?>
			<p>Your database should be initialized now.  You should continue back to the homepage and login.  The default administrative credentials are:</p>
			<table>
				<tr>
					<th>Username:</th>
					<td>douglas</th>
				</tr>
				<tr>
					<th>Password:</th>
					<td>fargo</th>
				</tr>
			</table>
			<p>You may login and create more accounts and <em>don't</em> forget to change the default accounts username/password!
			<?php } ?>
		</div>
	</body>
</html>