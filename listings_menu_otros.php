<?
include_once("includes/inc.global.php");
$p->site_section = LISTINGS;
$p->page_title = "Altres";

$cUser->MustBeLoggedOn();

// $list .= "<STRONG>Otros</STRONG><P>";
$list .= "<A HREF=holiday.php?mode=self><FONT SIZE=2>Desactivar el meu compte per vacances</FONT></A><BR>";

$p->DisplayPage($list);

?>
