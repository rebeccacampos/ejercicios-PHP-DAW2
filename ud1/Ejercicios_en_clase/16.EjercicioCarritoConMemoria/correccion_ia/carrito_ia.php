<?php
session_start();

// Catálogo de referencia para validar que el ID exista
$catalogo = [
    1 => ["nombre" => "Camiseta Gamer", "precio" => 19.99],
    2 => ["nombre" => "Taza de Programador", "precio" => 9.50],
    3 => ["nombre" => "Teclado Mecánico", "precio" => 45.00]
];

// Si la petición viene por POST (el usuario acaba de hacer clic en "Añadir")
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = isset($_POST["id_producto"]) ? (int)$_POST["id_producto"] : 0;
    $cantidad = isset($_POST["cantidad"]) ? (int)$_POST["cantidad"] : 0;

    // Validación: que el ID exista en el catálogo y la cantidad sea positiva
    if (array_key_exists($id, $catalogo) && $cantidad > 0) {
        
        // Si el carrito aún no existe en la sesión, lo inicializamos como un array vacío
        if (!isset($_SESSION["carrito"])) {
            $_SESSION["carrito"] = [];
        }

        // Si el producto ya estaba en el carrito, sumamos la cantidad; si no, lo agregamos
        if (isset($_SESSION["carrito"][$id])) {
            $_SESSION["carrito"][$id] += $cantidad;
        } else {
            $_SESSION["carrito"][$id] = $cantidad;
        }
    }

    // Patrón PRG (Post/Redirect/Get) usando header y 303 para evitar duplicar envíos al refrescar
    header("location: carrito_ia.php", true, 303);
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Tu Carrito de Compras</h1>
    <p><a href="catalogo_ia.php">← Volver al catálogo</a></p>

    <?php if (empty($_SESSION["carrito"])): ?>
        <p>Tu carrito está vacío.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_global = 0;
                foreach ($_SESSION["carrito"] as $id => $cantidad): 
                    $producto = $catalogo[$id];
                    $subtotal = $producto["precio"] * $cantidad;
                    $total_global += $subtotal;
                ?>
                    <tr>
                        <td><?php echo $producto["nombre"]; ?></td>
                        <td>$<?php echo number_format($producto["precio"], 2); ?></td>
                        <td><?php echo $cantidad; ?></td>
                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <h3>Total a pagar: $<?php echo number_format($total_global, 2); ?></h3>
        
        <p><a href="vaciar_carrito_ia.php">Vaciar carrito</a></p>
    <?php endif; ?>
</body>
</html>