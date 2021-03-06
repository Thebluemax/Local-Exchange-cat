<?

class cPerson
{
	var $person_id;			
	var $member_id;
	var $primary_member;
	var $directory_list;
	var $first_name;
	var $last_name;
	var $mid_name;
	var $dob;
	var $mother_mn;
	var $email;
	var $phone1_area;
	var $phone1_number;
	var $phone1_ext;
	var $phone2_area;
	var $phone2_number;
	var $phone2_ext;
	var $fax_area;
	var $fax_number;
	var $fax_ext;
	var $address_street1;
	var $address_street2;
	var $address_city;
	var $address_state_code;
	var $address_post_code;
	var $address_country;
    var $imagen;
    var $sexo;
    var $firmadodocs;


	function cPerson($values=null) {
		if($values) {
			$this->member_id = $values['member_id'];
			$this->primary_member = $values['primary_member'];
			$this->directory_list = $values['directory_list'];
			$this->first_name = ucfirst(strtolower($values['first_name']));
			$this->last_name = ucfirst(strtolower($values['last_name']));
			$this->mid_name = ucfirst(strtolower($values['mid_name']));
			$this->dob = $values['dob'];
			$this->mother_mn = $values['mother_mn'];
			$this->email = $values['email'];
			$this->phone1_area = $values['phone1_area'];
			$this->phone1_number = $values['phone1_number'];
			$this->phone1_ext = $values['phone1_ext'];
			$this->phone2_area = $values['phone2_area'];
			$this->phone2_number = $values['phone2_number'];
			$this->phone2_ext = $values['phone2_ext'];
			$this->fax_area = $values['fax_area'];
			$this->fax_number = $values['fax_number'];
			$this->fax_ext = $values['fax_ext'];
			$this->address_street1 = $values['address_street1'];
			$this->address_street2 = $values['address_street2'];
			$this->address_city = $values['address_city'];
			$this->address_state_code = $values['address_state_code'];
			$this->address_post_code = $values['address_post_code'];
			$this->address_country = $values['address_country'];
            $this->imagen = $values['imagen'];
            $this->sexo = $values['sexo'];
            $this->firmadodocs = $values['firmadodocs'];
		}
	}

	function SaveNewPerson() {
		global $cDB, $cErr;

		$duplicate_exists = $cDB->Query("SELECT NULL FROM ".DATABASE_PERSONS." WHERE member_id='". $this->member_id ."' AND first_name". $cDB->EscTxt2($this->first_name) ." AND last_name". $cDB->EscTxt2($this->last_name) ." AND mother_mn". $cDB->EscTxt2($this->mother_mn) ." AND mid_name". $cDB->EscTxt2($this->mid_name) ." AND dob". $cDB->EscTxt2($this->dob) .";");
		
		if($row = mysql_fetch_array($duplicate_exists)) {
			$cErr->Error("Could not save new person. There is already a person in your account with the same name, date of birth, and mother's maiden name. If you received this error after pressing the Back button, try going back to the menu and starting again.");
			include("redirect.php");
		}
		$nadie = "nadie";
		$insert = $cDB->Query("INSERT INTO ".DATABASE_PERSONS." (member_id, primary_member, directory_list, first_name, last_name, mid_name, dob, mother_mn, email, phone1_area, phone1_number, phone1_ext, phone2_area, phone2_number, phone2_ext, fax_area, fax_number, fax_ext, address_street1, address_street2, address_city, address_state_code, address_post_code, address_country, imagen, sexo, firmadodocs) VALUES ('". $this->member_id ."','". $this->primary_member ."','". $this->directory_list ."',". $cDB->EscTxt($this->first_name) .",". $cDB->EscTxt($this->last_name) .",". $cDB->EscTxt($this->mid_name) .",". $cDB->EscTxt($this->dob) .",". $cDB->EscTxt($this->mother_mn) .",". $cDB->EscTxt($this->email) .",". $cDB->EscTxt($this->phone1_area) .",". $cDB->EscTxt($this->phone1_number) .",". $cDB->EscTxt($this->phone1_ext) .",". $cDB->EscTxt($this->phone2_area) .",". $cDB->EscTxt($this->phone2_number) .",". $cDB->EscTxt($this->phone2_ext) .",". $cDB->EscTxt($this->fax_area) .",". $cDB->EscTxt($this->fax_number) .",". $cDB->EscTxt($this->fax_ext) .",". $cDB->EscTxt($this->address_street1) .",". $cDB->EscTxt($this->address_street2) .",'". $this->address_city ."','". $this->address_state_code ."','". $this->address_post_code ."','". $this->address_country ."','". $nadie ."','". $this->sexo ."','". $this->firmadodocs ."');");             //,'". $this->imagen ."');");
	
		return $insert;
	}
			
