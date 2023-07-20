/*
 * Create Tables
 */

CREATE TABLE IF NOT EXISTS `ycs_permissions` (
  `ID` int(11) NOT NULL auto_increment,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` char(64) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `Title` (`Title`),
  KEY `Lft` (`Lft`),
  KEY `Rght` (`Rght`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ycs_rolepermissions` (
  `RoleID` int(11) NOT NULL,
  `PermissionID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL,
  PRIMARY KEY  (`RoleID`,`PermissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `ycs_roles` (
  `ID` int(11) NOT NULL auto_increment,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` varchar(128) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `Title` (`Title`),
  KEY `Lft` (`Lft`),
  KEY `Rght` (`Rght`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `ycs_userroles` (
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL,
  PRIMARY KEY  (`UserID`,`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*
 * Insert Initial Table Data
 */

INSERT INTO `ycs_permissions` (`ID`, `Lft`, `Rght`, `Title`, `Description`)
VALUES (1, 0, 1, 'root', 'root');

INSERT INTO `ycs_rolepermissions` (`RoleID`, `PermissionID`, `AssignmentDate`)
VALUES (1, 1, UNIX_TIMESTAMP());

INSERT INTO `ycs_roles` (`ID`, `Lft`, `Rght`, `Title`, `Description`)
VALUES (1, 0, 1, 'root', 'root');

INSERT INTO `ycs_userroles` (`UserID`, `RoleID`, `AssignmentDate`)
VALUES (1, 1, UNIX_TIMESTAMP());



--
-- Custom Table - Table structure for table `ycs_users` - ref wp_users table
--

CREATE TABLE IF NOT EXISTS `ycs_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_ID` int(11) NOT NULL,  
  `user_login` varchar(60) NOT NULL, 
  `user_pass` varchar(255) NOT NULL, 
  `user_nicename` varchar(50) DEFAULT NULL, 
  `user_email` varchar(100) DEFAULT NULL,
  `user_url` varchar(100) DEFAULT NULL,
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) DEFAULT '0',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

--
-- Branch table `ycs_Branch`
--
CREATE TABLE IF NOT EXISTS `ycs_branch` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `phprbac_branch`
--

INSERT INTO `ycs_branch` (`ID`, `Title`, `Description`) VALUES
(1, 'karaikal', 'karaikal branch');



--
-- Dumping data for table `ycs_users`
--

INSERT INTO `ycs_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'gbs', 'c7c16ad0a608fde08aa24cdfce1a062d', 'gbs', 'gunabalans@yahoo.com', '', '2015-11-15 12:10:38', '', 0, 'gbs'),
(2, 'guest', '084e0343a0486ff05530df6c705c8bb4', 'guest', 'guest@gmailss.com', '', '2016-03-30 06:20:22', '', 0, '');



--
-- Table structure for table `customer`
--


CREATE TABLE IF NOT EXISTS `ycs_customer` (
  `CustId` varchar(10) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `Pincode` int(6) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `Country` varchar(20) DEFAULT NULL,
  `SAddress` varchar(100) DEFAULT NULL,
  `SCity` varchar(20) DEFAULT NULL,
  `SPincode` int(6) DEFAULT NULL,
  `SState` varchar(20) DEFAULT NULL,
  `SCountry` varchar(20) DEFAULT NULL,
  `PhoneNo` varchar(15) DEFAULT NULL,
  `MobileNo` int(10) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `DateOfInstallation` datetime DEFAULT NULL,
  `PackageId` varchar(10) DEFAULT NULL,
  `APName` varchar(50) DEFAULT NULL,
  `Location` varchar(50) DEFAULT NULL,
  `EquipmentMac` varchar(50) DEFAULT NULL,
  `EquipmentName` varchar(20) DEFAULT NULL,
  `EquipmentIp` varchar(50) DEFAULT NULL,
  `Proof` varchar(100) DEFAULT NULL,
  `Reference` varchar(20) DEFAULT NULL,
  `PhotoUpload` varchar(100) DEFAULT NULL,
  `ProofUpload` varchar(100) DEFAULT NULL,
`ProofUploadA` varchar(100) DEFAULT NULL,
`ProofUploadB` varchar(100) DEFAULT NULL,
`ProofUploadC` varchar(100) DEFAULT NULL,
`ProofUploadD` varchar(100) DEFAULT NULL,
  `Entity` varchar(20) DEFAULT NULL,
  `CustType` varchar(20) NOT NULL,
  PRIMARY KEY (`CustId`),
  KEY `PackageId` (`PackageId`),
  KEY `CustType` (`CustType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `ycs_customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`PackageId`) REFERENCES `package` (`PackageId`),
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`CustType`) REFERENCES `custtype` (`CustType`);
