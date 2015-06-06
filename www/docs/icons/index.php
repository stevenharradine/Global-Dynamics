<?php
	require_once '../../views/_secureHead.php';
	require_once 'views/icons.php';
	require_once 'views/howToUseIcons.php';

	if( isset ($sessionManager) && $sessionManager->isAuthorized () ) {
	
		$page_title = 'Icons';
		$isDocumentation = true;

		$views_to_load = array();
		$views_to_load[] = ' ' . HowToUseIconsView::render ( null );
		$views_to_load[] = ' ' . IconsView::render ( null );
		
		include $relative_base_path . 'views/_generic.php';
	}