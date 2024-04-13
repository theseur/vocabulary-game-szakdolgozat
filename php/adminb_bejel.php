<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<?php
  require_once 'connect.php';

  ?>

<html>
<head><title>Adminsztátor bejelentkezés</title></head>
    <body>
    <?php

if(!isset($_SESSION["adminuserid"]))
{
    echo'<div id="signIn">
    <form action="AdminBejelentkezes.php">
      <label for="username">felhasználónév</label><br>
      <input type="text" id="username" name="username" value="word"><br>
      <label for="password">jelszó</label><br>
      <input type="password" id="password" name="password" value="word"><br><br>
      <button id="bejelentkezes" >Bejelentkezés</button>
    </form> 
   
    </div>';
    echo'<a href=index.php>Vissza</a>';

}
else
{
  include_once "menuAdmin.php";
    

}

?>
       
</body>

</html>