	function SavePerson() {
		global $cDB, $cErr;
		
		$update = $cDB->Query("UPDATE ". DATABASE_PERSONS ." SET member_id='". $this->member_id ."', primary_member='". $this->primary_member ."', directory_list='". $this->directory_list ."', first_name=". $cDB->EscTxt($this->first_name) .", last_name=". $cDB->EscTxt($this->last_name) .", mid_name=". $cDB->EscTxt($this->mid_name) .", dob=". $cDB->EscTxt($this->dob) .", mother_mn=". $cDB->EscTxt($this->mother_mn) .", email=". $cDB->EscTxt($this->email) .", phone1_area=". $cDB->EscTxt($this->phone1_area) .", phone1_number=". $cDB->EscTxt($this->phone1_number) .", phone1_ext=". $cDB->EscTxt($this->phone1_ext) .", phone2_area=". $cDB->EscTxt($this->phone2_area) .", phone2_number=". $cDB->EscTxt($this->phone2_number) .", phone2_ext=". $cDB->EscTxt($this->phone2_ext) .", fax_area=". $cDB->EscTxt($this->fax_area) .", fax_number=". $cDB->EscTxt($this->fax_number) .", fax_ext=". $cDB->EscTxt($this->fax_ext) .", address_street1=". $cDB->EscTxt($this->address_street1) .", address_street2=". $cDB->EscTxt($this->address_street2) .", address_city='". $this->address_city ."', address_state_code='". $this->address_state_code ."', address_post_code='". $this->address_post_code ."', address_country='". $this->address_country ."', sexo='". $this->sexo ."', firmadodocs='". $this->firmadodocs ."' WHERE person_id='".$this->person_id ."';");

		if(!$update)
			$cErr->Error("Could not save changes to '". $this->first_name ." ". $this->last_name ."'. Please try again later.");	
			
		return $update;
	}

	function LoadPerson($who)
	{
		global $cDB, $cErr;

		$query = $cDB->Query("SELECT member_id, primary_member, directory_list, first_name, last_name, mid_name, dob, mother_mn, email, phone1_area, phone1_number, phone1_ext, phone2_area, phone2_number, phone2_ext, fax_area, fax_number, fax_ext, address_street1, address_street2, address_city, address_state_code, address_post_code, address_country, imagen, sexo, firmadodocs FROM ".DATABASE_PERSONS." WHERE person_id=".$who);
		
		if($row = mysql_fetch_array($query))
		{
			$this->person_id=$who;	
			$this->member_id=$row[0];
			$this->primary_member=$row[1];
			$this->directory_list=$row[2];
			$this->first_name=$cDB->UnEscTxt($row[3]);
			$this->last_name=$cDB->UnEscTxt($row[4]);
			$this->mid_name=$cDB->UnEscTxt($row[5]);
			$this->dob=$row[6];
			$this->mother_mn=$cDB->UnEscTxt($row[7]);
			$this->email=$row[8];
			$this->phone1_area=$row[9];
			$this->phone1_number=$row[10];
			$this->phone1_ext=$row[11];
			$this->phone2_area=$row[12];
			$this->phone2_number=$row[13];
			$this->phone2_ext=$row[14];
			$this->fax_area=$row[15];
			$this->fax_number=$row[16];
			$this->fax_ext=$row[17];
			$this->address_street1=$cDB->UnEscTxt($row[18]);
			$this->address_street2=$cDB->UnEscTxt($row[19]);
			$this->address_city=$row[20];
			$this->address_state_code=$row[21];
			$this->address_post_code=$row[22];
			$this->address_country=$row[23];
            $this->imagen=$row[24];
            $this->sexo=$row[25];
            $this->firmadodocs=$row[26];
	
		}
		else 
		{
			$cErr->Error("There was an error accessing this person (".$who.").  Please try again later.");
			include("redirect.php");
		}		
	}		
	
