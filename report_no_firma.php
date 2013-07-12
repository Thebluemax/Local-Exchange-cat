<?
	include_once("includes/inc.global.php");
	
	include("classes/class.table.php");
	
	$p->site_section = ADMINISTRATION;
	$p->page_title = "Asociados/as (personas inscritas) que nunca han entrado en el sistema: ";
	
	$cUser->MustBeLevel(1);
	
	$output = "";
	
	$table = new cTable;
	$table->AddSimpleHeader(array("Asociado/a", "Fecha de inscripción", "Teléfonos", "Email(s)"));
	// $table->SetFieldAlignRight(4);  // row 4 is numeric and should align to the right
	
	$allmembers = new cMemberGroup;
	$allmembers->LoadMemberGroup();
	
	foreach($allmembers->members as $member) {
		if($member->account_type == "F")  // Skip fund accounts
			continue;
			
		$history = new cLoginHistory;
	//	if(! $history->LoadLoginHistory($member->member_id)) { // Have they logged in?
	if($member->status="X") { // 
			$join_date = new cDateTime($member->join_date);
			$data = array($member->PrimaryName(), $join_date->ShortDate(), $member->AllPhones(), $member->AllEmails());
			$table->AddSimpleRow($data);
		}
	}
	
	$output = $table->DisplayTable();
	
	if($output == "")
		$output = "Todos los/as asociados/as han entrado en el sistema al menos una vez.";
	
	$p->DisplayPage($output);
	
?>
