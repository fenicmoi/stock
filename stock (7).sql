-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 15, 2020 at 11:27 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

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
-- Table structure for table `description`
--

DROP TABLE IF EXISTS `description`;
CREATE TABLE IF NOT EXISTS `description` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `recid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `typeID` int(11) NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `federal`
--

DROP TABLE IF EXISTS `federal`;
CREATE TABLE IF NOT EXISTS `federal` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `recid` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` int(11) NOT NULL,
  `lcode` varchar(11) NOT NULL,
  `rcode` varchar(11) NOT NULL,
  `detail` text NOT NULL,
  `amount` varchar(11) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `howto` text NOT NULL,
  `date_recive` date NOT NULL,
  `law_number` text NOT NULL,
  `lifeage` int(11) NOT NULL,
  `owner` text NOT NULL,
  `status` int(11) NOT NULL,
  `subID` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `recid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `money` int(10) NOT NULL COMMENT 'งบประมาณ',
  `yid` int(11) NOT NULL,
  `uid` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`pid`, `recid`, `name`, `money`, `yid`, `uid`, `created_at`) VALUES
(11, 1, 'โครงการพัฒนาอุตสาหกรรมท่องเที่ยวเชิงอนุรักษ์เข้มแข็งสู่ประชาคมอาเซียน', 0, 1, 2, '2020-10-13 17:00:00'),
(12, 2, 'โครงการผลผลิตทางการเกษตรขับเคลื่อนเศรษฐกิจเข้มแข็ง', 0, 1, 2, '2020-10-13 17:00:00'),
(13, 1, 'สนับสนุนอุปกรณ์สำรวจความพึงพอใจผู้รับบริการ', 350000, 5, 1, '2020-10-15 11:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `st_class`
--

DROP TABLE IF EXISTS `st_class`;
CREATE TABLE IF NOT EXISTS `st_class` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cnumber` int(11) NOT NULL,
  `cname` varchar(200) NOT NULL,
  `cstatus` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `st_class`
--

INSERT INTO `st_class` (`cid`, `cnumber`, `cname`, `cstatus`, `gid`) VALUES
(1, 4110, 'อุปกรณ์ตู้เย็น', 1, 29),
(4, 4120, 'อุปกรณ์เครื่องปรับอากาศ', 1, 29),
(5, 4130, 'ส่วนประกอบของตู้เย็นและเครื่องปรับอากาศ', 1, 29),
(6, 4140, 'พัดลม เครื่องถ่ายเทอากาศ และเครื่องเป่าลม', 1, 29),
(9, 4010, 'โซ่และเชือกลวด', 1, 28),
(10, 4020, 'เชือก ด้าย และเชือกควั่น', 1, 28),
(11, 4030, 'ของใช้กับ เชือก เคเบิ้ล และโซ่', 1, 28),
(12, 1005, 'ปืนที่มีขนาดถึง 30 มม.', 1, 1),
(13, 1010, 'ปืนที่มีขนาดเกินกว่า 30 มม. ถึง 75มม.', 1, 1),
(14, 1015, 'ปืนขนาด 75 มม. ถึง 125 มม.', 1, 1),
(15, 7690, 'สิ่งพิมพ์อื่นๆ', 1, 64),
(16, 2340, 'รถจักรยานยนต์ รถจักรยานยนต์ล้อเล็ก และรถจักรยาน', 1, 13),
(17, 7610, 'หนังสือ และอนุสาร', 1, 64),
(18, 7440, 'ระบบกรรมวิธีอัตโนมัติสำหรับอุตสาหกรรรมวิทยาศาสตร์ และสำนักงาน', 1, 61),
(19, 7405, 'เครื่ององบันทึกเสียงและอัดเสียงสํานักงาน ', 1, 61);

-- --------------------------------------------------------

--
-- Table structure for table `st_group`
--

DROP TABLE IF EXISTS `st_group`;
CREATE TABLE IF NOT EXISTS `st_group` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `gnumber` int(2) NOT NULL,
  `gname` varchar(200) NOT NULL,
  `gstatus` int(1) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM AUTO_INCREMENT=307 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `st_group`
--

