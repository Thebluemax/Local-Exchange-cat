<?

include_once("includes/inc.global.php");

$cUser->MustBeLevel(1);
$p->site_section = SITE_SECTION_OFFER_LIST;

include("includes/inc.forms.php");
require_once "Mail.php";
require_once "Mail/mime.php";  
//
// First, we define the form
//
$form->addElement("header", null, "Crear nou soci");
$form->addElement("html", "<TR></TR>");


$form->addElement("text", "member_id", "ID soci", array("size" => 10, "maxlength" => 15));
$form->addElement("text", "password", "Contrasenya", array("size" => 10, "maxlength" => 15));

$form->addElement("select", "member_role", "Rol", array("0"=>"Soci", "1"=>"Administrador nivel 1", "2"=>"Administrador nivel 2"));
// $acct_types = array("S"=>"Normal", "J"=>"Acompañante", "H"=>"Hogar", "O"=>"Organización", "B"=>"Negocios", "F"=>"Asociación");
// $form->addElement("select", "account_type", "Tipo de cuenta", $acct_types);
$form->addElement("static", null, "Notes de l'administrador", null);
$form->addElement("textarea", "admin_note", null, array("cols"=>45, "rows"=>2, "wrap"=>"soft", "maxlength" => 100));

$today = getdate();
$options = array("language"=> "ca", "format" => "dFY", "minYear"=>JOIN_YEAR_MINIMUM, "maxYear"=>$today["year"]);
$form->addElement("date", "join_date",    "Data de inscripció", $options);    
$form->addElement("static", null, null, null);    

$form->addElement("text", "first_name", "Nom", array("size" => 15, "maxlength" => 20));
$form->addElement("text", "last_name", "Primer Cognom", array("size" => 20, "maxlength" => 30));
$form->addElement("text", "mid_name", "Segon Cognom", array("size" => 10, "maxlength" => 20));
$form->addElement("select", "sexo", "Sexo", array(""=>"", "M"=>"Masculí", "F"=>"Femení", "O"=>"Organització"));
$form->addElement("static", null, null, null); 

$options = array("language"=> "ca", "format" => "dFY", "maxYear"=>$today["year"], "minYear"=>"1880"); 
$form->addElement("date", "dob", "Data de naixement", $options);
// $form->addElement("text", "mother_mn", "Mother's Maiden Name", array("size" => 20, "maxlength" => 30)); 
$form->addElement("static", null, null, null);
$form->addElement("text", "email", "Email", array("size" => 25, "maxlength" => 40));
$form->addElement("text", "phone1", "Telèfon", array("size" => 20));
$form->addElement("text", "phone2", "Telèfon 2", array("size" => 20));
// $form->addElement("text", "fax", "Fax Number", array("size" => 20));
$form->addElement("static", null, null, null);
$frequency = array("0"=>"Mai", "1"=>"Diàriament", "7"=>"Setmanalment", "30"=>"Mensualment");
$form->addElement("select", "email_updates", "Amb quina freqüència rebrà emails?", $frequency);
$form->addElement("static", null, null, null);
$form->addElement("text", "address_street1", "Adreça", array("size" => 25, "maxlength" => 30));
// $form->addElement("text", "address_street2", "Address Line 2", array("size" => 25, "maxlength" => 30));
$form->addElement("text", "address_city", "Localitat", array("size" => 20, "maxlength" => 30));

// TODO: The State and Country codes should be Select Menus, and choices should be built
// dynamically using an internet database (if such exists).
// $form->addElement("text", "address_state_code", STATE_TEXT, array("size" => 2, "maxlength" => 2));
 $form->addElement("text", "address_post_code", "Codi Postal", array("size" => 5, "maxlength" => 6));
 $form->addElement("text", "address_country", "Província", array("size" => 20, "maxlength" => 30));
$form->addElement("static", null, null, null);
$form->addElement('submit', 'btnSubmit', 'Crear soci');

//
// Define form rules
//
$form->addRule('member_id', 'no lo pots dejar buit el ID del nou usuari.', 'required');
$form->addRule('password', 'Contrasenya massa curta', 'minlength', 7);
$form->addRule('first_name', 'Introdueix un nom', 'required');
// $form->addRule('mid_name', 'Introduce un apellido', 'required');
// Por alguna razón que no conozco, si se quita la siguiente línea el programa da un error. 
$form->addRule('last_name', 'Introdueix un cognom', 'required');
$form->addRule('address_city', 'Introdueix una ciutat', 'required');
// $form->addRule('address_state_code', 'Enter a state', 'required');
// $form->addRule('address_post_code', 'Enter a '.ZIP_TEXT, 'required');
// $form->addRule('address_country', 'Enter a country', 'required');

