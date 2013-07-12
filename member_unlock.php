<?
include_once("includes/inc.global.php");
require_once "Mail.php";
require_once "Mail/mime.php"; 

$cUser->MustBeLevel(1);
$p->site_section = ADMINISTRATION;
$p->page_title = "Desbloquear cuenta y restablecer contraseña";

include("includes/inc.forms.php");

$form->addElement("static", 'contact', "Con este formulario puedes desbloquear una cuenta (si está bloqueada) y restablecer la contraseña de un usuario. La nueva contraseña se enviará por e-mail al usuario. Asegúrate de que la dirección de correo del usuario sigue siendo válida.", null);
$form->addElement("static", null, null);
$ids = new cMemberGroup;
$ids->LoadMemberGroup();
$form->addElement("select", "member_id", "Selecciona la cuenta de usuario", $ids->MakeIDArray());

$form->addElement("static", null, null, null);
$form->addElement("submit", "btnSubmit", "Desbloquear y restablecer contraseña");


if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
     $form->process("process_data", false);
} else {  // Display the form
    $p->DisplayPage($form->toHtml());
}

function process_data ($values) {
    global $p;
    
    $list = "";
    $member = new cMember;
    $member->LoadMember($values["member_id"]);
    
    if($consecutive_failures = $member->UnlockAccount()) {
        $list .= "La cuenta de usuario había sido bloqueada después de ". $consecutive_failures ." intentos de acceso fallidos.  La cuenta ha sido desbloqueada.  Si el número de intentos es más de 10 o 20, puedes contactar con el administrador en ". PHONE_ADMIN ."</I>, porque alguien puede estar intentando entrar con tu cuenta.<P>";
    }


    $password = $member->GeneratePassword();
    $member->ChangePassword($password); // This will bomb out if the password change fails
    
    
    
    $list .= "La contraseña ha sido restablecida.<P>";
    
    if($member->person[0]->email !="")
    {
    $text = PASSWORD_RESET_MESSAGE . "\n\nIdentificador de cuenta: ". $member->member_id ."\nNueva contraseña: ". $password;
    //$html = iconv('utf-8', 'windows-1252', ROTULO_MAIL.nl2br($text).AVISO_LEGAL); 
    $html=ROTULO_MAIL.nl2br($text).AVISO_LEGAL;
    $to = $member->person[0]->email;
   /* $crlf = "\n";
    $headers = array ('From' => EMAIL_FROM,
   'To' => $to,
    'Subject' => PASSWORD_RESET_SUBJECT);
            $mime = new Mail_mime($crlf);
            $mime->setTXTBody($text);
            $mime->setHTMLBody($html); 
            $body = $mime->get();
           // $headers = $mime->headers($headers);*/

            // reparación de los problemas de mail con pear.
 $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= "From: noreplyt@bancsdeltempsdesalt.org \r\n";
$headers .= "Reply-To: ".$to. "\r\n";
             $mailed=mail($to,"Banc del temps de Salt- Nou Password ", $html,$headers);
   /*  $smtp = Mail::factory('mail');
     $mailed = $smtp->send($to, $headers, $body);
     if (PEAR::isError($mailed)) {*/
      if(!$mailed){
               $list .= ". <I>Sin embargo, ha fallado el envío del correo con la nueva contraseña.  Esto probablemente se deba a un problema técnico.  Contacta con el adminstrador en ". PHONE_ADMIN ."</I>.";                                                               
               } else {
               $list .= " y enviada a la dirección de correo del usuario (". $member->person[0]->email .").";                                                            
                  } 
    }
    else{
    $list .= "Sin embargo, el usuario no ha suministrado ninguna dirección de correo. <b>Tendrá que ser informado por otro medio</b> de que sus datos de acceso son los siguientes:<p>";
    $list .= "Identificador de cuenta: <b>" . $member->member_id ."</b><br>Nueva contraseña: <b>". $password ."</b>"; 
    }
    $p->DisplayPage($list);
}

?>

     