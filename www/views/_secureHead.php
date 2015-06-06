<?php
	session_start();
	ini_set('display_errors', '1');

	$relative_base_path = isset ($relative_base_path) ? $relative_base_path : '../../';

	require_once $relative_base_path . 'global.php';
	require_once $relative_base_path . 'models/add.php';
	require_once $relative_base_path . 'models/search.php';
	require_once $relative_base_path . 'models/table.php';
	require_once $relative_base_path . 'models/button.php';
	require_once $relative_base_path . 'models/icon.php';
	require_once 'config.php';
	require_once '_model.php';

	if( isset ($_SESSION['sessionManager']) ) {
		$sessionManager = unserialize ($_SESSION['sessionManager']);
	} else {
		$sessionManager = new sessionManager (null);
	}


	// TODO: this needs to be consolidated with auth possibly make auth a service :) ---------
	if (request_isset('myusername') && request_isset('mypassword')) {
		require_once '/etc/SARAH/www/auth/_model.php';
		// Connects to your Database
		mysql_connect($DB_ADDRESS, $DB_USER, $DB_PASS) or die(mysql_error());
		mysql_select_db($DB_NAME) or die(mysql_error());
		// To protect MySQL injection (more detail about MySQL injection)
		$username = mysql_real_escape_string(stripslashes(request_isset('myusername')));
		$password = mysql_real_escape_string(stripslashes(request_isset('mypassword')));
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
		}
	}
	// END -----------------------------------------------------------------------------------


	if( $sessionManager->isAuthorized () ) {
		$USER_ID = $_SESSION['USER_ID'];
		
		$page_action = request_isset ('action');

		$db_link = DB_Connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_NAME);
	} else {
		if ( isset ($forceLogin) ) {
			if ( $forceLogin == true ) {
				require_once ($relative_base_path . 'auth/login.php');
			}
		} else {
			require_once ($relative_base_path . 'auth/login.php');
		}
	}