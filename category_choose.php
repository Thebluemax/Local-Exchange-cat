<?

include_once("includes/inc.global.php");

$p->site_section = LISTINGS;
$p->page_title = "Elegir categoría";

include("includes/inc.forms.php");
include_once("classes/class.category.php");

//
// Define form elements
//
$cUser->MustBeLevel(2);

$categories = new cCategoryList;
$category_list = $categories->MakeCategoryArray();
unset($category_list[0]);

$form->addElement("select", "category", "¿Qué categoría?", $category_list);
$form->addElement("static", null, null, null);

$buttons[] = &HTML_QuickForm::createElement('submit', 'btnEdit', 'Editar');
$buttons[] = &HTML_QuickForm::createElement('submit', 'btnDelete', 'Esborrar');
$form->addGroup($buttons, null, null, '&nbsp;');

//
// Define form rules
//


//
// Then check if we are processing a submission or just displaying the form
//
if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
 	$form->process("process_data", false);
} else {
   $p->DisplayPage($form->toHtml());  // just display the form
}

function process_data ($values) {
	global $p, $cErr;
	
	if(isset($values["btnDelete"])) {
		$category = new cCategory;
		$category->LoadCategory($values["category"]);
		if($category->HasListings()) {
			$output = "Esta categoría todavía tiene elementos en ella. Debes mover esos elementos a nuevas categorías, o borrarlos, antes de borrar esta categoría. Observa que los elementos podrían estar temporalmente inactivos, o haber expirado. En ese caso no aparecen en la lista de Ofertas o de Demandas.<P>";

			$output .= "Elementos en esta categoría:<BR>";
			$listings = new cListingGroup(OFFER_LISTING);
			$listings->LoadListingGroup(null, $values["category"]);
			foreach($listings->listing as $listing)
				$output .= "OFFERED: ". $listing->description ." (". $listing->member_id .")<BR>"; 
				
			$listings = new cListingGroup(WANT_LISTING);
			$listings->LoadListingGroup(null, $values["category"]);
			foreach($listings->listing as $listing)
				$output .= "WANTED: ". $listing->description ." (". $listing->member_id .")<BR>";			
		} else {
			if($category->DeleteCategory())
				$output = "La categoría ha sido borrada.";
		}
	} else {
		header("location:http://".HTTP_BASE."/category_edit.php?category_id=". $values["category"]);
		exit;	
	}
	
	$p->DisplayPage($output);
}

//
// Form rule validation functions
//


?>
