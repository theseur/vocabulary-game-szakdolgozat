<?php
header('Content-type:application/json;charset=utf-8');
require_once 'connect.php';
session_start();

$datum=$_GET["nev"];
$osztalynev=$_GET["osztaly"];


$result2 =$db-> query("SELECT felhasznalok.usernev, feladatok.pontszam 
FROM feladatok 
INNER JOIN ropdolgozat on feladatok.ropdolgozatid=ropdolgozat.id 
INNER JOIN ropbeallitas on ropdolgozat.ropbeallitasid=ropbeallitas.id 
INNER JOIN felhasznalok ON feladatok.userid=felhasznalok.id 
WHERE ropbeallitas.datum= '$datum'
AND ropbeallitas.osztaly like '%$osztalynev%'
;

");
$szavak=array();
while ($row = $result2->fetch_assoc()){

    //var_dump($row);
    array_push($szavak, $row );

}

echo json_encode($szavak,JSON_UNESCAPED_UNICODE);


?>
<?php mysqli_close($db);
?>