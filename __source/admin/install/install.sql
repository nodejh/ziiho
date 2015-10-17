/*
Date: 2014/03/21 18:36:34
*/

-- ----------------------------
-- Table structure for #@@__admin_member
-- ----------------------------
DROP TABLE IF EXISTS `#@@__admin_member`;
CREATE TABLE `#@@__admin_member` (
  `uid` mediumint(10) NOT NULL,
  `groupid` mediumint(10) NOT NULL,
  PRIMARY KEY (`uid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `#@@__admin_menu`;
CREATE TABLE `#@@__admin_menu` (
  `menu_id` mediumint(10) NOT NULL AUTO_INCREMENT,
  `menu_ids` mediumint(10) NOT NULL,
  `module` varchar(100) NOT NULL,
  `listorder` int(20) NOT NULL DEFAULT '0',
  `title` varchar(100) DEFAULT NULL,
  `urlfile` varchar(100) DEFAULT NULL,
  `getval` text,
  `actions` text,
  `menu_url` text,
  `target` varchar(50) DEFAULT NULL,
  `ctime` int(20) NOT NULL,
  `isopenchild` int(4) NOT NULL,
  PRIMARY KEY (`menu_id`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__admin_menuof
-- ----------------------------
DROP TABLE IF EXISTS `#@@__admin_menuof`;
CREATE TABLE `#@@__admin_menuof` (
  `menuofid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `menu_id` mediumint(10) NOT NULL,
  `uid` mediumint(10) NOT NULL,
  PRIMARY KEY (`menuofid`)
) TYPE=MyISAM;

