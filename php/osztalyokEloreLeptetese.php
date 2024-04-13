<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<?php
  require_once 'connect.php';

  ?>
  <html>
<head><title>Osztályok előre léptetése</title></head>
    <body>
    <?php

if(!isset($_SESSION["adminuserid"]))
{
    echo'<a href="index.php">Nincs bejelentkezve.</a> ';

}
else
{
    require_once 'menuAdmin.php';

    echo '<a href="adminb_bejel.php">Vissza az adminisztrátor oldalra</a> <br>';
    $db-> query('UPDATE felhasznalok 
   SET deactivate=1
    WHERE osztaly like "8%"
    ');

    $result1 =$db-> query(" SELECT DISTINCT osztaly FROM felhasznalok 
    where osztaly IS not NULL 
    and osztaly not like 'administrator'
    and
    deactivate=0
    ");
    $szavak=array();
    while ($row = $result1->fetch_assoc()){
    
        //var_dump($row);
        array_push($szavak, $row );
    
    }
  
    foreach($szavak as $osztalyok)
    {
        
        $osztalySzam=intval(substr($osztalyok["osztaly"],0,1));
        $teljesoszttaly=$osztalyok["osztaly"];
        $osztalySzam++;
        $maradekosztaly=substr($osztalyok["osztaly"],1);
        $beirando=$osztalySzam.$maradekosztaly;
        $db-> query("UPDATE felhasznalok 
        SET osztaly='$beirando'
         WHERE osztaly like '$teljesoszttaly'"
         );
       
       


    }


}

?>
       
</body>

</html>