<?
include_once("includes/inc.global.php");
//$cUser->MustBeLevel(1);

$p->site_section = ADMINISTRATION;
$p->page_title = "¿Elige miembro (pagador/cobrador) y la opción deseada";

include("includes/inc.forms.php");
require_once "pear/HTML/QuickForm/radio.php";

//$form->addElement("header", null, "For which member?");
//$form->addElement("html", "<TR></TR>");
//$form->addElement("hidden", "action", $_REQUEST["action"]);
$form->addElement("hidden", "action", "trade_n");

if(isset($_REQUEST["get1"])) {
	$form->addElement("hidden", "get1", $_REQUEST["get1"]);
	$form->addElement("hidden", "get1val", $_REQUEST["get1val"]);
}

$ids = new cMemberGroup;
		
if(isset($_REQUEST["inactive"]))
	$ids->LoadMemberGroup(false, true);
else
	$ids->LoadMemberGroup();
	
$form->addElement("select", "member_id", "Miembro", $ids->MakeIDArray());
$form->addElement("static", null, null, null);

$radioP = new HTML_QuickForm_radio('tipusopc', null, 'Cobrar de este usuario', 'C',array('checked' => null));
$radioC = new HTML_QuickForm_radio('tipusopc', null, 'Pagar a este usuario', 'P');
$form->addElement($radioP);
$form->addElement($radioC);

$form->addElement('submit', 'btnSubmit', 'Enviar');

if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
 	$form->process("process_data", false);
} else {  // Display the form
	$p->DisplayPage($form->toHtml());
}

function process_data ($values) {
	global $cUser;
	
	if(isset($_REQUEST["get1"]))
		$get_string = "&". $_REQUEST["get1"] ."=". $_REQUEST["get1val"];
	else
		$get_string = "";
		
	header("location:http://".HTTP_BASE."/". $_REQUEST["action"] .".php?mode=admin&member_id=".$values["member_id"] . $get_string."&tipusopc=".$values["tipusopc"]);
	exit;	
}

?>
