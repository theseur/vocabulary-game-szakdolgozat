<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<?php
  require_once 'connect.php';

  ?>
  <html>
<head><title>Nyolcadikosok törlése</title></head>
    <body>
    <?php

if(!isset($_SESSION["adminuserid"]))
{
    echo'<a href="index.php">Nincs bejelentkezve.</a> ';

}
else
{
    require_once 'menuAdmin.php';

  
   $db-> query('UPDATE felhasznalok 
   SET deactivate=1
    WHERE osztaly like "8%"
    ');
   

  
   


}

?>
       
</body>

</html>