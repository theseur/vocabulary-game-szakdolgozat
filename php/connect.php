<?php
$db =new mysqli ('127.0.0.1','root','','szakdolgozatdb' );
$db->set_charset("utf8");
if($db->connect_errno)
{
    echo $db->connect_errno;
}


?>