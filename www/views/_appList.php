<?php
	require_once $relative_base_path . 'models/icon.php';

	$path = (isset ($isDocumentation) && $isDocumentation ? 'docs' : 'apps');

	require_once $relative_base_path . $path .'/registered.php';
?>
	<ul>
<?php
		$usertype = isset ($_SESSION['usertype']) ? $_SESSION['usertype'] : 'NONE';

		foreach ($registered_apps as $app) {
			require $relative_base_path . "$path/$app/config.php";
			
			if (in_array ($usertype, $app_users)) {
?>
				<li><a href="<?php echo $relative_base_path . "$path/$app" ?>/"><?php echo IconView::render( new IconModel ($app_icon_id, $app_title)) ?></a></li>
<?php
			}
		}

		if (isset ($_SESSION['usertype'])) {	// if logged in
			if ($path != 'docs') {
?>
				<li><a href="<?php echo $relative_base_path . "docs/" ?>"><?php echo IconView::render( new IconModel ('gear', 'Documentation')) ?></a></li>
<?php
			} else {
?>
				<li><a href="<?php echo $relative_base_path ?>"><?php echo IconView::render( new IconModel ('gear', 'Apps')) ?></a></li>
<?php
			}
?>
			<li><a href="<?php echo $relative_base_path; ?>auth/logout.php"><?php echo IconView::render( new IconModel ('logout', 'Log out')) ?></a></li>
<?php
	} else {
?>
			<li><a href="<?php echo $relative_base_path; ?>auth/login.php"><?php echo IconView::render( new IconModel ('login', 'Log in')) ?></a></li>
<?php
		}
?>
	</ul>