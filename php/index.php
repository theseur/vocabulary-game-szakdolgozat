<!DOCTYPE html>
<?php
  require_once 'connect.php';

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

<!--<div id="visszajel">

<form action="/action_page.php">
  <label for="mit">Mit javítanál?</label><br>
  <input type="text" id="mit" name="mit" value="word"><br>
  <label for="mire">Mire?</label><br>
  <input type="text" id="mire" name="mire" value="word"><br><br>
  
</form> -->

 
</div>
<div id="buttons">
<button id="temakorBtn" >Témakör</button>
<button id="dolgozat" >Dolgozat</button>
<button id="tanaroknak" >Tanároknak</button>
<button id="adminisztator">Adminisztátor</button>

</div>

<div id=legorduloTargy>
<form action="/action_page.php">
  <label for="Targyak">Válassz tárgyat:</label>
  <select name="Targyak" id="Targyak">
  <option value="0">Válassz!</option>
  </select>
  <select name="temakorok" id="temakorok">
    
  </select>
  
</form>

</div>

<div id="signIn">
<form action="/action_page.php">
  <label for="username">felhasználónév</label><br>
  <input type="text" id="username" name="username" value="word"><br>
  <label for="password">jelszó</label><br>
  <input type="password" id="password" name="password" value="word"><br><br>
