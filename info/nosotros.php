<?

include_once("../includes/inc.global.php");
$p->site_section = LISTINGS;
$p->page_title = ">Què és el banc del temps?";

print $p->MakePageHeader();
print $p->MakePageMenu();
print $p->MakePageTitle();

?>
<ul>
  <li><strong><a href='info/que_es.php'>Què és el banc del temps?</a><br>
    <br>
  </strong></li>
  <li><strong><a href='info/como_funciona.php'>Com funciona el banc del temps?</a><br>
    <br></strong></li>
  <li><strong><a href='info/tipos_de_intercambio.php'>Tipus d'intercanvi</a><br><br></strong></li>
  <li><strong><a href='info/condiciones_de_uso.php'>Condicions d'ús</a><br>
   
  </strong></li>
</ul>
 

<?

print $p->MakePageFooter();

?>