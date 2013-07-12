<?php

include_once("includes/inc.global.php");
	
include("classes/class.feedback.php");
	
$cUser->MustBeLoggedOn();
	
if($_REQUEST["mode"] == "other") 
	$member_id = $_REQUEST["member_id"];
else
	$member_id = $cUser->member_id;
	
$p->site_section = SECTION_FEEDBACK;
$member = new cMember;
$member->LoadMember($member_id);
$p->page_title = "Valoració de : ". $member->PrimaryName();

$feedbackgrp = new cFeedbackGroup;
$feedbackgrp->LoadFeedbackGroup($member_id);

if (isset($feedbackgrp->feedback)) {
    $output = "<p> A continuació es detallen com han valorat a aquest usuari altres membres del Banc. La primera columna indica si el vot ha estat positiu, negatiu o neutral, i 'De' indica qui l'ha emès. El 'context' indica si ". $member->PrimaryName()." va actuar com a comprador (demandant de serveis) o com a venedor (proveïdor de serveis) i la categoria del servei.</p>"; 
	$output .= $feedbackgrp->DisplayFeedbackTable($cUser->member_id);
} else  {
	if($_REQUEST["mode"] == "self")
		$output = "Encara no tens cap valoració.";
	else
		$output = "Aquesta persona no té cap valoració encara.";
}

$p->DisplayPage($output);
	
?>	
