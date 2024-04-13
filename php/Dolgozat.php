<!DOCTYPE html>
<?php
  require_once 'connect.php';
  session_start();
  ?>
<html>
<head><title>Játék</title>
  <link rel="stylesheet" type="text/css" href="../stiluslap.css"></head>
  <body>
  
    <div id="kocka">

</div>
<div id="pontkiiras">
0
</div>
<div id=vegekiirias>
  vége: 
</div>

<div id=kerdesszam>
  Kérdések száma: 
</div>


<!--<div id="visszajel">



<form action="/action_page.php">
  <label for="mit">Mit javítanál?</label><br>
  <input type="text" id="mit" name="mit" value="word"><br>
  <label for="mire">Mire?</label><br>
  <input type="text" id="mire" name="mire" value="word"><br><br>
  
</form> -->
</div>
<div id="feladat">
A helyes csuszkával pattintsd vissza a négyzetet!
</div>
<div id= "leiras">
  <ul>
    <li>
      Vidd az egeret a megfelelő téglalapra!
</li>
    <li>
      A bal egérgombot lenyomva vidd a téglalapot<br> a zöld négyzethez!
</li>
    <li>
      Ha eltaláltad a párt, kapsz egy pontot!
</li>
</ul>
</div>
<div id="temakorkiiras"></div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    for (var i=0; i<5;i++){
      $( "#draggable"+i ).draggable();
    }
    
  } );
  </script>

  <?php
  $position =0;

  //select cast(datum as date) FROM ropbeallitas;
  $date = date('Y-m-d');

  $my_date_time = date("Y-m-d H:i:s", strtotime("+1 hours"));
  $osztaly=$_SESSION["diakosztaly"];
  echo $osztaly;
  $result2 =$db-> query(" SELECT ropbeallitas.*, targytemakor.kepnev FROM ropbeallitas
  INNER JOIN targytemakor ON targytemakor.id =ropbeallitas.temakorid
where osztaly like '$osztaly'
and '$date' = cast(datum as date) 
and datum<'$my_date_time'
"
);

