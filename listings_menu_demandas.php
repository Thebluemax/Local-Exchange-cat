<?
include_once("includes/inc.global.php");
$p->site_section = LISTINGS;
$p->page_title = "Les meves demandes";

$cUser->MustBeLoggedOn();
$cUser->LimitesPasados("Demanda");

// $list .= "<STRONG>Demandas</STRONG><P>";
$list .= "<A HREF=listing_create.php?type=Want&mode=self><FONT SIZE=2>Crear demandes</FONT></A><BR>";
$list .= "<A HREF=listing_to_edit.php?type=Want&mode=self><FONT SIZE=2>Editar demandes</FONT></A><BR>";
$list .= "<A HREF=listing_delete.php?type=Want&mode=self><FONT SIZE=2>Esborrar demandes</FONT></A><P>";

$p->DisplayPage($list);

?>
