<?php
header('Content-type:application/json;charset=utf-8');
require_once 'connect.php';

$targyid=$db -> real_escape_string($_GET["targyid"]);

$result1 =$db-> query(" SELECT * FROM targytemakor WhERE szulo=$targyid"
);
$temakorok=array();
while ($row = $result1->fetch_assoc()){

    //var_dump($row);
    array_push($temakorok, $row );

}

echo json_encode($temakorok,JSON_UNESCAPED_UNICODE);


?>
<?php mysqli_close($db);
?>