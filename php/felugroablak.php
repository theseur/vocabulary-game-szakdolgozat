<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="<?=$_GET['tovabb']?>" id="joform">
    <label for="jovahagyas">Írja be az igen szót, ha jóváhagyja a műveletet:</label><br>
  <input type="text" id="approval" name="approval"><br>

    <button>
    Kattints ide a továbblépéshez!
</button>

    </form>
    <button id="vissza">
    Vissza.
</button>

<script>
    let formValt=document.getElementById("joform");
    let textValt=document.getElementById("approval");
    let gombValt=document.getElementById("vissza");

    function viszzagomb() {
        window.history.back();
        
    }

    function formValidalas(e)
    {
            if(textValt.value!="igen")
            {
                e.preventDefault();
            }

    }

    



    gombValt.addEventListener("click", viszzagomb);
    formValt.addEventListener("click", formValidalas);
    


</script>   

</body>
</html>