$form->registerRule('verify_not_future_date','function','verify_not_future_date');
$form->addRule('dob', 'El naixement no pot ser en el futur', 'verify_not_future_date');
$form->registerRule('verify_reasonable_dob','function','verify_reasonable_dob');
$form->addRule('dob', 'Una mica jove, no creus?', 'verify_reasonable_dob');
$form->registerRule('verify_valid_email','function', 'verify_valid_email');
$form->addRule('email', 'Email no vàlid', 'verify_valid_email');
$form->registerRule('verify_phone_format','function','verify_phone_format');
$form->addRule('phone1', 'El número de telèfon no és vàlid', 'verify_phone_format');
$form->addRule('phone2', 'El número de telèfon no és vàlid', 'verify_phone_format');
// $form->addRule('fax', 'Phone format invalid', 'verify_phone_format');

$form->registerRule('verify_unique_member_id','function','verify_unique_member_id');
$form->addRule('member_id','Aquest ID ja està sent usat','verify_unique_member_id');
$form->registerRule('verify_good_member_id','function','verify_good_member_id');
$form->addRule('member_id','No es permeten caràcters especials','verify_good_member_id');
$form->registerRule('verify_good_password','function','verify_good_password');
$form->addRule('password', 'La contrasenya ha de contenir almenys un número', 'verify_good_password');
$form->registerRule('verify_no_apostraphes_or_backslashes','function','verify_no_apostraphes_or_backslashes');
$form->addRule("password", "És millor no utilitzar apòstrofs o cometes en contrasenyes", "verify_no_apostraphes_or_backslashes");
$form->registerRule('verify_role_allowed','function','verify_role_allowed');
$form->addRule('member_role','No pots assignar un major nivell d´accés del qual tens','verify_role_allowed');
$form->addRule('join_date', 'La data no pot estar en el futur', 'verify_not_future_date');



//
// Check if we are processing a submission or just displaying the form
//
if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
     $form->process("process_data", false);
} else {
    $today = getdate();
    $current_date = array("Y"=>$today["year"], "F"=>$today["mon"], "d"=>$today["mday"]);
    $defaults = array("password"=>$cUser->GeneratePassword(), "dob"=>$current_date, "join_date"=>$current_date, "account_type"=>"S", "member_role"=>"0", "email_updates"=>DEFAULT_UPDATE_INTERVAL, "address_state_code"=>DEFAULT_STATE, "address_city"=>DEFAULT_CITY, "address_country"=>DEFAULT_COUNTRY);
    $form->setDefaults($defaults);
   $p->DisplayPage($form->toHtml());  // just display the form
}

