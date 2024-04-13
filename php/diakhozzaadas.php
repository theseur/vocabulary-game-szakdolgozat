<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<?php
  require_once 'connect.php';

  ?>
  <html>
<head><title>Diák hozzáadása a listához</title></head>
    <body>
    <?php

if(!isset($_SESSION["adminuserid"]))
{
    echo'<a href="index.php">Nincs bejelentkezve.</a> ';

}
else
{
    include_once "menuAdmin.php";
    echo'<a href="DiakokHozzaadasaCSV.php">Diákok hozzáadása csv file-ból</a>';
    echo'<div id="signIn">
    <form action="diakhozzaadas.php" method="post">
      <label for="username">felhasználónév</label><br>
      <input type="text" id="username" name="username" value="word" required><br>
      <label for="password">jelszó</label><br>
      <input type="password" id="password" name="password" value="word" required><br><br>
      <label for="osztaly">osztály</label><br>
      <input type="text" id="osztaly" name="osztaly" value="word" required><br><br>
      <button id="bejelentkezes" >Hozzáadás</button>
    </form> 
   
    </div>';
    
    if(isset($_POST["username"]))
    {
        //include_once "menuAdmin.php";
            $felhasznalonev=$db -> real_escape_string($_POST["username"]);
            $jelszo=$db -> real_escape_string($_POST["password"]);
            $osztaly=$db -> real_escape_string($_POST["osztaly"]);
            if(!is_numeric(substr($osztaly, 0, 1)) )
            {
                die("Nem számmal kezdődik az osztály!");
            }

            if(substr($osztaly, 1, 1)!=".")
            {
                die("Túl nagy az osztály száma!");
            }
            if(1>intval(substr($osztaly, 0, 1)) ||intval(substr($osztaly, 0, 1))>8  )
            {
                
                    die("Az osztály száma nagyobb mint nyolc vagy kisebb mint egy");
                
            }

            $result1 =$db-> query(" SELECT usernev,id,deactivate  FROM felhasznalok
            where osztaly IS not NULL
            and osztaly not like 'administrator'
            and
            usernev like '$felhasznalonev'
            and
            jelszo like '".sha1($jelszo)."'
            ");

            /*echo " SELECT usernev,id.deactivate  FROM felhasznalok
            where osztaly IS not NULL
            and osztaly not like 'administrator'
            and
            usernev like '$felhasznalonev'
            and
            jelszo like '".sha1($jelszo)."'
            ";*/

            $szavak=array();
            while ($row = $result1->fetch_assoc())
            {
            
                //var_dump($row);
                array_push($szavak, $row );
            
            }
            if(count($szavak)==0)
            {
                
                $jelszo=$db -> real_escape_string(sha1($_POST["password"]));
                $db-> query(" INSERT INTO felhasznalok(usernev, osztaly, jelszo) VALUES('$felhasznalonev', '$osztaly','$jelszo' )");
                echo '<a href="adminb_bejel.php">Vissza az adminisztrátor oldalra</a>';

            }
            else
            {
                $id=$szavak[0]['id'];
                echo"Már van ilyen nevű diák az adatbázisban";
                if($szavak[0]['deactivate']==1)
                {
                    echo "<a href='visszaaktivalas.php?id=$id'  onclick=\"return confirm('Are you sure?')\">Vissza aktiválja?</a>";
                }


                
                

            }       
        
    }


}

?>
       
</body>

</html>