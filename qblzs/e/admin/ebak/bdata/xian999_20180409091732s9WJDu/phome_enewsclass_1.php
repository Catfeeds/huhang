<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewsclass`;");
E_C("CREATE TABLE `phome_enewsclass` (
  `classid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `bclassid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `classname` varchar(50) NOT NULL DEFAULT '',
  `sonclass` text NOT NULL,
  `is_zt` tinyint(1) NOT NULL DEFAULT '0',
  `lencord` smallint(6) NOT NULL DEFAULT '0',
  `link_num` tinyint(4) NOT NULL DEFAULT '0',
  `newstempid` smallint(6) NOT NULL DEFAULT '0',
  `onclick` int(11) NOT NULL DEFAULT '0',
  `listtempid` smallint(6) NOT NULL DEFAULT '0',
  `featherclass` text NOT NULL,
  `islast` tinyint(1) NOT NULL DEFAULT '0',
  `classpath` text NOT NULL,
  `classtype` varchar(10) NOT NULL DEFAULT '',
  `newspath` varchar(20) NOT NULL DEFAULT '',
  `filename` tinyint(1) NOT NULL DEFAULT '0',
  `filetype` varchar(10) NOT NULL DEFAULT '',
  `openpl` tinyint(1) NOT NULL DEFAULT '0',
  `openadd` tinyint(1) NOT NULL DEFAULT '0',
  `newline` int(11) NOT NULL DEFAULT '0',
  `hotline` int(11) NOT NULL DEFAULT '0',
  `goodline` int(11) NOT NULL DEFAULT '0',
  `classurl` varchar(200) NOT NULL DEFAULT '',
  `groupid` smallint(6) NOT NULL DEFAULT '0',
  `myorder` smallint(6) NOT NULL DEFAULT '0',
  `filename_qz` varchar(20) NOT NULL DEFAULT '',
  `hotplline` tinyint(4) NOT NULL DEFAULT '0',
  `modid` smallint(6) NOT NULL DEFAULT '0',
  `checked` tinyint(1) NOT NULL DEFAULT '0',
  `firstline` tinyint(4) NOT NULL DEFAULT '0',
  `bname` varchar(50) NOT NULL DEFAULT '',
  `islist` tinyint(1) NOT NULL DEFAULT '0',
  `searchtempid` smallint(6) NOT NULL DEFAULT '0',
  `tid` smallint(6) NOT NULL DEFAULT '0',
  `tbname` varchar(60) NOT NULL DEFAULT '',
  `maxnum` int(11) NOT NULL DEFAULT '0',
  `checkpl` tinyint(1) NOT NULL DEFAULT '0',
  `down_num` tinyint(4) NOT NULL DEFAULT '0',
  `online_num` tinyint(4) NOT NULL DEFAULT '0',
  `listorder` varchar(50) NOT NULL DEFAULT '',
  `reorder` varchar(50) NOT NULL DEFAULT '',
  `intro` text NOT NULL,
  `classimg` varchar(255) NOT NULL DEFAULT '',
  `jstempid` smallint(6) NOT NULL DEFAULT '0',
  `addinfofen` int(11) NOT NULL DEFAULT '0',
  `listdt` tinyint(1) NOT NULL DEFAULT '0',
  `showclass` tinyint(1) NOT NULL DEFAULT '0',
  `showdt` tinyint(1) NOT NULL DEFAULT '0',
  `checkqadd` tinyint(1) NOT NULL DEFAULT '0',
  `qaddlist` tinyint(1) NOT NULL DEFAULT '0',
  `qaddgroupid` text NOT NULL,
  `qaddshowkey` tinyint(1) NOT NULL DEFAULT '0',
  `adminqinfo` tinyint(1) NOT NULL DEFAULT '0',
  `doctime` smallint(6) NOT NULL DEFAULT '0',
  `classpagekey` varchar(255) NOT NULL DEFAULT '',
  `dtlisttempid` smallint(6) NOT NULL DEFAULT '0',
  `classtempid` smallint(6) NOT NULL DEFAULT '0',
  `nreclass` tinyint(1) NOT NULL DEFAULT '0',
  `nreinfo` tinyint(1) NOT NULL DEFAULT '0',
  `nrejs` tinyint(1) NOT NULL DEFAULT '0',
  `nottobq` tinyint(1) NOT NULL DEFAULT '0',
  `ipath` varchar(255) NOT NULL DEFAULT '',
  `addreinfo` tinyint(1) NOT NULL DEFAULT '0',
  `haddlist` tinyint(4) NOT NULL DEFAULT '0',
  `sametitle` tinyint(1) NOT NULL DEFAULT '0',
  `definfovoteid` smallint(6) NOT NULL DEFAULT '0',
  `wburl` varchar(255) NOT NULL DEFAULT '',
  `qeditchecked` tinyint(1) NOT NULL DEFAULT '0',
  `wapstyleid` smallint(6) NOT NULL DEFAULT '0',
  `repreinfo` tinyint(1) NOT NULL DEFAULT '0',
  `pltempid` smallint(6) NOT NULL DEFAULT '0',
  `cgroupid` text NOT NULL,
  `yhid` smallint(6) NOT NULL DEFAULT '0',
  `wfid` smallint(6) NOT NULL DEFAULT '0',
  `cgtoinfo` tinyint(1) NOT NULL DEFAULT '0',
  `bdinfoid` varchar(25) NOT NULL DEFAULT '',
  `repagenum` smallint(5) unsigned NOT NULL DEFAULT '0',
  `keycid` smallint(6) NOT NULL DEFAULT '0',
  `allinfos` int(10) unsigned NOT NULL DEFAULT '0',
  `infos` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `oneinfo` tinyint(1) NOT NULL DEFAULT '0',
  `addsql` varchar(255) NOT NULL DEFAULT '',
  `wapislist` tinyint(1) NOT NULL DEFAULT '0',
  `fclast` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`classid`),
  KEY `bclassid` (`bclassid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8");
