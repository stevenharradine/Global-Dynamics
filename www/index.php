<?php
	session_start();
	$relative_base_path = './';
	
	require_once 'global.php';
	require_once $relative_base_path . 'models/icon.php';
	
	DB_Connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_NAME);
	
	$page = isset ($_REQUEST['page']) ? $_REQUEST['page'] : "overview";
	
	$page_title = 'SARAH';
	if( isset ($_SESSION['username']) ) {
		$alt_menu = '<a href="auth/logout.php' . ( isset ( $_REQUEST['page'] ) ? '?page=' . $_REQUEST['page'] : '') .'" id="logout" class="add">' . IconView::render( new IconModel ('logout', 'Logout')) . '</a>';
	} else {
		$alt_menu = '<a href="auth/login.php' . ( isset ( $_REQUEST['page'] ) ? '?page=' . $_REQUEST['page'] : '') . '" id="login" class="add">' . IconView::render( new IconModel ('login', 'Login')) . '</a>';
	}
	
	include 'views/_header.php';
?>
		<div id="navigation" class="tabs">
<?php include 'views/_appList.php'; ?>
		</div>
<?php
	include 'views/_footer.php';