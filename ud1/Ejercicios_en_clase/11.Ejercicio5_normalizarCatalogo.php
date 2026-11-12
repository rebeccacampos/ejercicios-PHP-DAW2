<?php 

/* Ejercicio 5 normalizar un catálogo
- Trabaja con una lista de nombres de productos 
- Quita espacios sobrantes al principio y al final
- Muestra los nombres ordenados alfabéticamente
- Elimina los nombres duplicados
- Indica cuántos productos distintos quedan

Pistas: trim(), array_unique(), sort(), count()

*/

$productos = [" Teclado", "Ratón ", "Teclado", " webcam"];

# print_r($productos);

$productosLimpios = [];
echo "<h3>Los productos sin espacios son: </h3>";
for ($i=0; $i < count($productos); $i++) { 
    trim($productos[$i]);
    echo "$productos[$i]" . "<br>"; 

    array_push($productosLimpios, trim($productos[$i])); 
}

echo "<hr>";

$productosUnicos = array_unique($productosLimpios);
echo "<h3>Productos unicos: </h3>";
print_r($productosUnicos);

echo "<hr>";

sort($productosUnicos);
echo "<h3>Productos unicos ordenados: </h3>";
print_r($productosUnicos) ;

$totalProductosUnicos = count($productosUnicos);

echo "<hr>";

echo "<h3>El total de productos únicos es: $totalProductosUnicos </h3> ";

?>