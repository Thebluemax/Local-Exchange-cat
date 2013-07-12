<?
include_once("includes/inc.global.php");
$p->site_section = SITE_SECTION_OFFER_LIST;

$output = "Per poder accedir a aquesta secció, has de tenir un compte amb el teu nom i contrasenya. <br><br>Si ja la tens, accedeix aquí mateix:<BR><BR><CENTER><DIV STYLE='width=60%; padding: 5px;'><FORM ACTION=login.php METHOD=POST><INPUT TYPE=HIDDEN NAME=action VALUE=login><INPUT TYPE=HIDDEN NAME=location VALUE='".$_SESSION["REQUEST_URI"]."'><TABLE class=NoBorder><TR><TD ALIGN=RIGHT>ID Miembro:</TD><TD ALIGN=LEFT><INPUT TYPE=TEXT SIZE=12 NAME=user></TD></TR><TR><TD ALIGN=RIGHT>Contrasenya:</TD><TD ALIGN=LEFT><INPUT TYPE=PASSWORD SIZE=12 NAME=pass></TD></TR></TABLE><DIV align='right'><INPUT TYPE=SUBMIT VALUE='Login'></DIV></FORM></DIV></CENTER><BR>Si no tens un compte, <A HREF=member_self.php>apunta't</A> al Banc del Temps.<BR>";

$p->DisplayPage($output);
// NOTA: Cambiado el inicio del form:  <FORM ACTION=".SERVER_PATH_URL."
?>
