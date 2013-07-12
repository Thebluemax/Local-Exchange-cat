<?
include_once("includes/inc.global.php");
$p->site_section = SITE_SECTION_OFFER_LIST;

include("includes/inc.forms.php");
require_once "Mail.php";
require_once "Mail/mime.php";

$form->addElement("header", null, "Restablir contrasenya");
$form->addElement("html", "<TR></TR>");

$form->addElement("text", "member_id", "Introdueix el teu identificador d'associat");
$form->addElement("text", "email", "Introdueix el email del teu compte");

$form->addElement("static", null, null, null);
$form->addElement("submit", "btnSubmit", "Restablir contrasenya");

$form->registerRule('verify_email','function','verify_email');
$form->addRule('email','L´adreça de correu o l´identificador de membre no és correcte','verify_email');
$form->addElement("static", null, null, null);
$form->addElement("static", 'contact', "Si no recordes el teu identificador d'associat o el teu correu electrònic, <A HREF=contact.php>contacta</A> amb nosaltres.", null);

if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
 	$form->process("process_data", false);
} else {  // Display the form
	$p->DisplayPage($form->toHtml());
}

function process_data ($values) {
	global $p;
	
	$member = new cMember;
	$member->LoadMember($values["member_id"]);

	$password = $member->GeneratePassword();
	$member->ChangePassword($password); // This will bomb out if the password change fails
	$member->UnlockAccount();
	
	$list = "La teva contrasenya ha estat restablerta. Pots canviar la teva nova contrasenya després que entris al sistema, anant a la secció Perfil.<P>";
	
            $text = PASSWORD_RESET_MESSAGE . "\n\nNueva contraseña: ". $password;
            // ATENCION, con la función iconv() de ph, en nuevos servers es mortal.
            //$html = iconv('utf-8', 'windows-1252', ROTULO_MAIL.nl2br($text).AVISO_LEGAL); 
            $html=ROTULO_MAIL.nl2br($text).AVISO_LEGAL;
            $to = $values['email'];
           /* $crlf = "\n";
            $headers = array ('From' => EMAIL_FROM,
            'To' => $to,
            'Subject' => PASSWORD_RESET_SUBJECT);
            $mime = new Mail_mime($crlf);
            $mime->setTXTBody($text);
            $mime->setHTMLBody($html);
            $body = $mime->get();
            $headers = $mime->headers($headers);*/
            
          //  $smtp = Mail::factory('mail');
          //  $mailed = $smtp->send($to, EMAIL_FROM.$to.PASSWORD_RESET_SUBJECT, $body);
            //Este progama es obsoleto para ciertas funciones pear y empeora con el tiempo.
            //   if (PEAR::isError($mailed)) { -retirado feb -2012- y buscar para todos mail individuales.
          //Modificado por @mxml13, para solucionar los problemas de pear.
             $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
             $headers .= "From: noreplyt@bancsdeltempsdesalt.org \r\n";
$headers .= "Reply-To: ".$to. "\r\n";

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
             $mailed=mail($to,NEW_MEMBER_SUBJECT, $html,$headers);

          // if (PEAR::isError($mailed)) {
            if (!$mailed) {
           
               $list  .= "<I>No obstant això, no s'ha pogut enviar la nova contrasenya al teu email. És possible que es degui a un problema tècnic. Contacta amb la persona encarregada del sistema  ". PHONE_ADMIN ."</I>.";                                                                                                      
               } else {
               $list .= "S'ha enviat la nova contrasenya al teu correu electrònic.";                                                                                                 
                  } 
    
	$p->DisplayPage($list);
}

function verify_email($element_name,$element_value) {
	global $form;
	$member = new cMember;

	if(!$member->VerifyMemberExists($form->getElementValue("member_id")))
		return false;  // Don't want to try to load member if member_id invalid, 
							// because of inappropriate error message.
		
	$member->LoadMember($form->getElementValue("member_id"));

	if($element_value == $member->person[0]->email)
		return true;
	else
		return false;
}

?>
