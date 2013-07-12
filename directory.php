<?
include_once("includes/inc.global.php");

$cUser->MustBeLoggedOn();
$p->site_section = LISTINGS;
$p->page_title = "Descarregar un directori en format pdf";

include("classes/class.directory.php");
include("includes/inc.forms.php");

$form->addElement("static", null, "Prem al botó 'Descarregar' i t'arribarà una versió en format pdf del directori. ", null);
$form->addElement("static", null, null, null);
$form->addElement("static", null, "Necessitaràs un programa que llegeixi documents en format pdf, en Linux probablement tinguis diverses opcions, i per a Windows probablement necessitis <a href='http://www.adobe.com/products/acrobat/readstep2_servefile.html'>Adobe</a>.", null);
$form->addElement("static", null, null, null);  
$form->addElement("submit", "btnSubmit", "Descargar");

if ($form->validate()) { // Form is validated so processes the data
   $form->freeze();
 	$form->process("process_data", false);
} else {  // Display the form
	$p->DisplayPage($form->toHtml());
}

function process_data ($values) {
	global $p;

	$dir = new cDirectory();
	$dir->DownloadDirectory();

	$list = "Descarga completa.";
	$p->DisplayPage($list);
}
?>


