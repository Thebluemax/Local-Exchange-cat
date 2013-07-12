<?

include_once("includes/inc.global.php");

$p->site_section = LISTINGS;
$p->page_title = "Editar categoría";

include("includes/inc.forms.php");
include_once("classes/class.category.php");

//
// Define form elements
//
$cUser->MustBeLevel(2);

$category = new cCategory();
$category->LoadCategory($_REQUEST["category_id"]);

$form->addElement("hidden", "category_id", $_REQUEST["category_id"]);
$form->addElement("text", "category", "Descripción de la categoría", array("size" => 30, "maxlength" => 30));
$form->addElement("static", null, null, null);

$form->addElement('submit', 'btnSubmit', 'Enviar');

//
// Define form rules
//
$form->addRule('category', 'La descripción no puede estar en blanco', 'required');

//
// Then check if we are processing a submission or just displaying the form
//
if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
 	$form->process("process_data", false);
} else {
	$form->setDefaults(array("category"=>$category->description));
   $p->DisplayPage($form->toHtml());  // just display the form
}

function process_data ($values) {
	global $p, $cErr, $category;
	
	$category->description = $values["category"];
	if ($category->SaveCategory()) {
		$output = "La categoría ha sido actualizada.";
	} else {
		$output = "No se han podido guardar los cambios. Por favor inténtelo más tarde.";
	}
	
	$p->DisplayPage($output);
}

//
// Form rule validation functions
//


?>
