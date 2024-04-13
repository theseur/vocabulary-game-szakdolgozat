<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Képfeltöltés</title>
</head>
<body>

<?php
include_once "menu.php";
?>
    <div id="kepfeltolt">
    <form action="kepfeltoltes.php" method="post" 
    enctype="multipart/form-data">
   
    <label>Kép:
    <input type="file" name="elso" required >
    </label><br>
    
    <input type="submit" name="kuld">
    </form>
    </div>

    
</body>
</html>