<?php
	// $relative_base_path = '../../'
	// $page_title = '{TITLE}';
	// $style = <<<EOD
	//     * { padding: 0; margin: 0 }
	// EOD;
	// $meta = '';
	
	if ( !isset ( $relative_base_path ) ) {
		$relative_base_path = '../../';
	}

	$debug_url = request_isset ('debug');
	if (isset ($_REQUEST['debug'])) {
		setcookie("frontend_debug", $debug_url, time() + 60);
	}

		require_once $relative_base_path . 'models/icon.php';

	if (isset ($headerView)) {
?>
<!DOCTYPE html>
 <html>
	<head>
		<title><?php echo $headerView->getTitle(); ?> | SARAH</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<script data-main="require-loader.js" src="<?php echo $relative_base_path; ?>js/require.js"></script>
<?php if ( $headerView->getScript () != null ) { echo $headerView->getScript (); } ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $relative_base_path; ?>css/responsive.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $relative_base_path; ?>css/fonts.css" />
		<link rel="stylesheet" type="text/css" href="css/styles.css" />
<?php if ( $headerView->getLink () != null ) { echo $headerView->getLink (); } ?>
<?php if ( $headerView->getStyle() != null ) { ?>
		<style>
<?php echo $headerView->getStyle(); ?>
		</style>
<?php } ?>
<?php if ( $headerView->getMeta() ) { echo $headerView->getMeta(); } ?>
	</head>
	<body>
		<header>
<?php
		if ( $relative_base_path != './' ) {
// <a href="<?php  echo ( endsWith ($_SERVER['REQUEST_URI'], 'index.php') || endsWith ($_SERVER['REQUEST_URI'], '/') ) ? '../../' : './'; ?*****>" class="back">&lt; SARAH</a>
?>
			<?php echo IconView::render( new IconModel ('hamburger', 'Menu')); ?>
<?php
		}
?>
<?php if ( $headerView->getAltMenu () != null ) { echo $headerView->getAltMenu (); } ?>
			<h1><?php echo explode ( '|', $headerView->getTitle () )[0]; ?></h1>
<?php if ( $headerView->getOther () != null ) { echo $headerView->getOther (); } ?>
		</header>
		<nav class="main">
<?php include '_appList.php'; ?>
		</nav>
		<div class="content" id="content">
<?php
	} else {	// legacy support 
?>
<!DOCTYPE html>
 <html>
	<head>
		<title><?php echo isset ($page_title) ? $page_title : $app_title; ?> | SARAH</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<script data-main="require-loader.js" src="<?php echo $relative_base_path; ?>js/require.js"></script>
<?php if ( isset ( $script ) ) { echo $script; } ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $relative_base_path; ?>css/responsive.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $relative_base_path; ?>css/fonts.css" />
		<link rel="stylesheet" type="text/css" href="css/styles.css" />
<?php if ( isset ( $links ) ) { echo $links; } ?>
<?php if ( isset ( $style ) ) { ?>
		<style>
<?php echo "$style\n"; ?>
		</style>
<?php } ?>
<?php if ( isset ( $meta ) ) { echo $meta; } ?>
	</head>
	<body>
		<header>
<?php
		if ( $relative_base_path != './' ) {
// <a href="<?php  echo ( endsWith ($_SERVER['REQUEST_URI'], 'index.php') || endsWith ($_SERVER['REQUEST_URI'], '/') ) ? '../../' : './'; ?*****>" class="back">&lt; SARAH</a>
?>
			<?php echo IconView::render( new IconModel ('hamburger', 'Menu')); ?>
			<?php if ( isset ( $header_other ) ) { echo $header_other; } ?>
<?php
		}
?>
<?php if ( isset ( $alt_menu ) ) { echo $alt_menu; } ?>
			<h1><?php echo explode ( '|', isset ($page_title) ? $page_title : $app_title )[0]; ?></h1>
		</header>
		<nav class="main">
<?php include '_appList.php'; ?>
		</nav>
		<div class="content" id="content">
<?php
	}
?>