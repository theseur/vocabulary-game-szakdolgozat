<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<?php
  require_once 'connect.php';

  ?>

<html>
<head><title>TTémakör felvétel</title></head>
    <body>
    <?php

if(isset($_SESSION["userid"]))
{
    
    include_once "menu.php";
    
    $result1= $db->query("SELECT id, nev FROM  targytemakor WHERE szulo is null");
    $temakorok=array();
while ($row = $result1->fetch_assoc()){

    //var_dump($row);
    array_push($temakorok, $row );

}
$targyakNeve="<select name='opcio'>";
foreach($temakorok as $targy)
{
    $targyakNeve.='<option value='.$targy["id"].'>'.$targy["nev"].'</option>';

}
$targyakNeve.="</select>";

    echo'<div>
    <form action="temakorfelvetel.php">
    <select name="nameOfPic" id="kepLegordulo">
<option vaLue="NULL">Nincs kép</option>
';

$i=0;
$kimentettkepnev="";
foreach(glob('../kep/*.*') as $filename){
    $filename = trim(substr($filename, strrpos($filename, '/') + 1));
    if($i==0)
    {
        $kimentettkepnev.=$filename;

    }
    $kiir.="<option value='" . $filename ."'>" . $filename . "</option>"; 
    $i++;
}
$kiir.='</select>';
echo $kiir.'<br>
      <label for="temakorNev">Témakör neve</label><br>
      <input type="text" id="temakorNev" name="temakorNev" placeholder="Témakör neve"><br>' 
      .$targyakNeve.'

      <button>Hozzáadás</button>
    </form> 
   
    </div>';

}
if(isset($_GET["temakorNev"]))
{
    $result1 =$db-> query(" SELECT MAX(id) as 'legnagyobbId' FROM targytemakor");

$temakorok=0;
while ($row = $result1->fetch_assoc()){

    //var_dump($row);
    $temakorok=$row['legnagyobbId'] ;

}
$temakorok++;
//var_dump($_GET);
$kepnev;
if($_GET["nameOfPic"]=="NULL")
{
    $kepnev="NULL";
}
else
{
    $kepnev=$_GET["nameOfPic"];

}
$nevbejovo=$_GET["temakorNev"];
$szuloId=$_GET["opcio"];
$db-> query(" INSERT INTO targytemakor VALUES($temakorok,'$nevbejovo',$szuloId,'$kepnev')");
if(!empty($error))
{
  
  print("Hiba történt az adatok feltöltése során: ".$error);
  error_log(
     $error, 
     3,
    "Error.txt",
  
  );
  $file = 'error2.txt';
  $data = "\n".$error.date("Y-m-d");
  file_put_contents($file, $data, FILE_APPEND);


}
}


?>
       
</body>

</html>
