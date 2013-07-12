<?

include_once("includes/inc.global.php");

$member_about = new cMember;
$member_about->LoadMember($_REQUEST["about"]);

$p->site_section = SECTION_FEEDBACK;
$p->page_title = "Introduir valoració per ". $member_about->PrimaryName();

include("classes/class.feedback.php");
include("includes/inc.forms.validation.php");

//
// Define form elements
//
$member = new cMember;

if($_REQUEST["mode"] == "admin") {
	$cUser->MustBeLevel(2);
	$member->LoadMember($_REQUEST["author"]);
	$p->page_title .= " per a ". $member->PrimaryName();
} else {
	$cUser->MustBeLoggedOn();
	$member = $cUser;
}

$form->addElement('static', null, 'Totes les valoracions són públiques. Abans d´atorgar una valoració <i>negativa</i> , recomanem dialogar directament amb l´altra persona. Sovint els desacords es poden solucionar d´aquesta manera per a benefici d´ambdues parts.', null);
$form->addElement('static', null, null, null);
$ratings = array(0=>"", POSITIVE=>"Positiva", NEUTRAL=>"Neutral", NEGATIVE=>"Negativa"); 
$form->addElement("select", "rating", "Valoració ", $ratings);
$form->addElement("hidden", "about", $member_about->member_id);
$form->addElement("hidden", "author", $_REQUEST["author"]);
$form->addElement("hidden", "mode", $_REQUEST["mode"]);
$form->addElement("hidden", "trade_id", $_REQUEST["trade_id"]);
$form->addElement('static', null, 'Comentaris', null);
$form->addElement('textarea', 'comments', null, array('cols'=>60, 'rows'=>4, 'wrap'=>'soft'));
$form->addElement('submit', 'btnSubmit', 'Enviar');

//
// Define form rules
//
$form->registerRule('verify_selection','function','verify_selection');
$form->addRule('rating', 'Tria una puntuació', 'verify_selection');

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
	global $p, $member_about, $member, $cErr;
	
	$trade = new cTrade();
	$trade->LoadTrade($_REQUEST["trade_id"]);
	
	// Decide whether member leaving feedback was buyer or seller & make sure trade members correct
	if ($trade->member_from->member_id == $member->member_id and $trade->member_to->member_id == $member_about->member_id) {
		$context = BUYER;
	} elseif ($trade->member_to->member_id == $member->member_id and $trade->member_from->member_id == $member_about->member_id) {
		$context = SELLER;
	} else {
		$cErr->Error("Aquests membres no es corresponen amb l'intercanvi realitzat."); // Theoretically, must be a hacker
		include("redirect.php");
	}
	
	$feedback = new cFeedback($member->member_id, $member_about->member_id, $context, $trade->category->id, $_REQUEST["trade_id"], $values["rating"], $values["comments"]);
	$success = $feedback->SaveFeedback();
	
	if($success) {
		if(LOG_LEVEL > 0 and $_REQUEST["mode"] == "admin") { // Log if enabled & entered by an admin
			$log_entry = new cLogEntry (FEEDBACK, FEEDBACK_BY_ADMIN, $feedback->feedback_id);
			$log_entry->SaveLogEntry();	
		}
		$output = "La teva valoració ha estat guardada.";
	} else {
		$output = "Hi ha hagut un error guardant la teva valoració. Torna-ho més tard.";
	}
	
	$p->DisplayPage($output);
}

?>
