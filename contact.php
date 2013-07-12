<?
include_once("includes/inc.global.php");
$p->site_section = SECTION_EMAIL;
$p->page_title = "Contactar";

include("includes/inc.forms.php");
require_once "Mail.php";  
require_once "Mail/mime.php"; 

//
// First, we define the form
//
$form->addElement("static", null, "Per participar del Banc de Temps o demanar qualsevol informació, omple el següent qüestionari, i contestarem en breu. Els requadres amb asterisc són obligatoris ", null);
$form->addElement("static", null, null, null);
$form->addElement("text", "name", "Nom ");
$form->addElement("text", "email", "Email   ");
$form->addElement("text", "phone", "Telèfon ");
$form->addElement("static", null, null, null);
$form->addElement("textarea", "message", "Missatge: ", array("cols"=>50, "rows"=>10, "wrap"=>"soft"));
$form->addElement("static", null, null, null);
$heard_from = array ("0"=>"(Seleccionar uno)", "1"=>"Buscant a internet", "2"=>"Per un amic/a", "3"=>"Per la AAVV", "4"=>"Otros");
$form->addElement("select", "how_heard", "Com ens has conegut?", $heard_from);

$form->addElement("static", null, null, null);
$form->addElement("submit", "btnSubmit", "Enviar");

//
// Define form rules
//
$form->addRule("name", "Introdueix el teu nom", "required");
$form->addRule("email", "Introdueix el teu email", "required");
//$form->addRule("phone", "Enter your phone number", "required");

$form->registerRule('verify_valid_email','function', 'verify_valid_email');
$form->addRule('email', 'Email no válido', 'verify_valid_email');
$form->registerRule('verify_phone_format','function','verify_phone_format');
$form->addRule('phone', 'El número de teléfono no es válido', 'verify_phone_format');




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
    
    $text = "De: ". $values["name"]. "\n". "Teléfono: ". $values["phone"] ."\n". "Conocido en: ". $heard_from[$values["how_heard"]] ."\n\n". wordwrap($values["message"], 64);
    $crlf = "\n"; 
    $to = EMAIL_ADMIN;
    $headers = array ('From' => $values["email"],
    'To' => $to,
    'Subject' => SITE_SHORT_TITLE ." Formulari de contacto");
    
   // $mime = new Mail_mime($crlf);
  //  $mime->setTXTBody($text);
    $body = $mime->get();
  //  $headers = $mime->headers($headers);
     $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
             $headers .= "From: noreplyt@tubanc.org \r\n";
$headers .= "Reply-To: ".$to. "\r\n";
   // $smtp = Mail::factory('mail');
  //  $mailed = $smtp->send($to, $headers, $body);
  $mailed=mail($to,$values["email"], $text,$headers);
   // if (PEAR::isError($mailed)) {
   if (!$mailed) {
        $output = "Hi ha hagut un problema enviant el teu email. Prem 'Enrere' en el teu navegador i comprova que has escrit l'adreça de correu electrònic correctament.";                                                         
    } else {
        $output = "Gràcies, s'ha enviat el teu correu."; 
    } 
    $p->DisplayPage($output); 
    
    
}
function verify_valid_email ($element_name,$element_value) {
    if ($element_value=="")
        return true;        // Currently not planning to require this field
    if (strstr($element_value,"@") and strstr($element_value,"."))
        return true;    
    else
        return false;
    
}

function verify_phone_format ($element_name,$element_value) {
    $phone = new cPhone($element_value);
    
    if(substr($phone->area,0,1)== "9" or substr($phone->area,0,1)== "8" or substr($phone->area,0,1)=="6") 
        return true;
    else
        return false;
}
    
           

?>