INSERT INTO `st_group` (`gid`, `gnumber`, `gname`, `gstatus`) VALUES
(1, 10, 'อาวุธ', 1),
(2, 11, 'สรรพาวุธนิวเคลียร์', 1),
(3, 12, 'อุปกรณ์ควบคุมการยิง', 1),
(4, 13, 'กระสุนและวัตถุระเบิด', 1),
(5, 14, 'อาวุธนำวิถี', 1),
(6, 15, 'อากาศยานและองค์ประกอบโครงสร้าง', 1),
(7, 16, 'ส่วนประกอบอากาศยานและเครื่องใช้', 1),
(8, 17, 'อุปกรณ์การยิงส่ง การลงพื้น และการยกขนทางพื้นดิน', 1),
(9, 18, 'ยานอาวกาศ', 1),
(10, 19, 'เรือ เรือเล็ก เรือท้องแบน และอู่ลอย', 1),
(11, 20, 'เรือและอุปกรณ์สำหรับเรือ', 1),
(12, 22, 'อุปกรณ์รถไฟ', 1),
(13, 23, 'ยานพาหนะพื้นดิน ยานยนต์ รถพ่วง และจักรยาน', 1),
(14, 24, 'รถลากจูง', 1),
(15, 25, 'ส่วนประกอบของยานพาหนะ', 1),
(16, 26, 'ยางนอกและยางใน', 1),
(17, 28, 'เครื่องยนต์ เทอร์ไบน์ และส่วนประกอบ', 1),
(18, 29, 'ส่วนประกอบของเครื่องยนต์', 1),
(19, 30, 'อุปกรณ์การส่งผ่านกำลังงานกล', 1),
(20, 31, 'รองเพลา', 1),
(21, 32, 'อุปกรณ์และเครื่องจักรงานไม้', 1),
(22, 34, 'เครื่องจักรงานโลหะ', 1),
(23, 35, 'อุปกรณ์การบริหาร', 1),
(24, 36, 'เครื่องจักรกล เฉพาะงานอุตสาหกรรม', 1),
(25, 37, 'เครื่องจักรและอุปกรณ์การเกษตร', 1),
(26, 38, 'อุปกรณ์ก่อสร้าง การเหมืองแร่ การขุดดิน และการซ่อมบำรุงทาง', 1),
(27, 39, 'อุปกรณ์การยกขนพัสดุ', 1),
(28, 40, 'เชือก เคเบิล โซ่และเครื่องรัด', 1),
(29, 41, 'อุปกรณ์ตู้เย็น เครื่องปรับอากาศ และเครื่องถ่ายเทอากาศ', 1),
(30, 42, 'อุปกรณ์ผจยเพลิง เครื่องช่วยชีวิตและความปลอดภัย', 1),
(31, 43, 'สูบและเครื่องอัด', 1),
(32, 44, 'เตาหลอมโรงไอน้ำ และอุปกรณ์ทำให้แห้ง และปฏิกรณ์นิวเคลียร์', 1),
(33, 45, 'อุปกรณ์สุขภัณฑ์  เครื่องให้ความร้อน และการสุขาภิบาล', 1),
(34, 46, 'เครื่องกรองน้ำและเครื่องขจัดสิ่งโสโครก', 1),
(35, 47, 'ท่อหลอด ท่อยาง และจุกอัด', 1),
(36, 48, 'วาล์ว (VALVE)', 1),
(37, 49, 'อุปกรณ์ซ่อมบำรุง และโรงงานซ่อม', 1),
(38, 51, 'เครื่องมือ', 1),
(39, 52, 'เครื่องวัด', 1),
(40, 53, 'เครื่องใช้และวัสดุขัด', 1),
(41, 54, 'โครงสร้างถอดประกอบได้ และนั่งร้าน', 1),
(42, 55, 'กระดาน ไม้อัด ไม้แปรรูป และไม้เคลือบ (วีเนีย)', 1),
(45, 58, 'อุปกรณ์คมนาคม การค้นหา และการกระจายคลื่น', 1),
(44, 56, 'วัสดุการสร้างอาคารและสิ่งก่อสร้าง', 1),
(46, 59, 'อุปกรณ์ และส่วนประกอบ เครื่องไฟฟ้าและเครื่องอีเลคโทรนิค', 1),
(50, 61, 'สายไฟ เครื่องกำเนิดไฟฟ้า และอุปกรณ์จ่ายไฟฟ้า', 1),
(51, 62, 'หลอดไฟ และอุปกรณ์ติดตั้งเครื่องให้แสงสว่าง', 1),
(52, 63, 'ระบบเตือนภัยและสัญญาณ', 1),
(53, 65, 'อุปกรณ์และเครื่องใช้ทางการแพทย์ ทันตแพทย์ และสัตวแพทย์', 1),
(54, 66, 'เครื่องมือ และอุปกรณ์ห้องปฏิบัติการ (ทดลอง)', 1),
(55, 67, 'อุปกรณ์การภาพ', 1),
(56, 68, 'วัตถุเคมีและผลิตภัณฑ์เคมี', 1),
(57, 69, 'เครื่องช่วยฝึกและอุปกรณ์', 1),
(58, 71, 'เครื่องตกแต่ง', 1),
(59, 72, 'เครื่องใช้ และเครื่องตกแต่งบ้าน และร้านค้า', 1),
(60, 73, 'อุปกรณ์ประกอบอาหาร และเลี้ยงดู', 1),
(61, 74, 'เครื่องกลสำนักงาน และอุปกรณ์กรรมวิธีบันทึก และลงข้อมูล', 1),
(62, 75, 'พัสดุ และเครื่องใช้สำนักงาน', 1),
(64, 76, 'หนังสือ แผนที่ และสิ่งพิมพ์', 1),
(65, 77, 'เครื่องดนตรี เครื่องเล่นแผน่เสียง และิทยุใช้ในบ้าน', 1),
(66, 78, 'อุปกรณ์สันทนาการและการกีฬา', 1),
(290, 79, 'อุปกรณ์และอุปกรณ์ทำความสะอาด', 1),
(291, 80, 'แปรง และภู่กัน สีวัสดุยาอุด และผนึก', 1),
(292, 81, 'ภาชนะบรรจุหีบห่อ', 1),
(296, 83, 'สิ่งถักทอ หนัง ขนสัตว์ เครื่องตกแต่ง อุปกรณ์สำหรับเย็บรองเท้า กระโจม และธง', 1),
(297, 84, 'เสื้อผ้า อุปกรณ์ประจำกาย และเครื่องแบบ', 1),
(298, 85, 'เครื่องสุขภัณฑ์ และเครื่องสำอางค์', 1),
(299, 87, 'อุปกรณ์การเกษตร', 1),
(300, 88, 'สัตว์เลี้ยง', 1),
(301, 89, 'อาหาร', 1),
(302, 91, 'เชื้อเพลง นำ้มันหล่อลื่น น้ำมันเครื่อง และขี้ผึ้ง', 1),
(303, 94, 'วัตถุดิบที่ไม่ใช่โลหะ', 1),
(304, 95, 'โลหะที่เป็นแท่ง แผ่นและมีทรง', 1),
(305, 96, 'สินแร่ แร่ และผลิตภัณฑ์ขั้นต้นจากสินแร่', 1),
(306, 99, 'เบ็ดเตล็ด', 1);

