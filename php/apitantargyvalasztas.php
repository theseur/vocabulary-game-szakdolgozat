<?php
header('Content-type:application/json;charset=utf-8');
require_once 'connect.php';
$tantargye=$_GET['fomenu'];
$sql='';
if($tantargye=="true")
{
    $sql=" SELECT * FROM targytemakor WhERE szulo IS NULL";
}
else
{
    $sql=" SELECT * FROM targytemakor WhERE szulo IS not NULL";
}

$result1 =$db-> query($sql);
$temakorok=array();
while ($row = $result1->fetch_assoc()){

    //var_dump($row);
    array_push($temakorok, $row );

}

echo json_encode($temakorok,JSON_UNESCAPED_UNICODE);


?>
<?php mysqli_close($db);
?>