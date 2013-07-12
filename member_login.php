<?
include_once("includes/inc.global.php");
$p->site_section = SITE_SECTION_OFFER_LIST;

if($cUser->IsLoggedOn())

//esto lo quito para que me aparezca el menu principal debajo
 {
	$list = "Benvingut a el ". SITE_LONG_TITLE .", ". $cUser->PrimaryName() ."!";
}

else 
{
	$list = $cUser->UserLoginPage();
}

$p->DisplayPage($list);

?>
