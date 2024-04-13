<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<?php
  require_once 'connect.php';

  ?>
  <html>
<head><title>Tanár hozzáadása a listához</title></head>
    <body>
    <?php

if(!isset($_SESSION["adminuserid"]))
{
    echo'<a href="index.php">Nincs bejelentkezve.</a> ';

}
else
{
    require_once 'menuAdmin.php';
    echo'<div id="signIn">
    <form action="tanarhozzaadas.php" method="post">
      <label for="username">felhasználónév</label><br>
      <input type="text" id="username" name="username" value="word" required><br>
      <label for="password">jelszó</label><br>
      <input type="password" id="password" name="password" value="word" required><br><br>
      <button id="bejelentkezes" >Hozzáadás</button>
    </form> 
   
    </div>';
    
    if(isset($_POST["username"]))
    {
            $felhasznalonev=$db -> real_escape_string($_POST["username"]);
            $result1 =$db-> query(" SELECT usernev,id  FROM felhasznalok
            where osztaly IS NULL
            and
            usernev like '$felhasznalonev'
            ");
            $szavak=array();
            while ($row = $result1->fetch_assoc())
            {
            
                //var_dump($row);
                array_push($szavak, $row );
            
            }
            
            if(count($szavak)==0)
            {
                
                $jelszo=$db -> real_escape_string(sha1($_POST["password"]));
                $db-> query(" INSERT INTO felhasznalok(usernev, osztaly, jelszo) VALUES('$felhasznalonev', NULL,'$jelszo' )");
                echo $felhasznalonev." hozzáadva!<br>";
                echo '<a href="adminb_bejel.php">Vissza az adminisztrátor oldalra</a>';

            }
            else
            {
                $id=$szavak[0]['id'];
                echo"Már van ilyen nevű tanár az adatbázisban.<br>";
                echo "<a href='visszaaktivalas.php?id=$id'>Vissza aktiválja?</a><br>";
                echo '<a href="adminb_bejel.php">Vissza az adminisztrátor oldalra</a>';

            }       
        
    }


}

?>
       
</body>

</html>