E_D("replace into `phome_enewsclass` values('19','9',0xe8a385e4bfaee8b4b7e6acbe,0x7c,'0','25','10','0','0','0',0x7c397c,'0',0x6d6f62696c652f6c6f616e73,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe8a385e4bfaee8b4b7e6acbe,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','13','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1523068198','0','','0','1523069316');");
E_D("replace into `phome_enewsclass` values('2','0',0xe5ae9ae588b6e695b4e8a385,0x7c,'0','25','10','0','0','0','','0',0x70726f64756374,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe695b4e8a385e4baa7e59381,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','3','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522834734','0','','0','1523065599');");
E_D("replace into `phome_enewsclass` values('3','0',0xe9878fe688bfe8aebee8aea1,0x7c,'0','25','10','0','0','0','','0',0x64657369676e,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe5858de8b4b9e9878fe688bfe8aebee8aea1,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','1','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522835771','0','','0','1522835771');");
E_D("replace into `phome_enewsclass` values('4','0',0xe699bae883bde68aa5e4bbb7,0x7c,'0','25','10','0','0','0','','0',0x71756f7465,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe8a385e4bfaee699bae883bde68aa5e4bbb7,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','1','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522835815','0','','0','1522835815');");
E_D("replace into `phome_enewsclass` values('5','0',0xe5ae9ee699afe6a0b7e69dbfe997b4,0x7c,'0','25','10','0','0','0','','0',0x63617365,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe5ae9ee699af2fe8a385e4bfaee6a188e4be8b,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','1','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522835996','0','','0','1522836223');");
E_D("replace into `phome_enewsclass` values('6','0',0xe5beb7e7b3bbe5b7a5e889ba,0x7c,'0','25','10','0','0','0','','0',0x70726f63657373,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe5beb7e7b3bbe5b7a5e889ba,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','1','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522836139','0','','0','1522836139');");
E_D("replace into `phome_enewsclass` values('7','0',0xe585b3e4ba8ee68891e4bbac,0x7c,'0','25','10','0','0','0','','0',0x61626f7574,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe585b3e4ba8ee68891e4bbac,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','1','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522836200','0','','0','1522836200');");
E_D("replace into `phome_enewsclass` values('8','7',0xe88194e7b3bbe68891e4bbac,0x7c,'0','25','10','0','0','0',0x7c377c,'0',0x61626f75742f636f6e74616374,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe88194e7b3bbe68891e4bbac,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','1','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522836476','0','','0','1522836476');");
E_D("replace into `phome_enewsclass` values('9','0',0xe6898be69cbae7ab99e9a696e9a1b5,0x7c,'0','25','10','0','0','0','','0',0x6d6f62696c65,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe6898be69cbae7ab99,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','20','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522934862','0','','0','1523069165');");
E_D("replace into `phome_enewsclass` values('11','9',0xe5858de8b4b9e8aebee8aea1,0x7c,'0','25','10','0','0','0',0x7c397c,'0',0x6d6f62696c652f64657369676e,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe5858de8b4b9e9878fe688bfe8aebee8aea1,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','11','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522935006','0','','0','1523069177');");
E_D("replace into `phome_enewsclass` values('12','9',0xe5ae9ae588b6e695b4e8a385,0x7c,'0','25','10','0','0','0',0x7c397c,'0',0x6d6f62696c652f70726f64756374,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe695b4e8a385e4baa7e59381,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','12','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522935043','0','','0','1523069188');");
E_D("replace into `phome_enewsclass` values('14','9',0xe699bae883bde68aa5e4bbb7,0x7c,'0','25','10','0','0','0',0x7c397c,'0',0x6d6f62696c652f71756f7465,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe699bae883bde68aa5e4bbb7,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','14','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522935096','0','','0','1523069204');");
E_D("replace into `phome_enewsclass` values('15','9',0xe69c80e696b0e4bc98e683a0,0x7c,'0','25','10','0','0','0',0x7c397c,'0',0x6d6f62696c652f6163746976697479,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe69c80e696b0e4bc98e683a0,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','15','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522935150','0','','0','1523069216');");
E_D("replace into `phome_enewsclass` values('16','9',0xe6bbb4e6bbb4e68ea5e9a9be,0x7c,'0','25','10','0','0','0',0x7c397c,'0',0x6d6f62696c652f64726f7073,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe6bbb4e6bbb4e68ea5e9a9be,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','16','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522935184','0','','0','1523069247');");
E_D("replace into `phome_enewsclass` values('17','9',0xe59ca8e7babfe592a8e8afa2,0x7c,'0','25','10','0','0','0',0x7c397c,'0',0x6d6f62696c652f74656c,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe59ca8e7babfe592a8e8afa2,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','17','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522935286','0','','0','1523069297');");
E_D("replace into `phome_enewsclass` values('18','9',0xe997a8e5ba97e5afbce888aa,0x7c,'0','25','10','0','0','0',0x7c397c,'0',0x6d6f62696c652f73746f7265735f6e6176,0x2e68746d6c,0x592d6d2d64,'0',0x2e68746d6c,'0','1','10','10','10','','0','0','','10','1','1','10',0xe997a8e5ba97e5afbce888aa,'0','0','1',0x6e657773,'0','0','2','2',0x69642044455343,0x6e65777374696d652044455343,'','','1','0','0','0','0','0','0','','0','0','0','','0','18','0','0','0','0','','1','0','0','0','','0','0','0','0','','0','0','0','','0','0','0','0','1522935388','0','','0','1523069306');");

@include("../../inc/footer.php");
?>