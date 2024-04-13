<?php
header('Content-type:application/json;charset=utf-8');
require_once 'connect.php';

$nevbejovo=$db -> real_escape_string($_GET["nev"]);
$jelszobejovo=$db -> real_escape_string($_GET["jelszo"]);



$result1 =$db-> query(" SELECT * FROM felhasznalok
where usernev like '$nevbejovo'
and
jelszo like '".sha1($jelszobejovo)."'
and
deactivate =1
");
$szavak=array();
while ($row = $result1->fetch_assoc()){

    //var_dump($row);
    array_push($szavak, $row );

}

echo json_encode($szavak,JSON_UNESCAPED_UNICODE);


?>
<?php mysqli_close($db);
?>