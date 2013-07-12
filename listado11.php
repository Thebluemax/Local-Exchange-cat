<?

// listado todos menos I
include_once("includes/inc.global.php");
$cUser->MustBeLevel(1);

$csql = "SELECT person.first_name, person.last_name, person.mid_name, person.email, phone1_area, phone1_number, phone2_area, phone2_number, member.join_date, member.status from person, member where person.member_id = member.member_id and member.status<> 'I' order by member.join_date";

		$query = $cDB->Query($csql);	
$list = "";
		while($row = mysql_fetch_array($query)){
			//$list.=$row[0]."<br>";
			$list.=$row[0]." ".$row[1]." ".$row[2]." ".$row[3]." ".$row[4]."".$row[5]." ".$row[6]."".$row[7]." ".$row[8]."".$row[9]."<br>";

//			$list.="<a href=mailto:".$row[0].">".$row[0]."</a><br>";
		}

$p->DisplayPage($list);		
?>