	function DeletePerson() {
		global $cDB, $cErr;
		
		if($this->primary_member == 'Y') {
			$cErr->Error("Cannot delete primary member!");	
			return false;
		} 
		
		$delete = $cDB->Query("DELETE FROM ".DATABASE_PERSONS." WHERE person_id=". $this->person_id);
		
		unset($this->person_id);
		
		if (mysql_affected_rows() == 1) {
			return true;
		} else {
			$cErr->Error("Error deleting joint member.  Please try again later.");
		}
		
	}
							
	function ShowPerson()
	{
		$output = $this->person_id . ", " . $this->member_id . ", " . $this->primary_member . ", " . $this->directory_list . ", " . $this->first_name . ", " . $this->last_name . ", " . $this->mid_name . ", " . $this->dob . ", " . $this->mother_mn . ", " . $this->email . ", " . $this->phone1_area . ", " . $this->phone1_number . ", " . $this->phone1_ext . ", " . $this->phone2_area . ", " . $this->phone2_number . ", " . $this->phone2_ext . ", " . $this->fax_area . ", " . $this->fax_number . ", " . $this->fax_ext . ", " . $this->address_street1 . ", " . $this->address_street2 . ", " . $this->address_city . ", " . $this->address_state_code . ", " . $this->address_post_code . ", " . $this->address_country ."," . $this->imagen . "," . $this->sexo . "," . $this->firmadodocs;
		
		return $output;
	}

	function Name() {
		return $this->first_name . " " .$this->last_name;	
	}
			
	function DisplayPhone($type)
	{
		global $cErr;

		switch ($type)
		{
			case "1":
				$phone_area = $this->phone1_area;
				$phone_number = $this->phone1_number;
				$phone_ext = $this->phone1_ext;
				break;
			case "2":
				$phone_area = $this->phone2_area;
				$phone_number = $this->phone2_number;
				$phone_ext = $this->phone2_ext;
				break;
			case "fax":
				$phone_area = $this->fax_area;
				$phone_number = $this->fax_number;
				$phone_ext = $this->fax_ext;
				break;								
			default:
				$cErr->Error("No existe ese tipo de teléfono.");
				return "ERROR";
		}
		
		if($phone_number != "") {
		    $phone = $phone_area . $phone_number;
		} else {
			$phone = "";
		}
		
		return $phone;
	}

}

class cPhone {
    var $area;
    var $prefix;
    var $suffix;
    var $ext;
    
    function cPhone($phone_str=null) { // this constructor attempts to break down free-form phone #s
        if($phone_str) {                        // TODO: Use reg expressions to shorten this thing
            $ext = "";
            $phone_str = strtolower($phone_str);
            $phone_str = ereg_replace("\(","",$phone_str);
            $phone_str = ereg_replace("\)","",$phone_str);
            $phone_str = ereg_replace("-","",$phone_str);
            $phone_str = ereg_replace("\.","",$phone_str);
            $phone_str = ereg_replace(" ","",$phone_str);
            $phone_str = ereg_replace("e","",$phone_str);
            
            if (strlen($phone_str) == 9) {
                $this->area = substr($phone_str,0,3);
                $this->prefix = substr($phone_str,3,3);
                $this->suffix = substr($phone_str,6,3);
                $this->ext = $ext;                
            } else {
                return false;            
            }
        }
    }
    /* paso de renombrar */
    function SevenDigits() {
        return $this->prefix . $this->suffix;
    }
    
} 
?>
