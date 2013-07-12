<?
include_once("includes/inc.global.php");
$p->site_section = ADMINISTRATION;
$p->page_title = "Menú de Listados";

$cUser->MustBeLevel(1);

$list = "<STRONG>Cuentas</STRONG><P>";
$list .= "<A HREF=listado1.php><FONT SIZE=3>Emails de socios (no eliminados) activos</FONT></A><BR>";
$list .= "<A HREF=listado11.php><FONT SIZE=3>Tfnos 2 apellidos de socios (no eliminados) </FONT></A><BR>";
$list .= "<A HREF=listado2.php><FONT SIZE=3>socios pendientes de firmar emails</FONT></A><BR>";
$list .= "<A HREF=listado3.php><FONT SIZE=3>socios pendientes de firmar tfnos</FONT></A><BR>";
$list .= "<A HREF=listado4.php><FONT SIZE=3>socios pendientes de firmar tfnos 2 apellidos</FONT></A><BR>";
$list .= "<A HREF=report_no_firma.php><FONT SIZE=3>socios pendientes de firmar tabla(no funciona todavia)</FONT></A><BR>";

$p->DisplayPage($list);



?>
