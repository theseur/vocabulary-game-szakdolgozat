<!DOCTYPE html>
<html>
  <head></head>
  <body><h1>Hello </h1>
  <div id="kodolnidiv"></div>
  <div id="fuggvkiiras"></div>
  <div id="aketstring"></div>
  <div id="fuggvkiiras2"></div>
  <div id="teszteles"></div>
  <div id="sorting1"></div>
  <div id="sorting2"></div>
  <div id="jsonkiir"></div>

<script>
    let kodolni="aabcccccaaa";
    let kiir = document.getElementById("kodolnidiv");
    let kiirfuggv= document.getElementById("fuggvkiiras");
    kiir.innerText=kodolni;
    wordrefresh(kodolni);
    function wordrefresh(kodolni)
    {
        console.log("fuggv");
        let length = kodolni.length;
        let szamtomb=[];
        let betutomb=[];
        let j=0;
        for (let i = 0; i < length-1; i++)
        {
          // alapból a tömbben null van, ehhez nem tudunk hozzáadni egyet
          // ezért ha null-t találunk beállítjuk átállítjuk 0-ra
            if (szamtomb[j] == null) {
              szamtomb[j] = 0;
            }
            if(i==0)
            {
                betutomb[j]=kodolni[i];
                szamtomb[j]++;
            }
            else
            {
              // Ha utolsó előtti elem van 2-t növel a számlálón
                if (i+2 == kodolni.length) {
                  betutomb[j]=kodolni[i];
                  szamtomb[j]=szamtomb[j]+2;
                  j++;
                } else if(kodolni[i]!=kodolni[i+1])
                {
                    betutomb[j]=kodolni[i];
                    szamtomb[j]++;
                    j++;
                }
                 else
                 {
                    szamtomb[j]++;
                }

            }

           

        }
        console.log(betutomb, szamtomb)
        for(let i=0;i<betutomb.length;i++){
            console.log(betutomb[i]+szamtomb[i]);
            kiirfuggv.innerText+=betutomb[i]+szamtomb[i];

        }

    }
</script>
<script>
  
  let str1="waterbottle";
  let str2="erbottlewat";
  let strkiir=document.getElementById("aketstring");
  let fvkir=document.getElementById("fuggvkiiras2");
  let tstkiir=document.getElementById("teszteles");
  let s1rt=document.getElementById("sorting1");
  let s2rt=document.getElementById("sorting2");
  strkiir.innerText=str1+" "+str2;
  uaze( str1, str2);

  function uaze(str1, str2)
  {
    //tstkiir.innerText="benne";

    
    var arr1 = str1.split('');
    var sorted1 = arr1.sort();
    s1rt.innerText="az első "+str1+" "+sorted1;
    
    var arr2 = str2.split('');
    var sorted2 = arr2.sort();
    s2rt.innerText="a második "+str2+" "+sorted2; 
 
    let azons=true;
    let azons1= new String(sorted1 ).valueOf() == new String(sorted2).valueOf();
    if(azons1){
      fvkir.innerText="tényleg";

    }
    else  {fvkir.innerText="nem igazán";}
    //fvkir.innerText=arr1.length+" "+arr2.length;
    if(sorted1.length==sorted2.length){
      for(let i=0;i<sorted1.length&&azons;i++){
        if(sorted1[i]!=sorted2[i]){
          azons=false;
        }
      }
      if(azons){
        tstkiir.innerText="at ifben azon";
      }
      else{
      tstkiir.innerText=" az ifben nem azon";
    }


    }
    else{
      tstkiir.innerText=" az ifben nem azon";
    }

  
   

  }


</script>
  </body>
</html>