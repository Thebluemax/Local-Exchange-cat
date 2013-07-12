<?
//listados de emails de todos los socios salvo status I
include_once("includes/inc.global.php");
$cUser->MustBeLevel(1);

$csql = "SELECT person.email from person, member where person.member_id = member.member_id and member.status <> 'I' and person.email is not null order by email";

		$query = $cDB->Query($csql);	
$list = "";
		while($row = mysql_fetch_array($query)){
			$list.=$row[0]."<br>";
//			$list.=$row[0]." - ".$row[1]."<br>";

//			$list.="<a href=mailto:".$row[0].">".$row[0]."</a><br>";
		}

$p->DisplayPage($list);		
?>
