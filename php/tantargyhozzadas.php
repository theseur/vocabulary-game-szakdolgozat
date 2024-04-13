<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <body>

<?php


require_once 'connect.php';
if(isset($_SESSION["userid"]))
{

    include_once "menu.php";

echo'<form action="tantargyhozzadas.php">

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
<label for="tantargyNev">Tantárgy neve</label><br>
<input type="text" id="tantargyNev" name="tantargyNev" placeholder="Tantárgy neve"><br>

<button id="bejelentkezes" >Hozzáadás</button>
</form> ';




if(isset($_GET["tantargyNev"]))
{
    $kepnev;
    if($_GET["nameOfPic"]=="NULL")
    {
        $kepnev="NULL";
    }
    else
    {
        $kepnev=$_GET["nameOfPic"];

    }
    $result1 =$db-> query(" SELECT MAX(id) as 'legnagyobbId' FROM targytemakor");

$temakorok=0;
while ($row = $result1->fetch_assoc()){

    //var_dump($row);
    $temakorok=$row['legnagyobbId'] ;

}
$temakorok++;
var_dump($_GET);
$nevbejovo=$db -> real_escape_string($_GET["tantargyNev"]);


$db-> query(" INSERT INTO targytemakor VALUES($temakorok,'$nevbejovo',NULL,'$kepnev')");
$error = mysqli_error($db);
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
}





?>
<?php mysqli_close($db);
?>
</body>

</html>