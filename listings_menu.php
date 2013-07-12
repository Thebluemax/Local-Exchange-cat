<?
include_once("includes/inc.global.php");
$p->site_section = LISTINGS;
$p->page_title = "Afegir ofertes i demandes";

$cUser->MustBeLoggedOn();

$list = "<STRONG>Ofertes</STRONG><P>";
$list .= "<A HREF=listing_create.php?type=Offer&mode=self><FONT SIZE=2>Crear ofertes</FONT></A><BR>";
$list .= "<A HREF=listing_to_edit.php?type=Offer&mode=self><FONT SIZE=2>Editar ofertes</FONT></A><BR>";
$list .= "<A HREF=listing_delete.php?type=Offer&mode=self><FONT SIZE=2>Esborrar ofertes</FONT></A><P>";

$list .= "<STRONG>Demandes</STRONG><P>";
$list .= "<A HREF=listing_create.php?type=Want&mode=self><FONT SIZE=2>Crear demandes</FONT></A><BR>";
$list .= "<A HREF=listing_to_edit.php?type=Want&mode=self><FONT SIZE=2>Editar demandes</FONT></A><BR>";
$list .= "<A HREF=listing_delete.php?type=Want&mode=self><FONT SIZE=2>Esborrar demandes</FONT></A><P>";

$list .= "<STRONG>Altres</STRONG><P>";
$list .= "<A HREF=holiday.php?mode=self><FONT SIZE=2>Vacances</FONT></A><BR>";

$p->DisplayPage($list);

?>
