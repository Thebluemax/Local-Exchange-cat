<?
include_once("includes/inc.global.php");
$p->site_section = SECTION_EMAIL;
$p->page_title = "Email a todo el colectivo";

$cUser->MustBeLevel(2);

include("includes/inc.forms.php");
require_once "Mail.php"; 
require_once "Mail/mime.php";  
//
// First, we define the form
//
$form->addElement("static", null, "Este email se enviará a <i>TODAS</i> las personas usuarias de ".SITE_LONG_TITLE.". ESTE PROCESO PUEDE DEMORARSE VARIOS MINUTOS, POR LO QUE NO DEBES CANCELAR EL PROCESO HASTA QUE FINALICE.", null);
$form->addElement("static", null, null, null);
$form->addElement("text", "subject", "Encabezamiento", array("size" => 30, "maxlength" => 50));
$form->addElement("static", null, null, null);
$form->addElement("textarea", "message", "Tu mensaje", array("cols"=>65, "rows"=>10, "wrap"=>"soft"));
$form->addElement("static", null, null, null);

$form->addElement("static", null, null, null);
$form->addElement("submit", "btnSubmit", "Enviar");

//
// Define form rules
//
$form->addRule("subject", "Introdiu un asunpte", "required");
$form->addRule("message", "Introdiu el teu mensatje", "required");

if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
 	$form->process("process_data", false);
} else {  // Display the form
	$p->DisplayPage($form->toHtml());
}

//
// The form has been submitted with valid data, so process it   
//
function process_data ($values) {
	global $p, $heard_from;
	
	$output = "";
	$errors = "";
	$all_members = new cMemberGroup;
	$all_members->LoadMemberGroup();
    set_time_limit(0);	
    ignore_user_abort();
	foreach($all_members->members as $member) {
		if($errors != "")
			$errors .= ", ";
		
		if($member->person[0]->email != "")
        {
	    $text = wordwrap($values["message"], 64);
        //  $html = iconv('utf-8', 'windows-1252', ROTULO_MAIL.nl2br($text).AVISO_LEGAL);
        $html =  utf8_decode( ROTULO_MAIL.nl2br($text).AVISO_LEGAL);
        $to = $member->person[0]->email;
        
        $headers = array ('From' => EMAIL_ADMIN,
        'To' => $to,
        'Subject' => $values["subject"]);
        $mime = new Mail_mime($crlf);
        $mime->setTXTBody($text);
        $mime->setHTMLBody($html);  
        $body = $mime->get();
        $headers = $mime->headers($headers);
    
        $smtp = Mail::factory('mail');
        $mailed = $smtp->send($to, $headers, $body);
        }
		else
		$mailed = true;
		
		if (PEAR::isError($mailed))
			$errors .= $member->person[0]->email;
    }    
	    if($errors == "")
		    $output .= "El mensaje ha sido enviado a todos los usuarios.";
	    else
		    $output .= "Ha habido un error enviando el mensaje a estas direcciones:<BR>". $errors;	
		
	    $p->DisplayPage($output);
}
   

?>
