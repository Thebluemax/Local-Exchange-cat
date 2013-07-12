<?php
	include_once("includes/inc.global.php");
	
	$cUser->MustBeLoggedOn();
	$p->site_section = EXCHANGES;
	$p->page_title = "Història dels intercanvis";

	include("classes/class.trade.php");
	
	$member = new cMember;
	
	if($_REQUEST["mode"] == "self") {
		$member = $cUser;
	} else {
		$member->LoadMember($_REQUEST["member_id"]);
		$p->page_title .= " de ".$member->PrimaryName();
	}
	
	if ($member->balance > 0)
		$color = "#4a5fa4";
	else
		$color = "#554f4f";
		
	
	if(($member->member_role<1&&$cUser->member_role>0)||($member->member_id===$cUser->member_id))
	$list = "<B> Saldo actual: </B><FONT COLOR=". $color .">". $member->balance . " ". UNITS ."</FONT><P>";	

	$trade_group = new cTradeGroup($member->member_id);
	$trade_group->LoadTradeGroup();
        $list .= "<p> A continuació es detallen totes les transferències d'hores que s'han realitzat. La columna 'De' indica que ha transferit hores i la columna 'A' a qui han estat transferides.</p>";
        //damos una opcion para que muestre tus datos sin restricciones de administración
        if ($member->member_id == $cUser->member_id) 

        	$list .= $trade_group->DisplayTradeGroup(1);
        else                                   
	           $list .= $trade_group->DisplayTradeGroup($cUser->member_role);
            
	$p->DisplayPage($list);
	

	
?>
	
