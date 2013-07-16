<?php
	include_once("includes/inc.global.php");
	
	$cUser->MustBeLoggedOn();
	$p->site_section = EXCHANGES;
	$p->page_title = "Història dels intercanvis";

	include("classes/class.trade.php");
	
	$from = new cDateTime($_REQUEST["from"]);
	$to = new cDateTime($_REQUEST["to"]);
	
	$output = "<B>Per a un període des de ". $from->ShortDate() ." fins ". $to->ShortDate() ."</B><P>";	

	$trade_group = new cTradeGroup("%", $_REQUEST["from"], $_REQUEST["to"]);
	$trade_group->LoadTradeGroup();
    $output .= "<p> A continuació es detallen totes les transferències d'hores que s'han realitzat. La columna 'De' indica qui ha transferit hores i la columna 'A' a qui han estat transferides.</p>";    
   // echo   $cUser->member_role;
	$output .= $trade_group->DisplayTradeGroup($cUser->member_role);
	
	$p->DisplayPage($output);
	

	
?>
	
