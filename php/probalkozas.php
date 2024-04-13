<?php
header('Content-type:application/json;charset=utf-8');
require_once 'connect.php';



$nevbejovo=$db -> real_escape_string($_GET["nev"]);
$jelszobejovo=$db -> real_escape_string($_GET["jelszo"]);



$db-> query(" UPDATE diak
set probaszam=probaszam+1
where nev like '$nevbejovo'
and
jelszo like '$jelszobejovo'
");


?>
<?php mysqli_close($db);
?>