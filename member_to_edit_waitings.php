<?
include_once("includes/inc.global.php");
$p->site_section = SITE_SECTION_OFFER_LIST;

$cUser->MustBeLevel(1);
include("includes/inc.forms.php");

$form->addElement("header", null, "Escoge asociado/a a editar");
$form->addElement("html", "<TR></TR>");

$ids = new cMemberGroup;
$ids->LoadMemberGroup(false,false,true);

if($ids_array = $ids->MakeIDArray()){
$form->addElement("select", "member_id", "Asociado/a", $ids_array);
$form->addElement("static", null, null, null);
$form->addElement('submit', 'btnSubmit', 'Editar');
} else {
    $form->addElement("static", null, "No hay ningún usuario pendiente de aceptar.", null);
}
if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
 	$form->process("process_data", false);
} else {  // Display the form
	$p->DisplayPage($form->toHtml());
}

function process_data ($values) {
	global $cUser;
	header("location:http://".HTTP_BASE."/member_edit_waitings.php?mode=admin&member_id=".$values["member_id"]);
	exit;	
}

?>

