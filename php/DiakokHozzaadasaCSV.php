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
require_once 'menuAdmin.php';
?>

      <form id="fileFeltolt" action="DiakokHozzaadasaCSV.php"  method="post" enctype="multipart/form-data">
    <label for="myfile">Select a file:</label>
    
   
<input type="file" id="upload" name="myfile">
<label for="osztalyNeve">Osztály neve</label><br>
      <input type="text" id="osztalyNeve" name="osztalyNeve" value="word" require><br>
<button>Feltölt</button>
</form>

<?php



if(isset($_FILES["myfile"]))
{
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["myfile"]["name"]);
$uploadOk = 1;
$osztalyNev=$_POST["osztalyNeve"];

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else 
  {
    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) 
    {
      
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
              echo "Nem jó az oszlopok száma!";
              $vanehiba=true;
              break;
  
          }
          if(strlen($elso[0])==0){
              echo "Van egy üres rublika az első oszlopban!";
              $vanehiba=true;
              break;
          }
          if(strlen($elso[1])<3){
              echo "Van egy üres rublika a második oszlopban!";
              $vanehiba=true;
              break;
          }
          array_push($szoszedet,$elso);
  
         // echo var_dump($szoszedet[0][1])  . "<br>";

        }

      }


fclose($myFile);

if($vanehiba==false)
{
  //echo 'benn';
  $db-> autocommit(FALSE);
  $db->begin_transaction();

  $vanehiba2=false;
  $hanydikSorbanHiba=0;
  foreach($szoszedet as $egy)
  {
    $hanydikSorbanHiba++;
   $jelszo=sha1(trim($egy[1]));
   try
   {
      $db-> query(" INSERT INTO felhasznalok (`usernev`,`jelszo`,`osztaly`) VALUES('$egy[0]','$jelszo','$osztalyNev')"); //az oszlopneveknél altgr + 7 kell!!
    }
    catch(Throwable $e)
   {
        echo'Van már ilyen nevű és jelszavú diák!';
        echo "a hiba a ".$hanydikSorbanHiba." sor köról lehet";

   }
      $error = mysqli_error($db);
      if(!empty($error))
      {
        $vanehiba2=true;
        print("Hiba történt az adatok feltöltése során: ".$error);
        error_log(
          $error, 
          3,
          "Error.txt",
        
        );
        $file = 'error2.txt';
        $data = "\n".$error.date("Y-m-d");
        file_put_contents($file, $data, FILE_APPEND);

      }

    
   
  }
  if($vanehiba2==false)
  {
    $db->commit();
    echo "The file ". htmlspecialchars( basename( $_FILES["myfile"]["name"])). " has been uploaded.<br>";
    include_once "menuAdmin.php";

  }
  else{
    $db->rollback();
    echo "Sorry, there was an error uploading your file.";
    

  }

  

}

    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
?>
<?php mysqli_close($db);
?>
</body>

</html>