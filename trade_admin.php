<?
include_once("includes/inc.global.php");

$cUser->MustBeLoggedOn();
//$p->site_section = TRADES;
//$title = $cDB->UnEscTxt($_REQUEST['title']);
//if ($_REQUEST["type"] == "Offer") $p->page_title = "Editar oferta: ".$title;

include("classes/class.listing.php");
include("includes/inc.forms.php");

$cUser->MustBeLevel(1);
$form->addElement("hidden","mode","admin");
$form->addElement("hidden", "member_id", $_REQUEST["member_id"]);

//Llistat de trades, per poder saltar-hi
$sql_ntrades = "Select trade_id from ".DATABASE_TRADES." order by trade_id";
$query = $cDB->Query($sql_ntrades);

$i=0;
while($row = mysql_fetch_array($query)) {
	$i++;
	$arrayrows[$i] = $row['trade_id'];
}

$form->addElement("select", "num_registre_list","Número de registre", $arrayrows);
$form->addElement('submit', 'btnSubmit', 'Visualitzar');

$num_registre_triat = null;
$trade_id_triat = null;
$list="";

if (isset($_REQUEST['num_registre_list'])){
	$num_registre_triat = $_REQUEST['num_registre_list'];
	$trade_id_triat = $arrayrows[$num_registre_triat];

	//$form->addElement("hidden","num_registre_list_actual",$trade_id_triat);
	//$list.="Has triat el trade_id ".$trade_id_triat."<br>";
}

if (isset($_REQUEST['btnGuardar'])){
	UpdateTrade($_REQUEST['trade_id_form']);

	$num_registre_triat = $_REQUEST['num_registre_list'];
	$trade_id_triat = $arrayrows[$num_registre_triat];
	//$list.="Hem guardat. El ID següent és trade_id=".$trade_id_triat."<br>";
}

if (isset($_REQUEST['btnGuardariSeg'])){
	UpdateTrade($_REQUEST['trade_id_form']);

	$num_registre_triat = $_REQUEST['num_registre_list'] + 1;
	$trade_id_triat = $arrayrows[$num_registre_triat];
}

if (isset($_REQUEST['btnSeg'])){
	$num_registre_triat = $_REQUEST['num_registre_list'] + 1;
	$trade_id_triat = $arrayrows[$num_registre_triat];
}

function UpdateTrade($trade_id){
	global $cDB;

	$sql_update = "update ".DATABASE_TRADES." SET ";
	$sql_update.= " trade_date = trade_date, ";
	$sql_update.= " category = ".$_REQUEST['category'].", ";
	$sql_update.= " description = '".$_REQUEST['description']."' ";
	$sql_update.= " WHERE trade_id = ".$trade_id;

	$cDB->Query($sql_update);
	//echo $sql_update;
}


if ($trade_id_triat!=null){
	//$form->addElement('hidden', 'trade_id', $_REQUEST['trade_id']);

	//$list.="Has triat el trade_id ".$trade_id_triat;

	//$sql_trade = "SELECT trade_id, date_format(trade_date,'%Y-%m-%d'), status, member_id_from, member_id_to, amount, description, type, category FROM ".DATABASE_TRADES;

	/*$sql_trade = "SELECT trade_id, description, category FROM ".DATABASE_TRADES;
	$sql_trade.= " WHERE trade_id=".$trade_id_triat;*/

	//$query = $cDB->Query($sql_trade);


	$category_list = new cCategoryList();
	$form->addElement('select', 'category', 'Categoria', $category_list->MakeCategoryArray());

	$form->addElement('static', null, 'Descripció', null);
	$form->addElement('textarea', 'description', null, array('cols'=>45, 'rows'=>5, 'wrap'=>'soft'));


	$form->addElement('submit', 'btnGuardar', 'Guardar');
	$form->addElement('submit', 'btnGuardariSeg', 'Guardar i següent');
	$form->addElement('submit', 'btnSeg', 'Següent');


	$trade = new cTrade;
	$trade->LoadTrade($trade_id_triat);

	$form->addElement("hidden","trade_id_form","");
	$elmtradeid=$form->getElement('trade_id_form');
	$elmtradeid->setValue($trade_id_triat);
	
	//$current_values = array ("description"=>$trade->description, "category"=>$trade->category->id);
	//$form->setDefaults($current_values);

	$elmnumreg=$form->getElement('num_registre_list');
	$elmnumreg->setValue($num_registre_triat);

	$elmcat=$form->getElement('category');
	$elmcat->setValue($trade->category->id);

	$elmtxt=$form->getElement('description');
	$elmtxt->setValue($trade->description);
}


$p->DisplayPage($list.$form->toHtml());  // just display the form
//$p->DisplayPage($form->toHtml());  // just display the form
?>
