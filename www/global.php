<?php
	ini_set('display_errors', '1');
//	error_reporting(-1);
	include_once ('session-manager.php');
	include_once ('application.php');
	include_once ('helpers/load.php');
	require_once ($relative_base_path . 'config.php');
	
	function DB_Connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_NAME) {
		$link = mysql_connect($DB_ADDRESS, $DB_USER, $DB_PASS);
		
		if(!$link) {
			die ('Could not connect to MySQL');
		}

		if (isDBInit ()) {
			mysql_select_db($DB_NAME, $link) or die(mysql_error());
		}
		
		return $link;
	}
	
	function request_isset ($index, $default_value = null) {
		return isset ($_REQUEST[$index]) ? $_REQUEST[$index] : $default_value;
	}
	
	function isDBInit () {
		$sql = <<<EOD
	SELECT
		COUNT(*)
	FROM
		INFORMATION_SCHEMA.SCHEMATA
	WHERE
		SCHEMA_NAME = 'sarah'
EOD;
		$db_list = mysql_query ( $sql ) or die (mysql_error());

		return mysql_fetch_array($db_list)['COUNT(*)'];
	}
	
	function DBInit () {
		$createDB					= mysql_query ('CREATE DATABASE `sarah`') or die (mysql_error()) ? 'Created database "sarah"' : 'ERROR: database "sarah" not created';
		$insertUsers				= mysql_query ("INSERT INTO `sarah`.`users` (`USER_ID`, `user_type`, `username`, `hash_algorithm`, `salt`, `password`) VALUES (1, 'ADMIN', 'douglas', 'SHA256', 'HjgawkNjtbanNZ8KBx3Er9xPRjHaGLCXSGExofDVQhBT1uGbK7kZSr+oC+RtZqnDN79XH228wxsJi8+R0gat/g==', '51bee9acdef40861896bfeb04cc3c6a3f0ba6392a2500e77e84949f3cea6526c');") or die (mysql_error());
		$insertSettings				= mysql_query ("INSERT INTO `sarah`.`settings` (`key`, `value`) VALUES ('music_fileRoot', '/Music'), ('music_localStartPath', '/etc/SARAH/media'), ('music_webStartPath', 'http://localhost/media'), ('music_flacTranscodePath', '/transcode/flac'), ('music_coverIndex', '0'), ('music_coversPath', '/covers'), ('youtubedownloader_savedir', '/Music/Music%20Videos/'), ('music_audio', 'mp3;flac;aac;m4a'), ('music_video', 'mp4;flv;mpg;mpeg;mkv;ts;avi'), ('music_default_audio', 'mp3'), ('music_default_video', 'mp4');") or die (mysql_error());

		return	$createDB &&
				$insertSettings &&
				$insertUsers;
		//echo mysql_query ("") or die (mysql_error());
	}
	
	function sEditWrite ($id, $label, $value, $extra = '') {
		return "<form action='index.php' method='POST'>$extra<input type='hidden' name='id' value='$id' /><input type='hidden' name='action' value='save_$label". "_by_id' /><input type='text' value='$value' name='$label' /><input type='submit' value='Save' /></form>";
	}
	
	function delimitedToJSArray ($delimiter, $haystack) {
		$exploded = explode ($delimiter, $haystack);
		
		$jsArray = '[';
		foreach ($exploded as $item) {
			$jsArray .= "\"$item\",";
		}
		$jsArray = substr ($jsArray, 0, strlen ($jsArray) - 1) . ']';
		
		return $jsArray;
	}
	
	// http://stackoverflow.com/questions/193794/how-can-i-change-a-files-extension-using-php on 20140215 @ 18:00 EST
	function replace_extension($filename, $new_extension) {
		$info = pathinfo($filename);
		return $info['dirname'] . '/' . $info['filename'] . '.' . $new_extension;
	}
	
   /*
	* isExtentionValid (String path, String[] extentions)
	* returns boolean, does the path end with an extention in the extentions array?
	*/
	function isExtentionValid ($path, $extentions) {
		foreach ($extentions as $extention) {
			if (endsWith (strtolower ($path), strtolower ($extention))) {
				return true;
			}
		}
		
		return false;
	}
	
	// TODO: i dont think mysql_real_escapre_string is the right way to do this.
	function db_safe ($str) {
		//$safe_str = str_replace($str, '\'', '\\\'');
		return mysql_real_escape_string($str);
	}

	function isAjax () {
		// Taken from http://stackoverflow.com/questions/4301150/how-do-i-check-if-the-request-is-made-via-ajax-with-php on 20140416 at 00:07 EST
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
	}