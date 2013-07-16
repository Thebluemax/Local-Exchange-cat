<?

include_once("includes/inc.global.php");

//$cUser->MustBeLevel(1);
$p->site_section = SITE_SECTION_OFFER_LIST;

include("includes/inc.forms.php");
require_once('HTML/QuickForm/textarea.php');
require_once "Mail.php";
require_once "Mail/mime.php";
//
// First, we define the form
//
$form->addElement("header", null, "Inscriure's al Banc de Temps");
$form->addElement("static", null, "Benvingut al Banc de Temps. Inscriu-te aquí per poder enviar ofertes i demandes, i realitzar intercanvis amb altres persones.<br> Després d´inscriure't aquí hauràs d'esperar que la persona que administra el Banc accepti la teva petició, i te enviï un correu confirmant la teva participació.<br>",null);

$form->addElement("html", "<TR></TR>");
$form->addElement("text", "member_id", "ID Membre", array("size" => 10, "maxlength" => 15));
$form->addElement("static", null, "    (L'identificador és un nom que utilitzaràs per connectar-te, és important que ho recordis, serà també el nom que apareixerà públicament i fins i tot, per als no membres, així que utilitza un àlies si vols anonimat).<br>", null);
$form->addElement("text", "password", "Contrasenya (mínim set caràcters d'ells almenys un numèric)", array("size" => 10, "maxlength" => 15));
// $form->addElement("select", "member_role", "Member Role", array("0"=>"Member", "1"=>"Administrator Level 1", "2"=>"Administrator Level 2"));
//$acct_types = array("S"=>"Single", "J"=>"Joint", "H"=>"Household", "O"=>"Organization", "B"=>"Business", "F"=>"Fund");
//$form->addElement("select", "account_type", "Account Type", $acct_types);
// $form->addElement("static", null, "Administrator Note", null);
// $form->addElement("textarea", "admin_note", null, array("cols"=>45, "rows"=>2, "wrap"=>"soft", "maxlength" => 100));

$today = getdate();
$options = array("language"=> "ca", "format" => "dFY", "minYear"=>JOIN_YEAR_MINIMUM, "maxYear"=>$today["year"]);
$form->addElement("date", "join_date",	"Data d'inscripció", $options);	
$form->addElement("static", null, null, null);	

$form->addElement("text", "first_name", "Nom", array("size" => 15, "maxlength" => 20));
$form->addElement("text", "last_name", "Primer cognom", array("size" => 20, "maxlength" => 30));
$form->addElement("text", "mid_name", "Segon Cognom", array("size" => 10, "maxlength" => 20));
$form->addElement("select", "sexo", "Sexo", array(""=>"", "M"=>"Masculí", "F"=>"Femení", "O"=>"Organització"));
$form->addElement("static", null, null, null); 

$options = array("language"=> "ca", "format" => "dFY", "maxYear"=>$today["year"], "minYear"=>"1880"); 
$form->addElement("date", "dob", "Data de naixement", $options);
// $form->addElement("text", "mother_mn", "Mother's Maiden Name", array("size" => 20, "maxlength" => 30)); 
$form->addElement("static", null, null, null);
$form->addElement("text", "email", "E-mail", array("size" => 25, "maxlength" => 40));
$form->addElement("text", "phone1", "Telèfon", array("size" => 20));
$form->addElement("text", "phone2", "Telèfon 2", array("size" => 20));
// $form->addElement("text", "fax", "Fax Number", array("size" => 20));
$form->addElement("static", null, null, null);
$frequency = array("0"=>"Mai", "1"=>"Diari", "7"=>"Setmanal", "30"=>"Mensualment");
$form->addElement("select", "email_updates", "Amb quina freqüència vols rebre e-mails?", $frequency);
$form->addElement("static", null, null, null);
$form->addElement("text", "address_street1", "Direcció", array("size" => 25, "maxlength" => 30));
// $form->addElement("text", "address_street2", "Address Line 2", array("size" => 25, "maxlength" => 30));
$form->addElement("text", "address_city", "Ciutat", array("size" => 20, "maxlength" => 30));

