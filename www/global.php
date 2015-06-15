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
//		$createUsers				= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`users` (`USER_ID` int(5) NOT NULL AUTO_INCREMENT,`user_type` text NOT NULL,`username` text NOT NULL,`hash_algorithm` text NOT NULL,`salt` text NOT NULL,`password` text NOT NULL,PRIMARY KEY (`USER_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;") or die (mysql_error());
//		$createBookmarks			= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`bookmarks` (`BOOKMARK_ID` int(11) NOT NULL AUTO_INCREMENT,`USER_ID` int(11) NOT NULL,`title` text NOT NULL,`url` text NOT NULL,PRIMARY KEY (`BOOKMARK_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;") or die (mysql_error());
//		$createReaderFeeds			= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`reader_feeds` (`FEED_ID` int(11) NOT NULL AUTO_INCREMENT,`USER_ID` int(11) NOT NULL,`name` text NOT NULL,`label` text NOT NULL,`rss` text NOT NULL,`isDisabled` tinyint(1) NOT NULL DEFAULT '0',PRIMARY KEY (`FEED_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;") or die (mysql_error());
//		$createReaderCache			= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`reader_cache` (`ITEM_ID` int(11) NOT NULL AUTO_INCREMENT,`USER_ID` int(11) NOT NULL,`FEED_ID` int(11) NOT NULL,`feed_name` text NOT NULL,`label` text NOT NULL,`url` text NOT NULL,`title` text NOT NULL,`description` text NOT NULL,`posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,`viewed` tinyint(1) NOT NULL DEFAULT '0',`favorite` tinyint(1) NOT NULL DEFAULT '0',PRIMARY KEY (`ITEM_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;") or die (mysql_error());
//		$createContacts				= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`contacts` (`CONTACT_ID` int(11) NOT NULL AUTO_INCREMENT,`USER_ID` int(11) NOT NULL,`first_name` text NOT NULL,`middle_name` text NOT NULL,`last_name` text NOT NULL,`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`CONTACT_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;") or die (mysql_error());
//		$createContactsAddress		= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`contacts_address` (`ADDRESS_ID` int(11) NOT NULL AUTO_INCREMENT,`CONTACT_ID` int(11) NOT NULL,`location` text NOT NULL,`street_number` int(11) NOT NULL,`street_name` text NOT NULL,`street_type` text NOT NULL,`street_direction` text NOT NULL,`postal_code` text NOT NULL,`city` text NOT NULL,`province` text NOT NULL,`country` text NOT NULL,`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,PRIMARY KEY (`ADDRESS_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;") or die (mysql_error());
//		$createContactsEmail		= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`contacts_email` (`EMAIL_ID` int(11) NOT NULL AUTO_INCREMENT,`CONTACT_ID` int(11) NOT NULL,`location` text NOT NULL,`email` text NOT NULL,PRIMARY KEY (`EMAIL_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;") or die (mysql_error());
//		$createContactsNotes		= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`contacts_notes` (`NOTE_ID` int(11) NOT NULL AUTO_INCREMENT,`CONTACT_ID` int(11) NOT NULL,`title` text NOT NULL,`note` text NOT NULL,`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`NOTE_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;") or die (mysql_error());
//		$createContactsPhone		= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`contacts_phonenumber` (`PHONENUMBER_ID` int(11) NOT NULL AUTO_INCREMENT,`CONTACT_ID` int(11) NOT NULL,`location` text NOT NULL,`phonenumber` text NOT NULL,`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`PHONENUMBER_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;") or die (mysql_error());
//		$createBudget				= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`spending` (`SPENDING_ID` int(11) NOT NULL AUTO_INCREMENT,`USER_ID` int(11) NOT NULL,`amount` float NOT NULL,`category` text NOT NULL,`store` text NOT NULL,`items` text NOT NULL,`date` datetime NOT NULL,PRIMARY KEY (`SPENDING_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1;") or die (mysql_error());
//		$createSpendingRecurring	= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`budget_recurring` (`RECURRING_ID` int(11) NOT NULL,`USER_ID` int(11) NOT NULL,`amount` float NOT NULL,`category` text NOT NULL,`store` text NOT NULL,`items` text NOT NULL,`startDate` datetime NOT NULL,`endDate` datetime NOT NULL) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;") or die (mysql_error());
//		$createNutritionHistory		= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`nutrition_history` (`NUTRITION_HISTORY_ID` int(11) NOT NULL AUTO_INCREMENT,`USER_ID` int(11) NOT NULL,`FOOD_ID` int(11) NOT NULL,`quantity` float NOT NULL DEFAULT '1',`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`NUTRITION_HISTORY_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;") or die (mysql_error());
//		$createNutritionInformation	= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`nutrition_information` (`FOOD_ID` int(11) NOT NULL AUTO_INCREMENT,`name` text NOT NULL,`brand` text NOT NULL,`serving_size` float NOT NULL,`serving_unit` text NOT NULL,`calories` float NOT NULL,`fat` float NOT NULL,`fat_saturated` float NOT NULL,`fat_trans` float NOT NULL,`fat_monosaturated` float NOT NULL,`fat_polysaturated` float NOT NULL,`cholesterol` float NOT NULL,`sodium` float NOT NULL,`potassium` float NOT NULL,`carbohydrate` float NOT NULL,`fiber` float NOT NULL,`fiber_insoluble` float NOT NULL,`fiber_soluble` float NOT NULL,`sugar` float NOT NULL,`protein` float NOT NULL,`calcium` float NOT NULL,`zinc` float NOT NULL,`copper` float NOT NULL,`manganese` float NOT NULL,`selenium` float NOT NULL,`fluoride` float NOT NULL,`niacin` float NOT NULL,`folate` float NOT NULL,`magnesium` float NOT NULL,`phosphorus` float NOT NULL,`iron` float NOT NULL,`riboflavin` float NOT NULL,`vitamin_a` float NOT NULL,`vitamin_b12` float NOT NULL,`vitamin_c` float NOT NULL,`vitamin_d` float NOT NULL,`vitamin_e` float NOT NULL,`vitamin_k` float NOT NULL,`thiamine` float NOT NULL,`vitamin_b6` float NOT NULL,`pantothenic_acid` float NOT NULL,`choline` float NOT NULL,`betaine` float NOT NULL,PRIMARY KEY (`FOOD_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;") or die (mysql_error());
//		$createMusic				= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`music` (  `MUSIC_ID` int(11) NOT NULL AUTO_INCREMENT,  `path` text NOT NULL,  `artist` text NOT NULL,  `track` text NOT NULL,  `album` text NOT NULL,  `year` text NOT NULL,  `track_no` int(11) NOT NULL DEFAULT '-1',  `cover` text,  `md5` text NOT NULL,  `last_md5_pass` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,  `md5_checked` tinyint(1) NOT NULL DEFAULT '0',  PRIMARY KEY (`MUSIC_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;") or die (mysql_error());
//		$createMusicPlaylist		= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`music_playlist` (`PLAYLIST_ID` int(11) NOT NULL AUTO_INCREMENT,`MUSIC_ID` int(11) NOT NULL,`USER_ID` int(11) NOT NULL,`playlist_name` text NOT NULL,PRIMARY KEY (`PLAYLIST_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;") or die (mysql_error());
//		$createSettings				= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`settings` (`SETTING_ID` int(9) NOT NULL AUTO_INCREMENT, `key` text NOT NULL,  `value` text NOT NULL,   PRIMARY KEY (`SETTING_ID`) ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;") or die (mysql_error());
//		$createError				= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`error` (  `ERROR_ID` int(11) NOT NULL AUTO_INCREMENT,  `subsystem` text NOT NULL,  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, `description` text NOT NULL, PRIMARY KEY (`ERROR_ID`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;") or die (mysql_error());
//		$createPassman				= mysql_query ("CREATE TABLE IF NOT EXISTS `sarah`.`passman` (`PASSMAN_ID` int(11) NOT NULL AUTO_INCREMENT,`USER_ID` int(11) NOT NULL,`site` text NOT NULL,`url` text NOT NULL,`username` text NOT NULL,`password` text NOT NULL,`last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`PASSMAN_ID`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1;") or die (mysql_error());
		
		$insertUsers				= mysql_query ("INSERT INTO `sarah`.`users` (`USER_ID`, `user_type`, `username`, `hash_algorithm`, `salt`, `password`) VALUES (1, 'ADMIN', 'douglas', 'SHA256', 'HjgawkNjtbanNZ8KBx3Er9xPRjHaGLCXSGExofDVQhBT1uGbK7kZSr+oC+RtZqnDN79XH228wxsJi8+R0gat/g==', '51bee9acdef40861896bfeb04cc3c6a3f0ba6392a2500e77e84949f3cea6526c');") or die (mysql_error());
		$insertSettings				= mysql_query ("INSERT INTO `sarah`.`settings` (`key`, `value`) VALUES ('music_fileRoot', '/Music'), ('music_localStartPath', '/etc/SARAH/media'), ('music_webStartPath', 'http://localhost/media'), ('music_flacTranscodePath', '/transcode/flac'), ('music_coverIndex', '0'), ('music_coversPath', '/covers'), ('youtubedownloader_savedir', '/Music/Music%20Videos/'), ('music_audio', 'mp3;flac;aac;m4a'), ('music_video', 'mp4;flv;mpg;mpeg;mkv;ts;avi'), ('music_default_audio', 'mp3'), ('music_default_video', 'mp4');") or die (mysql_error());

		return	$createDB &&
				$createUsers &&
				$insertUsers &&
				$createBookmarks &&
				$createReaderFeeds &&
				$createReaderCache &&
				$createContacts &&
				$createContactsAddress &&
				$createContactsEmail &&
				$createContactsNotes &&
				$createContactsPhone &&
				$createBudget &&
				$createSpendingRecurring &&
				$createNutritionHistory &&
				$createNutritionInformation &&
				$createMusic &&
				$createMusicPlaylist;
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