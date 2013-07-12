-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-03-2013 a las 14:36:58
-- Versión del servidor: 5.5.29
-- Versión de PHP: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bdt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_activity`
--

CREATE TABLE IF NOT EXISTS `admin_activity` (
  `log_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_id` varchar(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `category` char(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `action` char(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `ref_id` varchar(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `note` varchar(100) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(4) unsigned DEFAULT NULL,
  `description` varchar(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`category_id`, `parent_id`, `description`) VALUES
(1, NULL, 'Arte y artesanÃ­a'),
(2, NULL, 'AlbañilerÃía y construcción'),
(3, NULL, 'Servicios de empresa'),
(4, NULL, 'Cuidado de niños/as'),
(5, NULL, 'Informática'),
(6, NULL, 'PsicopedagogÃía y terapia'),
(7, NULL, 'Cocina'),
(8, NULL, 'Trabajos de jardinerí­a'),
(9, NULL, 'Servicio técnico'),
(10, NULL, 'Salud y cuidado de personas'),
(11, NULL, 'Trabajos del hogar'),
(12, NULL, 'Otros'),
(13, NULL, 'Música y entretenimiento'),
(14, NULL, 'Cuidado de animales'),
(15, NULL, 'Deportes y animación'),
(16, NULL, 'Enseñaanza'),
(17, NULL, 'Transporte'),
(18, NULL, 'Compras y comercio');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `feedback_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` char(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `member_id_author` varchar(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `member_id_about` varchar(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `trade_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rating` char(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `comment` text COLLATE utf8_general_ci,
  PRIMARY KEY (`feedback_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feedback_rebuttal`
--

CREATE TABLE IF NOT EXISTS `feedback_rebuttal` (
  `rebuttal_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `rebuttal_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `feedback_id` mediumint(8) unsigned DEFAULT NULL,
  `member_id` varchar(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `comment` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`rebuttal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listings`
--

CREATE TABLE IF NOT EXISTS `listings` (
  `title` varchar(60) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_general_ci,
  `category_code` smallint(4) unsigned NOT NULL DEFAULT '0',
  `member_id` varchar(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `rate` varchar(30) COLLATE utf8_general_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expire_date` date DEFAULT NULL,
  `reactivate_date` date DEFAULT NULL,
  `type` char(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`title`,`member_id`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `member_id` varchar(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `total_failed` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `consecutive_failures` mediumint(3) unsigned NOT NULL DEFAULT '0',
  `last_failed_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_success_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `member_id` varchar(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` varchar(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `member_role` char(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `security_q` varchar(25) COLLATE utf8_general_ci DEFAULT NULL,
  `security_a` varchar(15) COLLATE utf8_general_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `member_note` varchar(100) COLLATE utf8_general_ci DEFAULT NULL,
  `admin_note` varchar(100) COLLATE utf8_general_ci DEFAULT NULL,
  `join_date` date NOT NULL DEFAULT '0000-00-00',
  `expire_date` date DEFAULT NULL,
  `away_date` date DEFAULT NULL,
  `account_type` char(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `email_updates` int(3) unsigned NOT NULL DEFAULT '0',
  `balance` decimal(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `member`
--

INSERT INTO `member` (`member_id`, `password`, `member_role`, `security_q`, `security_a`, `status`, `member_note`, `admin_note`, `join_date`, `expire_date`, `away_date`, `account_type`, `email_updates`, `balance`) VALUES
('admin', 'password', '9', NULL, NULL, 'A', NULL, NULL, '2009-07-07', NULL, NULL, 'S', 7, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_general_ci NOT NULL,
  `sequence` decimal(6,4) NOT NULL DEFAULT '0.0000',
  `create_date` date NOT NULL,
  `expire_date` date DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `person_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` varchar(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `primary_member` char(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `directory_list` char(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `first_name` varchar(20) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `last_name` varchar(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mid_name` varchar(20) COLLATE utf8_general_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `mother_mn` varchar(30) COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8_general_ci DEFAULT NULL,
  `phone1_area` char(3) COLLATE utf8_general_ci DEFAULT NULL,
  `phone1_number` varchar(7) COLLATE utf8_general_ci DEFAULT NULL,
  `phone1_ext` varchar(4) COLLATE utf8_general_ci DEFAULT NULL,
  `phone2_area` char(3) COLLATE utf8_general_ci DEFAULT NULL,
  `phone2_number` varchar(7) COLLATE utf8_general_ci DEFAULT NULL,
  `phone2_ext` varchar(4) COLLATE utf8_general_ci DEFAULT NULL,
  `fax_area` char(3) COLLATE utf8_general_ci DEFAULT NULL,
  `fax_number` varchar(7) COLLATE utf8_general_ci DEFAULT NULL,
  `fax_ext` varchar(4) COLLATE utf8_general_ci DEFAULT NULL,
  `address_street1` varchar(30) COLLATE utf8_general_ci DEFAULT NULL,
  `address_street2` varchar(30) COLLATE utf8_general_ci DEFAULT NULL,
  `address_city` varchar(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `address_state_code` char(2) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `address_post_code` varchar(6) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `address_country` varchar(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `imagen` varchar(21) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`person_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=145 ;

--
-- Volcado de datos para la tabla `person`
--

INSERT INTO `person` (`person_id`, `member_id`, `primary_member`, `directory_list`, `first_name`, `last_name`, `mid_name`, `dob`, `mother_mn`, `email`, `phone1_area`, `phone1_number`, `phone1_ext`, `phone2_area`, `phone2_number`, `phone2_ext`, `fax_area`, `fax_number`, `fax_ext`, `address_street1`, `address_street2`, `address_city`, `address_state_code`, `address_post_code`, `address_country`, `imagen`) VALUES
(1, 'admin', 'Y', 'Y', 'Administrador', 'del Sistema', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` char(32) NOT NULL,
  `data` text,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ts` (`ts`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trades`
--

CREATE TABLE IF NOT EXISTS `trades` (
  `trade_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `trade_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` char(1) COLLATE utf8_general_ci DEFAULT NULL,
  `member_id_from` varchar(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `member_id_to` varchar(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `category` smallint(4) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `type` char(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`trade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `upload_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(100) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `type` char(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `filename` varchar(100) COLLATE utf8_general_ci DEFAULT NULL,
  `note` varchar(100) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`upload_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
