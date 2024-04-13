<?php
// Start the session
session_start();
?>
<?php
header('Content-type:application/json;charset=utf-8');
require_once 'connect.php';

$nevbejovo=$db -> real_escape_string($_GET["username"]);
$jelszobejovo=$db -> real_escape_string($_GET["password"]);



$result1 =$db-> query(" SELECT * FROM felhasznalok
where usernev like '$nevbejovo'
and 
osztaly like 'administrator'
and
jelszo like '".sha1($jelszobejovo)."'

");

echo " SELECT * FROM felhasznalok
where usernev  like '$nevbejovo'
and 
osztaly like 'administrator'
and
jelszo like '".sha1($jelszobejovo)."'";
$szavak=array();
while ($row = $result1->fetch_assoc()){

    //var_dump($row);
    array_push($szavak, $row );

}
if (count($szavak)>0)
{
    $_SESSION["adminuserid"]=$szavak[0]["id"];
    $_SESSION["adminusername"]=$szavak[0]["nev"];
    

}
header('Location: adminb_bejel.php');


?>
<?php mysqli_close($db);
?>
