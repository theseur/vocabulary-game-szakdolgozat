
<?php
header('Content-type:application/json;charset=utf-8');
require_once 'connect.php';

$result1 =$db-> query(" SELECT * FROM szoszedet
ORDER BY RAND()
LIMIT 5");
$szavak=array();
while ($row = $result1->fetch_assoc()){

    //var_dump($row);
    array_push($szavak, $row );

}

echo json_encode($szavak,JSON_UNESCAPED_UNICODE);


?>
<?php mysqli_close($db);
?>
