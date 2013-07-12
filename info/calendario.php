<?

include_once("../includes/inc.global.php");
$p->site_section = LISTINGS;
$p->page_title = "Calendari";

print $p->MakePageHeader();
print $p->MakePageMenu();
print $p->MakePageTitle();

?>
<iframe src="https://www.google.com/calendar/embed?hl=ca&src=ild17h7g2jusprlbb9oldjkgd0%40group.calendar.google.com&ctz=Europe/Madrid" style="border: 0" width="700" height="600" frameborder="0" scrolling="no"></iframe>
 

<?

print $p->MakePageFooter();

?>
