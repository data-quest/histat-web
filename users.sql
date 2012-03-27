-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 20. Jan 2012 um 13:44
-- Server Version: 5.1.58
-- PHP-Version: 5.3.6-13ubuntu3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `histat`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'login', 'Login privileges, granted after account confirmation'),
(2, 'admin', 'Administrative user, has access to everything.'),
(3, 'guest', 'Guest user');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `roles_users`
--

DROP TABLE IF EXISTS `roles_users`;
CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `roles_users`
--

INSERT INTO `roles_users` (`user_id`, `role_id`) 
SELECT `ID` AS `user_id` ,1 AS `role_id` FROM `auth_user`;
INSERT INTO `roles_users` (`user_id`, `role_id`) 
SELECT `ID` AS `user_id` ,2 AS `role_id` FROM `auth_user` WHERE `status`  = 'admin';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

DROP TABLE IF EXISTS `users`;
RENAME TABLE `auth_user` TO `users` ;
ALTER TABLE `users` 
  CHANGE `ID` `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  CHANGE `email` `email` varchar(254) NOT NULL,
  CHANGE `username` `username` varchar(32) NOT NULL DEFAULT '',
  CHANGE `titel` `title` varchar(32) DEFAULT NULL,
  CHANGE `vorname` `name` varchar(64) NOT NULL,
  CHANGE `nachname` `surname` varchar(64) NOT NULL,
  CHANGE `institution` `institution` varchar(64) DEFAULT NULL,
  CHANGE `abteilung` `department` varchar(64) DEFAULT NULL,
  CHANGE `strasse` `street` varchar(64) NOT NULL,
  CHANGE `plz` `zip` int(10) NOT NULL,
  CHANGE `ort` `location` varchar(64) NOT NULL,
  CHANGE `land` `country` varchar(64) NOT NULL,
  CHANGE `telefon` `phone` varchar(32) DEFAULT NULL,
  CHANGE `password` `password` varchar(64) NOT NULL,
  CHANGE `chdate` `chdate` int(10) unsigned NOT NULL,
  CHANGE `mkdate` `mkdate` int(10) unsigned NOT NULL,
  ADD `logins` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' ,
  ADD `last_action` INT( 10 ) UNSIGNED NOT NULL ,
  ADD `ip` VARCHAR( 15 ) NOT NULL ,
  ADD `last_login` INT( 10 ) UNSIGNED NOT NULL ,
  DROP `status`;
ALTER TABLE `users` ENGINE = InnoDB;
--
-- Daten für Tabelle `users`
--

INSERT INTO `users` ( `email`, `username`, `title`, `name`, `surname`, `institution`, `department`, `street`, `zip`, `location`, `country`, `phone`, `password`, `logins`, `last_login`, `ip`, `last_action`, `chdate`, `mkdate`) VALUES
('guest@guest.com', 'guest', '', 'guest', 'guest', '', '', 'gueststreet', 0, 'guesttown', 'guestcountry', '', '123456', 7, 1327061926, '127.0.0.1', 1327061946, 1327052005, 1327052005);
INSERT INTO `roles_users` (`user_id`, `role_id`) 
SELECT `ID` AS `user_id` ,3 AS `role_id` FROM `users` WHERE `username`  = 'guest';
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_tokens`
--

DROP TABLE IF EXISTS `user_tokens`;
CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `user_logins`;
CREATE TABLE IF NOT EXISTS `user_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mkdate` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `roles_users`
--
ALTER TABLE `roles_users`
  ADD CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

ALTER TABLE `user_logins`
  ADD CONSTRAINT `user_logins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Schluessel UPDATE
INSERT INTO Lit_ZR( ID_HS, Schluessel )
SELECT da.ID_HS, da.Schluessel
FROM Daten__Aka da
LEFT OUTER JOIN Lit_ZR lz
USING ( ID_HS )
WHERE lz.ID_HS IS NULL
GROUP BY da.ID_HS, da.Schluessel


DROP TABLE IF EXISTS `Aka_Zeiten`;
 CREATE  TABLE  `Aka_Zeiten` (  
 `Zeit` varchar( 255  ) NOT  NULL DEFAULT  '',
 `ID_Zeit` int( 11  )  NOT  NULL AUTO_INCREMENT,
 `Position` int( 11  )  NOT  NULL DEFAULT  '0',
 `chdate` timestamp NOT  NULL  DEFAULT CURRENT_TIMESTAMP  ON  UPDATE  CURRENT_TIMESTAMP ,
 PRIMARY  KEY (  `ID_Thema`  ) ,
 KEY  `Position` (  `Position` ,  `ID_Thema`  )  ) ENGINE  =  MyISAM  ;

ALTER TABLE `Aka_Projekte` ADD `ID_Zeit` INT( 11 ) NOT NULL AFTER `ID_Thema`;
INSERT INTO  `Aka_Zeiten` (Zeit)
VALUES
('Mittelalter'),
('Frühe Neuzeit'),
('Dreissigjähriger Krieg'),
('Aufklärung'),
('Deutscher Bund'),
('Kaiserreich'),
('Industrialisierung'),
('Weimarer Republik'),
('Nationalsozialismus'),
('Zweiter Weltkrieg'),
('DDR'),
('alte Bundesrepublik'),
('Wirtschaftswunder'),
('Grenzen des Wachstums'),
('Vereintes Deutschland')

DROP TABLE IF EXISTS `warenkorb`;
CREATE TABLE IF NOT EXISTS `warenkorb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ID_HS` varchar(32) NOT NULL,
  `filter` varchar(32) NOT NULL,
  `filter_text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `chdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;