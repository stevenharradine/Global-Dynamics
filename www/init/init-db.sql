--
-- Table structure for table `bookmarks`
--

CREATE TABLE IF NOT EXISTS `bookmarks` (
  `BOOKMARK_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `title` text NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`BOOKMARK_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`BOOKMARK_ID`, `USER_ID`, `title`, `url`) VALUES
(2, 1, 'SARAH Git', 'https://stevenharradine@bitbucket.org/stevenharradine/sarah.git');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `USER_ID` int(5) NOT NULL AUTO_INCREMENT,
  `user_type` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `user_type`, `username`, `password`) VALUES
(1, 'ADMIN', 'douglas', 'fargo');

--
-- Table structure for table `reader_feeds`
--

CREATE TABLE IF NOT EXISTS `reader_feeds` (
  `FEED_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `label` text NOT NULL,
  `rss` text NOT NULL,
  `isDisabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`FEED_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

-- Table structure for table `reader_cache`
--

CREATE TABLE IF NOT EXISTS `reader_cache` (
  `ITEM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `FEED_ID` int(11) NOT NULL,
  `feed_name` text NOT NULL,
  `label` text NOT NULL,
  `url` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `favorite` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ITEM_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `SETTING_ID` int(9) NOT NULL AUTO_INCREMENT,
  `key` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`SETTING_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

--
-- Table structure for table `error`
--

CREATE TABLE IF NOT EXISTS `error` (
  `ERROR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `subsystem` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  PRIMARY KEY (`ERROR_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;