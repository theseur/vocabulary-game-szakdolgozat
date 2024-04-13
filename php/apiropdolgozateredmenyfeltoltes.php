<?php
header('Content-type:application/json;charset=utf-8');
 require_once 'connect.php';
 session_start();
 
 $userid=$_GET["userid"];
 $szoszedetid=$_GET["szoszedetid"];
 $kezdesido=$_GET["kezdesido"];
 $ropbeallitasid=$_GET["ropbeallitasid"];

 if($_GET["talalat"]=="true")
 {
    $talalat=1;

 }
 else
 {
    $talalat=0;
 }
 
 /*echo  " INSERT INTO ropdolgozat (userid,szoszedetid,kezdesido,befejezesido,talalat)
 VALUES($userid,$szoszedetid,'$kezdesido',now(),$talalat)";*/
 $db-> query(" INSERT INTO ropdolgozat 	(userid,szoszedetid,kezdesido,befejezesido,talalat,ropbeallitasid)
  VALUES($userid,$szoszedetid,'$kezdesido',now(),$talalat,$ropbeallitasid)");
  $kellazidhez=[];
  $kellazidhez["id"]=$db->insert_id;

  echo json_encode( $kellazidhez,JSON_UNESCAPED_UNICODE);

?>