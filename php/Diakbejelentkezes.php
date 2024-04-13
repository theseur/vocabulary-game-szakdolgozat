<?php
// Start the session
session_start();
require_once 'connect.php';
?>
<?php


if(isset($_POST["username"])==false)
  {
    echo'
  <form action="Diakbejelentkezes.php" method="POST">
    <label for="username">felhasználónév</label><br>
    <input type="text" id="username" name="username" value="word"><br>
    <label for="password">jelszó</label><br>
    <input type="password" id="password" name="password" value="word"><br><br>
    <button id="bejelentkezes" >Bejelentkezés</button>

  </form> 
  
  ';
  echo'<a href=index.php>Vissza</a>';

  }
else
{
  $nevbejovo=$db -> real_escape_string($_POST["username"]);
$jelszobejovo=$db -> real_escape_string($_POST["password"]);
  $result1 =$db-> query(" SELECT * FROM felhasznalok
where usernev like '$nevbejovo'
and 
osztaly IS NOT NULL
and
jelszo like '".sha1($jelszobejovo)."'

");



/*echo " SELECT * FROM felhasznalok
where usernev  like '$nevbejovo'
and 
osztaly IS NOT NULL
and
jelszo like '".sha1($jelszobejovo)."'";*/
$szavak=array();
while ($row = $result1->fetch_assoc()){

    //var_dump($row);
    array_push($szavak, $row );

}
if (count($szavak)>0)
{
    $_SESSION["diakuserid"]=$szavak[0]["id"];
    $_SESSION["diakusername"]=$szavak[0]["usernev"];
    $_SESSION["diakosztaly"]=$szavak[0]["osztaly"];
    
echo "bent vagy";
header('Location: Dolgozat.php');
}
else
{
  echo"nemmsikerült";
  echo'<a href="Diakbejelentkezes.php">vissza</a>';
  //header('Location: Diakbejelentkezes.php');
}


}


?>