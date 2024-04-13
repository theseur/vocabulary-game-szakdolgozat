<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<?php
  require_once 'connect.php';

  ?>
  <html>
<head><title>Jelszó módosítás</title></head>
    <body>
    <?php

if(!isset($_SESSION["adminuserid"]))
{
    echo'<a href="index.php">Nincs bejelentkezve.</a> ';

}
else
{
  require_once 'menuAdmin.php';

   $id=$_POST["id"];
   $password=$_POST["password"];
   try
   {
    $db-> query('UPDATE felhasznalok 
    SET jelszo="'.sha1($password).'"
     WHERE id='.$id
     );
     echo "Sikeres jelszómódosítás!";
   }
   catch(Throwable $e)
   {
        echo'Van már ilyen nevű és jelszavú diák!';
   }
   
    

  
   


}

?>
       
</body>

</html>