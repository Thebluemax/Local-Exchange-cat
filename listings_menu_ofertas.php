<?
include_once("includes/inc.global.php");
$p->site_section = LISTINGS;
$p->page_title = "Les meves Ofertes";

$cUser->MustBeLoggedOn();
  
$cUser->LimitesPasados("Oferta");
// $list = "<STRONG>Ofertas</STRONG><P>";
$list .= "<A HREF=listing_create.php?type=Offer&mode=self><FONT SIZE=2>Crear ofertes</FONT></A><BR>";
$list .= "<A HREF=listing_to_edit.php?type=Offer&mode=self><FONT SIZE=2>Editar ofertes</FONT></A><BR>";
$list .= "<A HREF=listing_delete.php?type=Offer&mode=self><FONT SIZE=2>Esborrar ofertes</FONT></A><P>";

$p->DisplayPage($list);

?>
