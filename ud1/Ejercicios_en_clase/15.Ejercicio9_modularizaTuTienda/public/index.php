<?php require_once __DIR__ . '/../src/catalogo.php'; ?>
<?php require_once __DIR__ . '/../src/funciones.php'; ?>

// hacer comprobaciones ejercicio 10 -> revision de seguridad

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Muestra una tabla HTML con todos los campos. -->

    <h1>Información de los productos</h1>
    <table style="border: 1px solid black; border-collapse: collapse; padding: 8px; ">
        <tr style="border: 1px solid black; border-collapse: collapse; padding: 8px; ">
            <th style="padding: 5px"><?= "ID" ?></th>
            <th style="padding: 5px"><?= "NOMBRE" ?></th>
            <th style="padding: 5px"><?= "PRECIO" ?></th>
            <th style="padding: 5px"><?= "STOCK" ?></th>
            <th style="padding: 5px"><?= "STOCK < 3" ?></th>
            <th style="padding: 5px"><?= "Precio del stock" ?></th>
        </tr>
        <?php

        $valorTotalInventario = 0;

        foreach ($productos as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p["id"]) ?></td>
                <td><?= htmlspecialchars($p["nombre"]) ?></td>
                <td><?= htmlspecialchars($p["precio"]) ?></td>
                <td><?= htmlspecialchars($p["stock"]) ?></td>
                <!-- Destaca los productos con stock menor que 3.-->
                <td><?php if ($p["stock"] < 3) {
                        echo "⚠️";
                    } else {
                        echo "✅";
                    } ?></td>
                <!-- Calcula el valor total de las existencias.  -->
                <td><?php $valorStock = $p['stock'] * $p['precio'];
                    echo $valorStock;
                    $valorTotalInventario += $valorStock;
                    ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <table border="1px solid black" style="border-collapse: collapse;">
        <tr>
            <th>Valor total del inventario</th>
        </tr>
        <tr>
            <td><?= $valorTotalInventario ?></td>
        </tr>
    </table>

    <br>
    <hr>
    <br>

    <?php  ?>
    <!-- Ejercicio 4 · Filtrar productos -> Añade un formulario GET con precio máximo. -->
    <?php

    $precioMaximo = validarPrecioMaximo();
    $productoBuscar = validarIDUsuario();

    $encontrado = buscarProducto($productos, $productoBuscar);
    if ($encontrado !== null) {
        echo "Producto a buscar: " . htmlspecialchars($encontrado);
    } else {
        echo "⚠️ El producto indicado no existe.";
    }
    echo "<br/>";
    //echo "Resultado función puedeComprar: " . puedeComprar($productos, 2, 2);

    ?>

    <form action="" method="get"> <!--dejando el action así redirige a la misma página-->
        <p>
            <label for="precioMaximo"><strong>Indica el precio máximo:</strong></label>
            <input id="precioMaximo" name="precioMaximo" type="number" min="0" required>
        </p>
        <p>
            <label for="IDbuscar"><strong>Indica que producto quieres buscar: </strong></label>
            <input id="IDbuscar" name="IDbuscar" type="number" min="0" required>
        </p>
        <button type="submit">Calcular</button>
    </form>

    <!-- Muestra solo los productos con precio <= máximo. -->
    <?php if ($precioMaximo > 0): ?>
        <h1>Productos en función del precio máximo</h1>
        <table style="border: 1px solid black; border-collapse: collapse; padding: 8px; ">
            <tr style="border: 1px solid black; border-collapse: collapse; padding: 8px; ">
                <th style="padding: 5px"><?= "ID" ?></th>
                <th style="padding: 5px"><?= "NOMBRE" ?></th>
                <th style="padding: 5px"><?= "PRECIO" ?></th>
                <th style="padding: 5px"><?= "STOCK" ?></th>
                <th style="padding: 5px"><?= "STOCK < 3" ?></th>
                <th style="padding: 5px"><?= "Precio del stock" ?></th>
            </tr>
            <?php

            $valorTotalInventario = 0;
            $productosMenorPrecioMax = filtrarPorPrecioMax($productos, $precioMaximo);

            ?>

            <?php if ($productosMenorPrecioMax != null):  ?>
                <?php foreach ($productosMenorPrecioMax as $pr): ?>
                    <tr>
                        <td><?= htmlspecialchars($pr["id"]) ?></td>
                        <td><?= htmlspecialchars($pr["nombre"]) ?></td>
                        <td><?= htmlspecialchars($pr["precio"]) ?></td>
                        <td><?= htmlspecialchars($pr["stock"]) ?></td>
                        <!-- Destaca los productos con stock menor que 3.-->
                        <td><?php if ($pr["stock"] < 3) {
                                echo "⚠️";
                            } else {
                                echo "✅";
                            } ?></td>
                        <!-- Calcula el valor total de las existencias.  -->
                        <td><?php $valorStock = $pr['stock'] * $pr['precio'];
                            echo $valorStock;
                            $valorTotalInventario += $valorStock;
                            ?></td>
                    </tr>
                <?php endforeach; ?>
        </table>
    <?php endif ?>
<?php endif ?>
<br>

<?php if ($precioMaximo == 0 || $precioMaximo == null) {
    echo "⚠️ Indica un precio máximo válido";
} ?>

</body>

</html>