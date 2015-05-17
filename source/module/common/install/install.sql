/*
Date: 2014/03/21 18:37:38
*/

-- ----------------------------
-- Table structure for #@@__common_attr
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_attr`;
CREATE TABLE `#@@__common_attr` (
  `attrid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`attrid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_badword_filter
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_badword_filter`;
CREATE TABLE `#@@__common_badword_filter` (
  `cwordid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `cgroupid` mediumint(10) NOT NULL DEFAULT '0',
  `listorder` int(20) NOT NULL DEFAULT '0',
  `badword` varchar(200) NOT NULL,
  `filterword` varchar(200) DEFAULT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cwordid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_badword_group
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_badword_group`;
CREATE TABLE `#@@__common_badword_group` (
  `cgroupid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `listorder` int(20) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cgroupid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_blend_content
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_blend_content`;
CREATE TABLE `#@@__common_blend_content` (
  `id` mediumint(10) NOT NULL AUTO_INCREMENT,
  `module` varchar(50) NOT NULL,
  `idtype` varchar(50) NOT NULL,
  `sid` mediumint(10) NOT NULL,
  `uid` mediumint(10) NOT NULL,
  `ctime` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_category
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_category`;
CREATE TABLE `#@@__common_category` (
  `catid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `catids` mediumint(10) NOT NULL DEFAULT '0',
  `module` varchar(100) NOT NULL,
  `listorder` int(20) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `description` text,
  `ctime` int(20) NOT NULL DEFAULT '0',
  `disabled` int(4) NOT NULL DEFAULT '0',
  `innav` int(4) NOT NULL DEFAULT '0',
  `seo_title` text,
  `seo_keywords` text,
  `seo_description` text,
  `template` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`catid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_content_click
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_content_click`;
CREATE TABLE `#@@__common_content_click` (
  `module` varchar(100) NOT NULL,
  `idtype` varchar(50) NOT NULL,
  `values` mediumtext,
  `click0` smallint(6) NOT NULL DEFAULT '0',
  `click1` smallint(6) NOT NULL DEFAULT '0',
  `click2` smallint(6) NOT NULL DEFAULT '0',
  `click3` smallint(6) NOT NULL DEFAULT '0',
  `click4` smallint(6) NOT NULL DEFAULT '0',
  `click5` smallint(6) NOT NULL DEFAULT '0',
  `click6` smallint(6) NOT NULL DEFAULT '0',
  `click7` smallint(6) NOT NULL DEFAULT '0',
  `click8` smallint(6) NOT NULL DEFAULT '0',
  `click9` smallint(6) NOT NULL DEFAULT '0'
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_credit_change
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_credit_change`;
CREATE TABLE `#@@__common_credit_change` (
  `changeid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(10) NOT NULL,
  `outcost` varchar(20) DEFAULT NULL,
  `outcredit` varchar(100) NOT NULL,
  `incost` varchar(20) DEFAULT NULL,
  `incredit` varchar(100) NOT NULL,
  `ctime` int(20) NOT NULL,
  `disabled` int(4) NOT NULL,
  PRIMARY KEY (`changeid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_credit_log
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_credit_log`;
CREATE TABLE `#@@__common_credit_log` (
  `logid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(10) NOT NULL,
  `logtype` varchar(100) DEFAULT NULL,
  `reward` varchar(100) DEFAULT NULL,
  `description` text,
  `ctime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`logid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_credit_rule
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_credit_rule`;
CREATE TABLE `#@@__common_credit_rule` (
  `ruleid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `cycletype` varchar(100) DEFAULT NULL,
  `cycletime` text,
  `rewardnum` varchar(20) DEFAULT NULL,
  `credit0` varchar(20) DEFAULT NULL,
  `credit1` varchar(20) DEFAULT NULL,
  `credit2` varchar(20) DEFAULT NULL,
  `credit3` varchar(20) DEFAULT NULL,
  `credit4` varchar(20) DEFAULT NULL,
  `credit5` varchar(20) DEFAULT NULL,
  `credit6` varchar(20) DEFAULT NULL,
  `credit7` varchar(20) DEFAULT NULL,
  `credit8` varchar(20) DEFAULT NULL,
  `credit9` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ruleid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_datacall
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_datacall`;
CREATE TABLE `#@@__common_datacall` (
  `dcid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL,
  `dsid` mediumint(10) NOT NULL,
  `uid` mediumint(10) NOT NULL,
  `listorder` int(20) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL,
  `values` mediumtext,
  `ctime` int(20) NOT NULL DEFAULT '0',
  `btime` int(20) NOT NULL DEFAULT '0',
  `etime` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dcid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_datastyle
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_datastyle`;
CREATE TABLE `#@@__common_datastyle` (
  `dsid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL,
  `uid` mediumint(10) NOT NULL,
  `listorder` int(20) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL,
  `content` mediumtext,
  `ctime` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dsid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_emotional
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_emotional`;
CREATE TABLE `#@@__common_emotional` (
  `emotid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `emotgroupid` mediumint(10) NOT NULL,
  `uid` mediumint(10) NOT NULL,
  `listorder` int(10) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `file_name` varchar(200) NOT NULL,
  `file_type` varchar(20) NOT NULL,
  `ctime` int(20) NOT NULL,
  PRIMARY KEY (`emotid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_emotional_group
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_emotional_group`;
CREATE TABLE `#@@__common_emotional_group` (
  `emotgroupid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(10) NOT NULL,
  `listorder` int(10) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL,
  `ctime` int(20) NOT NULL,
  PRIMARY KEY (`emotgroupid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_favorite
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_favorite`;
CREATE TABLE `#@@__common_favorite` (
  `favorid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `module` varchar(50) NOT NULL,
  `idtype` varchar(50) NOT NULL,
  `uid` mediumint(10) NOT NULL,
  `sid` mediumint(10) NOT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`favorid`),
  KEY `favorite` (`favorid`,`uid`,`sid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_invitecode
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_invitecode`;
CREATE TABLE `#@@__common_invitecode` (
  `invitecodeid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(10) NOT NULL,
  `invitecode` varchar(50) NOT NULL,
  `ctime` int(20) NOT NULL,
  `isbuy` int(4) NOT NULL,
  `buyuid` mediumint(10) NOT NULL DEFAULT '0',
  `buytime` int(20) NOT NULL DEFAULT '0',
  `registeruid` mediumint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`invitecodeid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_nav
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_nav`;
CREATE TABLE `#@@__common_nav` (
  `navid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `navids` mediumint(10) NOT NULL DEFAULT '0',
  `module` varchar(100) DEFAULT NULL,
  `navtype` varchar(100) NOT NULL,
  `listorder` int(20) NOT NULL DEFAULT '0',
  `title` mediumtext NOT NULL,
  `navurl` mediumtext,
  `ofkey` varchar(50) DEFAULT NULL,
  `ofval` varchar(50) DEFAULT NULL,
  `navxy` varchar(50) DEFAULT NULL,
  `target` varchar(50) DEFAULT NULL,
  `disabled` int(4) NOT NULL DEFAULT '0',
  `ctime` int(20) NOT NULL DEFAULT '0',
  `setting` mediumtext,
  PRIMARY KEY (`navid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_sense
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_sense`;
CREATE TABLE `#@@__common_sense` (
  `senseid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(10) NOT NULL,
  `sensetypeid` mediumint(10) NOT NULL,
  `listorder` int(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `filename` text,
  `ctime` int(20) NOT NULL,
  `disabled` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`senseid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_sense_type
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_sense_type`;
CREATE TABLE `#@@__common_sense_type` (
  `sensetypeid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL,
  `uid` mediumint(10) NOT NULL,
  `listorder` int(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `ctime` int(20) NOT NULL,
  PRIMARY KEY (`sensetypeid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_set
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_set`;
CREATE TABLE `#@@__common_set` (
  `setid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `smodule` varchar(50) NOT NULL,
  `stype` varchar(50) NOT NULL,
  `svariable` varchar(50) NOT NULL,
  `svalue` mediumtext NOT NULL,
  PRIMARY KEY (`setid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_showdata
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_showdata`;
CREATE TABLE `#@@__common_showdata` (
  `cdataid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `cgroupid` mediumint(10) NOT NULL DEFAULT '0',
  `listorder` int(20) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `description` text,
  `covertype` int(4) NOT NULL DEFAULT '0',
  `coverimage` text,
  `ctime` int(20) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cdataid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_showgroup
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_showgroup`;
CREATE TABLE `#@@__common_showgroup` (
  `cgroupid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `listorder` int(20) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cgroupid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_temp_attachment
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_temp_attachment`;
CREATE TABLE `#@@__common_temp_attachment` (
  `attachid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL,
  `idtype` varchar(50) NOT NULL,
  `attachtype` varchar(50) DEFAULT NULL,
  `uid` mediumint(10) NOT NULL,
  `file_name` varchar(200) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_info` varchar(200) DEFAULT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  `iscover` int(4) NOT NULL DEFAULT '0',
  `isedited` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`attachid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__common_template
-- ----------------------------
DROP TABLE IF EXISTS `#@@__common_template`;
CREATE TABLE `#@@__common_template` (
  `templateid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `listorder` int(20) NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `path` varchar(100) NOT NULL,
  `description` mediumtext,
  `ctime` int(20) NOT NULL DEFAULT '0',
  `disabled` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`templateid`)
) TYPE=MyISAM;

