<?php
	if ( strpos( $_SERVER['REQUEST_URI'], '/apps/') !== false ) {	// if in apps
		$relative_base_path = '../../';
	} else {														// prob on main index page of SARAH
		$relative_base_path = '../';
	}
	$page_title = isset ($page_title) ? $page_title : 'Login';
	$style = <<<EOD
			label, input {
				display: block;
			}
			.content {
				margin: 5%;
				padding-top: 20px;
			}
EOD;
	include $relative_base_path . 'views/_header.php';
?>
			<section id="login">
				<form name="form1" method="post" action="<?php echo $relative_base_path; ?>auth/checklogin.php<?php echo isset ($_REQUEST['page']) ? '?page=' . $_REQUEST['page'] : ''; ?>" class="form">
					<label for="myusername">Username:</label> <input name="myusername" type="text" id="myusername" autofocus="autofocus" /><br />
					<label for="mypassword">Password:</label> <input name="mypassword" type="password" id="mypassword" /><br />
					<input type="submit" name="Submit" value="Login" />
				</form>
			</section>
<?php
	include $relative_base_path . 'views/_footer.php';