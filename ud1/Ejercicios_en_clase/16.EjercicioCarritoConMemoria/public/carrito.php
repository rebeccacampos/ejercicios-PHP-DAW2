<?php
session_start();
require_once __DIR__ . "/../src/catalogo.php";
require_once __DIR__ . "/../src/funciones.php";

//$_SESSION["productosEnCarrito"] = [];
//$_SESSION["idAñadir"] = $_POST["idAñadir"];
//$_SESSION["unidadesAñadir"] = $_POST["unidadesAñadir"];

// 1. Inicializamos el carrito solo si todavía no existe en la sesión
if (!isset($_SESSION["productosEnCarrito"])) {
    $_SESSION["productosEnCarrito"] = [];
}

// 2. Solo intentamos leer el $_POST si la petición viene de un formulario POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Verificamos que las claves existan para evitar los warnings
    if (isset($_POST["idAñadir"]) && isset($_POST["unidadesAñadir"])) {
        $_SESSION["idAñadir"] = $_POST["idAñadir"];
        $_SESSION["unidadesAñadir"] = $_POST["unidadesAñadir"];
        
        // Aquí iría la lógica para meterlo en "productosEnCarrito"
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Carrito de la compra</h1>
    <a href="comprar.php">Volver al catalogo</a>

    <br>
    <br>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Comprar</th>
        </tr>

        <?php foreach ($productosEnCarrito as $pro): ?>
            <tr>
                <td><?php echo $p["id"] ?></td>
                <td><?php echo $p["nombre"] ?></td>
                <td><?php echo $p["precio"] ?></td>
                <td><?php echo $p["stock"] ?></td>
                <td>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>