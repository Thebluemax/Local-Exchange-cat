<?
include_once("includes/inc.global.php");
$p->site_section = ADMINISTRATION;
$p->page_title = "Menú de Administración";

$cUser->MustBeLevel(1);

$list = "<STRONG>Cuentas</STRONG><P>";
$list .= "<A HREF=member_create.php><FONT SIZE=3>Crear un nuevo usuario o usuaria</FONT></A><BR>";
$list .= "<A HREF=member_to_edit.php><FONT SIZE=3>Editar un usuario o usuaria</FONT></A><BR>";
$list .= "<A HREF=member_to_edit_waitings.php><FONT SIZE=3>Ver usuarios o usuarias pendientes de aceptar</FONT></A><BR>";
if ($cUser->member_role > 1) {
    $list .= "<A HREF=member_choose.php?action=member_status_change&inactive=Y><FONT SIZE=3>Desactivar / Reactivar a un usuario o usuaria</FONT></A><BR>";
}
//$list .= "<A HREF=member_contact_create.php?mode=admin><FONT SIZE=3>Adjuntar una persona a un usuario o usuaria</FONT></A><BR>";
//$list .= "<A HREF=member_contact_to_edit.php><FONT SIZE=3>Editar/Borrar un compañero/a de un/a usuario/a</FONT></A><BR>";
$list .= "<A HREF=member_unlock.php><FONT SIZE=3>Desbloquear una Cuenta y resetear la contraseña</FONT></A><P>";

if ($cUser->member_role > 1) {
    $list .= "<STRONG>Intercambios</STRONG><P>";
    $list .= "<A HREF=member_choose.php?action=trade><FONT SIZE=3>Crear un intercambio</FONT></A><BR>";
    $list .= "<A HREF=trade_reverse.php><FONT SIZE=3>Deshacer un intercambio hecho por error</FONT></A><BR>";
    $list .= "<A HREF=member_choose.php?action=feedback_choose><FONT SIZE=3>Grabar la Valoración de un usuario o usuaria</FONT></A><P>";
}

$list .= "<STRONG>Ofertas</STRONG><P>";
$list .= "<A HREF=member_choose.php?action=listing_to_edit&get1=type&get1val=Offer><FONT SIZE=3>Editar una oferta</FONT></A><BR>";
$list .= "<A HREF=member_choose.php?action=listing_delete&get1=type&get1val=Offer><FONT SIZE=3>Borrar una oferta</FONT></A><P>";

$list .= "<STRONG>Demandas</STRONG><P>";
$list .= "<A HREF=member_choose.php?action=listing_to_edit&get1=type&get1val=Want><FONT SIZE=3>Editar una demanda</FONT></A><BR>";
$list .= "<A HREF=member_choose.php?action=listing_delete&get1=type&get1val=Want><FONT SIZE=3>Borrar una demanda</FONT></A><P>";

$list .= "<STRONG>Varios</STRONG><P>";
$list .= "<A HREF=member_choose.php?action=holiday><FONT SIZE=3>Un usuario o usuaria se va de vacaciones</FONT></A>";
if ($cUser->member_role > 1) {
    $list .= "<BR><A HREF=category_create.php><FONT SIZE=3>Crear una nueva categoría</FONT></A><BR>";
    $list .= "<A HREF=category_choose.php><FONT SIZE=3>Editar / Borrar una categoría</FONT></A>";
}
$list .= "<P>";


$list .= "<STRONG>Sistema</STRONG><P>";
if ($cUser->member_role > 1) {
    $list .= "<A HREF=export.php><FONT SIZE=3>Exportar / Hacer un backup de datos en hoja de cálculo</FONT></A><BR>";
    $list .= "<A HREF=contact_all.php><FONT SIZE=3>Enviar un email a todas las personas usuarias</FONT></A><BR>";
}
$list .= "<A HREF=report_no_login.php><FONT SIZE=3>Ver quiénes no han entrado nunca</FONT></A><P>";

$list .= "<STRONG>Noticias y Eventos</STRONG><P>";
$list .= "<A HREF=news_create.php><FONT SIZE=3>Crear una noticia</FONT></A><BR>";
$list .= "<A HREF=news_to_edit.php><FONT SIZE=3>Editar una noticia</FONT></A><P>";
//$list .= "<A HREF=newsletter_upload.php><FONT SIZE=3>Subir una publicación</FONT></A><BR>";
//$list .= "<A HREF=newsletter_delete.php><FONT SIZE=3>Borrar periódico</FONT></A><BR>";

$list .= "<STRONG>Inventos Girona</STRONG><P>";
$list .= "<A HREF=listados.php><FONT SIZE=3>Listados varios</FONT></A><BR>";
$list .= "<A HREF=reportusuario.php><FONT SIZE=3>Email-Informe a socios de sus actividades realizadas</FONT></A><BR>";
$list .= "<A HREF=member_choose_n.php><FONT SIZE=3>Cobros de talleres 1 a varios a la vez</FONT></A><BR>";
$list .= "<A HREF=trade_admin.php><FONT SIZE=3>Editar intercambios</FONT></A><BR>";

$p->DisplayPage($list);



?>
