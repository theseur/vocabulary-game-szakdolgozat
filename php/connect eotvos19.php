<?php
// mysqli paraméterei: HOST, FELHASZNÁLÓNÉV, JELSZÓ, DB NEVE
$db =new mysqli ('dh-eotvos19-bpeo.sql.niif.hu','dh-eotvos19-bpeo','n2E593ZYtW','dh-eotvos19-bpeo' );
$db->set_charset("utf8");
if($db->connect_errno)
{
    echo $db->connect_errno;
}


?>