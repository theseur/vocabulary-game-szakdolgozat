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
      <form id="fileFeltolt" action="tananyag-feldolgozas.php"  method="post" enctype="multipart/form-data">
    <label for="myfile">Select a file:</label>
    <select name="Targyak" id="Targyak">
  <option value="0">Válassz!</option>
  </select>
<input type="file" id="upload" name="myfile">

</form>
</div>
  <!--</form>-->

</div>
<script>

let uploadDiv=document.getElementById("upload");
let targyakDiv=document.getElementById("Targyak");
tantargyValaszto();

uploadDiv.addEventListener("change",uploadFuggv);

function uploadFuggv()
{

var fullPath = document.getElementById('upload').value;
if (fullPath) {
    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
    var filename = fullPath.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
        filename = filename.substring(1);
    }
    var kiterjesztes=filename.split(".");

    if(kiterjesztes[kiterjesztes.length-1].toLowerCase()!="csv")
    {
      alert("nem csv a kiterjesztés!");

    }
    else{
      if(targyakDiv.value!=0)
      {
      var tovabbitas = document.getElementById("fileFeltolt");
      tovabbitas.submit();
      }
      else{
        alert("Nem választottál témakört!");
      }


      alert(kiterjesztes[kiterjesztes.length-1]);
    }

    
}
}

function tantargyValaszto()
{
  fetch('apitantargyvalasztas.php?fomenu=false')
  .then(response => response.json())
    .then(data => 
    {
      console.log(data);
      
      
      for (var i=0; i<data.length; i++)
      {
        targyakDiv.innerHTML+="<option value='"+data[i].id+"'>"+data[i].nev+"</option>";
        
      }
     
    });

}

</script>

<?php
if(isset($_SESSION["userid"]))
{

  
include_once "menu.php";

      
}

?>
<?php mysqli_close($db);
?>
</body>

</html>