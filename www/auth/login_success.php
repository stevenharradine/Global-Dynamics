<?php
session_start();
require_once '../global.php';

if(isset ($_SESSION['username'])){
	if (endsWith ($_SERVER['HTTP_REFERER'], '/auth/login.php') || endsWith ($_SERVER['HTTP_REFERER'], '/auth/checklogin.php')) {
		$goto_url = '../';
	} else {
		$goto_url = $_SERVER['HTTP_REFERER'];
	}
} else {
	$goto_url = 'login.php';
}
header ('location: ' . $goto_url);
?>
