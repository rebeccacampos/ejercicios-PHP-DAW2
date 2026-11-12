<?php
require_once __DIR__ . "/../src/catalogo.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Catalogo de la tienda</h1>
    <a href="carrito.php">Volver al carrito</a>
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

        <?php foreach ($productos as $p): ?>
            <tr>
                <td><?php echo $p["id"] ?></td>
                <td><?php echo $p["nombre"] ?></td>
                <td><?php echo $p["precio"] ?></td>
                <td><?php echo $p["stock"] ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="idAñadir" value="<?php echo $p["id"]; ?>">
                        <input id="unidadesAñadir" name="unidadesAñadir" type="number" min="0" value="1" required>
                        <button type="submit">Añadir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>