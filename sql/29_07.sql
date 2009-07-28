-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 29 Lip 2009, 00:44
-- Wersja serwera: 5.0.51
-- Wersja PHP: 5.2.5

--
-- Baza danych: `cube3`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_addalgs_cats_algs`
--

CREATE TABLE IF NOT EXISTS `portal_addalgs_cats_algs` (
  `ID` int(5) NOT NULL auto_increment,
  `cat` varchar(20) binary NOT NULL,
  `cat_alg` varchar(20) binary NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `cat` (`cat`)
) TYPE=MyISAM  AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_addalgs_movement`
--

CREATE TABLE IF NOT EXISTS `portal_addalgs_movement` (
  `ID` int(10) NOT NULL auto_increment,
  `cat` varchar(20) binary NOT NULL,
  `cat2` varchar(20) binary NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `cat` (`cat`)
) TYPE=MyISAM  AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_addalgs_moves`
--

CREATE TABLE IF NOT EXISTS `portal_addalgs_moves` (
  `ID` int(5) NOT NULL auto_increment,
  `cat` varchar(20) binary NOT NULL,
  `moves` varchar(100) binary default NULL,
  PRIMARY KEY  (`ID`),
  KEY `cat` (`cat`)
) TYPE=MyISAM  AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_algs`
--

CREATE TABLE IF NOT EXISTS `portal_algs` (
  `ID` int(10) NOT NULL auto_increment,
  `pre` varchar(15) binary default NULL,
  `alg` varchar(200) binary NOT NULL,
  `htm` int(5) NOT NULL default '0',
  `qtm` int(5) NOT NULL default '0',
  `stm` int(5) NOT NULL default '0',
  `user_id` int(5) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `alg` (`alg`)
) TYPE=MyISAM  AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_algs_sids`
--

CREATE TABLE IF NOT EXISTS `portal_algs_sids` (
  `ID` int(10) NOT NULL auto_increment,
  `alg_id` int(10) NOT NULL,
  `sid_id` int(6) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `sid_id` (`sid_id`)
) TYPE=MyISAM  AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_cats`
--

