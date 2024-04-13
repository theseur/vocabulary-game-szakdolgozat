<?php
require_once 'connect.php';
include_once "menu.php";
session_start();

$kezdido=$_GET["datum"];


$result2 =$db-> query("SELECT felhasznalok.usernev, felhasznalok.osztaly, ropdolgozat.ropbeallitasid,
 feladatok.pontszam, ropbeallitas.datum
FROM feladatok 
INNER JOIN ropdolgozat on feladatok.ropdolgozatid=ropdolgozat.id 
INNER JOIN ropbeallitas on ropdolgozat.ropbeallitasid=ropbeallitas.id 
INNER JOIN felhasznalok ON feladatok.userid=felhasznalok.id 
WHERE ropbeallitas.datum= '$kezdido';
");
$szavak="Név;osztály;dátum;pontszám\n";
while ($row = $result2->fetch_assoc()){

    //var_dump($row);
    $szavak.=$row["usernev"].";".$row["osztaly"].";".$row["datum"].";".$row["pontszam"]."\n";
   

}

$myfile = fopen("Eredmények.csv", "w") or die("Unable to open file!");

fwrite($myfile, utf8_encode($szavak));
fclose($myfile);


?>
<a href="Eredmények.csv" download><h2>Letöltés</h2></a>
<?php mysqli_close($db);
?>