// TODO: The State and Country codes should be Select Menus, and choices should be built
// dynamically using an internet database (if such exists).
// $form->addElement("text", "address_state_code", STATE_TEXT, array("size" => 2, "maxlength" => 2));
 $form->addElement("text", "address_post_code", "Codi Postal", array("size" => 5, "maxlength" => 6));
 $form->addElement("text", "address_country", "Província", array("size" => 20, "maxlength" => 30));

$form->addElement("static", null, null, null);   
$agreement = new HTML_QuickForm_textarea('agreement', 'agreement', array('cols'=>60,'rows'=>10,'readonly'=>'readonly'));

$parrafada ="Cláusula LOPD"."\n\n";
$parrafada .="D'acord amb la normativa de protecció de dades de caràcter personal, t'informem que les teves dades personals han estat incorporades a sengles fitxers de Persones participants en el Banc del Temps de Salt, mantinguts sota la responsabilitat del banc del temps de salt. Únicament s'utilitzaran amb la finalitat de participar en el Banc del Temps de Salt i donar-los a conèixer pel que fa al Banc, i exclusivament es cediran als usuaris del Banc amb la mateixa finalitat, segons estableix la normativa vigent. Així mateix t'informem que pots exercir els drets d'accés, rectificació, cancel.lació i oposició davant el responsable del fitxer al Hotel Entitats de Salt, despatx 1.0 Carrer Sant Dionís, 42 o en info@bancdeltempsdesalt.org"."\n\n\n";
$parrafada .="Responsabilitat:"."\n\n"; 
$parrafada .="El Banc del Temps de Salt només contacta els usuaris que diuen poder oferir un servei. El Banc del Temps no pot assegurar el rendiment de cap dels usuaris del Banc del Temps, de manera que mai serà el Banc del Temps de Salt responsable per cap lesió o dany a la propietat experimentats durant les transaccions."."\n";
$parrafada .="El Banc del Temps de Salt ofereix en la seva eina informàtica formes de conèixer les experiències que tots els usuaris han tingut mentre oferien serveis a altres usuaris del banc del temps."."\n\n\n";  
$parrafada .="Limitacions:"."\n\n"; 
$parrafada .="Els serveis no estan garantits i pot haver situacions quan un proveïdor d'un servei no omple les expectatives de qui el rep. Demanem l'apreciació de l'esforç que cadascú posa i això és el que fa que el Banc del Temps funcioni."."\n";
$parrafada .="Si hi hagués un problema real amb el servei rebut, Banc del Temps de Salt, ofereix en la seva eina informàtica formes de conèixer les experiències que tots els usuaris han tingut mentre oferien serveis a altres usuaris del banc del temps. El Banc de Temps intervindrà dins de les seves capacitats en els conflictes entre usuaris que no s'hagin pogut arreglar i les seves decisions sempre seran finals i sense possibilitat d'apel.lació. Si hagués accions irregulars el Banc del Temps del Pont de Salt podrà sancionar els usuaris, des obligar-los a retornar el crèdit obtingut fins a l'expulsió del sistema."."\n\n\n"; 
$parrafada .="Confidencialitat i privacitat:"."\n\n"; 
$parrafada .="Un dels criteris en què es basa el Banc de Temps és en la confiança mútua. Tots els usuaris han de protegir la privacitat i confidencialitat dels altres usuaris. Un usuari pot arribar a ser expulsat de la comunitat per aquest motiu. L'única excepció per compartir informació és quan un usuari senti que la salut o seguretat d'un altre usuari està en perill."."\n\n\n"; 
$parrafada .="QUE FER QUAN VOL REBRE UN SERVEI"."\n\n"; 
$parrafada .="Per poder donar o rebre un servei ha d'estar registrat en el Banc de Temps i haver passat un procés de verificació."."\n";
$parrafada .="Poseu-vos en contacte amb el Banc de Temps tan aviat com li sigui possible i acordi un lloc data per rebre el servei seleccionat. Si deixa un missatge i l'usuari no respon en uns dies, torni a provar, i si encara no ho aconsegueix contacti amb l'administrador."."\n\n\n"; 
$parrafada .="QUE FER I QUE NO FER"."\n\n"; 
$parrafada .="Que fer:"."\n\n";   
$parrafada .="- Assegureu-vos que l'altra persona entén el que va fer abans que comenci a fer-ho."."\n";
$parrafada .="- Contacti amb l'usuari per endavant si no pot arribar a temps a oferir el servei o si ha de cancel.lar."."\n";    
$parrafada .="- El rebedor del servei es compromet a realitzar el pagament estipulat com més aviat millor."."\n";    
$parrafada .="- Sigui pacient i obert més que crític. Estem per compartir i el fet d'aprendre a conèixer-nos ja és molt."."\n";    
$parrafada .="- Respecteu els altres, ja sigui per religió creences o pertinença política."."\n";    
$parrafada .="- Si demana un servei assegureu-vos de pagar per tots els materials, parts o ingredients necessaris."."\n\n";    
$parrafada .="Que no fer:"."\n\n";     
$parrafada .="- No fumeu al lloc d'altres usuaris sense el seu consentiment."."\n";      
$parrafada .="- No accepti mai diners ni propines."."\n";      
$parrafada .="- No utilitzeu alcohol ni drogues mentre ofereix els serveis. (En el cas de passar, és raó per a l'expulsió automàtica)"."\n";      
$parrafada .="- No compri alcohol ni tabac a altres usuaris."."\n";      

