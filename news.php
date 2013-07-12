<?
include_once("includes/inc.global.php");
include("classes/class.news.php");
include("classes/class.uploads.php");

$p->site_section = EVENTS;
$p->page_title = "Noticias y eventos";

$output = "<P><BR>";

$news = new cNewsGroup();
$news->LoadNewsGroup();
$newstext = $news->DisplayNewsGroup();
if($newstext != "")
	$output .= $newstext;
else
	$output .= "Próximamente os contaremos novedades sobre el Banco de Tiempo.<P>";

$newsletters = new cUploadGroup("N");

if($newsletters->LoadUploadGroup()) {
	$output .= "<I>Para leer las últimas novedades de  ". SITE_SHORT_TITLE . ", pulsa <A HREF=newsletters.php>aquí</A>.</I>";
}

$p->DisplayPage($output);


?>
