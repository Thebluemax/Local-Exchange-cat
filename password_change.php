<?

include_once("includes/inc.global.php");

$cUser->MustBeLoggedOn();
$p->site_section = SITE_SECTION_OFFER_LIST;

include("includes/inc.forms.php");

//
// Define form elements
//
$form->addElement('header', null, 'Cambiar la contraseña de '. $cUser->person[0]->first_name ." " . $cUser->person[0]->last_name);
$form->addElement('html', '<TR></TR>');  // TODO: Move this to the header
$form->addElement('static',null,'Por razones de seguridad, las contraseñas deben tener al menos 7 caracteres e incluir al menos un número.');
$form->addElement('html', '<TR></TR>');
$options = array('size' => 10, 'maxlength' => 15);
$form->addElement('password', 'old_passwd', 'Contraseña actual',$options);
$form->addElement('password', 'new_passwd', 'Elige una nueva contraseña',$options);
$form->addElement('password', 'rpt_passwd', 'Repite la nueva contraseña',$options);
$form->addElement('submit', 'btnSubmit', 'Cambiar contraseña');

//
// Define form rules
//
$form->addRule('old_passwd', 'Introduce tu contraseña actual', 'required');
$form->addRule('new_passwd', 'Introduce una nueva contraseña', 'required');
$form->addRule('rpt_passwd', 'Tienes que escribir la nueva contraseña aquí también', 'required');
$form->addRule('new_passwd', 'La contraseña tiene que ser más larga', 'minlength', 7);
$form->registerRule('verify_passwords_equal','function','verify_passwords_equal');
$form->addRule('new_passwd', 'Las contraseñas no son iguales', 'verify_passwords_equal');
$form->registerRule('verify_old_password','function','verify_old_password');
$form->addRule('old_passwd', 'La contraseña no es correcta', 'verify_old_password');
$form->registerRule('verify_good_password','function','verify_good_password');
$form->addRule('new_passwd', 'Las contraseñas tienen que tener al menos un número', 'verify_good_password');

//
//	Display or process the form
//
if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
 	$form->process('process_data', false);
} else {
   $p->DisplayPage($form->toHtml());  // just display the form
}

function process_data ($values) {
	global $p, $cUser;
	
	if($cUser->ChangePassword($values['new_passwd']))
		$list = 'La contraseña se ha cambiado correctamente.';
	else
		$list = 'Ocurrió un error al cambiar la contraseña.  Por favor, inténtalo más tarde.';
	$p->DisplayPage($list);
}

function verify_old_password($element_name,$element_value) {
	global $cUser;
	if($cUser->ValidatePassword($element_value))
		return true;
	else
		return false;
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


function verify_passwords_equal() {
	global $form;

	if ($form->getElementValue('new_passwd') != $form->getElementValue('rpt_passwd'))
		return false;
	else
		return true;
}

?>