$agreement->setValue($parrafada);  
$form->addElement("static", null, "Condicions legals i d'ús",null);
$form->addElement('static', 'valid',null, $agreement->toHtml()); 

$form->addElement('checkbox','acepto',null,'Accepto les condicions');

$form->addElement("static", null, null, null);   
$form->addElement('submit', 'btnSubmit', 'Crear soci');

//
// Define form rules
//
$form->addRule('password', 'Contrasenya massa curta', 'minlength', 7);
$form->addRule('first_name', 'Introdueix un nom', 'required');
// $form->addRule('mid_name', 'Introduce un apellido', 'required');
// Por alguna razón que no conozco, si se quita la siguiente línea el programa da un error. 
$form->addRule('last_name', 'Introdueix un cognom', 'required');
$form->addRule('address_city', 'Introdueix una ciutat', 'required');
// $form->addRule('address_state_code', 'Enter a state', 'required');
// $form->addRule('address_post_code', 'Enter a '.ZIP_TEXT, 'required');
// $form->addRule('address_country', 'Enter a country', 'required');
$form->addRule('member_id', 'no lo pots dejar buit el teu ID.', 'required');
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
	$values['status'] = "X";
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
//	$values['phone1_ext'] = $phone->ext;
	$phone = new cPhone($values['phone2']);
	$values['phone2_area'] = $phone->area;
	$values['phone2_number'] = $phone->SevenDigits();