-- --------------------------------------------------------

--
-- Table structure for table `st_typetype`
--

DROP TABLE IF EXISTS `st_typetype`;
CREATE TABLE IF NOT EXISTS `st_typetype` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `tnumber` varchar(11) NOT NULL,
  `tname` varchar(200) NOT NULL,
  `tstatus` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `st_typetype`
--

INSERT INTO `st_typetype` (`tid`, `tnumber`, `tname`, `tstatus`, `cid`, `gid`) VALUES
(1, '001', 'ตู้เย็น', 1, 1, 29),
(2, '002', 'เครื่องทำน้ำเย็น', 1, 1, 29),
(3, '003', 'ตู้น้ำเย็น', 1, 1, 29),
(4, '004', 'ตู้นมเย็น', 1, 1, 29),
(5, '005', 'ตู้ทำไอศครียม', 1, 1, 29),
(6, '006', 'ตู้ทำน้ำแข็ง', 1, 1, 29),
(7, '007', 'ตู้เก็บอาหารแช่แข็ง', 1, 1, 29),
(8, '001', 'ปืนพกอัตโนมัติขนาดต่าง ๆ', 1, 12, 1),
(9, '002', 'ปืนพกลูกโม่ขนาดต่างๆ', 1, 12, 1),
(10, '003', 'ปืนกลมือขนาดต่างๆ', 1, 12, 1),
(11, '001', 'เมนู', 1, 15, 64),
(12, '002', 'โปสเตอร์', 1, 15, 64),
(13, '003', 'โปรแกรม', 1, 15, 64),
(14, '001', 'จักรยาน 2 ล้อ', 1, 16, 13),
(15, '002', 'จักรยาน 3 ล้อ', 1, 16, 13),
(16, '001', 'เครื่องคอมพิวเตอร์', 1, 18, 61),
(17, '008', 'เครื่องอิเลคโทรนิค', 1, 18, 61);

-- --------------------------------------------------------

--
-- Table structure for table `subproject`
--

