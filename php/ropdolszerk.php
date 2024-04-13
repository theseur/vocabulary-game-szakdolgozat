<?php
require_once 'connect.php';


include_once "menu.php";


$result1 =$db-> query(" SELECT * FROM targytemakor
WHERE 	szulo	 IS NOT NULL

");
$szavak=array();
while ($row = $result1->fetch_assoc()){

    //var_dump($row);
    array_push($szavak, $row );

}
echo '<form action="ropdolgozatfeltoltes.php" method="post">';

echo '<select name="temakorval">';
for ($i=0;$i<count($szavak);$i++)
{
    echo'<option value="'.$szavak[$i]["id"].'">'.$szavak[$i]["nev"].'</option>';
}

echo '</select>';

$result2 =$db-> query(" SELECT DISTINCT osztaly FROM felhasznalok
WHERE 	osztaly	 IS NOT NULL
and osztaly NOT LIKE 'administrator'
order by osztaly asc
");
$szavak2=array();
while ($row1 = $result2->fetch_assoc()){

    //var_dump($row);
    array_push($szavak2, $row1 );

}

echo '<select name="osztalyval">';
for ($i=0;$i<count($szavak2);$i++)
{
    echo'<option value="'.$szavak2[$i]["osztaly"].'">'.$szavak2[$i]["osztaly"].'</option>';
}

echo '</select>';

echo '

    <label>Röpdolgozat ideje:
    <input type="datetime-local" name="idopont"required >
    </label><br>
';
echo'<input type="submit" name="kuld">';
echo '</form>'
?>
<?php mysqli_close($db);
?>