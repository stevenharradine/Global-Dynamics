<?php
	if ( !isAjax() ) {
		include '_header.php';
	}

	if (isset ($views_to_load)) {
		foreach ($views_to_load as $view) {
			if (beginsWith ($view, ' ')) {	// raw input (html)
				echo $view;
			} else if (beginsWith ($view, '.') || beginsWith ($view, '/')) {
				include $view;
			} else {
				include 'views/' . $view;
			}
		}
	}

	if ( !isAjax() ) {
		include '_footer.php';
	}