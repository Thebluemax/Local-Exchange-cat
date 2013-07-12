<?

include_once("includes/inc.global.php");
$p->site_section = PROFILE;

$member = new cMember;
$member->LoadMember($_REQUEST["member_id"]);

$p->page_title = "Informació general de ".$member->PrimaryName();

include_once("classes/class.listing.php");

$output = "<STRONG><I>INFORMACIÓ DE CONTACTE</I></STRONG><P>";

//@mxml13-16-03-2013- le enviamos nivel de segurtidad del usuario para restringir datos.
$output .= $member->DisplayMember($cUser->member_role);

$output .= "<BR><P><STRONG><I>OFERTES</I></STRONG><P>";
$listings = new cListingGroup(OFFER_LISTING);
$listings->LoadListingGroup(null, null, $_REQUEST["member_id"]);
$output .= $listings->DisplayListingGroup();

$output .= "<BR><P><STRONG><I>DEMANDES</I></STRONG><P>";
$listings = new cListingGroup(WANT_LISTING);
$listings->LoadListingGroup(null, null, $_REQUEST["member_id"]);
$output .= $listings->DisplayListingGroup();

$p->DisplayPage($output); 

?>
