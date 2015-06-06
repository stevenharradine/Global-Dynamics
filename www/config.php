<?php
	$config = json_decode(
		file_get_contents( $relative_base_path . '../config.json' ),
		true
	);

	// Database
	$DB_ADDRESS = $config['DB_ADDRESS'];
	$DB_USER = $config['DB_USER'];
	$DB_PASS = $config['DB_PASS'];
	$DB_NAME = $config['DB_NAME'];
