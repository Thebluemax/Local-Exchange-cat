<?

if (!isset($global))
{
    die(__FILE__." was included directly.  This file should only be included via inc.global.php.  Include() that one instead.");
}

/**********************************************************/
/******************* SITE LOCATIONS ***********************/

// What is the domain name of the site?  
define ("SERVER_DOMAIN","valkirya.atwebpages.com");    // no http://

// What is the path to the site? This is null for many sites.
define ("SERVER_PATH_URL","/original");    // no ending slash

// The following only needs to be set if Pear has been
// installed manually by downloading the files
//define ("PEAR_PATH", "C:\wamp\www\bdt\pear"); // no ending slash
define ("PEAR_PATH", $_SERVER["DOCUMENT_ROOT"].SERVER_PATH_URL."/pear");
//define ("PEAR_PATH", "/bdt/pear");
// Ok, then lets define some paths (no need to edit these)
define ("HTTP_BASE",SERVER_DOMAIN.SERVER_PATH_URL);
define ("CLASSES_PATH",$_SERVER["DOCUMENT_ROOT"].SERVER_PATH_URL."/classes/");
define ("IMAGES_PATH",SERVER_DOMAIN.SERVER_PATH_URL."/images/");
//define ("UPLOADS_PATH",$_SERVER["DOCUMENT_ROOT"].SERVER_PATH_URL."/uploads/");
/**********************************************************/
/***************** DATABASE LOGIN  ************************/

define ("DATABASE_USERNAME","1038356_tempsbd");
define ("DATABASE_PASSWORD","m4ax474");
define ("DATABASE_NAME","1038356_tempsbd");
define ("DATABASE_SERVER","fdb2.awardspace.com"); // often "localhost"

/**********************************************************/
/********************* SITE NAMES *************************/

// What is the name of the site?
define ("SITE_LONG_TITLE", "Banc del Temps de Salt");

// What is the short, friendly, name of the site?
define ("SITE_SHORT_TITLE", "BdT SALT");

/**********************************************************/
/***************** FOR MAINTENANCE ************************/

// If you need to take the website down for maintenance (such
// as during an upgrade), set the following value to true
// and customize the message, if you like

define ("DOWN_FOR_MAINTENANCE", false);
define ("MAINTENANCE_MESSAGE", SITE_LONG_TITLE ." está llevando a cabo tareas de mantenimiento.  Por favor, vuelva más tarde.");

/**************************************************************/
/******************** SITE CUSTOMIZATION **********************/

// email addresses & phone number to be listed in the site
define ("EMAIL_FEATURE_REQUEST","Banc del Temps de SALT". "<max@maximilianofernandez.net>");
define ("EMAIL_ADMIN","Banc del Temps de Salt "."<max@maximilianofernandez.net>");
define ("PHONE_ADMIN","Banc del Temps de Salt ". "<max@maximilianofernandez.net"); // an email address may be substituted...
define ("EMAIL_FROM","Banc del Temps de Salt"."<max@maximilianofernandez.net"); // to override EMAIL_ADMIN 
                                                                                // for replies

// What should appear at the front of all pages?
// Titles will look like "PAGE_TITLE_HEADER - PAGE_TITLE", or something 
// like "Local Exchange - Member Directory";
define ("PAGE_TITLE_HEADER", SITE_LONG_TITLE);

// What keywords should be included in all pages?
//define ("SITE_KEYWORDS", "Santa Eugenia, Sant Narcis, Girona,Banc del temps,trueque,intercambio,".SITE_LONG_TITLE);
define ("SITE_KEYWORDS", " Salt, Girona, Banc del temps, banc del temps salt, Trueque, Compartir, intercambio,".SITE_LONG_TITLE);

// Logo Graphic for Header
define ("HEADER_LOGO", "imagenLogo.png");
define ("HEADER_LOGO2", "aldaurilogo.jpg");

// Title Graphic for Header
define ("HEADER_TITLE", "localx_title.png");

// Logo for Home Page
define ("HOME_LOGO", "localx_black.png");

// Picture appearing left of logo on Home Page
define ("HOME_PIC", "localx_home.png");

