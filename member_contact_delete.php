<?
include_once("includes/inc.global.php");

//
//  Todos los archivos que empiezan por 'member contact' están referidos 
//  a los 'acompañantes', figura que no estamos utilizando en esta versión
//  del programa. 
//  Por tanto, estos formularios NO ESTÁN ACTUALIZADOS
//

$p->site_section = PROFILE;
$p->page_title = "Borrar asociado/a acompañante";

include("includes/inc.forms.php");

if($_REQUEST["mode"] == "admin") {
	$cUser->MustBeLevel(1);
	$form->addElement("hidden","mode","admin");
} else {
	$cUser->MustBeLoggedOn();
	$form->addElement("hidden","mode","self");
}

$person = new cPerson;
$person->LoadPerson($_REQUEST["person_id"]);

$form->addElement("hidden", "person_id", $_REQUEST["person_id"]);
$form->addElement("static", null, "¿Estás seguro de borrar a ". $person->Name() ." permanentemente?", null);
$form->addElement("static",null,null);
$form->addElement('submit', 'btnSubmit', 'Borrar');

if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
 	$form->process("process_data", false);
} else {  // Display the form
	$p->DisplayPage($form->toHtml());
}

function process_data ($values) {
	global $p, $person;
	
	if($person->DeletePerson())
		$output = "Asociado/a acompañante borrada.";
	else
		$output = "Hubo un error borrando a esta persona.";
		
	$p->DisplayPage($output);
}

?>
