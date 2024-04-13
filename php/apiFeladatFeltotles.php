<?php
header('Content-type:application/json;charset=utf-8');
require_once 'connect.php';
var_dump($_GET);

$userid=$_GET["userid"];
$ropdoliid=$_GET["ropdoolid"];
$pontszam=$_GET["pontszam"];



echo  " INSERT INTO feladatok (userid,ropdolgozatid, pontszam)
VALUES($userid,$ropdoliid,$pontszam )";
$db-> query(" INSERT INTO feladatok (userid,ropdolgozatid, pontszam)
VALUES($userid,$ropdoliid,$pontszam )");

$response = [];
$response['success'] = true;
echo json_encode($response);

?>
<?php mysqli_close($db);
?>