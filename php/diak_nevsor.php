<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<?php
  require_once 'connect.php';

  ?>
  <html>
<head><title>Diák névsor</title></head>
    <body>
    <?php

if(!isset($_SESSION["adminuserid"]))
{
    echo'<a href="index.php">Nincs bejelentkezve.</a> ';

}
else
{
   
    echo'<a href="kijelentkezes.php">Kijelentkezés</a> ';
    echo'<a href="diakhozzaadas.php">Új diák hozzáadása</a> ';
    echo'<a href="felugroablak.php?tovabb=nyolcadikDeAktivalas.php">Nyolcadikosok törlése</a> ';
    echo'<a href="felugroablak.php?tovabb=osztalyokEloreLeptetese.php">Osztályok előre léptetése</a> ';
    echo '<a href="adminb_bejel.php">Vissza az adminisztrátor oldalra</a> <br>';

    $result1 =$db-> query(" SELECT DISTINCT osztaly FROM felhasznalok 
    where osztaly IS not NULL 
    and osztaly not like 'administrator'
    and
    deactivate=0
    order by osztaly asc
    ");
    $szavak=array();
    while ($row = $result1->fetch_assoc()){
    
        //var_dump($row);
        array_push($szavak, $row );
    
    }
  
    foreach($szavak as $tanarok)
    {
        
        $nevek=$tanarok["osztaly"];
        echo $nevek." <a href='osztalykiir.php?id=$nevek'>Módosítás</a> <br>";
       


    }


}

?>
       
</body>

</html>