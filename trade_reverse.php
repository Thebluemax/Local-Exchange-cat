<?

include_once("includes/inc.global.php");

$cUser->MustBeLevel(2);
$p->site_section = EXCHANGES;
$p->page_title = "Deshacer un intercambio";

include("classes/class.trade.php");
include("includes/inc.forms.php");

//
// Define form elements
//
$trades = new cTradeGroup;
$trades->LoadTradeGroup();

 if($trades_array = $trades->MakeTradeArray()){
$form->addElement("select", "trade_id", "Escoge el intercambio a deshacer", $trades_array);
$form->addElement("html", "<TR></TR>");
$form->addElement('static', null, 'Escribe una breve (máx. 255 caracteres) explicación. La información sobre el intercambio original será introducida automáticamente. ', null);
$form->addElement('textarea', 'description', null, array('cols'=>50, 'rows'=>2, 'wrap'=>'soft', 'maxlength' => 75));
$form->addElement('submit', 'btnSubmit', 'Deshacer');
} else {
    $form->addElement("static", null, "No se ha realizado ningún intercambio", null);
}


//
// Define form rules
//
//$form->addRule('description', 'Enter a description', 'required');


//
// Then check if we are processing a submission or just displaying the form
//
if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
 	$form->process('process_data', false);
} else {
   $p->DisplayPage($form->toHtml());  // just display the form
}

function process_data ($values) {
	global $p, $cErr;

	$old_trade = new cTrade;
	$old_trade->LoadTrade($values["trade_id"]);
	$success = $old_trade->ReverseTrade($values["description"]);	
	
	if($success)
		$list = "El intercambio se ha deshecho correctamente.";
	else
		$list = "<i>Ha habido un error deshaciendo el intercambio, prueba más tarde<i>";
	
   $p->DisplayPage($list);
}




?>
