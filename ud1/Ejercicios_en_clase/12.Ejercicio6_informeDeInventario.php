<?php

/* Ejercicio 6 informe de inventario
- Reutiliza el array de productos de la sesión 2
- Calcula el valor total de existencias 
- Muestra importes con dos decimales
- Lista los productos cuyo nombre contenga "a".
- Muestra la fecha del informe y valida un filtro GET (usar el filter_input)

Pista: consulta el manual cuando lo necesites

*/

# array de productos de la sesión 2
$productos = [
    ["id" => 1, "nombre" => "auriculares", "precio" => 45.5, "stock" => 6],
    ["id" => 2, "nombre" => "teclado", "precio" => 200, "stock" => 2],
    ["id" => 3, "nombre" => "ratón", "precio" => 30.20, "stock" => 1],
    ["id" => 4, "nombre" => "pantalla", "precio" => 120, "stock" => 5],
    ["id" => 5, "nombre" => "pendrive", "precio" => 20, "stock" => 2]
];

$valorTotalExistencias = 0;
$nombresContienenA = [];
foreach($productos as $pro) {
    $valorTotalExistencias = $valorTotalExistencias + $pro["stock"] * $pro["precio"];
    //echo "$valorTotalExistencias <br>";

    //Lista los productos cuyo nombre contenga "a".
    $nombreDelProducto = $pro["nombre"];
    for ($i=0; $i < strlen($nombreDelProducto) ; $i++) { 
        if ($nombreDelProducto[$i] === "a") {
            array_push($nombresContienenA, $nombreDelProducto);
            break;
        }
    }
}

$valorTotalExistencias = number_format($valorTotalExistencias, 2);
echo "El valor total de las existencias es $valorTotalExistencias €";
echo "<br>";
// print_r($nombresContienenA);
echo "<br> Los nombres de productos que contienen la letra 'a' son: ";
foreach($nombresContienenA as $nomb) {
    echo "<li>$nomb</li>";
}

echo "<br> La fecha de hoy es: " . date("d/m/Y") . "<br><br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="get">
        <label for="cantidad"><strong>Cantidad de auriculares que desea:</strong></label>
        <input id="cantidad" name="cantidad" type="number" min="0" required value = "<?= $cantidad?>">
        <button type="submit">Enviar</button>
    </form>
    <?php  
        $cantidad = filter_input(INPUT_GET, 'cantidad', FILTER_VALIDATE_INT);
        if ($cantidad != null) {
            echo "La cantidad validada con un filtro get es: " . htmlspecialchars($cantidad) . " €";
        } else {
            echo "⚠️ Introduzca una cantidad valida para poder validar el input :)";
        }
    ?>
</body>
</html>

<?php

/* Ejercicio 6 informe de inventario
- Reutiliza el array de productos de la sesión 2
- Calcula el valor total de existencias 
- Muestra importes con dos decimales
- Lista los productos cuyo nombre contenga "a".
- Muestra la fecha del informe y valida un filtro GET (usar el filter_input)

Pista: consulta el manual cuando lo necesites

*/

/*
# array de productos de la sesión 2
$productos = [
    ["id" => 1, "nombre" => "auriculares", "precio" => 45.5, "stock" => 6],
    ["id" => 2, "nombre" => "teclado", "precio" => 200, "stock" => 2],
    ["id" => 3, "nombre" => "ratón", "precio" => 30.20, "stock" => 1],
    ["id" => 4, "nombre" => "pantalla", "precio" => 120, "stock" => 5],
    ["id" => 5, "nombre" => "pendrive", "precio" => 20, "stock" => 2]
];

# 1. Calcula el valor total monetario de las existencias (precio * stock de cada uno)
$valorTotalInventario = 0;
foreach ($productos as $producto) {
    $valorTotalInventario += ($producto["precio"] * $producto["stock"]);
}

# 2. Validar un filtro GET usando filter_input (por ejemplo, un parámetro 'categoria' o 'orden')
$filtroBusqueda = filter_input(INPUT_GET, 'buscar', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';

# 3. Obtener la fecha actual del informe
$fechaInforme = date('d/m/Y H:i:s');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Inventario</title>
</head>
<body>
    <h1>Informe de Inventario</h1>
    <p><strong>Fecha del informe:</strong> <?php echo $fechaInforme; ?></p>

    <?php if ($filtroBusqueda !== ''): ?>
        <p>Filtrando por término GET: <strong><?php echo $filtroBusqueda; ?></strong></p>
    <?php endif; ?>

    <h2>Listado general de productos</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Valor Total (Stock)</th>
        </tr>
        <?php foreach ($productos as $prod): ?>
            <tr>
                <td><?php echo $prod["id"]; ?></td>
                <td><?php echo htmlspecialchars($prod["nombre"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo number_format($prod["precio"], 2, ',', '.'); ?> €</td>
                <td><?php echo $prod["stock"]; ?></td>
                <td><?php echo number_format($prod["precio"] * $prod["stock"], 2, ',', '.'); ?> €</td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Valor total de todas las existencias: <strong><?php echo number_format($valorTotalInventario, 2, ',', '.'); ?> €</strong></h3>

    <hr>

    <h2>Productos cuyo nombre contiene la letra "a":</h2>
    <ul>
        <?php 
        foreach ($productos as $prod) {
            // str_contains busca si la subcadena "a" está presente en el nombre del producto -> https://www.php.net/manual/en/function.str-contains.php
            if (str_contains($prod["nombre"], "a")) {
                echo "<li>" . htmlspecialchars($prod["nombre"], ENT_QUOTES, 'UTF-8') . " (Precio: " . number_format($prod["precio"], 2, ',', '.') . " €)</li>";
            }
        }
        ?>
    </ul>
</body>
</html>
*/