<?php
// Start the session
session_start();
?>

  <?php

require_once 'connect.php';

//var_dump($_POST);
$temakor=$_POST["temakorval"];
$oszalydef=$_POST["osztalyval"];
$ropdoliidopont=$_POST["idopont"];
$tanarid=($_SESSION["userid"]);

$ropdoliidopont=str_replace('T',' ',$ropdoliidopont);
$ropdoliidopont.=':00';
//echo "röpgoliidő".$ropdoliidopont."<br>";
$date = DateTime::createFromFormat('Y-m-d H:i:s', $ropdoliidopont);
$date1=DateTime::createFromFormat('Y-m-d H:i:s', $ropdoliidopont);
// Add 1 hour
$date1= date_modify($date1, "+1 hour");


// Set the minutes to 00
$date->setTime($date->format('H'), 0);
$date1->setTime($date1->format('H'), 0);
$date=$date->format('Y-m-d H:i:s');
$date1=$date1->format('Y-m-d H:i:s');
//echo "date ".$date."<br>";
//echo "date1 ".$date1."<br>";

$dbsz=$db-> query("SELECT osztaly,datum
from ropbeallitas
where ropbeallitas.datum>='$date'
and
ropbeallitas.datum< '$date1'
AND ropbeallitas.osztaly like '$oszalydef'
;

");
echo "sql-be"."<br>";

echo "SELECT osztaly,datum
from ropbeallitas
where ropbeallitas.datum>='$date'
and
ropbeallitas.datum< '$date1'
AND ropbeallitas.osztaly like '$oszalydef'
;";

/*where ropbeallitas.datum>='$ropdoliidopont'
and
ropbeallitas.datum< DATE_ADD('$ropdoliidopont', INTERVAL 60 MINUTE)
and '$oszalydef' like ropbeallitas.osztaly;*/

echo "<br>";



$szavak=array();
while ($row = $dbsz->fetch_assoc()){

    
    array_push($szavak, $row );
   // var_dump($row);

}
echo "szavak:";
echo count($szavak);
var_dump(count($szavak));
/*echo "<br> szavak";
foreach($szavak as $p)
{
  echo $p.'<br>';
}*/
if(count($szavak)==0)
{
  try
  {
   $db-> query(" INSERT INTO ropbeallitas (`temakorid`,`osztaly`,`datum`,`tanarid`) VALUES('$temakor','$oszalydef','$ropdoliidopont',$tanarid)") or die("Nem került adat az adatbázisba!"); //az oszlopneveknél altgr + 7 kell!!
   echo '<br>'."Sikeres időpont rögzítés!";

  }
   catch(Throwable $e)
  {
       echo'Ennek az osztálynak van már ebben az időpontban röpdlgozata!';

  }
}
else
{
  echo'Ennek az osztálynak van már ebben az időpontban röpdlgozata!';
}


include_once "menu.php";
?>