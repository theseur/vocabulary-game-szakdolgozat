<?php

session_start();
require_once 'connect.php';

?>
<html>
<head><title>Eredmény </title>
<meta charset="UTF-8">
</head>
    <body>

    <?php

if(isset($_SESSION["userid"]))
{
  $felhasznaloid=$_SESSION["userid"];
  
  include_once "menu.php";
  
      
      $result1= $db->query("SELECT DISTINCT felhasznalok.osztaly, ropdolgozat.ropbeallitasid
      FROM feladatok
      INNER JOIN ropdolgozat on feladatok.ropdolgozatid=ropdolgozat.id
      INNER JOIN ropbeallitas on ropdolgozat.ropbeallitasid=ropbeallitas.id
      INNER JOIN felhasznalok ON feladatok.userid=felhasznalok.id
      WHERE ropbeallitas.tanarid=$felhasznaloid
      GROUP BY felhasznalok.osztaly
      order by felhasznalok.osztaly asc
      ");
       $temakorok=array();
      
       while ($row = $result1->fetch_assoc())
       {
       
           //var_dump($row);
           array_push($temakorok, $row );
          // var_dump($row);
           
       }
       //ar_dump($temakorok);
            $targyakNeve="<select name='opcio' id='targy'>";
      foreach($temakorok as $targy)
      {
          $targyakNeve.='<option value="'.$targy["osztaly"].'">'.$targy["osztaly"].'</option>';

      }
      $targyakNeve.="</select>";
      echo'<div>
      <br>
            <label for="temakorNev">Osztály</label><br>' 
            .$targyakNeve.'

            <button id="gomb">Kiválaszt</button>
        
        
          </div>';
}
?>
<div id="kezdesiidokiir">

</div>
<div id="tanulonevkiir">
</div>




<script>
 
let targyDiv= document.getElementById("targy");
let gombDiv=document.getElementById("gomb");
let kezdesiidokiir=document.getElementById("kezdesiidokiir");
let tanulonevkiir=document.getElementById("tanulonevkiir");




gombDiv.addEventListener("click",kezdido);


function kezdido()
{


  fetch('apikezdesiido.php?nev='+targyDiv.value)
  .then(response => response.json())
    .then(data => 
    {   
      console.log(data);
      let resultkiir="<select name='opcio2+' id='kezdesiido'>";
      resultkiir+="<option value='0'>Gördítsd le!</option>";
      for (var i=0; i<data.length; i++)
      {
        resultkiir+="<option value='"+data[i].datum+"'>"+data[i].datum+"</option>";
        
      }
      resultkiir+="</select> <button id='tanulonevgomb'>Válassz időpontot</button>";
      kezdesiidokiir.innerHTML=resultkiir;
      let tanulonevgombdiv=document.getElementById("tanulonevgomb");
      tanulonevgombdiv.addEventListener("click",tanulonevek);



    })
    
}

function tanulonevek()
{
  let kezdesiidodiv=document.getElementById("kezdesiido");
  fetch('apitanulonev.php?nev='+kezdesiidodiv.value+'&osztaly='+targyDiv.value)
  .then(response => response.json())
    .then(data => 
    {
      tanulonevkiir.innerHTML="";
      for (var i=0; i<data.length; i++)
      {
        tanulonevkiir.innerHTML+=data[i].usernev+" "+data[i].pontszam+"<br>";
      }
      tanulonevkiir.innerHTML+="<a href='txtbeirat.php?datum="+kezdesiidodiv.value+"'>Eredmények txt fliebe kiíratása</a>"

    }

    )

}


</script>
       
     


</body>
</html>