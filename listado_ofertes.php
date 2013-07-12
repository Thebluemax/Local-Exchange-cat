<?
// nombre, emails de personas pdtes de firmar
include_once("includes/inc.global.php");
$cUser->MustBeLevel(1);

$csql = "SELECT description from listing";

		$query = $cDB->Query($csql);	
$list = "";
		while($row = mysql_fetch_array($query)){
			$list.=$row[0]."<br>";
//			$list.=$row[0]." - ".$row[1]."<br>";

//			$list.="<a href=mailto:".$row[0].">".$row[0]."</a><br>";
		}

$p->DisplayPage($list);		
?>
