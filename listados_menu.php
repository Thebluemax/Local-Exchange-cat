<?
include_once("includes/inc.global.php");
$p->site_section = ADMINISTRATION;
$p->page_title = "Menú de Listados";

$cUser->MustBeLevel(1);

$list = "<STRONG>Cuentas</STRONG><P>";
$list .= "<A HREF=listado1.php><FONT SIZE=3>Emails de socios activos</FONT></A><BR>";
$list .= "<A HREF=listado2.php><FONT SIZE=3>Emails de socios pendientes de firmar</FONT></A><BR>";
$list .= "<A HREF=listado3.php><FONT SIZE=3>socios pendientes de firmar</FONT></A><BR>";


$p->DisplayPage($list);



?>
