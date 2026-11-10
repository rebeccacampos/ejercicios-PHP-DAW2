<?php 

/*

Ejercicio 11 · Carrito con memoria
•  Crea catalogo.php con enlaces para elegir un producto.
•  Envía por POST el id y la cantidad.
•  Valida id contra el catálogo y cantidad positiva.
•  Guarda el carrito en $_SESSION.
•  Muestra una tabla con los artículos añadidos

*/



?>

<?php
// Iniciamos sesión por si queremos mostrar cuántos productos hay en el carrito
session_start();

// Definimos nuestro catálogo simulado (en un caso real vendría de una base de datos)
$catalogo = [
    1 => ["nombre" => "Camiseta Gamer", "precio" => 19.99],
    2 => ["nombre" => "Taza de Programador", "precio" => 9.50],
    3 => ["nombre" => "Teclado Mecánico", "precio" => 45.00]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Productos</title>
</head>
<body>
    <h1>Catálogo de la Tienda</h1>
    <p><a href="carrito_ia.php">Ver mi carrito de compras</a></p>
    
    <hr>

    <h2>Productos disponibles:</h2>
    <ul>
        <?php foreach ($catalogo as $id => $producto): ?>
            <li>
                <strong><?php echo $producto["nombre"]; ?></strong> - 
                $<?php echo number_format($producto["precio"], 2); ?>
                
                <!-- Formulario para enviar el ID y la cantidad por POST -->
                <form action="carrito_ia.php" method="POST" style="display:inline; margin-left: 10px;">
                    <input type="hidden" name="id_producto" value="<?php echo $id; ?>">
                    <label for="cantidad_<?php echo $id; ?>">Cantidad:</label>
                    <input type="number" id="cantidad_<?php echo $id; ?>" name="cantidad" value="1" min="1" max="10" style="width: 50px;">
                    <button type="submit">Añadir al carrito</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>