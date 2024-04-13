<?php
header('Content-type:application/json;charset=utf-8');
require_once 'connect.php';

$mit=$db -> real_escape_string($_GET["mit"]);
$mire=$db -> real_escape_string($_GET["mire"]);

$db-> query("INSERT INTO `visszajelzes`( `mit`, `mire`) VALUES ('$mit','$mire')");


?>

<?php mysqli_close($db);
?>