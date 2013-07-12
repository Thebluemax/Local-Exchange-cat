<?
include_once("includes/inc.global.php");
$p->site_section = SITE_SECTION_OFFER_LIST;

if($cUser->IsLoggedOn())
{
	$list = "Benvingut a". SITE_LONG_TITLE .", ". $cUser->PrimaryName() ."!";
}
else 
{
	$list = $cUser->UserLoginPage();
}

$p->DisplayPage($list);

?>
