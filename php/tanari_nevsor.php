<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<?php
  require_once 'connect.php';

  ?>
  <html>
<head><title>Tanári névsor</title></head>
    <body>
    <?php

if(!isset($_SESSION["adminuserid"]))
{
    echo'<a href="index.php">Nincs bejelentkezve.</a> ';

}
else
{
    require_once 'menuAdmin.php';

    $result1 =$db-> query(" SELECT id, usernev  FROM felhasznalok
    where 
    osztaly IS NULL
    and
    deactivate=0
    ");
    $szavak=array();
    while ($row = $result1->fetch_assoc()){
    
        //var_dump($row);
        array_push($szavak, $row );
    
    }
  
    foreach($szavak as $tanarok)
    {
        $id=$tanarok["id"];
        $nevek=$tanarok["usernev"];
        echo $nevek."<a href='tanartorles.php?id=$id' onclick=\"return confirm('Biztosan törli?')\">Törlés</a> 
        <a href='tanarjelszomodosit.php?id=$id'>Jelszó módosítása</a> <br>";

    }


}

?>
       
</body>

</html>