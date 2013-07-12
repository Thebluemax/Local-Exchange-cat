<?

if (!isset($global))
{
	die(__FILE__." was included without inc.global.php being included first.  Include() that file first, then you can include ".__FILE__);
}

class cPage {
	var $page_title;
	var $page_title_image; // Filename, no path
	var $page_header;	// HTML
	var $page_footer;	// HTML
	var $keywords;		
	var $site_section;
	var $sidebar_buttons; 	// An array of cMenuItem objects
	var $top_buttons;			// An array of cMenuItem objects    TODO: Implement top buttons...

	function cPage() {
		global $cUser, $SIDEBAR;
		
		$this->keywords = SITE_KEYWORDS;
		$this->page_header = PAGE_HEADER_CONTENT;
		$this->page_footer = PAGE_FOOTER_CONTENT;
		
		foreach ($SIDEBAR as $button) {
			$this->AddSidebarButton($button[0], $button[1]);
		}

		if ($cUser->IsLoggedOn()) {	
			$this->AddSidebarButton("<div style='font-weight:bold'>Les meves Ofertes</div>", "listings_menu_ofertas.php");
			$this->AddSidebarButton("<div style='font-weight:bold'>Les meves Demandes</div>", "listings_menu_demandas.php");
			$this->AddSidebarButton("<div style='font-weight:bold'>Intercanvi</div>", "exchange_menu.php");
			$this->AddSidebarButton("<div style='font-weight:bold'>Membres</div>", "member_directory.php");
			$this->AddSidebarButton("<div style='font-weight:bold'>Perfil</div>", "member_profile.php");
			//$this->AddSidebarButton("<div style='font-weight:bold'>Altres</div>", "listings_menu_otros.php");
		}

		if ($cUser->member_role > 0) 
			$this->AddSidebarButton("<div style='font-weight:bold'>Administració</div>", "admin_menu.php");

	}		
									
	function AddSidebarButton ($button_text, $url) {
		$this->sidebar_buttons[] = new cMenuItem($button_text, $url);
	}
	
	function AddTopButton ($button_text, $url) { // Top buttons aren't integrated into header yet...
		$this->top_buttons[] = new cMenuItem($button_text, $url);
	}

	function MakePageHeader() {
		global $cUser;
		
		if(isset($this->page_title)) 
			$title = " - ". $this->page_title;
		else
			$title = "";
		
		$output = '<HEAD><meta name="verify-v1" content="NpBtG7ofqLlzGzlObZCsIkXggmaMlPANDCqjDGgEa6E=" />
		
		<link rel="SHORTCUT ICON" href="http://'. HTTP_BASE .'/images/favicon.ico" />
		
		<link rel="stylesheet" href="http://'. HTTP_BASE .'/'. SITE_STYLESHEET .'" type="text/css"></link>
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html;CHARSET=UTF-8"><meta name="description" content="'.$this->page_title.'"><meta NAME="keywords" content="'. $this->keywords .'"><TITLE>'. PAGE_TITLE_HEADER . $title .'</TITLE></HEAD>';
		
		$output .= "<HTML><BODY>";
             
        $output .= $this->page_header;
        $output .= "<div id='user_box' align=right>";
         if ($cUser->IsLoggedOn())
        $output .= "<B>". $cUser->PrimaryName(). "</B>";
        $output .= $cUser->UserLoginLogout();                                   
        $output .= "</div></td></tr>";    
		return $output;  
	}

	function MakePageMenu() {
		global $cUser, $cSite, $cErr;
	
		$output = "<td valign=top id=\"sidebar\"><ul>";
	
		foreach ($this->sidebar_buttons as $menu_item) {

				$output .= $menu_item->DisplayButton();

		}
// TO DO:  En el siguiente if he cambiado  $_SESSION["REQUEST_URI"]  por   SERVER_PATH_URL."/member_login.php  
// porque no leía la sesión.
		if (!$cUser->IsLoggedOn())
			$output .= "<li><b><br>Associats/es:</b></li><li><FORM ACTION='".SERVER_PATH_URL."/login.php' METHOD=POST><INPUT TYPE=HIDDEN NAME=action VALUE=login><INPUT TYPE=HIDDEN NAME=location VALUE='".SERVER_PATH_URL."/member_login.php'>ID Membre:<br><INPUT TYPE=TEXT SIZE=12 NAME=user></li><li>Contrasenya:<br><INPUT TYPE=PASSWORD SIZE=12 NAME=pass></li><li><INPUT TYPE=SUBMIT VALUE='Entrar'></FORM></li>";
		
		
		$output .= "</ul><p>&nbsp;</p>";
//social media
         $output .="<div id='social'>
    <a href='https://www.facebook.com/banc.deltemps.3?ref=ts&fref=ts'><img src='".SERVER_PATH_URL."/images/faceb.png'></a><BR/>
     <a Style='padding-left:10px'href='http://bancdeltempsdesalt.blogspot.com.es/'><img src='".SERVER_PATH_URL."/images/blog.png'></a>
</div><iframe src='https://www.google.com/calendar/embed?showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showTz=0&amp;mode=AGENDA&amp;wkst=1&amp;bgcolor=%23ffcc33&amp;hl=ca&amp;src=ild17h7g2jusprlbb9oldjkgd0%40group.calendar.google.com&ctz=Europe/Madrid' style='border: 0' width='200' height='250' frameborder='0' scrolling='no'></iframe>
       <a style='font-size:14pt;width:100%;margin-top:10px' href='".SERVER_PATH_URL."/info/calendario.php'>Calendari en format gran.</a>
</td>";
		$output .= "<TD id=\"maincontent\" valign=top>".$cErr->ErrorBox();
	
		return $output;
	}

	function MakePageTitle() {
		global $SECTIONS;
		
		if (!isset($this->page_title) or !isset($this->site_section)) {
			return "";
		} else {
			if (!isset($this->page_title_image))
				$this->page_title_image = $SECTIONS[$this->site_section][2];
				
			return '<H2><IMG SRC="http://'. IMAGES_PATH . $this->page_title_image .'" align=middle>'. $this->page_title .'</H2><P>';
		}		
	}
									
	function MakePageFooter() {
		return "</TD></TR>". $this->page_footer ."</BODY></HTML>";
	}	
			
	function DisplayPage($content = "") {
		global $cErr;
		if ($content=="")
			$cErr->Error("DisplayPage() was called with no content included!  Was a blank page intended?",ERROR_SEVERITY_HIGH,__FILE__,__LINE__);
	
		print $this->MakePageHeader();
		print $this->MakePageMenu();	
		print $this->MakePageTitle();
		
		print $content;
		print $this->MakePageFooter();
	}	
	
	
}

class cMenuItem {
	var $button_text;
	var $url;
	
	function cMenuItem ($button_text, $url) {
		$this->button_text = $button_text;
		$this->url = $url;
	}
	
	function DisplayButton() {
		return "<li><div align=left><a href=\"http://". HTTP_BASE ."/". $this->url ."\">". $this->button_text ."</a></div></li>";
	}
}

$p = new cPage;

?>
