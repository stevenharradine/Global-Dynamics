<?php
	session_start();

	$relative_base_path = '../';

	require_once '../global.php';
	require_once '_model.php';
	
	// Connects to your Database
	mysql_connect($DB_ADDRESS, $DB_USER, $DB_PASS) or die(mysql_error());
	mysql_select_db($DB_NAME) or die(mysql_error());

	// To protect MySQL injection (more detail about MySQL injection)
	$username = mysql_real_escape_string(stripslashes($_POST['myusername']));
	$password = mysql_real_escape_string(stripslashes($_POST['mypassword']));

	$authManager = new AuthManager();

	$checkLogin = $authManager->checkLogin($username, $password);

	// if a single record was found given the username and password
	if ($checkLogin['count'] == 1) {
		// store  nessasary data to the session
		$_SESSION['USER_ID'] = $checkLogin['USER_ID'];
		$_SESSION['usertype'] = $checkLogin['user_type'];
		$_SESSION['username'] = $username;

		$sessionManager = new sessionManager ($checkLogin['USER_ID'], $checkLogin['user_type'], $username);

		$_SESSION['sessionManager'] = serialize ($sessionManager);
		
		// redriect the client to their requested page (prior to require login)
		header("location:login_success.php" . (isset ($_REQUEST['page']) ? '?page=' . $_REQUEST['page'] : ''));
	} else {	// wrong username or password

		$page_title = 'Error: Wrong Username or Password | Login';
		// load views to be used in front end
//		$views_to_load = array();
//		$views_to_load[] = ' ' . '<p></p>';
		
		include 'login.php';
	}
?> 