// What content should be in the site header and footer?
//define ("PAGE_HEADER_CONTENT", "<table align=center cellpadding=15 cellspacing=0 id=\"mainTable\"><tr><td id=\"header\" align=center><img style='padding-right:5px' src=\"http://".HTTP_BASE."/images/". HEADER_LOGO ."\" alt=\"". SITE_SHORT_TITLE . " logo\"></td><td id=\"header\"><h1 align=right><br>Banco de tiempo - Konekta<br>");


// define ("PAGE_HEADER_CONTENT", "<table align=center cellpadding=15 cellspacing=0 id=\"mainTable\"><tr><td colspan='2'><table><tr><td id=\"header\" align=center><img  src=\"http://".HTTP_BASE."/images/". HEADER_LOGO ."\" alt=\"". SITE_SHORT_TITLE . " logo\"></td><td id=\"header\"><h1 align=right><br>Banco de tiempo - Konekta<br></td></tr></table>");


// Posibilidad de añadir    <img src=\"http://".HTTP_BASE."/images/". HEADER_LOGO2 ."\" alt=\"". SITE_SHORT_TITLE . " logo\">

// (ORIGINAL)
define ("PAGE_HEADER_CONTENT", "<table align=center cellpadding=15 cellspacing=0 id=\"mainTable\"><tr><td id=\"header\" align=center ><img src=\"http://".HTTP_BASE."/images/". HEADER_LOGO ."\" alt=\"". SITE_SHORT_TITLE . " logo\"></td><td id=\"header\" class=\"fondoCabecera\"><img src=\"http://".HTTP_BASE."/images/". HEADER_TITLE ."\"><br>");

