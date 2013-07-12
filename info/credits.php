<?

include_once("../includes/inc.global.php");
$p->site_section = LISTINGS;
$p->page_title = "Crèdits";

print $p->MakePageHeader();
print $p->MakePageMenu();
print $p->MakePageTitle();

?>

  <A HREF="http://sourceforge.net/projects/local-exchange/">Local Exchange 0.3.2</A>.Aquest software està desenvolupat per Calvin Priest en el any 2005<p>

S'ha encarregat de la seva adaptació: Borja Aguirre i Aitor Blázquez.<p>

Adaptació a BdT Pont del Dimoni: Pilar M.<p>

Traducció al català : Pablo L.<p>

Va treballar per a la versió el Bdt de Salt: Max F (@mxml13).

<?

print $p->MakePageFooter();

?>
