/*
Date: 2014/03/11 20:51:24
*/

-- ----------------------------
-- Table structure for #@@__comment
-- ----------------------------
DROP TABLE IF EXISTS `#@@__comment`;
CREATE TABLE `#@@__comment` (
  `commentid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `commentids` mediumint(10) NOT NULL DEFAULT '0',
  `module` varchar(50) NOT NULL,
  `idtype` varchar(50) NOT NULL,
  `sid` mediumint(10) NOT NULL,
  `uid` mediumint(10) NOT NULL,
  `content` mediumtext,
  `ip` varchar(50) DEFAULT NULL,
  `ctime` int(20) NOT NULL,
  `touid` mediumint(10) NOT NULL DEFAULT '0',
  `floorid` int(20) NOT NULL DEFAULT '0',
  `floors` text,
  `good` text,
  `middle` text,
  `bad` text,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`commentid`),
  KEY `commentid` (`commentid`,`commentids`,`module`,`idtype`,`sid`,`uid`,`status`)
) TYPE=MyISAM;

