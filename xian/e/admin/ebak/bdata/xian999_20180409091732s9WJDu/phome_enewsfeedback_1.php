<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewsfeedback`;");
E_C("CREATE TABLE `phome_enewsfeedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL DEFAULT '',
  `saytext` text NOT NULL,
  `name` varchar(30) NOT NULL DEFAULT '',
  `mycall` varchar(60) NOT NULL DEFAULT '',
  `saytime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `filepath` varchar(20) NOT NULL DEFAULT '',
  `filename` text NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `haveread` tinyint(1) NOT NULL DEFAULT '0',
  `eipport` varchar(6) NOT NULL DEFAULT '',
  `woshi` varchar(255) NOT NULL DEFAULT '',
  `keting` varchar(255) NOT NULL DEFAULT '',
  `weishengjian` varchar(255) NOT NULL DEFAULT '',
  `yangtai` varchar(255) NOT NULL DEFAULT '',
  `fengge` varchar(255) NOT NULL DEFAULT '',
  `dangci` varchar(255) NOT NULL DEFAULT '',
  `xiaoqu` varchar(255) NOT NULL DEFAULT '',
  `leixing` varchar(255) NOT NULL DEFAULT '',
  `chuangyi` varchar(255) NOT NULL DEFAULT '',
  `laiyuan` varchar(255) NOT NULL DEFAULT '',
  `mianji` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `bid` (`bid`),
  KEY `haveread` (`haveread`)
) ENGINE=MyISAM AUTO_INCREMENT=164 DEFAULT CHARSET=utf8");

@include("../../inc/footer.php");
?>