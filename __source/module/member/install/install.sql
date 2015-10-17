/*
Date: 2014/03/21 18:38:30
*/

-- ----------------------------
-- Table structure for #@@__member
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member`;
CREATE TABLE `#@@__member` (
  `uid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `email_auth` int(4) NOT NULL DEFAULT '0',
  `register_time` int(20) NOT NULL DEFAULT '0',
  `before_time` int(20) NOT NULL DEFAULT '0',
  `last_time` int(20) NOT NULL DEFAULT '0',
  `register_ip` text,
  `before_ip` text,
  `last_ip` text,
  `dateline` int(20) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0',
  `adminid` mediumint(10) NOT NULL DEFAULT '0',
  `groupid` mediumint(10) NOT NULL DEFAULT '0',
  `extgroupid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `uid` (`uid`,`username`,`password`,`email`,`status`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_area
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_area`;
CREATE TABLE `#@@__member_area` (
  `aid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `aids` mediumint(10) NOT NULL DEFAULT '0',
  `listorder` int(20) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_avatar
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_avatar`;
CREATE TABLE `#@@__member_avatar` (
  `uid` mediumint(10) NOT NULL,
  `file_name` text,
  `ctime` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `uid` (`uid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_avatar_temp
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_avatar_temp`;
CREATE TABLE `#@@__member_avatar_temp` (
  `uid` mediumint(10) NOT NULL,
  `file_name` text,
  `file_type` varchar(100) DEFAULT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL,
  `isedited` int(4) NOT NULL,
  PRIMARY KEY (`uid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_credit
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_credit`;
CREATE TABLE `#@@__member_credit` (
  `uid` mediumint(10) NOT NULL,
  `credit0` varchar(20) NOT NULL,
  `credit1` varchar(20) DEFAULT NULL,
  `credit2` varchar(20) DEFAULT NULL,
  `credit3` varchar(20) DEFAULT NULL,
  `credit4` varchar(20) DEFAULT NULL,
  `credit5` varchar(20) DEFAULT NULL,
  `credit6` varchar(20) DEFAULT NULL,
  `credit7` varchar(20) DEFAULT NULL,
  `credit8` varchar(20) DEFAULT NULL,
  `credit9` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_friend
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_friend`;
CREATE TABLE `#@@__member_friend` (
  `friendid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `follow_uid` mediumint(10) NOT NULL,
  `fans_uid` mediumint(10) NOT NULL,
  `ctime` int(20) NOT NULL,
  PRIMARY KEY (`friendid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_group
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_group`;
CREATE TABLE `#@@__member_group` (
  `groupid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  `grouptype` varchar(100) NOT NULL,
  `iscore` int(4) NOT NULL,
  `credit` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_groupset
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_groupset`;
CREATE TABLE `#@@__member_groupset` (
  `groupsetid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `groupid` mediumint(10) NOT NULL,
  `module` varchar(50) NOT NULL,
  `setting` mediumtext,
  PRIMARY KEY (`groupsetid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_message
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_message`;
CREATE TABLE `#@@__member_message` (
  `messageid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `inboxuid` mediumint(10) NOT NULL,
  `outboxuid` mediumint(10) NOT NULL,
  `inbox` int(4) NOT NULL DEFAULT '0',
  `outbox` int(4) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL,
  `content` mediumtext,
  `ctime` int(20) NOT NULL,
  `isview` int(4) NOT NULL DEFAULT '0',
  `isreply` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`messageid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_notice
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_notice`;
CREATE TABLE `#@@__member_notice` (
  `noticeid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `inboxuid` mediumint(10) NOT NULL,
  `outboxuid` mediumint(10) NOT NULL,
  `fromuid` mediumint(10) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` mediumtext,
  `ctime` int(20) NOT NULL,
  `isview` int(4) NOT NULL DEFAULT '0',
  `isreply` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`noticeid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_operation
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_operation`;
CREATE TABLE `#@@__member_operation` (
  `uid` mediumint(10) NOT NULL,
  `setting` mediumtext,
  PRIMARY KEY (`uid`),
  KEY `uid` (`uid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_profile
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_profile`;
CREATE TABLE `#@@__member_profile` (
  `uid` mediumint(10) NOT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `gender` int(4) NOT NULL DEFAULT '2',
  `birthday` varchar(50) DEFAULT NULL,
  `hometown` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `inform` text,
  PRIMARY KEY (`uid`),
  KEY `uid` (`uid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_remind
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_remind`;
CREATE TABLE `#@@__member_remind` (
  `remindid` mediumint(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`remindid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_tag
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_tag`;
CREATE TABLE `#@@__member_tag` (
  `tagid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `listorder` int(20) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  `disabled` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tagid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_tagof
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_tagof`;
CREATE TABLE `#@@__member_tagof` (
  `id` mediumint(10) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(10) NOT NULL,
  `tagid` mediumint(10) NOT NULL,
  `ctime` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`tagid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__member_task_base
-- ----------------------------
DROP TABLE IF EXISTS `#@@__member_task_base`;
CREATE TABLE `#@@__member_task_base` (
  `tb_id` mediumint(10) NOT NULL AUTO_INCREMENT,
  `tb_listorder` int(20) NOT NULL DEFAULT '0',
  `tb_name` varchar(200) NOT NULL,
  `tb_content` text,
  `tb_time` int(20) NOT NULL DEFAULT '0',
  `tb_type` varchar(100) NOT NULL,
  `tb_disabled` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tb_id`)
) TYPE=MyISAM;

