<?php
header('Content-type:application/json;charset=utf-8');
require_once 'connect.php';

$temakorvaltozo=$db -> real_escape_string($_GET["temakorval"]);

$result1 =$db-> query(" SELECT * FROM szoszedet 
WHERE 	temakorid=$temakorvaltozo");
$szavak=array();
while ($row = $result1->fetch_assoc()){

    //var_dump($row);
    array_push($szavak, $row );

}

echo json_encode($szavak,JSON_UNESCAPED_UNICODE);


?>
<?php mysqli_close($db);
?>