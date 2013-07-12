<?
// listado nombre, emails de personas pdtes de firmar
include_once("includes/inc.global.php");
$cUser->MustBeLevel(1);

$csql = "SELECT phone1_area, phone1_number, phone2_area, phone2_number, person.first_name, person.last_name, person.email, member.join_date from person, member where person.member_id = member.member_id and member.status = 'X' order by member.join_date";

		$query = $cDB->Query($csql);	
$list = "";
		while($row = mysql_fetch_array($query)){
			//$list.=$row[0]."<br>";
			$list.=$row[0]." ".$row[1]." ".$row[2]." ".$row[3]." ".$row[4]." ".$row[5]." ".$row[6]." ".$row[7]." ".$row[8]."<br>";

//			$list.="<a href=mailto:".$row[0].">".$row[0]."</a><br>";
		}
if (strlen($list)==0) {
	$list="No se encontraron datos, puto";
}
$p->DisplayPage($list);		
?>