DROP TABLE IF EXISTS `subproject`;
CREATE TABLE IF NOT EXISTS `subproject` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `recid` int(11) NOT NULL,
  `listname` varchar(200) NOT NULL COMMENT 'ชื่อทรัพย์สิน',
  `fedID` varchar(50) NOT NULL COMMENT 'รหัสทรัพย์สิน',
  `moneyID` varchar(50) NOT NULL COMMENT 'รหัสสินทรัพย์',
  `descript` text NOT NULL COMMENT 'รายละเอียด',
  `amount` varchar(50) NOT NULL COMMENT 'จำนวน',
  `price` int(11) NOT NULL COMMENT 'ราคาต่อหน่วย',
  `howto` varchar(50) NOT NULL COMMENT 'วิธีการได้มา',
  `reciveDate` date NOT NULL COMMENT 'วันที่ตรวจรับ',
  `lawID` varchar(50) NOT NULL COMMENT 'เลขที่สัญญา',
  `age` varchar(100) NOT NULL COMMENT 'อายุการใช้งาน',
  `reciveOffice` varchar(150) NOT NULL COMMENT 'หน่วยงานที่ใช้',
  `status` varchar(50) NOT NULL COMMENT 'สภาพ',
  `pid` int(11) NOT NULL COMMENT 'รหัสโครงการ',
  `tid` int(11) NOT NULL COMMENT 'ประเภทครุภัณฑ์',
  `cid` int(11) NOT NULL COMMENT 'ชนิดครุภัณฑ์',
  `gid` int(11) NOT NULL COMMENT 'กลุ่มครุภัณฑ์',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subproject`
--

INSERT INTO `subproject` (`sid`, `recid`, `listname`, `fedID`, `moneyID`, `descript`, `amount`, `price`, `howto`, `reciveDate`, `lawID`, `age`, `reciveOffice`, `status`, `pid`, `tid`, `cid`, `gid`) VALUES
(4, 1, 'ป้ายประชาสัมพันธ์แหล่งท่องเที่ยวล่องแก่ง', '7690-002-1', 'พน0011', 'ป้ายประชาสัมพันธ์ขนาด 7.8', '1', 250000, 'ประกาศเชิญชวน', '2020-10-15', 'พท02/64', '1', 'อุตสาหกรรมจังหวัด', 'ดี', 11, 12, 15, 64),
(5, 2, 'ป้ายประชาสัมพันธ์แหล่งท่องเที่ยวพร้อมอุปกรณ์', '7690-002-0002', 'พน01234', 'ป้ายประชาสัมพันธ์แหล่งท่องเที่ยวพร้อมอุปกรณ์', '7', 70000, 'ประกาศเชิญชวน', '2020-10-15', 'พท01/251', '1 ปี', 'ท่องเที่ยว', 'ดี', 11, 12, 15, 64),
(6, 1, 'อุปกรณ์สำรวจความพึงพอใจ', '7440-008-0008', '0', '-', '1', 0, 'เฉพาะเจาะจง', '2020-10-15', '-', '-', 'อำเภอเมือง', 'ดี', 13, 17, 18, 61);

-- --------------------------------------------------------

--
-- Table structure for table `sys_year`
--

DROP TABLE IF EXISTS `sys_year`;
CREATE TABLE IF NOT EXISTS `sys_year` (
  `yid` int(11) NOT NULL AUTO_INCREMENT,
  `yname` char(4) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`yid`)
) ENGINE=InnoDB AUTO_INCREMENT=2564 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_year`
--

INSERT INTO `sys_year` (`yid`, `yname`, `status`) VALUES
(1, '2559', 1),
(2, '2560', 1),
(3, '2561', 1),
(4, '2562', 1),
(5, '2563', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data`
--

DROP TABLE IF EXISTS `tbl_data`;
CREATE TABLE IF NOT EXISTS `tbl_data` (
  `data_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_text` varchar(255) NOT NULL,
  `data_select` int(5) NOT NULL,
  PRIMARY KEY (`data_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_data`
--

INSERT INTO `tbl_data` (`data_id`, `data_text`, `data_select`) VALUES
(1, 'ปืน11', 1),
(9, 'มีด', 1),
(10, 'ดาบ', 2),
(11, 'ทดสอบการทำงาน', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Userlevel` varchar(1) NOT NULL,
  `office` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `Password`, `Firstname`, `Lastname`, `Userlevel`, `office`) VALUES
(1, 'admin', 'hellojava', 'สมศักดิ์', 'แก้วเกลี้ยง', 'A', 'สำนักงานจังหวัดพัทลุง'),
(2, 'user1', 'hellojava', 'สมมุติ', 'สุดหล่อ', 'M', 'ที่ทำการปกครองจังหวัด');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
