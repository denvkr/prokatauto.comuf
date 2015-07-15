-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- ����: localhost
-- ����� ��������: ��� 26 2011 �., 16:12
-- ������ �������: 5.1.46
-- ������ PHP: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

SET AUTOCOMMIT=0;
START TRANSACTION;

--
-- ���� ������: `rentacar`
--

-- --------------------------------------------------------

--
-- ��������� ������� `body_type`
--

DROP TABLE IF EXISTS `body_type`;
CREATE TABLE IF NOT EXISTS `body_type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BODY_TYPE` varchar(50) COLLATE cp1251_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=6 ;

--
-- ���� ������ ������� `body_type`
--

INSERT INTO `body_type` (`ID`, `BODY_TYPE`) VALUES
(1, '�����'),
(2, '�������'),
(3, '���������'),
(4, '����'),
(5, '���������');

-- --------------------------------------------------------

--
-- ��������� ������� `carsinfo`
--

DROP TABLE IF EXISTS `carsinfo`;
CREATE TABLE IF NOT EXISTS `carsinfo` (
  `CAR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CAR_NAME` varchar(100) COLLATE cp1251_bin NOT NULL,
  `ODOMETER_VALUE` int(11) NOT NULL,
  `MODIFICATION_ID` int(11) NOT NULL,
  `POWER_ID` int(11) NOT NULL,
  `YEAR_OF_PRODUCTION_ID` int(11) NOT NULL,
  `POWER_SHIFT_ID` int(11) NOT NULL,
  `POWER_SHIFT_TYPE_ID` int(11) NOT NULL,
  `TRANSMISSION_ID` int(11) NOT NULL,
  `STEERING_SIDE_ID` int(11) NOT NULL,
  `BODY_TYPE_ID` int(11) NOT NULL,
  `COLOR_ID` int(11) NOT NULL,
  `CAR_STATUS_ID` int(11) NOT NULL,
  `CUSTOM_STATUS_ID` int(11) NOT NULL,
  `RENT_STATUS_ID` int(11) NOT NULL,
  `MONEY_SPEND_ID` int(11) NOT NULL,
  `MONEY_GET_ID` int(11) NOT NULL,
  `PHOTO` blob,
  PRIMARY KEY (`CAR_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=2 ;

--
-- ���� ������ ������� `carsinfo`
--

INSERT INTO `carsinfo` (`CAR_ID`, `CAR_NAME`, `ODOMETER_VALUE`, `MODIFICATION_ID`, `POWER_ID`, `YEAR_OF_PRODUCTION_ID`, `POWER_SHIFT_ID`, `POWER_SHIFT_TYPE_ID`, `TRANSMISSION_ID`, `STEERING_SIDE_ID`, `BODY_TYPE_ID`, `COLOR_ID`, `CAR_STATUS_ID`, `CUSTOM_STATUS_ID`, `RENT_STATUS_ID`, `MONEY_SPEND_ID`, `MONEY_GET_ID`, `PHOTO`) VALUES
(1, 'Skoda Octavia Tour', 15000, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- ��������� ������� `car_color`
--

DROP TABLE IF EXISTS `car_color`;
CREATE TABLE IF NOT EXISTS `car_color` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COLOR` varchar(50) COLLATE cp1251_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=6 ;

--
-- ���� ������ ������� `car_color`
--

INSERT INTO `car_color` (`ID`, `COLOR`) VALUES
(1, '�����'),
(2, '������'),
(3, '�����������'),
(4, '�������'),
(5, '�����');

-- --------------------------------------------------------

--
-- ��������� ������� `car_status`
--

DROP TABLE IF EXISTS `car_status`;
CREATE TABLE IF NOT EXISTS `car_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CAR_STATUS` varchar(50) COLLATE cp1251_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=4 ;

--
-- ���� ������ ������� `car_status`
--

INSERT INTO `car_status` (`ID`, `CAR_STATUS`) VALUES
(1, '�������'),
(2, '��������'),
(3, '������������������');

-- --------------------------------------------------------

--
-- ��������� ������� `custom_status`
--

DROP TABLE IF EXISTS `custom_status`;
CREATE TABLE IF NOT EXISTS `custom_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CUSTOM_STATUS` varchar(50) COLLATE cp1251_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=3 ;

--
-- ���� ������ ������� `custom_status`
--

INSERT INTO `custom_status` (`ID`, `CUSTOM_STATUS`) VALUES
(1, '�����������'),
(2, '�� �����������');

-- --------------------------------------------------------

--
-- ��������� ������� `modification`
--

DROP TABLE IF EXISTS `modification`;
CREATE TABLE IF NOT EXISTS `modification` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CAR_ID` int(11) DEFAULT NULL,
  `MODIFICATION` varchar(100) COLLATE cp1251_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=2 ;

--
-- ���� ������ ������� `modification`
--

INSERT INTO `modification` (`ID`, `CAR_ID`, `MODIFICATION`) VALUES
(1, NULL, '2.0 i 16V (137 Hp)');

-- --------------------------------------------------------

--
-- ��������� ������� `money_get`
--

DROP TABLE IF EXISTS `money_get`;
CREATE TABLE IF NOT EXISTS `money_get` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MONEY_GET` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=1 ;

--
-- ���� ������ ������� `money_get`
--


-- --------------------------------------------------------

--
-- ��������� ������� `money_spend`
--

DROP TABLE IF EXISTS `money_spend`;
CREATE TABLE IF NOT EXISTS `money_spend` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MONEY_SPEND` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=1 ;

--
-- ���� ������ ������� `money_spend`
--


-- --------------------------------------------------------

--
-- ��������� ������� `power`
--

DROP TABLE IF EXISTS `power`;
CREATE TABLE IF NOT EXISTS `power` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POWER_TYPE` varchar(100) COLLATE cp1251_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=1 ;

--
-- ���� ������ ������� `power`
--


-- --------------------------------------------------------

--
-- ��������� ������� `power_shift`
--

DROP TABLE IF EXISTS `power_shift`;
CREATE TABLE IF NOT EXISTS `power_shift` (
  `ID` int(11) NOT NULL,
  `SHIFT` varchar(100) COLLATE cp1251_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin;

--
-- ���� ������ ������� `power_shift`
--

INSERT INTO `power_shift` (`ID`, `SHIFT`) VALUES
(0, '��������������'),
(1, '������������'),
(2, '����������������');

-- --------------------------------------------------------

--
-- ��������� ������� `power_shift_type`
--

DROP TABLE IF EXISTS `power_shift_type`;
CREATE TABLE IF NOT EXISTS `power_shift_type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POWER_SHIFT_TYPE` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=5 ;

--
-- ���� ������ ������� `power_shift_type`
--

INSERT INTO `power_shift_type` (`ID`, `POWER_SHIFT_TYPE`) VALUES
(1, 4),
(2, 5),
(3, 6),
(4, 7);

-- --------------------------------------------------------

--
-- ��������� ������� `rent_status`
--

DROP TABLE IF EXISTS `rent_status`;
CREATE TABLE IF NOT EXISTS `rent_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `RENT_START_DATE` date DEFAULT NULL,
  `RENT_STOP_DATE` date DEFAULT NULL,
  `RENT_STATUS` varchar(255) COLLATE cp1251_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=2 ;

--
-- ���� ������ ������� `rent_status`
--

INSERT INTO `rent_status` (`ID`, `RENT_START_DATE`, `RENT_STOP_DATE`, `RENT_STATUS`) VALUES
(1, NULL, NULL, '��������');

-- --------------------------------------------------------

--
-- ��������� ������� `steering_side`
--

DROP TABLE IF EXISTS `steering_side`;
CREATE TABLE IF NOT EXISTS `steering_side` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `STEERING_SIDE` varchar(20) COLLATE cp1251_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=3 ;

--
-- ���� ������ ������� `steering_side`
--

INSERT INTO `steering_side` (`ID`, `STEERING_SIDE`) VALUES
(1, '�����'),
(2, '������');

-- --------------------------------------------------------

--
-- ��������� ������� `transmission`
--

DROP TABLE IF EXISTS `transmission`;
CREATE TABLE IF NOT EXISTS `transmission` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TRANSMISSION` varchar(50) COLLATE cp1251_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin AUTO_INCREMENT=4 ;

--
-- ���� ������ ������� `transmission`
--

INSERT INTO `transmission` (`ID`, `TRANSMISSION`) VALUES
(1, '������ ������'),
(2, '������ ������'),
(3, '�������� ������');

-- --------------------------------------------------------

--
-- ��������� ������� `year_of_production`
--

DROP TABLE IF EXISTS `year_of_production`;
CREATE TABLE IF NOT EXISTS `year_of_production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `YEAR_OF_PRODUCTION` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

--
-- ���� ������ ������� `year_of_production`
--


DELIMITER $$
--
-- ���������
--
DROP PROCEDURE IF EXISTS `carsinfo_add_row`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `carsinfo_add_row`(
IN MY_CAR_NAME VARCHAR(100),
IN MY_ODOMETER_VALUE INT(11),
IN MY_MODIFICATION_ID INT(11),
IN MY_POWER_ID INT(11),
IN MY_YEAR_OF_PRODUCTION_ID INT(11),
IN MY_POWER_SHIFT_ID INT(11),
IN MY_POWER_SHIFT_TYPE_ID INT(11),
IN MY_TRANSMISSION_ID INT(11),
IN MY_STEERING_SIDE_ID INT(11),
IN MY_BODY_TYPE_ID INT(11),
IN MY_COLOR_ID INT(11),
IN MY_CAR_STATUS_ID INT(11),
IN MY_CUSTOM_STATUS_ID INT(11),
IN MY_RENT_STATUS_ID INT(11),
IN MY_MONEY_SPEND_ID INT(11),
IN MY_MONEY_GET INT(11),
OUT RETVAL INT)
BEGIN

IF (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME LIKE '%carsinfo%') IS NOT NULL THEN 
INSERT INTO `rentacar`.`carsinfo` 
VALUES(NULL,
MY_CAR_NAME,
MY_ODOMETER_VALUE,
MY_MODIFICATION_ID,
MY_POWER_ID,
MY_YEAR_OF_PRODUCTION_ID,
MY_POWER_SHIFT_ID,
MY_POWER_SHIFT_TYPE_ID,
MY_TRANSMISSION_ID,
MY_STEERING_SIDE_ID,
MY_BODY_TYPE_ID,
MY_COLOR_ID,
MY_CAR_STATUS_ID,
MY_CUSTOM_STATUS_ID,
MY_RENT_STATUS_ID,
MY_MONEY_SPEND_ID,
MY_MONEY_GET,
NULL);
SET RETVAL=1;
ELSE
SET RETVAL=0;
END IF;

END$$

DROP PROCEDURE IF EXISTS `carsinfo_del_row`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `carsinfo_del_row`(
IN MY_ID INT(11),
IN MY_CAR_NAME VARCHAR(100),
OUT RETVAL INT)
BEGIN
IF (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME LIKE '%carsinfo%') IS NOT NULL THEN 
DELETE FROM `rentacar`.`carsinfo` WHERE CAR_ID=MY_ID AND CAR_NAME=MY_CAR_NAME;
SET RETVAL=1;
ELSE
SET RETVAL=0;
END IF;

END$$

drop procedure `GET_LOGIN`$$#

CREATE PROCEDURE GET_LOGIN (IN MY_SESSION_ID VARCHAR(30),OUT MY_LOGIN VARCHAR(50))
BEGIN
SELECT DISTINCT login INTO MY_LOGIN FROM register_user_session_info WHERE login=MY_SESSION_ID;
END$$

DELIMITER ;

COMMIT;

CALL GET_LOGIN ('071acc271383a614d84667b8df4511',@LOGIN);
select @LOGIN;