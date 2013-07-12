<?
/*
 * JLD: Script para reportar un resumen del perfil de cada usuario y mostrarlo en PDF
 * */
include_once("includes/inc.global.php");
require_once "Mail.php";
require_once "Mail/mime.php"; 
require_once("classes/class.listing.php");



//Iniciamos bucle para recorrer usuarios:
global $cDB, $cErr;

//
// select all Member data and populate the properties
//
$member = new cMember;
//$member->LoadMember($values["member_id"]);
$member->LoadMember($_SESSION["user_login"]);

$cUser->MustBeLevel(2);

$ssql = "SELECT member_id, status, email_updates FROM ".DATABASE_MEMBERS;
$ssql.= " WHERE  status = 'A' ";
$ssql.= " ORDER BY member_id ";
//$ssql.= " AND member_id='".$member->member_id."'";
//$ssql.= " AND member_id IN ('jordill')";

$query = $cDB->Query($ssql);

$resultat = "";

$LimitRegEnviament = 100;
$nregistros = mysql_num_rows($query);
$npaginaactual = 0;
	$npaginas = ceil($nregistros / $LimitRegEnviament);
	
	$resultat.="<form name='filtro'>";
	$resultat.="Filtrar por intervalo de registro";
	$resultat.="<select name='npagina'>";
	
	for ($i = 1; $i <= $npaginas; $i++) {
		$RegActualIni = (($i - 1)* $LimitRegEnviament) + 1;
		$RegActualFin = (($i - 1)* $LimitRegEnviament) + $LimitRegEnviament;
		
		$resultat.="<option value=$i>$RegActualIni a $RegActualFin</option>"; 
	}
	
	$resultat.="</select>";
	$resultat.="<input type='submit' value='Enviar'>";
	$resultat.="</form>";
	 
//if($row = mysql_fetch_array($query)){

	if (isset($_GET['npagina'])){
		$npaginaactual = $_GET['npagina'];
		$RegActualIni = (($npaginaactual - 1)* $LimitRegEnviament) + 1;
		
		$ssql = "SELECT member_id, status, email_updates FROM ".DATABASE_MEMBERS;
		$ssql.= " WHERE  status = 'A' ";
		$ssql.= " ORDER BY member_id ";
		$ssql.= " LIMIT ".$RegActualIni.", ".$LimitRegEnviament;
		
		$query = $cDB->Query($ssql);
		
		require('classes/fpdf/fpdf.php');
		$pdf = new FPDF();

		while($row = mysql_fetch_array($query)){
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',10);
			
			$member = new cMember;
			$member->LoadMember($row[0]);
		
			$resultat .= process_data ($member)."<br>";
		}
		
		$pdf->Output();
	}

$p->DisplayPage($resultat);

function process_data ($member) {
    global $p, $pdf;
    $list = "";
    
    ///$member = new cMember;
    //$member->LoadMember($values["member_id"]);
    ///$member->LoadMember($_SESSION["user_login"]);


    
    if($member->person[0]->email !=""){
    //$text = "\n\nIdentificador de cuenta: ". $member->member_id;
    $text = "Siusplau, revisa les següents dades i diga'ns si hi ha cap error o bé hi falta o sobra alguna dada. Gr&#224;cies.\n\n";
    $output = "";
    
    $output .= "<STRONG><I>INFORMACIÓ DE CONTACTE</I></STRONG><P>";
    $output .= $member->DisplayMember();
    
    $output .= "<BR><P><STRONG><I>OFERTES</I></STRONG><P>";
    $listings = new cListingGroup(OFFER_LISTING);
    $listings->LoadListingGroup(null, null, $member->member_id);
    $output .= $listings->DisplayListingGroup();
    
    $output .= "<BR><P><STRONG><I>DEMANDES</I></STRONG><P>";
    $listings = new cListingGroup(WANT_LISTING);
    $listings->LoadListingGroup(null, null, $member->member_id);
    $output .= $listings->DisplayListingGroup();
        
    //include("classes/class.trade.php");
    $historic = "<h2>Historia dels intercanvis de ".$member->PrimaryName()."</h2>";
    $historic .= "<B> Saldo actual: </B><FONT COLOR=". $color .">". $member->balance . " ". UNITS ."</FONT><P>";
    $trade_group = new cTradeGroup($member->member_id);
    $trade_group->LoadTradeGroup();
    $historic .= "<p> A continuació es detallen totes les transferències d'hores que s'han realitzat. La columna 'De' indica que ha transferit hores i la columna 'A' a qui han estat transferides.</p>";
    $historic .= $trade_group->DisplayTradeGroup();
    
    
    //include("classes/class.feedback.php");
    $feedbackgrp = new cFeedbackGroup;
    $feedbackgrp->LoadFeedbackGroup($member_id);
    if (isset($feedbackgrp->feedback)) {
    	$strfeedback = "<p> A continuació es detallen com han valorat a aquest usuari altres membres del Banc. La primera columna indica si el vot ha estat positiu, negatiu o neutral, i 'De' indica qui l'ha emès. El 'context' indica si ". $member->PrimaryName()." va actuar com a comprador (demandant de serveis) o com a venedor (proveïdor de serveis) i la categoria del servei.</p>";
    	$strfeedback .= $feedbackgrp->DisplayFeedbackTable($cUser->member_id);
    } else  {
    	//if($_REQUEST["mode"] == "self")
    		$strfeedback = "Encara no tens cap valoració.";
    	//else
    		//$strfeedback = "Aquesta persona no té cap valoració encara.";
    }
    
    $text .= "<br><br>".$output."<br>".$historic."<br>".$strfeedback;
    
    //$html = iconv('utf-8', 'windows-1252', ROTULO_MAIL.nl2br($text).AVISO_LEGAL); 
    //$to = $member->person[0]->email;
    $crlf = "\n";
    /*$headers = array ('From' => EMAIL_FROM,
    'To' => $to,
    'Subject' => "La teva activitat al Banc del Temps: ofertes/sol�licituds/intercanvis");
            $mime = new Mail_mime($crlf);
            $mime->setTXTBody($text);
            $mime->setHTMLBody($html); 
            $body = $mime->get();
            $headers = $mime->headers($headers);
     $smtp = Mail::factory('mail');
     $mailed = $smtp->send($to, $headers, $body);*/
     /*if (PEAR::isError($mailed)) {
     	$list .= ". <I>Problema técnico.  Contacta con el adminstrador en ". PHONE_ADMIN ."</I>.";                                                               
     } else {
     	$list .= " Informaci�n enviada a ".$member->member_id." (". $member->person[0]->email .").";                                                            
     } */
    /*$mime = new Mail_mime($crlf);
    $mime->setTXTBody($text);
    $mime->setHTMLBody($html);
    $body = $mime->get();*/
    
    $text = utf8_decode($text);
    
    //$pdf->Write(10,$body);
    $pdf->WriteHTML($text);
    //$pdf->WriteHTML($body);
    }
    else{
    $list .= "El usuario no ha suministrado ninguna dirección de correo. <b>Tendrá que ser informado por otro medio</b> de que sus datos de acceso son los siguientes:<p>";
    //$list .= "Identificador de cuenta: <b>" . $member->member_id ."</b><br>";
    //$list .= "Operaci�n realizada<br>";
    }
	return $list;
    //$p->DisplayPage($list);
}


?>

     