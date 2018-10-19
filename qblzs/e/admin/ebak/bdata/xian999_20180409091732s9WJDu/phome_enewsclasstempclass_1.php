<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewsclasstempclass`;");
E_C("CREATE TABLE `phome_enewsclasstempclass` (
  `classid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `classname` char(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
E_D("replace into `phome_enewsclasstempclass` values('1',0xe794b5e88491e7abaf);");
E_D("replace into `phome_enewsclasstempclass` values('2',0xe6898be69cbae7abaf);");

@include("../../inc/footer.php");
?>