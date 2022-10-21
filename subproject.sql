-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 14 ต.ค. 2020 เมื่อ 05:04 PM
-- เวอร์ชันของเซิร์ฟเวอร์: 10.4.10-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `subproject`
--

DROP TABLE IF EXISTS `subproject`;
CREATE TABLE IF NOT EXISTS `subproject` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `recid` int(11) NOT NULL,
  `listname` varchar(200) NOT NULL COMMENT 'ชื่อทรัพย์สิน',
  `fedID` int(11) NOT NULL COMMENT 'รหัสทรัพย์สิน',
  `moneyID` int(11) NOT NULL COMMENT 'รหัสสินทรัพย์',
  `descript` text NOT NULL COMMENT 'รายละเอียด',
  `amount` varchar(50) NOT NULL COMMENT 'จำนวน',
  `price` int(11) NOT NULL COMMENT 'ราคาต่อหน่วย',
  `howto` varchar(50) NOT NULL COMMENT 'วิธีการได้มา',
  `reciveDate` date NOT NULL COMMENT 'วันที่ตรวจรับ',
  `lawID` int(11) NOT NULL COMMENT 'เลขที่สัญญา',
  `age` varchar(100) NOT NULL COMMENT 'อายุการใช้งาน',
  `reciveOffice` varchar(200) NOT NULL COMMENT 'หน่วยงานที่ใช้',
  `status` int(5) NOT NULL COMMENT 'สภาพ',
  `pid` int(11) NOT NULL COMMENT 'รหัสโครงการ',
  `tid` int(11) NOT NULL COMMENT 'ประเภทครุภัณฑ์',
  `cid` int(11) NOT NULL COMMENT 'ชนิดครุภัณฑ์',
  `gid` int(11) NOT NULL COMMENT 'กลุ่มครุภัณฑ์',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
