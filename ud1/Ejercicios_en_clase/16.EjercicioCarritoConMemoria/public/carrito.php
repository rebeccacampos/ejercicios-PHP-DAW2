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
// codigo equivalente: 
//$_SESSION["carrito"] ??= []; // inicializa el carrito de compras como un arreglo vacío solo si aún no existe o su valor es nulo.



// 2. Solo intentamos leer el $_POST si la petición viene de un formulario POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["limpiarCarrito"])) {
        limpiarCarritoV1($_SESSION["productosEnCarrito"]);
    }

    // Verificamos que las claves existan para evitar los warnings
    if (isset($_POST["idAñadir"]) && isset($_POST["unidadesAñadir"])) {
        $_SESSION["idAñadir"] = $_POST["idAñadir"];
        $_SESSION["unidadesAñadir"] = $_POST["unidadesAñadir"];
        
    
    // Aquí iría la lógica para meterlo en "productosEnCarrito"

        // Compruebo que el producto existe en el catálogo original y que existe stock suficiente. 
        $producto = existeProductoyStock($productos, $_SESSION["idAñadir"], $_SESSION["unidadesAñadir"]);

        //If true quiere decir que podemos continuar para añadirlo al carrito
        if ($producto != 0 ) {

            // producto ya esta en el array de carrito?
            // comprobamos si ya esta en el carrito buscando su posicion

            $encontradoIndex = null;

            foreach($_SESSION["productosEnCarrito"] as $i => $p) {
                // Guardamos la posición exacta (ej: 0, 1, 2...)
                if ($p["id"] === $producto["id"]) {
                    $encontradoIndex = $i;
                    break;
                }
            }

            // Si $encontradoIndex no es null, significa que YA está en el carrito
            if ($encontradoIndex !== null) {
                // Actualizamos usando el índice numérico de la sesión 
                $_SESSION["productosEnCarrito"][$encontradoIndex]["cantidadEnCarrito"] += $_SESSION["unidadesAñadir"];
                $_SESSION["productosEnCarrito"][$encontradoIndex]["subtotalProducto"] += ($_SESSION["unidadesAñadir"]*$producto["precio"]);
            } else {
                // no, añadir producto al carrito
            
                // creo una copia del producto original devuelto por la funcion para no modificar el original
                $productoCarrito = $producto;
            
                // añado un nuevo par clave valor para almacenar las unidades a añadir
                $productoCarrito["cantidadEnCarrito"] =  $_SESSION["unidadesAñadir"];
                $productoCarrito["subtotalProducto"] =  ($_SESSION["unidadesAñadir"]*$producto["precio"]);
            
            
                array_push($_SESSION["productosEnCarrito"], $productoCarrito);
                // otra forma de hacerlo
                //$_SESSION["productosEnCarrito"][] = $producto;

                print_r($_SESSION["productosEnCarrito"]);
            }
        }
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
            <th>Producto</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Subtotal</th>
        </tr>

        <?php foreach ($_SESSION["productosEnCarrito"] as $p): ?>
            <tr>
                <td><?php echo $p["nombre"] ?></td>
                <td><?php echo $p["precio"] ?></td>
                <td><?php echo $p["cantidadEnCarrito"] ?></td>
                <td><?php echo $p["subtotalProducto"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table><br>

    <form action="carrito.php" method="POST">
        <input type="text" name="limpiarCarrito" value="true" hidden>
        <button type="submit">Limpiar carrito</button>
    </form>

</body>

</html>