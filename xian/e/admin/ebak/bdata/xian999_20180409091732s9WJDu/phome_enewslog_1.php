<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewslog`;");
E_C("CREATE TABLE `phome_enewslog` (
  `loginid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '',
  `logintime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `loginip` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(30) NOT NULL DEFAULT '',
  `loginauth` tinyint(1) NOT NULL DEFAULT '0',
  `ipport` varchar(6) NOT NULL DEFAULT '',
  PRIMARY KEY (`loginid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8");
E_D("replace into `phome_enewslog` values('1',0x61646d696e,'2018-04-04 16:46:53',0x3131372e33362e37362e323330,'1','','0',0x3631313233);");
E_D("replace into `phome_enewslog` values('2',0x61646d696e,'2018-04-04 16:52:29',0x3131372e33362e37362e323330,'1','','0',0x3631343433);");
E_D("replace into `phome_enewslog` values('3',0x61646d696e,'2018-04-04 16:57:53',0x3131372e33362e37362e323330,'1','','0',0x3631343431);");
E_D("replace into `phome_enewslog` values('4',0x61646d696e,'2018-04-04 17:06:42',0x3131372e33362e37362e323330,'0','','0',0x3631343431);");
E_D("replace into `phome_enewslog` values('5',0x61646d696e,'2018-04-04 17:06:50',0x3131372e33362e37362e323330,'1','','0',0x3631343431);");
E_D("replace into `phome_enewslog` values('6',0x61646d696e,'2018-04-04 17:12:53',0x3131372e33362e37362e323330,'1','','0',0x3632343830);");
E_D("replace into `phome_enewslog` values('7',0x61646d696e,'2018-04-04 18:06:24',0x3131372e33362e37362e323330,'1','','0',0x3634313233);");
E_D("replace into `phome_enewslog` values('8',0x61646d696e,'2018-04-04 18:20:46',0x3131372e33362e37362e323330,'1','','0',0x3535383432);");
E_D("replace into `phome_enewslog` values('9',0x61646d696e,'2018-04-04 18:49:10',0x3131372e33362e37362e323330,'1','','0',0x3635303438);");
E_D("replace into `phome_enewslog` values('10',0x61646d696e,'2018-04-05 09:56:48',0x3131332e3133392e3139352e313533,'1','','0',0x36363335);");
E_D("replace into `phome_enewslog` values('11',0x7475696775616e67,'2018-04-05 10:15:38',0x3131332e3133392e3139352e313533,'1','','0',0x37353831);");
E_D("replace into `phome_enewslog` values('12',0x61646d696e,'2018-04-05 16:52:35',0x3131332e3133392e3139352e313533,'1','','0',0x38303933);");
E_D("replace into `phome_enewslog` values('13',0x61646d696e,'2018-04-05 21:12:59',0x3131332e3133392e3139352e313533,'1','','0',0x39313538);");
E_D("replace into `phome_enewslog` values('14',0x79616e677869,'2018-04-07 09:16:51',0x3131372e33362e37362e323330,'0','','0',0x3531373134);");
E_D("replace into `phome_enewslog` values('15',0x79616e677869,'2018-04-07 09:17:06',0x3131372e33362e37362e323330,'0','','0',0x3531373136);");
E_D("replace into `phome_enewslog` values('16',0x79616e677869,'2018-04-07 09:17:20',0x3131372e33362e37362e323330,'0','','0',0x3531373136);");
E_D("replace into `phome_enewslog` values('17',0x61646d696e,'2018-04-07 09:40:28',0x3131372e33362e37362e323330,'1','','0',0x3532343539);");
E_D("replace into `phome_enewslog` values('18',0x61646d696e,'2018-04-07 10:21:44',0x3131372e33362e37362e323330,'1','','0',0x3530323532);");
E_D("replace into `phome_enewslog` values('19',0x79616e677869,'2018-04-07 14:31:04',0x3131372e33362e37362e323330,'0','','0',0x3537343435);");
E_D("replace into `phome_enewslog` values('20',0x79616e677869,'2018-04-07 14:31:17',0x3131372e33362e37362e323330,'0','','0',0x3537343435);");
E_D("replace into `phome_enewslog` values('21',0x79616e677869,'2018-04-07 14:31:29',0x3131372e33362e37362e323330,'0','','0',0x3537343435);");
E_D("replace into `phome_enewslog` values('22',0x79616e677869,'2018-04-07 14:31:49',0x3131372e33362e37362e323330,'0','','0',0x3537343435);");
E_D("replace into `phome_enewslog` values('23',0x61646d696e,'2018-04-07 15:35:43',0x3131372e33362e37362e323330,'1','','0',0x3536333935);");
E_D("replace into `phome_enewslog` values('24',0x61646d696e,'2018-04-07 15:39:42',0x3131372e33362e37362e323330,'1','','0',0x3534373735);");
E_D("replace into `phome_enewslog` values('25',0x79616e677869,'2018-04-07 16:32:05',0x3131372e33362e37362e323330,'0','','0',0x3632313936);");
E_D("replace into `phome_enewslog` values('26',0x79616e677869,'2018-04-07 16:32:18',0x3131372e33362e37362e323330,'0','','0',0x3632313936);");
E_D("replace into `phome_enewslog` values('27',0x61646d696e,'2018-04-07 17:55:53',0x3131372e33362e37362e323330,'1','','0',0x3439323533);");
E_D("replace into `phome_enewslog` values('28',0x61646d696e,'2018-04-07 18:39:20',0x3131372e33362e37362e323330,'1','','0',0x3632373030);");
E_D("replace into `phome_enewslog` values('29',0x61646d696e,'2018-04-07 22:52:00',0x3131332e3133392e3139332e3330,'1','','0',0x3130313030);");
E_D("replace into `phome_enewslog` values('30',0x61646d696e,'2018-04-07 22:52:00',0x3131332e3133392e3139332e3330,'1','','0',0x3130303939);");
E_D("replace into `phome_enewslog` values('31',0x61646d696e,'2018-04-08 10:27:46',0x3131372e33362e37362e323330,'1','','0',0x3530313732);");
E_D("replace into `phome_enewslog` values('32',0x61646d696e,'2018-04-08 10:35:39',0x3131372e33362e37362e323330,'1','','0',0x3530333031);");
E_D("replace into `phome_enewslog` values('33',0x79616e677869,'2018-04-08 11:40:29',0x3131372e33362e37362e323330,'0','','0',0x3535333832);");
E_D("replace into `phome_enewslog` values('34',0x61646d696e,'2018-04-08 11:51:53',0x3131372e33362e37362e323330,'1','','0',0x3532393636);");
E_D("replace into `phome_enewslog` values('35',0x61646d696e,'2018-04-08 15:00:36',0x3131372e33362e37362e323330,'1','','0',0x3633353134);");
E_D("replace into `phome_enewslog` values('36',0x61646d696e,'2018-04-08 16:25:37',0x3131372e33362e37362e323330,'1','','0',0x3536323336);");
E_D("replace into `phome_enewslog` values('37',0x61646d696e,'2018-04-08 16:38:04',0x3131372e33362e37362e323330,'1','','0',0x3537393338);");
E_D("replace into `phome_enewslog` values('38',0x61646d696e,'2018-04-08 17:19:22',0x3131372e33362e37362e323330,'1','','0',0x3536383532);");
E_D("replace into `phome_enewslog` values('39',0x61646d696e,'2018-04-08 17:27:12',0x3131372e33362e37362e323330,'0','','0',0x3633303132);");
E_D("replace into `phome_enewslog` values('40',0x61646d696e,'2018-04-08 17:27:37',0x3131372e33362e37362e323330,'0','','0',0x3633303132);");
E_D("replace into `phome_enewslog` values('41',0x61646d696e,'2018-04-08 17:28:11',0x3131372e33362e37362e323330,'1','','0',0x3633303132);");
E_D("replace into `phome_enewslog` values('42',0x61646d696e,'2018-04-08 17:57:58',0x3131372e33362e37362e323330,'1','','0',0x3537313833);");
E_D("replace into `phome_enewslog` values('43',0x61646d696e,'2018-04-09 09:16:54',0x3131372e33362e37362e323330,'1','','0',0x3439363637);");

@include("../../inc/footer.php");
?>