$szavak=array();
while ($row = $result2->fetch_assoc())
{

  //var_dump($row);
  array_push($szavak, $row );

}
//var_dump($szavak[0]);
echo '<input type="hidden" value="'.$szavak[0]["id"].'" id="ropbeallidkiir">';
//cdfac85df641c02fd0e491df0a97ea456fe4e945
if(empty($szavak))
{
  echo "<script>
alert('Ma nincs dolgozat!');
window.location.href='index.php';
</script>";
}
echo $szavak[0]["temakorid"];
$szoszedetidang;
  $result1 =$db-> query(" SELECT * FROM szoszedet
  where temakorid =". $szavak[0]["temakorid"]."
  ORDER BY RAND()
  LIMIT 5");
  $kiirandooangolszo;
  $draggavlenovelo=0;
  $veletlen=rand(0, 4);
  while ($row = $result1->fetch_assoc())
  {
    echo'<div id="draggable'.$draggavlenovelo.'" class="ui-widget-content draggable" style="bottom:'.$position.'px">
    '.$row["magyar"].'
  </div>
    ';
    if($veletlen==$draggavlenovelo){
      $kiirandooangolszo=$row["angol"];
      $szoszedetidang=$row["id"];
    }
    $position+=25;
  $draggavlenovelo++;
  }
  echo'<div id="kiirandooangolszo">'.$kiirandooangolszo.'
  </div>';
  
  ?>
<script>//elkapások


let fnNev=null;
let jelsz=null;
let fnId=null;
let probalkozasoksSzama=1;
let temakoridropdoli=<?=$szavak[0]["temakorid"]?>;
let kezdesido=new Date();

let kattintas=[false,false,false,false,false];
let szinek=[{r:rndNum(),g:rndNum(),b:rndNum()}, {r:rndNum(),g:rndNum(),b:rndNum()}, {r:rndNum(),g:rndNum(),b:rndNum()}, 
{r:rndNum(),g:rndNum(),b:rndNum()}, 
{r:rndNum(),g:rndNum(),b:rndNum()} ];
let kockaDiv = document.getElementById("kocka");
let pontDiv=document.getElementById("pontkiiras");
let vegeKiirasDiv=document.getElementById("vegekiirias");
let kiirandooangolszoDiv=document.getElementById("kiirandooangolszo");
let leftkockaPosition = 0;
      let topkockaPosition = 0;
      let kockamozgas = setInterval(kockamoveDiv, 300);
      let kockafuggseb=10;
      let kockavisszeb=1;
      let vege=0;
      let vegecsuszka=0; //a próbálkozások számát méri
      var x = <?=$veletlen?>;
      let pont=0;
      let mitDiv=document.getElementById("mit");
      let mireDiv=document.getElementById("mire");
      let drg0=document.getElementById("draggable0");
      let kerdesdiv=document.getElementById("kerdesszam");
      let szoszedetid1=<?=$szoszedetidang?>;
      //let hibakuldesDiv=document.getElementById("visszajel");
      let ropDoliId=0;
      let ropbeallitasid=document.getElementById("ropbeallidkiir").value;
      let userid1=<?=$_SESSION["diakuserid"]?>;
      

      //hibakuldesDiv.addEventListener("click",feltoltes); 

   

      var draggables = document.getElementsByClassName('draggable');
     
      var myImage = new Image(300,300);
      myImage.src = '../kep/<?=$szavak[0]["kepnev"]?>';
      myImage.style.marginLeft = '400px';
      myImage.style.marginTop = '150px';
      document.body.appendChild(myImage);

     // targyakDiv.addEventListener("change",temakorokFuggv);

     
      for (var i=0; i<draggables.length; i++){

        let j=i;

        draggables[i].addEventListener("click",function()
        {
          //
            kattintas[j]=true;
            //alert("kattintottál");
        });

      }


      //függvények

      function kockamoveDiv() 
      {

        
        if(probalkozasoksSzama>5)

        {

          clearInterval(kockamozgas);
          alert('vége a dolgozatnak!');
          fetch('apiFeladatFeltotles.php?ropdoolid='+ropDoliId+'&pontszam='+pont+'&userid='+userid1)
          .then
          (data=>
          {
            window.location.href='kijelentkezes.php';
          }
          
          )
          

        }
        
         draggables = document.getElementsByClassName('draggable');  //var offsets = document.getElementsByClass('draggable').getBoundingClientRect();
        for (var i=0; i<draggables.length; i++)
        {

          var offsets = draggables[i].getBoundingClientRect();
          var top = offsets.top;
          var left = offsets.left;

          draggables[i].style.backgroundColor="rgb("+szinek[i].r+","+szinek[i].g+","+szinek[i].b+")"; //szinek[i]
        if(Math.abs(top-topkockaPosition)<Math.abs(kockafuggseb)&&(leftkockaPosition-left)>0&&(leftkockaPosition-left)< 400)
        {
          kockafuggseb=-1*kockafuggseb;
          vegecsuszka++;
          console.log(kattintas);
          if(i==x&& kattintas[i]==true)
          {
            console.log(kattintas);
            pont++;
            //pontszamNovelo();
            
            vege++;
            pontDiv.innerText="pontjaid száma "+pont;
            vegeKiirasDiv.innerText="vége: "+vege;
            alert("Van egy pontod!");
            myImage.src = '../kep/giphy360p.mp4_000001793.gif';
            console.log("I am the third ");
            setTimeout(function(){
              console.log("I am the third log after 5 seconds");
              kepcsere();
              },3000);
             
                wordCategoryRefresh();
                blocreset(true);
                
          }
          
         }
          if(topkockaPosition>window.innerHeight||topkockaPosition<0){
            kockafuggseb=-1*kockafuggseb;
            vege++;
            //vegeKiirasDiv.innerText="vége: "+vege;

          }
          if(leftkockaPosition>window.innerWidth||leftkockaPosition<0){
            kockavisszeb=-1*kockavisszeb;
            vege++;
            //vegeKiirasDiv.innerText="vége: "+vege;
          }
          console.log(vege);
        }
        if(vege>10||vegecsuszka===2){
          pont+=0.1; 
          //vegeKiirasDiv.innerText="vége: "+vege;
          
                wordCategoryRefresh();
                blocreset(false);
             
          
        }
          
        leftkockaPosition+=kockavisszeb;
        //topkockaPosition++;
        topkockaPosition+=kockafuggseb;
        kockaDiv.style.left = leftkockaPosition + "px";
        kockaDiv.style.top = topkockaPosition + "px";
        
      }
      function appearing()
{

  signInDiv.style.visibility="visible";

}
function disappearing()
{

  signInDiv.style.visibility="hidden";

}

function wordCategoryRefresh( vanecsere)
     {
      fetch('apitemakorszavak.php?temakorid=<?=$szavak[0]["temakorid"]?>')
    .then(response => response.json())
    .then(data => 
    {
      console.log(data);
      x= Math.floor(Math.random()*5);
      kiirandooangolszoDiv.innerText=data[x].angol;
      szoszedetid1=data[x].id;
      for (var i=0; i<draggables.length; i++){
        draggables[i].innerText=data[i].magyar;
      }
      vege=0;
      vegecsuszka=0;
    });
    kerdesdiv.innerText=probalkozasoksSzama;
    probalkozasoksSzama++;
    //probaSzamNovelo();
    
     // kepcsere();
    
    }
    // console.log(temakorokDiv.value);


    
    
   // temakorkiirasDiv.innerText="témakörszám wcreffuggv: "+temakorokDiv.value;
     


     function rndNum(){
       return Math.floor(Math.random() * 125)+128;
     }


function blocreset(vanepont)
{
  let positioninscript=0;
  for (var i=0; i<draggables.length; i++)
  {

    draggables[i].style.bottom=positioninscript+"px";
    draggables[i].style.top=null;
    draggables[i].style.left=null;
    positioninscript+=25; 
    szinek=[{r:rndNum(),g:rndNum(),b:rndNum()}, 
            {r:rndNum(),g:rndNum(),b:rndNum()}, 
            {r:rndNum(),g:rndNum(),b:rndNum()}, 
            {r:rndNum(),g:rndNum(),b:rndNum()}, 
            {r:rndNum(),g:rndNum(),b:rndNum()} ];

  }
  topkockaPosition=0;
  leftkockaPosition=0;
  //kattintas[j]=false;
 
  //await wait(5000);
  
 
 

  
  kattintas=[false,false,false,false,false];
  //let userid1=<?=$_SESSION["diakuserid"]?>;

  

  fetch('apiropdolgozateredmenyfeltoltes.php?userid='+userid1+'&szoszedetid='+szoszedetid1
  +'&kezdesido='+kezdesido.toISOString().replace("T"," ").replace("Z","")+'&talalat='+vanepont+'&ropbeallitasid='+ropbeallitasid)
  .then(response => response.json())
  .then(data=>{
    if(ropDoliId==0)
    {
      ropDoliId=data.id;
    }
    
  })

}

function feltoltes()
{
  fetch('szovaltoztatas.php?mit='+mitDiv.value+'&mire='+mireDiv.value);
}

function kepcsere()
{
  myImage.src = '../kep/<?=$szavak[0]["kepnev"]?>';


}

</script>
  </body>
</html>
<?php mysqli_close($db);
?>