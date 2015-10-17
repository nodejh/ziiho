/*
Date: 2014/03/11 20:50:12
*/

-- ----------------------------
-- Table structure for #@@__article
-- ----------------------------
DROP TABLE IF EXISTS `#@@__article`;
CREATE TABLE `#@@__article` (
  `aid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(10) NOT NULL,
  `catid` mediumint(10) NOT NULL DEFAULT '0',
  `imgsrc` varchar(200) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `tourl` varchar(500) DEFAULT NULL,
  `description` text,
  `origin` varchar(100) DEFAULT NULL,
  `originurl` varchar(500) DEFAULT NULL,
  `keywords` varchar(200) DEFAULT NULL,
  `abouts` varchar(200) DEFAULT NULL,
  `template` varchar(50) DEFAULT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  `pictures` int(20) NOT NULL DEFAULT '0',
  `comments` int(20) NOT NULL DEFAULT '0',
  `views` int(20) NOT NULL DEFAULT '0',
  `iscomment` int(4) NOT NULL DEFAULT '0',
  `isdescription` int(4) NOT NULL DEFAULT '0',
  `isslide` int(4) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0',
  `labelid` mediumint(10) NOT NULL DEFAULT '0',
  `attrid` mediumint(10) NOT NULL DEFAULT '0',
  `iconid` mediumint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`),
  KEY `aid` (`aid`,`uid`,`catid`,`title`,`status`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__article_content
-- ----------------------------
DROP TABLE IF EXISTS `#@@__article_content`;
CREATE TABLE `#@@__article_content` (
  `aid` mediumint(10) NOT NULL,
  `content` mediumtext,
  PRIMARY KEY (`aid`),
  KEY `aid` (`aid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__article_icon
-- ----------------------------
DROP TABLE IF EXISTS `#@@__article_icon`;
CREATE TABLE `#@@__article_icon` (
  `iconid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(10) NOT NULL,
  `listorder` int(20) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `iconident` varchar(100) DEFAULT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`iconid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__article_label
-- ----------------------------
DROP TABLE IF EXISTS `#@@__article_label`;
CREATE TABLE `#@@__article_label` (
  `labelid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`labelid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__article_labelid
-- ----------------------------
DROP TABLE IF EXISTS `#@@__article_labelid`;
CREATE TABLE `#@@__article_labelid` (
  `id` mediumint(10) NOT NULL AUTO_INCREMENT,
  `aid` mediumint(10) NOT NULL,
  `labelid` mediumint(10) NOT NULL,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__article_picture
-- ----------------------------
DROP TABLE IF EXISTS `#@@__article_picture`;
CREATE TABLE `#@@__article_picture` (
  `picid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(10) NOT NULL,
  `aid` mediumint(10) NOT NULL,
  `file_name` text,
  `file_type` varchar(20) DEFAULT NULL,
  `file_size` varchar(20) DEFAULT NULL,
  `file_info` varchar(200) DEFAULT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  `iscover` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`picid`),
  KEY `pic_id` (`picid`,`uid`,`aid`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__article_tag
-- ----------------------------
DROP TABLE IF EXISTS `#@@__article_tag`;
CREATE TABLE `#@@__article_tag` (
  `id` mediumint(10) NOT NULL AUTO_INCREMENT,
  `aid` mediumint(10) NOT NULL,
  `tid` mediumint(10) NOT NULL,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

-- ----------------------------
-- Table structure for #@@__article_tagname
-- ----------------------------
DROP TABLE IF EXISTS `#@@__article_tagname`;
CREATE TABLE `#@@__article_tagname` (
  `tid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `listorder` int(20) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `ctime` int(20) NOT NULL DEFAULT '0',
  `disabled` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`)
) TYPE=MyISAM;

