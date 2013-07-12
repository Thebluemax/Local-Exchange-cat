<?
include_once("includes/inc.global.php");

$cUser->MustBeLoggedOn();
$p->site_section = PROFILE;
$p->page_title = "Desactivar ofertas y demandas en vacaciones";

include("classes/class.directory.php");
include("includes/inc.forms.php");

if($_REQUEST["mode"] == "admin") {
	$cUser->MustBeLevel(1);
	$form->addElement("hidden","mode","admin");
	$member = new cMember();
	$member->LoadMember($_REQUEST["member_id"]);
	$text = "Es importante desactivar temporalmente las ofertas y demandas mientras estás de vacaciones o no accesible, mediante esta opción.  ";
	$pronoun = "they";
} else {
	$cUser->MustBeLoggedOn();
	$member = $cUser;
	$form->addElement("hidden","mode","self");
	$text = "Es importante desactivar temporalmente las ofertas y demandas mientras estás de vacaciones o no accesible, mediante esta opción.  ";
	$pronoun = "you";
}

$text .= "Tus ofertas y demandas no aparecerán durante el tiempo que marques en el directorio. Cuando termine el plazo se reactivarán automáticamente.";
$form->addElement("static", null, $text, null);
$form->addElement("hidden","member_id", $member->member_id);
$form->addElement("static", null, null, null);
$today = getdate();
$options = array('language'=> 'ca', 'format' => 'dFY', 'minYear' => $today['year'],'maxYear' => $today['year']+5);
$form->addElement("date", "return_date", "¿Cuándo terminan las vacaciones?", $options);
$form->addElement("static", null, null, null);
$form->addElement("submit", "btnSubmit", "Desactivar");

$form->registerRule('verify_future_date','function','verify_future_date');
$form->addRule('return_date','Debe ser una fecha futura','verify_future_date');
$form->registerRule('verify_valid_date','function','verify_valid_date');
$form->addRule('return_date','La fecha no es válida','verify_valid_date');

if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
 	$form->process("process_data", false);
} else {  // Display the form
	$p->DisplayPage($form->toHtml());
}

function process_data ($values) {
	global $p, $member;
	
	$date = $values['return_date'];
	$return_date = new cDateTime($date['Y'] . '/' . $date['F'] . '/' . $date['d']);
	
	$listings = new cListingGroup(OFFER_LISTING);
	$listings->LoadListingGroup(null,"%",$member->member_id);
	$listings->InactivateAll($return_date);
	
	$listings = new cListingGroup(WANT_LISTING);
	$listings->LoadListingGroup(null,"%",$member->member_id);
	$listings->InactivateAll($return_date);
	
	$output="Ofertas y demandas desactivadas.";
	
	$p->DisplayPage($output);
}

function verify_future_date ($element_name,$element_value) {
	$today = getdate();
	$date = $element_value;
	$date_str = $date['Y'] . '/' . $date['F'] . '/' . $date['d'];

	if (strtotime($date_str) <= strtotime("now")) // date is a past date
		return false;
	else
		return true;
}

function verify_valid_date ($element_name,$element_value) {
	$date = $element_value;
	return checkdate($date['F'],$date['d'],$date['Y']);
}

?>
