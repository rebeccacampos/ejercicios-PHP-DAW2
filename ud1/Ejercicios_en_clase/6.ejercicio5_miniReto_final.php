<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- Enunciado
Crea producto.php con estas variables:
$producto, $precio, $unidades y $stock.
Debe mostrar:
• Nombre del producto.
• Importe total = precio × unidades.
• “Disponible” si hay stock suficiente o “Sin stock suficiente” en caso contrario.
• Si el importe supera 100 €, muestra además “Envío gratuito”.
Extra: muestra toda la salida dentro de HTML bien estructurado.
-->
<?php 
    $producto = "Termo";
    $precio = 80;
    $unidades = 5; // lo que se va a comprar
    $stock = 0; // las unidades disponibles en la tienda
    $importeTotal = $precio * $unidades;
    if ($stock > $unidades) {
        echo "Producto disponible" . "<hr>";
    } else {
        echo "Sin stock suficiente" . "<hr>";
    }

    if ($importeTotal > 100) {
        echo "Envío gratuito";
    }
?>
<h1> Venta de <?php echo $producto ?> </h1>
<ul>
    <li>Stock (disponibles en la tienda): <?php echo $stock ?></li>
    <li>Precio: <?php echo $precio ?></li>
    <li>Unidades a comprar: <?php echo $unidades ?></li>
    
    <li>Importe total: <strong><?php echo $importeTotal ?></strong></li>
</ul>

    
</body>
</html>