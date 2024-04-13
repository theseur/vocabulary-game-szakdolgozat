<?php
header('Content-type:application/json;charset=utf-8');
require_once 'connect.php';



$nevbejovo=$db -> real_escape_string($_GET["usernev"]);
$jelszobejovo=$db -> real_escape_string($_GET["jelszo"]);






?>
<?php mysqli_close($db);
?>