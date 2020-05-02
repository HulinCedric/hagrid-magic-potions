-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Version du serveur: 5.0.83
-- Version de PHP: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `hagridsmagicpotions`
--
CREATE DATABASE `hagridsmagicpotions` DEFAULT CHARACTER SET ;
USE `hagridsmagicpotions`;

-- --------------------------------------------------------

--
-- Structure de la table `clan`
--

CREATE TABLE IF NOT EXISTS `clan` (
  `clan_name` enum('Sorcier','Necromancien','Mage') collate utf8_unicode_ci NOT NULL,
  `level` int(2) NOT NULL,
  `rank_name` varchar(30) character set utf8 NOT NULL,
  PRIMARY KEY  (`clan_name`,`level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `num_recipe` int(11) NOT NULL,
  `login` varchar(9) collate utf8_unicode_ci NOT NULL,
  `comment_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `description` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`num_recipe`,`login`,`comment_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `composition`
--

CREATE TABLE IF NOT EXISTS `composition` (
  `num_recipe` int(11) NOT NULL,
  `name` varchar(40) collate utf8_unicode_ci NOT NULL COMMENT 'Nom de l''ingredient',
  `quantity` int(5) NOT NULL,
  `scale` varchar(20) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`num_recipe`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

CREATE TABLE IF NOT EXISTS `evaluation` (
  `num_recipe` int(11) NOT NULL,
  `login` varchar(9) collate utf8_unicode_ci NOT NULL,
  `mark` int(2) NOT NULL COMMENT 'note de la recette',
  PRIMARY KEY  (`num_recipe`,`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

CREATE TABLE IF NOT EXISTS `experience` (
  `level` int(2) NOT NULL,
  `experience` int(10) NOT NULL COMMENT 'nombre d''etoile et de recette',
  PRIMARY KEY  (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE IF NOT EXISTS `ingredient` (
  `name` varchar(40) collate utf8_unicode_ci NOT NULL,
  `type` enum('Liquide','Solide','Aucun') collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recipe`
--

CREATE TABLE IF NOT EXISTS `recipe` (
  `num_recipe` int(11) NOT NULL auto_increment,
  `name` varchar(40) collate utf8_unicode_ci NOT NULL,
  `direction` text collate utf8_unicode_ci NOT NULL,
  `category` enum('Euphorisant','Desalterant','Curratif') collate utf8_unicode_ci NOT NULL,
  `inventor` varchar(9) collate utf8_unicode_ci NOT NULL COMMENT 'login de l''inventeur',
  `recipe_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`num_recipe`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Structure de la table `scale`
--

CREATE TABLE IF NOT EXISTS `scale` (
  `type` enum('Liquide','Solide','Aucun') collate utf8_unicode_ci NOT NULL,
  `scale` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`type`,`scale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `login` varchar(9) collate utf8_unicode_ci NOT NULL,
  `pass` varchar(12) collate utf8_unicode_ci NOT NULL,
  `postal_code` varchar(5) collate utf8_unicode_ci default NULL,
  `town` varchar(10) collate utf8_unicode_ci default NULL,
  `country` varchar(10) collate utf8_unicode_ci default NULL,
  `account_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `clan_name` enum('Sorcier','Necromancien','Mage') collate utf8_unicode_ci NOT NULL,
  `level` int(2) NOT NULL default '0',
  `mail` varchar(30) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci,
  `quotation` varchar(100) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `valid_account`
--

CREATE TABLE IF NOT EXISTS `valid_account` (
  `login` varchar(10) collate utf8_unicode_ci NOT NULL,
  `confirm_key` varchar(32) collate utf8_unicode_ci NOT NULL,
  `valid` enum('0','1') collate utf8_unicode_ci NOT NULL default '0',
  PRIMARY KEY  (`login`,`confirm_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
