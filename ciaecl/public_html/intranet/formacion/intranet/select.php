<?        echo "<select name='pais' id='pais'>";

$paises = file("paises.txt");

$cuenta = count($paises);

for($i=0; $i < $cuenta; $i++){

echo "<option value='$paises[$i]'>$paises[$i]</option>";

}?>