//
// The form has been submitted with valid data, so process it   
//
function process_data ($values) {
    global $p, $cUser,$cErr, $today;
    $list = "";

    // Following are default values for which this form doesn't allow input
    $values['security_q'] = "";
    $values['security_a'] = "";
    $values['status'] = "A";
    $values['member_note'] = "";
    $values['expire_date'] = "";
    $values['away_date'] = "";
    $values['balance'] = 10;
    $values['primary_member'] = "Y";
    $values['directory_list'] = "Y";


    $date = $values['join_date'];
    $values['join_date'] = $date['Y'] . '/' . $date['F'] . '/' . $date['d'];
    $date = $values['dob'];
    $values['dob'] = $date['Y'] . '/' . $date['F'] . '/' . $date['d'];
    if($values['dob'] == $today['year']."/".$today['mon']."/".$today['mday'])
        $values['dob'] = ""; // if birthdate was left as default, set to null
    
    $phone = new cPhone($values['phone1']);
    $values['phone1_area'] = $phone->area;
    $values['phone1_number'] = $phone->SevenDigits();
//  $values['phone1_ext'] = $phone->ext;
    $phone = new cPhone($values['phone2']);
    $values['phone2_area'] = $phone->area;
    $values['phone2_number'] = $phone->SevenDigits();
//  $values['phone2_ext'] = $phone->ext;    
//  $phone = new cPhone($values['fax']);
//  $values['fax_area'] = $phone->area;
//  $values['fax_number'] = $phone->SevenDigits();
//  $values['fax_ext'] = $phone->ext;    


    $new_member = new cMember($values);
    $new_person = new cPerson($values);

    if($created = $new_person->SaveNewPerson()) 
        $created = $new_member->SaveNewMember();

    if($created) {
        $list .= "Associat creat. Clica <A HREF=member_create.php>aquí </A>per crear un altre.<P>";
        $list .= "También puedes <b>añadir una foto y genera el carnet de socio</b> pulsando <A HREF=member_edit.php?type=".$_REQUEST["type"]."&mode=admin&member_id=".$values['member_id'].">aquí</A>. ";  
        if($values['email'] == "") {
            $list .= "Esta persona tendrá que ser informada del ID de asociado/a ('". $values["member_id"]. "') y la contraseña ('". $values["password"] ."').";    
        } else {

            $text = NEW_MEMBER_MESSAGE . "\n\nID Membre: ". $values['member_id'] ."\n". "Contrasenya: ". $values['password'];
            $html = ROTULO_MAIL.nl2br($text).LOPD.AVISO_LEGAL;
            $to = $values['email'];
          /*  $crlf = "\n";
            $headers = array ('From' => EMAIL_FROM,
            'To' => $to,
            'Subject' => NEW_MEMBER_SUBJECT);
            $mime = new Mail_mime($crlf);
            $mime->setTXTBody($text);
            $mime->setHTMLBody($html); 
            $body = $mime->get();
            $headers = $mime->headers($headers);
            
            $smtp = Mail::factory('mail');
            $mailed = $smtp->send($to, $headers, $body);*/
// las cabeceras en utf-8 garantizan caracteres especiales como ç, à, á,
            $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
             $headers .= "From: noreplyt@bancsdeltempsdesalt.org \r\n";
$headers .= "Reply-To: ".$to. "\r\n";


             $mailed=mail($to,NEW_MEMBER_SUBJECT, $html,$headers);

          //  if (PEAR::isError($mailed)) {
             if (!$mailed) {
              $list .= "Ha fallat l'intent d'enviar un email. Probablement es degui a un problema tècnic. Contacta amb l'administrador a ". PHONE_ADMIN .". <I>El nou associat ha de ser informat de l'id ('". $values["member_id"]. "') y la contrasenya ('". $values["password"] ."').</I>";  
                         //no ews necesario ya que el admin crea este usuario.
                         /* $mailed=mail("bdt@maximilianofernandez.net",NEW_MEMBER_SUBJECT, " a nou member se ha incrit: ".$values["member_id"]."-".$values["email"]." i no ha rebut mail amb las dades.",$headers);      */                                                                     
               } else {
                 $list .= "S'ha enviat un correu electrònic a '". $values["email"] ."' contenint el nou id i contrasenya.";                
				                                                                                                                                                    
                  } 
        }         
    } else {
        $cErr->Error("Hi va haver un error guardant el número. Intenta-ho més tard.");
    }
   $p->DisplayPage($list);
}


//
// The following functions verify form data
//

// TODO: All my validation functions should go into a new cFormValidation class

function verify_unique_member_id ($element_name,$element_value) {
    $member = new cMember();
    
    return !($member->LoadMember($element_value, false));
}

function verify_good_member_id ($element_name,$element_value) {
    if(ctype_alnum($element_value)) { // it's good, so return immediately & save a little time
        return true;
    } else {
        $member_id = ereg_replace("\_","",$element_value);
        $member_id = ereg_replace("\-","",$member_id);
        $member_id = ereg_replace("\.","",$member_id);
        if(ctype_alnum($member_id))  // test again now that we've stripped the allowable special chars
            return true;        
    }
}

function verify_role_allowed($element_name,$element_value) {
    global $cUser;
    if($element_value > $cUser->member_role)
        return false;
    else
        return true;
}
        
function verify_reasonable_dob($element_name,$element_value) {
    global $today;
    $date = $element_value;
    $date_str = $date['Y'] . '/' . $date['F'] . '/' . $date['d'];
//    echo $date_str ."=".$today['year']."/".$today['mon']."/".$today['mday'];

    if ($date_str == $today['year']."/".$today['mon']."/".$today['mday']) 
        // date wasn't changed by user, so no need to verify it
        return true;
    elseif ($today['year'] - $date['Y'] < 17)  // A little young to be trading, presumably a mistake
        return false;
    else
        return true;
}

function verify_good_password($element_name,$element_value) {
    $i=0;
    $length=strlen($element_value);
    
    while($i<$length) {
        if(ctype_digit($element_value{$i}))
            return true;    
        $i+=1;
    }
    
    return false;
}

function verify_no_apostraphes_or_backslashes($element_name,$element_value) {
    if(strstr($element_value,"'") or strstr($element_value,"\\"))
        return false;
    else
        return true;
}

function verify_not_future_date ($element_name,$element_value) {
    $date = $element_value;
    $date_str = $date['Y'] . '/' . $date['F'] . '/' . $date['d'];

    if (strtotime($date_str) > strtotime("now"))
        return false;
    else
        return true;
}

// TODO: This simplistic function should ultimately be replaced by this class method on Pear:
//         http://pear.php.net/manual/en/package.mail.mail-rfc822.intro.php
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
