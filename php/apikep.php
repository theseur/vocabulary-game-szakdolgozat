<?php
header('Content-type:application/json;charset=utf-8');
require_once 'connect.php';

$temakorid=$_GET["temakorid"];
$result1 =$db-> query(" SELECT kepnev FROM targytemakor
WHERE id =$temakorid");
$szavak=array();
while ($row = $result1->fetch_assoc()){

    //var_dump($row);
    array_push($szavak, $row );

}

echo json_encode($szavak,JSON_UNESCAPED_UNICODE);


?>
<?php mysqli_close($db);
?>