define ("PAGE_FOOTER_CONTENT", "<tr><td id=\"footer\" colspan=2><p align=center><a href='http://bancdeltempsdesalt.blogspot.com.es/'><strong>Visita el blog de ". SITE_LONG_TITLE ." </strong></a><br>


 </strong></a>
 
 
 
 <table  border=\"0\" align=\"center\">
  <tr>
  <td><div align=\"center\"><a href=\"http://projecteicisalt.wordpress.com/\" target=\"_blank\"><img src=\"http://".HTTP_BASE."/images/logoIci.png\" border=\"0\"></a></div></td>
   <td><div align=\"center\"><a href=\"http://www.mouteenbici.es/\" target=\"_blank\"><img src=\"http://".HTTP_BASE."/images/bici.png\" border=\"0\"></a></div></td>
   <td><div align=\"center\"><a href=\"http://www.veinsdesalt.org/\" target=\"_blank\"><img src=\"http://".HTTP_BASE."/images/bvell.png\" border=\"0\"></a></div></td>
   <td><div align=\"center\"><a href=\"http://www.veinsdesalt.org/\" target=\"_blank\"><img src=\"http://".HTTP_BASE."/images/vecinos.png\" border=\"0\"></a></div></td>
   <td><div align=\"center\"><a href=\"http://www.facebook.com/associacio.senecat\" target=\"_blank\"><img src=\"http://".HTTP_BASE."/images/seneg.png\" border=\"0\"></a></div></td>
  </tr>
</table>

<font size=\"-2\"> Creat sota <a href=\"http://www.gnu.org/copyleft/gpl.html\">GPL</a> &#8226; <a href=\"http://". SERVER_DOMAIN . SERVER_PATH_URL ."/info/credits.php\">Credits</a><font><br>

</td></tr></table><br>");  

// (ORIGINAL)
// define ("PAGE_FOOTER_CONTENT", "<tr><td id=\"footer\" colspan=2><p align=center><strong>". SITE_LONG_TITLE ." </strong>&#8226; <a href=\"http://". SERVER_DOMAIN . SERVER_PATH_URL ."\">". SERVER_DOMAIN ."</a><br><a href=\"mailto:". EMAIL_ADMIN ."\">" . EMAIL_ADMIN ."</a> &#8226; ". PHONE_ADMIN ."<br><font size=\"-2\">Licensed under the <a href=\"http://www.gnu.org/copyleft/gpl.html\">GPL</a> &#8226; Local Exchange <a href=\"http://". SERVER_DOMAIN . SERVER_PATH_URL ."/info/credits.php\">Credits</a></td></tr></table><br>");

/**********************************************************/
/**************** DEFINE SIDEBAR MENU *********************/

$SIDEBAR = array (
    array("Principal","index.php"),
    array("Què és el banc ?","info/nosotros.php"),
    array("Ofertes","listings.php?type=Offer"),
    array("Demandes","listings.php?type=Want"),
    array("Contacta","contact.php"),
    array("Fes-te'n Soci/a","member_self.php"));

// El resto de opciones está en classes/class.page.php
    
/**********************************************************/
/**************** DEFINE SITE SECTIONS ********************/

define ("EXCHANGES",0);
define ("LISTINGS",1);
define ("EVENTS",2);
define ("ADMINISTRATION",3);
define ("PROFILE",4);
define ("SECTION_FEEDBACK",5);
define ("SECTION_EMAIL",6);
define ("SECTION_INFO",7);
define ("SECTION_DIRECTORY",8);

$SECTIONS = array (
    array(0, "Exchanges", "exchange.gif"),
    array(1, "Listings", "listing.png"),
    array(2, "Events", "news.png"),
    array(3, "Administration", "admin.png"),
    array(4, "Events", "member.png"),
    array(5, "Feedback", "feedback.png"),
    array(6, "Email", "contact.png"),
    array(7, "Info", "info.png"),
    array(8, "Directory", "directory.png"));

/**********************************************************/
/******************* GENERAL SETTINGS *********************/

define ("USE_RATES", false); // If turned on, listings will include a "Rate" field
define ("UNITS", "Horas");  // This setting affects functionality, not just text displayed, so if you want to use hours/minutes this needs to read "Hours" exactly.  All other unit descriptions are ok, but receive no special treatment (i.e. there is no handling of "minutes").
define ("MAX_FILE_UPLOAD","5000000"); // Maximum file size, in bytes, allowed for uploads to the server
define ("EMAIL_LISTING_UPDATES", true); // Should users receive automatic updates
                                                     // for new and modified listings?
define ("DEFAULT_UPDATE_INTERVAL", WEEKLY); // If automatic updates are sent, this is
                                                     // the default interval. Possible
                                                     // values are NEVER, DAILY, WEEKLY & MONTHLY.
// The following text will appear at the beggining of the email update messages
define ("LISTING_UPDATES_MESSAGE", "Les següents ofertes i demandes són noves o s'han actualitzat. <p> Si prefereixes no rebre correus electrònics automàtics, o si vols canviar la seva freqüència, pots fer-ho en l'àrea de <a href=http://".HTTP_BASE."/member_edit.php?mode=self>Perfil</a>.");

// Should inactive accounts have their listings automatically expired?
// This can be a useful feature.  It is an attempt to deal with the 
// age-old local currency problem of new members joining and then not 
// keeping their listings up to date or using the system in any way.  
// It is designed so that if a member doesn't record a trade OR update 
// a listing in a given period of time (default is six months), their 
// listings will be set to expire and they will receive an email to 
// that effect (as will the admin).
define ("EXPIRE_INACTIVE_ACCOUNTS",false); 

// If above is set, after this many days, accounts that have had no
// activity will have their listings set to expire.  They will have 
// to reactiveate them individually if they still want them.
define ("MAX_DAYS_INACTIVE","180");  

// How many days in the future the expiration date will be set for
define ("EXPIRATION_WINDOW","15");    

// How long should expired listings hang around before they are deleted?
define ("DELETE_EXPIRED_AFTER","90"); 

// The following message is the one that will be emailed to the person 
// whose listings have been expired (a delicate matter).
define ("EXPIRED_LISTINGS_MESSAGE", "Hola,\n\nDebido a la inactividad, tu cuenta ".SITE_SHORT_TITLE." ha expirado hace ". EXPIRATION_WINDOW ." días.\n\nPara que ".SITE_LONG_TITLE." esté actualizado y funcionando correctamente para todos los miembros, hemos desarrollado un sistema automático de finalización de cuentas para miembros que no han hecho cambios durante un periodo de ".MAX_DAYS_INACTIVE." días. Queremos que el directorio esté actualizado, así que los miembros no encontrarán cuentas que estén fuera de este periodo. Esto funciona para el beneficio común.\n\nLamentamos cualquier inconveniencia que te haya podido causar y te agradecemos tu participación. \n\n En todo caso, tienes ". EXPIRATION_WINDOW ." días para entrar con tu contraseña y reactivar las cuentas que quieres que sigan funcionando en el directorio. Si no las reactivas durante este plazo, tus cuentas no volverán a aparecer en el directorio, pero segirán almacenadas en el sistema durante ". DELETE_EXPIRED_AFTER ." días, plazo de tiempo durante el cual aún puedes editar y reactivar las cuentas. \n\n\nInstrucciones para reactivación:\n1) Entrar con tu contraseña\n2) Ir a Actualizar Cuentas\n3) Selecciona Editar Cuentas\n4) Selecciona la cuenta\n5) Desactiva el cuadradito correspondiente a '¿Se pondrá esta cuenta para finalización automática?'\n6) Pulsa Actualizar\n7) Repite los pasos 1-6 para todas las cuentas que quieres reactivar. \n");

// The year your local currency started -- the lowest year shown
// in the Join Year menu option for accounts.
define ("JOIN_YEAR_MINIMUM", "2010");  

define ("DEFAULT_COUNTRY", "Girona");
define ("DEFAULT_ZIP_CODE", "17006");
define ("DEFAULT_CITY", "Girona");
define ("DEFAULT_STATE", "WA");
define ("DEFAULT_PHONE_AREA", "360");

// Should short date formats display month before day (US convention)?
define ("MONTH_FIRST", false);        

define ("PASSWORD_RESET_SUBJECT", "Tu cuenta ". SITE_LONG_TITLE ." ");
define ("PASSWORD_RESET_MESSAGE", "La teva contrasenya per ". SITE_LONG_TITLE ." ha estat reseteada. Si no havies demanat aquest reseteo, és possible que hi hagi hagut algun problema amb el teu compte; posa't en contacte amb la persona administradora en ".PHONE_ADMIN.".\n\nLa teva nova contrasenya és al final d'aquest missatge. Pots canviar la teva contrasenya entrant en el sistema i anant al perfil d'associat.");
define ("NEW_MEMBER_SUBJECT", "Benvingut ". SITE_LONG_TITLE);
define ("NEW_MEMBER_MESSAGE", "Hola i benvingut a la comunitat ". SITE_LONG_TITLE ."\n\nS'ha creat un compte d'associat per a tu an :\nhttp://".SERVER_DOMAIN.SERVER_PATH_URL."/member_login.php\n\nSi us plau, entra al sistema i crea les teves ofertes i demandes. El teu identificador d'usuari i contrasenya estan al final d'aquest missatge. Podràs canviar la teva contrasenya entrant al sistema i anant al perfil d'associat.\n\n. Hauràs de passar per Hotel Entitats de Salt, despatx 1.0
Carrer Sant Dionís, 42.\n\n.Gràcies per unir-te al Banc del Temps. ");
define ("NEW_MEMBER_PENDING", "Hola i benvingut a la comunitat ". SITE_LONG_TITLE ."\n\nS'ha creat un compte d'associat per a tu a :\nhttp://".SERVER_DOMAIN.SERVER_PATH_URL."/member_login.php\n\nDe moment no pots entrar al Banc del Temps fins que l'administrador us autoritzi en el sistema. El teu identificador d'usuari i contrasenya estan al final d'aquest missatge. Podràs canviar la teva contrasenya entrant al sistema i anant al perfil d'associat.\n\n\n\n Hauràs de passar per Hotel Entitats de Salt, despatx 1.0
Carrer Sant Dionís, 42 . Gràcies per unir-te al Banc del Temps. ");  
define ("ACTIVE_MEMBER_SUBJECT", "Compte activada a ". SITE_LONG_TITLE); 
define ("ACTIVE_MEMBER_MESSAGE", "Hola i benvingut a la comunitat ". SITE_LONG_TITLE ."\n\nS'ha activat el compte d'associat per a tu a:\nhttp://".SERVER_DOMAIN.SERVER_PATH_URL."/member_login.php\n\nSi us plau, entra al sistema i crea les teves ofertes i demandes. El teu identificador d'usuari està al final d'aquest missatge. \n\n Pots canviar la teva contrasenya entrant al sistema i anant al perfil d'associat. \n\n\n Hauràs de passar per Hotel Entitats de Salt, despatx 1.0
Carrer Sant Dionís, 42. \n\nGràcies per unir-te al Banc del Temps. ");
/********************************************************************/
/************************* ADVANCED SETTINGS ************************/
// Normally, the defaults for the settings that follow don't need
// to be changed.

// What's the name and location of the stylesheet?
define ("SITE_STYLESHEET", "style.css");

// How long should trades be listed on the "leave feedback for 
// a recent exchange" page?  After this # of days they will be
// dropped from that list.
define ("DAYS_REQUEST_FEEDBACK", "30"); 

// Is debug mode on? (display errors to the general UI?)
define ("DEBUG",true);

// Should adminstrative activity be logged?  Set to 0 for no logging; 1 to 
// log trades recorded by administrators; 2 to also log changes to member 
// settings (LEVEL 2 NOT YET IMPLEMENTED)
define ("LOG_LEVEL", 1);

// How many consecutive failed logins should be allowed before locking out an account?
// This is important to protect against dictionary attacks.  Don't set higher than 10 or 20.
define ("FAILED_LOGIN_LIMIT", 10);

// Are magic quotes on?  Site has not been tested with magic_quotes_runtime on, 
// so if you feel inclined to change this setting, let us know how it goes :-)
define ("MAGIC_QUOTES_ON",false);
set_magic_quotes_runtime (0);

// CSS-related settings.  If you'r looking to change colors, 
// best to edit the CSS rather than add to this...
$CONTENT_TABLE = array("id"=>"contenttable", "cellspacing"=>"0", "cellpadding"=>"3");

// System events are processes which only need to run periodically,
// and so are run at intervals rather than weighing the system
// down by running them each time a particlular page is loaded.
// System Event Codes (such as ACCOUNT_EXPIRATION) are defined in inc.global.php
// System Event Frequency (how many minutes between triggering of events)
$SYSTEM_EVENTS = array (
    ACCOUT_EXPIRATION => 1440);  // Expire accounts once a day (every 1440 minutes)


/**********************************************************/
//    Everything below this line simply sets up the config.
//    Nothing should need to be changed, here.

if (PEAR_PATH != "")
    ini_set("include_path", PEAR_PATH .'/'. PATH_SEPARATOR . ini_get("include_path"));  
 

if (DEFAULT_COUNTRY == "United States") {
    define ("ZIP_TEXT", "Zip Code");
    define ("STATE_TEXT", "State");
} else {
    define ("ZIP_TEXT", "Código postal");
    define ("STATE_TEXT", "Region");
}

if (DEBUG) error_reporting(E_ALL);
    else error_reporting(E_ALL ^ E_NOTICE);

define("LOAD_FROM_SESSION",-1);  // Not currently in use

// URL to PHP page which handles redirects and such.
define ("REDIRECT_URL",SERVER_PATH_URL."/redirect.php");

define ("AVISO_LEGAL",'<p>&nbsp;</p>
<p>&nbsp;</p><p><font face="Arial" color="#336699" size="1"><strong>AVISO LEGAL</strong>.-
La información contenida en este correo electrónico es
para el uso exclusivo de la/s persona/s mencionadas como destinataria/s. Este
correo electrónico y los archivos adjuntos, en su caso, contienen información
confidencial y/o protegida legalmente por leyes de propiedad intelectual o por
otras leyes. Este mensaje no constituye ningún compromiso por parte de la
persona remitente, salvo que exista expreso pacto en contrario, previo y por
escrito entre la persona destinataria y la remitente. Si usted no es la persona
destinataria designada y recibe este mensaje por error, por favor, notifíquelo
a la persona remitente con la mayor brevedad posible a la siguiente dirección:(info@bancdeltempsdesalt.org) y proceda inmediatamente a su total destrucción. Así mismo, le informamos de que no debe, directa o indirectamente, usar, distribuir,
reproducir, imprimir o copiar, total o parcialmente este mensaje si no es la persona destinataria designada.<br>
<br>
<b>AVIS LEGAL</b> - La informació continguda en aquest correu electrònic és
per a l ús exclusiu de la / les persona / es esmentades com a destinatària / s. Aquest correu electrònic i els arxius adjunts, si escau, contenen informació confidencial i / o protegida legalment per lleis de propietat intel lectual o per altres lleis. Aquest missatge no constitueix cap compromís per part de la
persona remitent, llevat que hi hagi exprés pacte en contra, previ i per escrit entre la persona destinatària i la remitent. Si no és la persona destinatària designada i rep aquest missatge per error, si us plau, notifiqui a la persona remitent el més aviat possible a la següent adreça: (info@bancdeltempsdesalt.org) i procedeixi immediatament a la seva total destrucció. Així mateix, l informem que no deu, directament o indirectament, utilitzar, distribuir, reproduir, imprimir o copiar, totalment o parcialment aquest missatge si no és la persona destinatària designada..<br>
<br>
<b>DISCLAIMER </b>- The information contained in this email is for the exclusive
use of the person(s) mentioned as addressee(s). This email and the attached
files, where appropriate, contain confidential information and/or information
legally protected by intellectual property laws or other laws. This message does
not constitute any commitment on the part of the sender, except where there
exists prior express agreement to the contrary in writing between the addressee
and the sender. If you are not the designated addressee and receive this message
by mistake, please notify the sender as soon as possible at the following
address (bancdeltemps@eldimoni.com) and then delete it immediately. We also inform you
that you may not use, distribute, print or copy this message, either directly or
indirectly or totally or partially, if you are not the designated addressee</font></p>');

define ("LOPD",'<p>&nbsp;</p>
<p><font face="Arial" color="#990000" size="1"><b><font color="#660000">AVISO LEGAL</font></b><font color="#660000"> -
  De conformitat amb el que disposa la Llei Orgànica 15/1999, de 13 de desembre, de Protecció de Dades de caràcter personal, El Banc del Temps Pont del Dimoni, l informa que les dades que vostè va remetre estan incorporades a un fitxer de la seva titularitat té com a finalitat la participació en el Banc del Temps Pont del Dimoni.
El Banc del Temps de Salt es compromet a complir la seva obligació de guardar secret respecte de les dades de caràcter personal que figuren en el mateix i garanteix l adopció de les mesures de seguretat necessàries per vetllar per la confidencialitat d aquestes dades, que conservarà durant un període de dos anys des que vostè el va enviar, acabat el període es procedirà a la seva cancel.lació.
Se li reconeix la possibilitat d exercitar gratuïtament els drets d accés, rectificació, cancel.lació i oposició, en els termes previstos en la Llei Orgànica 15/1999, a l adreça dalt indicada.
Transcorreguts vuit dies des de l emissió d aquesta comunicació sense el teu manifesti res en contra, El Banc del Temps de Salt s entendrà que autoritza el tractament de les seves dades en els termes indicats. </font><br>
</font></p>');

define("ROTULO_MAIL", '<TABLE width="100%" border="0" cellPadding="0" cellSpacing="0" valign="middle"><TBODY><TR><TD width="100%" style="padding-left: 9px;font-family: Arial,Helvetica,sans-serif;background-color: #D6E7FC;">    
    <table width="98%" height="61" border="0" cellpadding="0" cellspacing="0" valign="middle">
    <tbody>
      <tr>
        <td style="PADDING-RIGHT: 7px; PADDING-LEFT: 8px; FONT-WEIGHT: bold; FONT-SIZE: 25px; COLOR: #fff; FONT-FAMILY: Arial,Helvetica,sans-serif; BACKGROUND-COLOR: #666666" align="middle">&gt;</td>
        <td width="100%" style="color: #000000;font-size: 18px;PADDING-LEFT: 8px;"><strong> Banc del Temps de Salt </strong></td>
      </tr>
    </tbody>
  </table>
          <span style="font-size: 12px; font-weight: bold; color: #666666;">Salt</span></TD>
      </TR>
</TBODY>
</TABLE><p>&nbsp;</p>');
?>