//	$values['phone2_ext'] = $phone->ext;	
//	$phone = new cPhone($values['fax']);
//	$values['fax_area'] = $phone->area;
//	$values['fax_number'] = $phone->SevenDigits();
//	$values['fax_ext'] = $phone->ext;	

    
     
     
	$new_member = new cMember($values);
	$new_person = new cPerson($values);

	if($created = $new_person->SaveNewPerson()) 
		$created = $new_member->SaveNewMember();

	  if($created) {
        $list .= "Ja has estat creat, Hauràs de passar per Hotel Entitats de Salt, cada Dijous de 17 a 19hs per signar l'aceptació de les normes.  La nostra adressa Carrer Sant Dionís, 42. Salt.<br>\nRecorda que el teu nom d'associat es <strong>". $values["member_id"]. "</strong> i la teva contrasenya <strong>". $values["password"] . "</strong><br><br>Prem <A HREF=member_create.php>aquí</A> si vols crear un altre compte.";
        if($values['email'] == "") {
        $list .= "<br>Normalment avisem per email, però no has donat cap. Espera uns pocs dies i fes la prova per veure si et pots donar d'alta. Si tens pressa, posa't en contacte amb el Banc del Temps per telèfon o email. ";                                                                                                                                                                                                     
        } else {
            //$text = NEW_MEMBER_PENDING . "\n\nID Membre: ". $values['member_id'] ."\n".; "Contrasenya: ". ['password'];
             $text = NEW_MEMBER_PENDING . "\n\nID Membre: ". $values['member_id'] ."\n". "Contrasenya: ". $values['password'];
            //$text = NEW_MEMBER_PENDING . "\n\nID Membre: ". $values['member_id'] ."\n". "Contrasenya: ";

          //  $html = iconv('utf-8', 'windows-1252', ROTULO_MAIL.nl2br($text).AVISO_LEGAL);   
             $html =  ROTULO_MAIL.nl2br($text).AVISO_LEGAL; 
            // $html =  ROTULO_MAIL.nl2br($text).AVISO_LEGAL; 
          echo 
//*****modificado por pablo 07-12-2010 para que me envie un correo a una dirección fija y asi saber que hay un usuario nuevo esperando
//mal: que se ve en enviado que el adm recibe un correo donde está la password del usuario****
//mejorar: ponerlo como copia certificada****

          //  $to = $values['email']; 
//$to  = $values['email'] . ', '; // ojo con la comma *********
			
$to  = $values['menber_id']."  <".$values['email'].">";

//$to  = 'aidan@example.com' . ', '; 
//$to .= 'wez@example.com';			
//----------------------------------------------------------
// To send HTML mail, the Content-type header must be set
// $headers  = 'MIME-Version: 1.0' . "\r\n";
// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//  Additional headers
// $headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
// $headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
// $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
// $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
// Mail it
// mail($to, $subject, $message, $headers);// 
	// comentado para encontara solucion.
		
          /*  $crlf = "\n";
            $headers = array ('From' =>"Banc del Temps Salt<".EMAIL_FROM.">",
            'To' => $to,
            'Subject' => NEW_MEMBER_SUBJECT);
            $mime = new Mail_mime($crlf);
            $mime->setTXTBody($text);
            $mime->setHTMLBody($html);
            $body = $mime->get();
            $headers = $mime->headers($headers);
            
            $smtp = Mail::factory('mail');
            $mailed = $smtp->send($to, $headers, $body);*/

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
            	//linea de control de error. comentar en produccion.
            	echo($mailed->getMessage());
               $list .= "<br><br>Ha fallat l'intent d'enviar un correu, probablement per problemes tècnics. En tot cas, el sistema ha recollit la teva inscripció i en uns pocs dies et donarem d'alta. ";                                                                        
               } else {
               $list .= "<br>Hem enviat un email a la teva adreça '". $values["email"] ."'. En uns pocs dies et donarem d'alta. Si tens pressa, posa't en contacte amb nosaltres per telèfon o email.";                                                                                                                                  
                  } 
//envio de mail al administrador para que sepa que hay un usuario esperando alta.
                   $headers2 .= 'To: adminBLog  <bmax@maximilianofernandez.net>'. "\r\n";
$headers .= 'From:  banco del tiempo <info@bancdeltempsdesalt.org>' . "\r\n";
 $headers .= 'Cc: adminWeb <admin@bancdeltempsdesalt.org>' . "\r\n";
// $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
// Mail it
 $subject="Nova inscripciò";
$to2=EMAIL_ADMIN;
$message2="Hi ha un nou Usuari inscrip en la Web :".$values['member_id'];
 mail($to2, $subject, $message2, $headers2);// 
        }         
    } else {
		$cErr->Error("Hi ha hagut un error gravant les teves dades. Prova una mica més tard.");
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
//	echo $date_str ."=".$today['year']."/".$today['mon']."/".$today['mday'];

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
// 		http://pear.php.net/manual/en/package.mail.mail-rfc822.intro.php
function verify_valid_email ($element_name,$element_value) {
	if ($element_value=="")
		return true;		// Currently not planning to require this field
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
