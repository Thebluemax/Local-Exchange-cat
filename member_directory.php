<?

include_once("includes/inc.global.php");
$p->site_section = SECTION_DIRECTORY;
$p->page_title = "Directori de membres";

$cUser->MustBeLoggedOn();

//include_once("classes/class.listing.php");
/* corrección de encvabezado
$output = "<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=3 WIDTH=\"100%\"><TR BGCOLOR=\"#d8dbea\"><TD><FONT SIZE=2><B>Soci/a</B></FONT></TD><TD><FONT SIZE=2><B>Telèfon</B></FONT></TD><TD><FONT SIZE=2><B>Email</B></FONT></TD><TD><FONT SIZE=2><B>Ciutat</B></FONT></TD></TR>";
*/
$output = "<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=3 WIDTH=\"100%\"><TR BGCOLOR=\"#d8dbea\"><TD><FONT SIZE=2><B>Soci/a</B></FONT></TD><TD><FONT SIZE=2><B>Email</B></FONT></TD><TD><FONT SIZE=2><B>Ciutat</B></FONT></TD></TR>";

//Phones (comma separated with first name in parentheses for non-primary phones)
//Emails (comma separated with first name in parentheses for non-primary emails)

$member_list = new cMemberGroup();
$member_list->LoadMemberGroup();

$i=0;

if($member_list->members) {
	foreach($member_list->members as $member) {
		if($member->account_type != "F") {  // Don't display fund accounts
			if($i % 2)
				$bgcolor = "#e4e9ea";
			else
				$bgcolor = "#FFFFFF";
	/*
	*
	*Sacamos los número de telefono de las listas
			$output .= "<TR VALIGN=TOP BGCOLOR=". $bgcolor ."><TD><FONT SIZE=2>". $member->AllNames()." (". $member->MemberLink() .")</FONT></TD><TD><FONT SIZE=2>". $member->AllPhones() ."</FONT></TD><TD><FONT SIZE=2>". $member->AllEmails() ."&nbsp;</FONT></TD><TD><FONT SIZE=2>". $member->person[0]->address_city ."</FONT></TD></TR>";*/
			$output .= "<TR VALIGN=TOP BGCOLOR=". $bgcolor ."><TD><FONT SIZE=2>". $member->AllNames()." (". $member->MemberLink() .")</FONT></TD><TD><FONT SIZE=2>". $member->AllEmails() ."&nbsp;</FONT></TD><TD><FONT SIZE=2>". $member->person[0]->address_city ."</FONT></TD></TR>";
			$i+=1;
		}
	}
}

$output .= "</TABLE>";

$p->DisplayPage($output); 

include("includes/inc.events.php");
?>
