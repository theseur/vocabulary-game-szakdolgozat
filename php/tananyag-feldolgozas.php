<?php
// Start the session
session_start();
?>
<?php
  require_once 'connect.php';

  ?>

<!DOCTYPE html>
<html>
    <body>
    <?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["myfile"]["name"]);
$uploadOk = 1;
$temakorId=$db -> real_escape_string($_POST["Targyak"]);

//echo 'témakörid ='. $temakorId;

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else 
  {
    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) 
    {
      //echo "The file ". htmlspecialchars( basename( $_FILES["myfile"]["name"])). " has been uploaded.";
      $myFile = fopen($target_file, "r") or die("Unable to open file!");
      $szoszedet=[];
      $vanehiba=false;
    
      while(!feof($myFile )) 
      {
          
        $megvane=utf8_encode(fgets($myFile)) ;
        if(strlen($megvane)>0)
        {
          $elso=explode(";",$megvane);
          if(count($elso)>2){
              echo "Nem jó az oszlopok száma! <br>";
              $vanehiba=true;
              break;
  
          }
          if(strlen($elso[0])==0){
              echo "Van egy üres rublika az első oszlopban! <br>";
              $vanehiba=true;
              break;
          }
          if(strlen($elso[1])<3){
              echo "Van egy üres rublika a második oszlopban! <br>";
              $vanehiba=true;
              break;
          }
          array_push($szoszedet,$elso);
  
         // echo var_dump($szoszedet[0][1])  . "<br>";

        }

      }
      if($vanehiba==false&&count($szoszedet)<5)
      {
        $vanehiba=true;
        echo'<br> A sorok száma kevesebb, mint öt!<br>';
      }


fclose($myFile);
include_once "menu.php";
if($vanehiba==false)
{
  
  foreach($szoszedet as $egy)
  {
   
    $db-> query(" INSERT INTO szoszedet (`angol`,`magyar`,`temakorid`) VALUES('$egy[0]','$egy[1]',$temakorId)"); //az oszlopneveknél altgr + 7 kell!!

  }
  echo '<br> Sikeres feltöltés!';

}

    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
?>

    <?php mysqli_close($db);
?>
</body>

</html>