CREATE TABLE IF NOT EXISTS `portal_cats` (
  `ID` int(2) NOT NULL auto_increment,
  `name` varchar(20) binary NOT NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM  AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_cats_imgcats`
--

CREATE TABLE IF NOT EXISTS `portal_cats_imgcats` (
  `ID` int(5) NOT NULL auto_increment,
  `method` int(2) NOT NULL,
  `chapter` varchar(20) binary default NULL,
  `subchapter` varchar(20) binary default NULL,
  `orientation` int(2) default NULL,
  `permutation` int(2) default NULL,
  `imgcat` varchar(100) binary NOT NULL,
  `imgcats` varchar(200) binary NOT NULL,
  `top_img` varchar(20) binary default NULL,
  `top_img_cats` varchar(100) binary default NULL,
  `title` varchar(100) binary default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM  AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_cats_sids`
--

CREATE TABLE IF NOT EXISTS `portal_cats_sids` (
  `ID` int(7) NOT NULL auto_increment,
  `SID` int(6) NOT NULL,
  `method` int(2) NOT NULL,
  `chapter` varchar(20) binary default NULL,
  `subchapter` varchar(20) binary default NULL,
  `orientation` int(2) default NULL,
  `permutation` int(2) default NULL,
  `key` varchar(10) binary default NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) TYPE=MyISAM  AUTO_INCREMENT=1637 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_cls_to_ss`
--

CREATE TABLE IF NOT EXISTS `portal_cls_to_ss` (
  `cls_SID` int(6) NOT NULL,
  `ss_SID` int(6) NOT NULL,
  KEY `cls_SID` (`cls_SID`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_coll_to_cll`
--

CREATE TABLE IF NOT EXISTS `portal_coll_to_cll` (
  `ID` int(10) NOT NULL auto_increment,
  `coll_SID` int(10) NOT NULL,
  `cll_SID` int(10) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `coll_SID` (`coll_SID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_comments`
--

CREATE TABLE IF NOT EXISTS `portal_comments` (
  `ID` int(5) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL,
  `SID` int(5) NOT NULL,
  `content` blob NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `ID` (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_eg_to_ortega_co`
--

CREATE TABLE IF NOT EXISTS `portal_eg_to_ortega_co` (
  `eg_SID` int(6) NOT NULL,
  `ortega_co_SID` int(6) NOT NULL,
  KEY `eg_SID` (`eg_SID`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_eg_to_ss`
--

CREATE TABLE IF NOT EXISTS `portal_eg_to_ss` (
  `eg_SID` int(10) NOT NULL,
  `ss_SID` int(10) NOT NULL,
  KEY `eg_SID` (`eg_SID`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_news`
--

CREATE TABLE IF NOT EXISTS `portal_news` (
  `ID` int(5) NOT NULL auto_increment,
  `Data` date NOT NULL,
  `Tytul` varchar(150) binary NOT NULL,
  `Tresc` text NOT NULL,
  `Dodal` varchar(50) binary NOT NULL,
  `Lang` varchar(3) binary NOT NULL,
  PRIMARY KEY  (`Data`,`ID`),
  KEY `ID` (`ID`)
) TYPE=MyISAM  AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_news_komentarze`
--

CREATE TABLE IF NOT EXISTS `portal_news_komentarze` (
  `ID` int(10) NOT NULL auto_increment,
  `NewsID` int(10) NOT NULL,
  `UserID` int(10) NOT NULL,
  `Tresc` text NOT NULL,
  `Data` date NOT NULL,
  KEY `ID` (`ID`)
) TYPE=MyISAM  AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_oll_to_els`
--

CREATE TABLE IF NOT EXISTS `portal_oll_to_els` (
  `oll_SID` int(101) NOT NULL,
  `els_SID` int(10) NOT NULL,
  `pre` varchar(10) binary default NULL,
  KEY `oll_SID` (`oll_SID`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_patterns`
--

CREATE TABLE IF NOT EXISTS `portal_patterns` (
  `SID` int(6) NOT NULL,
  `alg` varchar(100) binary NOT NULL,
  UNIQUE KEY `SID` (`SID`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_prev_next`
--

CREATE TABLE IF NOT EXISTS `portal_prev_next` (
  `ID` int(6) NOT NULL auto_increment,
  `SID` int(6) NOT NULL,
  `method` int(2) NOT NULL,
  `chapter` varchar(10) binary default NULL,
  `prev` int(6) NOT NULL,
  `next` int(6) NOT NULL,
  PRIMARY KEY  (`ID`,`SID`)
) TYPE=MyISAM  AUTO_INCREMENT=1637 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_pre_moves`
--

CREATE TABLE IF NOT EXISTS `portal_pre_moves` (
  `ID` int(5) NOT NULL auto_increment,
  `pre` varchar(20) binary default NULL,
  `pre2` varchar(20) binary default NULL,
  KEY `ID` (`ID`)
) TYPE=MyISAM  AUTO_INCREMENT=137 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_pre_moves2`
--

CREATE TABLE IF NOT EXISTS `portal_pre_moves2` (
  `ID` int(10) NOT NULL auto_increment,
  `pre` varchar(20) binary default NULL,
  `pre2` varchar(20) binary default NULL,
  PRIMARY KEY  (`ID`),
  KEY `pre` (`pre`)
) TYPE=MyISAM  AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_regrips`
--

CREATE TABLE IF NOT EXISTS `portal_regrips` (
  `ID` int(5) NOT NULL auto_increment,
  `pre` varchar(20) binary default NULL,
  `pre_end` varchar(50) binary default NULL,
  PRIMARY KEY  (`ID`),
  KEY `pre` (`pre`)
) TYPE=MyISAM  AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_sessions`
--

CREATE TABLE IF NOT EXISTS `portal_sessions` (
  `session_id` varchar(100) binary NOT NULL,
  `user_id` int(5) NOT NULL default '0',
  `session_start` int(11) default NULL,
  `session_time` int(11) default NULL,
  `session_ip` varchar(20) binary default NULL,
  `session_key` varbinary(100) default NULL,
  PRIMARY KEY  (`user_id`),
  KEY `ID` (`user_id`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_sids_best_algs`
--

CREATE TABLE IF NOT EXISTS `portal_sids_best_algs` (
  `SID` int(10) NOT NULL,
  `cat_1` int(10) NOT NULL,
  `votes_1` int(10) NOT NULL,
  `cat_2` int(10) NOT NULL,
  `votes_2` int(10) NOT NULL,
  `cat_3` int(10) NOT NULL,
  `votes_3` int(10) NOT NULL,
  PRIMARY KEY  (`SID`),
  KEY `cat_1` (`cat_1`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_situations`
--

CREATE TABLE IF NOT EXISTS `portal_situations` (
  `ID` int(15) NOT NULL auto_increment,
  `SID` int(6) NOT NULL,
  `pre` varchar(20) binary default NULL,
  `hash` varchar(100) binary NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `hash` (`hash`)
) TYPE=MyISAM  AUTO_INCREMENT=614530 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_temp_els`
--

CREATE TABLE IF NOT EXISTS `portal_temp_els` (
  `ID` int(10) NOT NULL auto_increment,
  `SID` int(10) NOT NULL,
  `pre` varchar(50) binary default NULL,
  `post` varchar(50) binary default NULL,
  `hash` varchar(100) binary NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `hash` (`hash`)
) TYPE=MyISAM  AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_temp_ortega_co`
--

CREATE TABLE IF NOT EXISTS `portal_temp_ortega_co` (
  `ID` int(10) NOT NULL auto_increment,
  `SID` int(10) NOT NULL,
  `hash` varchar(100) binary NOT NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM  AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_users`
--

CREATE TABLE IF NOT EXISTS `portal_users` (
  `ID` int(8) NOT NULL auto_increment,
  `username` varchar(60) binary NOT NULL,
  `rank` int(4) NOT NULL default '101',
  `pass` varchar(60) binary NOT NULL,
  `e-mail` varchar(100) binary NOT NULL,
  `session_time` int(11) default NULL,
  `regdate` int(12) NOT NULL,
  `algs` int(8) NOT NULL default '0',
  `lang` varchar(3) binary NOT NULL default 'pl',
  `visits` int(8) NOT NULL default '0',
  `algs_per_page` int(10) NOT NULL default '30',
  PRIMARY KEY  (`ID`),
  KEY `ID` (`ID`)
) TYPE=MyISAM  AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_users_algs`
--

CREATE TABLE IF NOT EXISTS `portal_users_algs` (
  `ID` int(15) NOT NULL auto_increment,
  `sid_id` int(10) NOT NULL,
  `alg_id` bigint(20) NOT NULL,
  `user_id` int(10) NOT NULL,
  `cat` int(2) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `SID` (`sid_id`)
) TYPE=MyISAM  AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_users_imgcats`
--

CREATE TABLE IF NOT EXISTS `portal_users_imgcats` (
  `ID` int(6) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL,
  `cat_name` varchar(30) binary NOT NULL,
  `subcat_name` varchar(30) binary NOT NULL,
  `value` int(2) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `ID` (`ID`)
) TYPE=MyISAM  AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_votes`
--

CREATE TABLE IF NOT EXISTS `portal_votes` (
  `ID` int(20) NOT NULL auto_increment,
  `sid_id` int(10) NOT NULL,
  `alg_id` int(20) NOT NULL,
  `user_id` int(10) NOT NULL,
  `cat` int(2) NOT NULL,
  `vote` int(2) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `sid_id` (`sid_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_zbf2l_to_els`
--

CREATE TABLE IF NOT EXISTS `portal_zbf2l_to_els` (
  `zbf2l_SID` int(6) NOT NULL,
  `els_SID` int(6) NOT NULL,
  `pre` varchar(20) binary default NULL,
  KEY `zbf2l_SID` (`zbf2l_SID`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_zbf2l_to_f2l`
--

CREATE TABLE IF NOT EXISTS `portal_zbf2l_to_f2l` (
  `zbf2l_SID` int(6) NOT NULL,
  `f2l_SID` int(6) NOT NULL,
  KEY `zbf2l_SID` (`zbf2l_SID`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `portal_zbll_to_coll`
--

CREATE TABLE IF NOT EXISTS `portal_zbll_to_coll` (
  `zbll_SID` int(6) NOT NULL,
  `coll_SID` int(6) NOT NULL,
  KEY `zbll_SID` (`zbll_SID`)
) TYPE=MyISAM;
