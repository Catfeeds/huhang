<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewsfeedbackf`;");
E_C("CREATE TABLE `phome_enewsfeedbackf` (
  `fid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `f` varchar(30) NOT NULL DEFAULT '',
  `fname` varchar(30) NOT NULL DEFAULT '',
  `fform` varchar(20) NOT NULL DEFAULT '',
  `fzs` varchar(255) NOT NULL DEFAULT '',
  `myorder` smallint(6) NOT NULL DEFAULT '0',
  `ftype` varchar(30) NOT NULL DEFAULT '',
  `flen` varchar(20) NOT NULL DEFAULT '',
  `fformsize` varchar(12) NOT NULL DEFAULT '',
  `fvalue` text NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8");
E_D("replace into `phome_enewsfeedbackf` values('1',0x7469746c65,0xe9a284e7baa6e9a1b5e99da2,0x74657874,'','1',0x56415243484152,0x313230,'','');");
E_D("replace into `phome_enewsfeedbackf` values('2',0x73617974657874,0xe585b6e4bb96e99c80e6b182,0x7465787461726561,'','14',0x54455854,'','','');");
E_D("replace into `phome_enewsfeedbackf` values('3',0x6e616d65,0xe5aea2e688b7e5a793e5908d,0x74657874,'','4',0x56415243484152,0x3330,'','');");
E_D("replace into `phome_enewsfeedbackf` values('12',0x7765697368656e676a69616e,0xe58dabe7949fe997b4e695b0e9878f,0x74657874,'','10',0x56415243484152,0x323535,'','');");
E_D("replace into `phome_enewsfeedbackf` values('5',0x6d7963616c6c,0xe6898be69cbae58fb7e7a081,0x74657874,'','5',0x56415243484152,0x3630,'','');");
E_D("replace into `phome_enewsfeedbackf` values('11',0x6b6574696e67,0xe5aea2e58e85e695b0e9878f,0x74657874,'','11',0x56415243484152,0x323535,'','');");
E_D("replace into `phome_enewsfeedbackf` values('10',0x776f736869,0xe58da7e5aea4e695b0e9878f,0x74657874,'','12',0x56415243484152,0x323535,'','');");
E_D("replace into `phome_enewsfeedbackf` values('13',0x79616e67746169,0xe998b3e58fb0e695b0e9878f,0x74657874,'','9',0x56415243484152,0x323535,'','');");
E_D("replace into `phome_enewsfeedbackf` values('14',0x66656e676765,0xe8a385e4bfaee9a38ee6a0bc,0x74657874,'','8',0x56415243484152,0x323535,'','');");
E_D("replace into `phome_enewsfeedbackf` values('15',0x64616e676369,0xe8a385e4bfaee6a1a3e6aca1,0x74657874,'','7',0x56415243484152,0x323535,'','');");
E_D("replace into `phome_enewsfeedbackf` values('16',0x7869616f7175,0xe5b08fe58cbae5908de7a7b0,0x74657874,'','0',0x56415243484152,0x323535,'','');");
E_D("replace into `phome_enewsfeedbackf` values('17',0x6c656978696e67,0xe688bfe5b18be7b1bbe59e8b,0x74657874,'','13',0x56415243484152,0x323535,'','');");
E_D("replace into `phome_enewsfeedbackf` values('18',0x636875616e677969,0xe68ea8e5b9bfe5889be6848f,0x74657874,'','3',0x56415243484152,0x323535,'','');");
E_D("replace into `phome_enewsfeedbackf` values('19',0x6c61697975616e,0xe68ea8e5b9bfe69da5e6ba90,0x74657874,'','2',0x56415243484152,0x323535,'','');");
E_D("replace into `phome_enewsfeedbackf` values('20',0x6d69616e6a69,0xe5bbbae7ad91e99da2e7a7af,0x74657874,'','6',0x56415243484152,0x323535,'','');");

@include("../../inc/footer.php");
?>