</form> 
<button id="bejelentkezes" >Bejelentkezés</button>
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
  $result1 =$db-> query(" SELECT * FROM szoszedet
  ORDER BY RAND()
  LIMIT 5");
  $kiirandooangolszo;
  $draggavlenovelo=0;
  $veletlen=rand(0, 4);
  while ($row = $result1->fetch_assoc()){
    echo'<div id="draggable'.$draggavlenovelo.'" class="ui-widget-content draggable" style="bottom:'.$position.'px">
    '.$row["magyar"].'
  </div>
    ';
    if($veletlen==$draggavlenovelo){
      $kiirandooangolszo=$row["angol"];
      
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

let kattintas=[false,false,false,false,false];
let szinek=[{r:rndNum(),g:rndNum(),b:rndNum()}, {r:rndNum(),g:rndNum(),b:rndNum()}, {r:rndNum(),g:rndNum(),b:rndNum()}, 
{r:rndNum(),g:rndNum(),b:rndNum()}, 
{r:rndNum(),g:rndNum(),b:rndNum()} ];
let kockaDiv = document.getElementById("kocka");
let pontDiv=document.getElementById("pontkiiras");
let vegeKiirasDiv=document.getElementById("vegekiirias");
let adminisztatordiv=document.getElementById("adminisztator");
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

     /* let hibakuldesDiv=document.getElementById("visszajel");

      hibakuldesDiv.addEventListener("click",feltoltes); */
      adminisztatordiv.addEventListener("click",adminBeJel); 
      

      let targyakDiv=document.getElementById("Targyak");
      let temakorokDiv=document.getElementById("temakorok");
      let temakorkiirasDiv=document.getElementById("temakorkiiras");
      tantargyValaszto();

      

      let temakorBtnDiv=document.getElementById("temakorBtn");
      

      temakorBtnDiv.addEventListener("click",function(){wordCategoryRefresh(true)});

      let signInButtonDiv=document.getElementById("dolgozat");
      signInButtonDiv.addEventListener("click",appearing);

      let signInDiv=document.getElementById("signIn");
      let bejelentkezesDiv=document.getElementById("bejelentkezes");
      let usernameDiv=document.getElementById("username");
      let passwordDiv=document.getElementById("password");
      let tanaroknakDiv=document.getElementById("tanaroknak");
      tanaroknakDiv.addEventListener("click",tanarBeJel);
      bejelentkezesDiv.addEventListener("click",signingIn);

      var draggables = document.getElementsByClassName('draggable');
     
      var myImage = new Image(300,300);
      myImage.src = '../kep/fitness.jpg';
      myImage.style.marginLeft = '400px';
      myImage.style.marginTop = '150px';
      document.body.appendChild(myImage);

      targyakDiv.addEventListener("change",temakorokFuggv);

     
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
        console.log("wordrefr dragg");
                console.log(draggables);
                console.log("wordrefr querysel");
                console.log(document.querySelector("#draggable0"));
        
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
            pont++;
            pontszamNovelo();
            
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
              console.log(temakorokDiv.value);
              if(temakorokDiv.value=="")
              {
                console.log("if");
               
                wordrefresh();
                blocreset();
              }
              else
              {
                console.log("else");
                wordCategoryRefresh(false);
                blocreset();
              }  
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
          if(temakorokDiv.value=="")
              {
                wordrefresh();
                blocreset();
              }
              else
              {
                wordCategoryRefresh(false);
                blocreset();
              }
          
        }
          
        leftkockaPosition+=kockavisszeb;
        //topkockaPosition++;
        topkockaPosition+=kockafuggseb;
        kockaDiv.style.left = leftkockaPosition + "px";
        kockaDiv.style.top = topkockaPosition + "px";
        
      }
      function appearing()
        {

          window.location.assign("Diakbejelentkezes.php");

        }
        function disappearing()
        {

          signInDiv.style.visibility="hidden";

        }

     function wordrefresh()
     {
     
      fetch('api.php')
    .then(response => response.json())
    .then(data => 
    {
      console.log(data);
      x= Math.floor(Math.random()*5);
      kiirandooangolszoDiv.innerText=data[x].angol;
      for (var i=0; i<draggables.length; i++){
        draggables[i].innerText=data[i].magyar;
      }
      vege=0;
      vegecsuszka=0;
      probalkozasoksSzama++;
      probaSzamNovelo();
    });
    
     }
     console.log(temakorokDiv.value);


     function wordCategoryRefresh( vanecsere)
     {
      fetch('apitemakorszavak.php?temakorid='+temakorokDiv.value)
    .then(response => response.json())
    .then(data => 
    {
      console.log(data);
      x= Math.floor(Math.random()*5);
      kiirandooangolszoDiv.innerText=data[x].angol;
      for (var i=0; i<draggables.length; i++){
        draggables[i].innerText=data[i].magyar;
      }
      vege=0;
      vegecsuszka=0;
    });
    probalkozasoksSzama++;
    probaSzamNovelo();
    if (vanecsere==true){
      kepcsere();

    }
    
    
   // temakorkiirasDiv.innerText="témakörszám wcreffuggv: "+temakorokDiv.value;
     }


     function rndNum(){
       return Math.floor(Math.random() * 125)+128;
     }


function blocreset()
{
  let positioninscript=0;
  console.log(draggables);
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

}

function feltoltes()
{
  fetch('szovaltoztatas.php?mit='+mitDiv.value+'&mire='+mireDiv.value);
}

function temakorokFuggv()
{
  console.log(targyakDiv.value);
 

  fetch('apitemakorok.php?targyid='+targyakDiv.value)
  .then(response => response.json())
    .then(data => 
    {
      console.log(data);
      temakorokDiv.style.visibility="visible";
      temakorokDiv.innerHTML="";
      for (var i=0; i<data.length; i++)
      {
        temakorokDiv.innerHTML+="<option value='"+data[i].id+"'>"+data[i].nev+"</option>";
        
      }
     
    });
 kepcsereTargy();

    //temakorkiirasDiv.innerText=targyakDiv.value;
    
 
}

function signingIn()
{
  fetch('apibejel.php?nev='+usernameDiv.value+'&jelszo='+passwordDiv.value)
    .then(response => response.json())
    .then(data => 
    {
      console.log(data);
      if (data.length>0)
      {
        fnId=data[0].id;
        fnNev=data[0].nev;
        jelsz=data[0].jelszo;
       alert("Sikeres bejelentketés!") ;
       disappearing();
       

      }
    

})}

function pontszamNovelo()
{
  if(fnNev!=null){
    fetch('pontszam.php?nev='+fnNev+'&jelszo='+jelsz);
   
  }
  

}
function probaSzamNovelo()
{
  if(fnNev!=null){
    fetch('probalkozas.php?nev='+fnNev+'&jelszo='+jelsz);
   
  }

}

function tantargyValaszto()
{
  console.log(targyakDiv.value);  
 

  fetch('apitantargyvalasztas.php?fomenu=true')
  .then(response => response.json())
    .then(data => 
    {
      console.log(data);
      
      
      for (var i=0; i<data.length; i++)
      {
        targyakDiv.innerHTML+="<option value='"+data[i].id+"'>"+data[i].nev+"</option>";
        
      }
     
    });
 

    //temakorkiirasDiv.innerText="tárgyszám: "+targyakDiv.value;
    
}

function kepcsere()
{
  if(temakorokDiv.value)
  {
    fetch('apikep.php?temakorid='+temakorokDiv.value)
  .then(response => response.json())
  .then(data=>{
    myImage.src ='../kep/'+data[0].kepnev ;
    
  })
  }
  else 
  {
    myImage.src = '../kep/fitness.jpg';

  }

  //console.log(temakorokDiv.value);
  

  /*if(temakorokDiv.value==2)
  {
    myImage.src = '../kep/Angol Család.jpg';

  }

  else if(temakorokDiv.value==5)
  {
    myImage.src = '../kep/Angol ház1.jpg';

  }

  else if(temakorokDiv.value==6)
  {
    myImage.src = '../kep/ókor.jpg';

  }

  else if(temakorokDiv.value==8)
  {
    myImage.src = '../kep/SI jelek.jpg';

  }

  else if(temakorokDiv.value==9)
  {
    myImage.src = '../kep/Világ országai.jpg 1.jpg';

  }

  else if(temakorokDiv.value==10)
  {
    myImage.src = '../kep/Si nevek.jpg';

  }
  else 
  {
    myImage.src = '../kep/fitness.jpg';

  }*/

}

function kepcsereTargy(){
  if(targyakDiv.value==1)
  {
    myImage.src = '../kep/angol.jpg';

  }

  if(targyakDiv.value==3)
  {
    myImage.src = '../kep/Történelem.jpg';

  }

  if(targyakDiv.value==4)
  {
    myImage.src = '../kep/Földrajz.jpg';

  }

  if(targyakDiv.value==7)
  {
    myImage.src = '../kep/fizika.jpg';

  }
}
function tanarBeJel()
{
  //window.location.href="Tanari-bejel.php";
  window.open("Tanari-bejel.php", '_blank').focus();

}

function adminBeJel() 
{

  window.open("adminb_bejel.php", '_blank').focus();
}

</script>
  </body>
</html>
<?php mysqli_close($db);
?>