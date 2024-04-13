<?php
header('Content-type:application/json;charset=utf-8');
require_once 'connect.php';
session_start();

$osztalynev=$_GET["nev"];

/*echo "SELECT ropdolgozat.id, szoszedetid, targytemakor.nev,  ropdolgozat.kezdesido
FROM  ropdolgozat
inner join szoszedet on szoszedet.id=ropdolgozat.szoszedetid

inner join targytemakor on targytemakor.id=szoszedet.temakorid 

where targytemakor.nev ='$targynev'
GROUP BY ropdolgozat.kezdesido";*/

$result2 =$db-> query("SELECT DISTINCT  datum
FROM ropbeallitas
INNER JOIN ropdolgozat on ropbeallitas.id=ropdolgozat.ropbeallitasid

WHERE ropbeallitas.osztaly like '%$osztalynev%'
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