<?

include_once("includes/inc.global.php");
$p->site_section = SITE_SECTION_OFFER_LIST;

print $p->MakePageHeader();
print $p->MakePageMenu();

include("classes/class.news.php");
include("classes/class.uploads.php");


?>

<table cellpadding=0 cellspacing=2>
 <tr>
 <td><!--<img src="images/<? echo HOME_PIC ?>" align=top>--></td>
 <td><h2> Banc del Temps de Salt </h2></td>

 </tr>
</table>


<img id="foto_tapa" src="images/banco-tiempo2.png" align=center>

<p><strong><a href='contact.php'><em>Inscripció als tallers </em></a></strong></p>
<p>&nbsp;</p>
 <!-- movido a otra página dejamos para futuras generaciones @mxml13 març 2013
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
-->
<?

//un poco de estilo para las ultimas novetas
/*$output="<iframe src='https://www.google.com/calendar/embed?src=ild17h7g2jusprlbb9oldjkgd0%40group.calendar.google.com&ctz=Europe/Madrid' style='border: 0' width='700' height='600' frameborder='0' scrolling='no'></iframe>";*/

$output = "<BR><h2 class='novetats' >Últimes novetats</h2><p>";

$news = new cNewsGroup();
$news->LoadNewsGroup();
$newstext = $news->DisplayNewsGroup();
if($newstext != "")
    $output .= $newstext;
else
    $output .= "Properament us explicarem novetats sobre el Banc de Temps.<P>";

$newsletters = new cUploadGroup("N");

if($newsletters->LoadUploadGroup()) {
    $output .= "<I>Para leer las últimas novedades de  ". SITE_SHORT_TITLE . ", pulsa <A HREF=newsletters.php>aquí</A>.</I>";
}

echo $output;

print $p->MakePageFooter(); 
//  Cabecera original

?>
