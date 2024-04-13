<?php

$uzenet = array();
$MAXMERET = 500*1024;
$TIPUSOK = array ('.jpg', '.png'); // kép típusok
$MEDIATIPUSOK = array('image/jpeg', 'image/png');
$MAPPA = '../kep/';


if (isset($_POST['kuld'])) 
{
    
    include_once "menu.php";
    

    foreach($_FILES as $fajl) 
    { // Végig megy a feltöltött fájlokon. (max. 3)
       // echo 'foreaxh';
            //echo 'else';
            
            $vegsohely = $MAPPA.strtolower($fajl['name']); // kisbetűssé alakítja a fájl nevet
            echo '<br>'. $vegsohely.'<br>';
            if (file_exists($vegsohely)) // Ha a fájl már létezik
            $uzenet[] = " Már létezik: " . $fajl['name'];
            else 
            {
                move_uploaded_file($fajl['tmp_name'], $vegsohely); // felmásolja

                $uzenet[] = ' Ok: ' . $fajl['name'];
               
            }
        
    }
}
?>