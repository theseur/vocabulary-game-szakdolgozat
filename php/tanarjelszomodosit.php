<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<?php
  require_once 'connect.php';

  ?>
  <html>
<head><title>Tanári jelszó módosítás</title></head>
    <body>
    <?php

if(!isset($_SESSION["adminuserid"]))
{
    echo'<a href="index.php">Nincs bejelentkezve.</a> ';

}
else
{
  require_once 'menuAdmin.php';
  echo "<br>";

    $tanarid=$_GET["id"];
    $result1 =$db-> query(" SELECT id, usernev  FROM felhasznalok
    where 
    id =$tanarid
    ");
    $szavak=array();
    while ($row = $result1->fetch_assoc()){
    
        //var_dump($row);
        array_push($szavak, $row );
    
    }
  
   echo $szavak[0]["usernev"].
   '<div id="signIn">
   <form action="JelszoValtoztatas.php" method="POST">
   <input type="hidden" name="id" value="'.$tanarid.'">
     <label for="password">jelszó</label><br>
     <input type="password" id="password" name="password" value="word"><br><br>
     <button id="bejelentkezes" >Változtatás</button>
   </form> 
  
   </div>';

}

?>
       
</body>

</html>