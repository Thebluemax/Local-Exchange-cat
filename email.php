<?
include_once("includes/inc.global.php");
$p->site_section = SECTION_EMAIL;
$p->page_title = "Envia un email a algun usuari o usuària";

$cUser->MustBeLoggedOn();

include("includes/inc.forms.php");
require_once "Mail.php"; 
require_once "Mail/mime.php";
//
// First, we define the form
//

$form->addElement("hidden", "email_to", $_REQUEST["email_to"]);
$form->addElement("hidden", "member_to", $_REQUEST["member_to"]);
$member_to = new cMember;
$member_to->LoadMember($_REQUEST["member_to"]);
$form->addElement("static", null, "Para: <I>". $_REQUEST["email_to"] . " (". $member_to->member_id .")</I>");
$form->addElement("text", "subject", "Encapçalament: ", array('size' => 35, 'maxlength' => 100));
$form->addElement("select", "cc", "Vols rebre una còpia?", array("Y"=>"Si", "N"=>"No"));

/*  The following code should work, and works on my server, but not on Open Access.  Bug?
$cc[] =& HTML_QuickForm::createElement('radio',null,null,'<FONT SIZE=2>Yes</FONT>','Y');
$cc[] =& HTML_QuickForm::createElement('radio',null,null,'<FONT SIZE=2>No</FONT>','N');
$form->addGroup($cc, "cc", 'Would you like to recieve a copy?');
*/

$form->addElement("static", null, null, null);
$form->addElement("textarea", "message", "El teu missatge:", array("cols"=>65, "rows"=>10, "wrap"=>"soft"));

$form->addElement("static", null, null, null);
$form->addElement("submit", "btnSubmit", "Enviar");

//
// Define form rules
//
$form->addRule("message", "Introduïu el tu missatge", "required");

if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
 	$form->process("process_data", false);
} else {  // Display the form
	$form->setDefaults(array("cc"=>"Y"));
	$p->DisplayPage($form->toHtml());
}

//
// The form has been submitted with valid data, so process it   
//
function process_data ($values) {
	global $p, $cUser;
	
	if($values["cc"] == "Y")
		$copy = $cUser->person[0]->email;
	else 
		$copy = "";
		$aclaracion="Este mansaje te lo envia, ".$cUser->person[0]->member_id."-".$cUser->person[0]->email."<BR/>Usando el correo del banco y te dice: ";
    $text = wordwrap($aclaracion.$values["message"], 64);
    //$html = iconv('utf-8', 'windows-1252', ROTULO_MAIL.nl2br($text).AVISO_LEGAL); 
    $html = utf8_decode( ROTULO_MAIL.nl2br($text).AVISO_LEGAL);
    $crlf = "\n";
    $to = $_REQUEST["email_to"];
    $cc = $copy;
    $headers = array ('From' => $cUser->person[0]->email,
    'To' => $to,
    'CC' => $cc,
    'Subject' => SITE_SHORT_TITLE .": ". $values["subject"]);
    
    $mime = new Mail_mime($crlf);
    $mime->setTXTBody($text);
    $mime->setHTMLBody($html); 
    $body = $mime->get();
    $headers = $mime->headers($headers);
    
    $smtp = Mail::factory('mail');
    $mailed = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mailed)) 
     $output = "Hi ha hagut un problema enviant el missatge. Prova més tard.";                                                                                       
     else 
        $output = "El teu missatge s'ha enviat."; 		
	$p->DisplayPage($output);
}



?>
