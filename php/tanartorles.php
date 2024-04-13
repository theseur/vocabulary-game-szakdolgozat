<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<?php
  require_once 'connect.php';

  ?>
  <html>
<head><title>Tanár törlése a névsorból</title></head>
    <body>
    <?php

if(!isset($_SESSION["adminuserid"]))
{
    echo'<a href="index.php">Nincs bejelentkezve.</a> ';

}
else
{
    require_once 'connect.php';

   $id=$_GET["id"];
   $db-> query('UPDATE felhasznalok 
   SET deactivate=1
    WHERE id='.$id
    );
    echo '<a href="adminb_bejel.php">Vissza az adminisztrátor oldalra</a>';

  
   


}

?>
       
</body>

</html>