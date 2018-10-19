<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewsuser`;");
E_C("CREATE TABLE `phome_enewsuser` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `rnd` varchar(20) NOT NULL DEFAULT '',
  `adminclass` mediumtext NOT NULL,
  `groupid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `checked` tinyint(1) NOT NULL DEFAULT '0',
  `styleid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `filelevel` tinyint(1) NOT NULL DEFAULT '0',
  `salt` varchar(8) NOT NULL DEFAULT '',
  `loginnum` int(10) unsigned NOT NULL DEFAULT '0',
  `lasttime` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(20) NOT NULL DEFAULT '',
  `truename` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(120) NOT NULL DEFAULT '',
  `classid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pretime` int(10) unsigned NOT NULL DEFAULT '0',
  `preip` varchar(20) NOT NULL DEFAULT '',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `addip` varchar(20) NOT NULL DEFAULT '',
  `userprikey` varchar(50) NOT NULL DEFAULT '',
  `salt2` varchar(20) NOT NULL DEFAULT '',
  `lastipport` varchar(6) NOT NULL DEFAULT '',
  `preipport` varchar(6) NOT NULL DEFAULT '',
  `addipport` varchar(6) NOT NULL DEFAULT '',
  `uprnd` varchar(32) NOT NULL DEFAULT '',
  `wname` varchar(60) NOT NULL DEFAULT '',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `wxno` varchar(80) NOT NULL DEFAULT '',
  `qq` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
E_D("replace into `phome_enewsuser` values('1',0x61646d696e,0x6362346137336334316663316234326263636462333437646539343239316163,0x5346336b377453476b724954615757426c794331,'','1','0','1','0',0x664b45486d355250,'29','1523236614',0x3131372e33362e37362e323330,'','','0','1523181478',0x3131372e33362e37362e323330,'1522831584',0x3131372e33362e37362e323330,0x4e5272374d347179534e5a4b38754171687142767431306e347657744549684d4b44646e6567764653313666456e6147,0x364c7549504b5742766848626c4d4f7a73545748,0x3439363637,0x3537313833,0x3631313339,'','','','','');");
E_D("replace into `phome_enewsuser` values('2',0x7475696775616e67,0x3839663730616239666363376439663463313337656361336134326462636437,0x4854496d73323879626958614f54627676787035,0x7c,'2','0','1','0',0x5a716a6956317934,'1','1522894538',0x3131332e3133392e3139352e313533,'','','0','0','','1522894514',0x3131332e3133392e3139352e313533,0x364c6b514635335144346f4a44635449334d486474306e7969326352625046564857674875615268476e594973636848,0x613344616a7543636a56467a586735566a647647,0x37353831,0x36363336,0x36363336,'','','','','');");

@include("../../inc/footer.php");
?>