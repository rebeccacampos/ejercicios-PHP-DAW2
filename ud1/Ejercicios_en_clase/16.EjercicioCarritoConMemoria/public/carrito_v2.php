<?php
session_start();
require_once __DIR__ . "/../src/catalogo.php";
require_once __DIR__ . "/../src/funciones.php";

//$_SESSION["productosEnCarrito"] = [];
//$_SESSION["idAñadir"] = $_POST["idAñadir"];
//$_SESSION["unidadesAñadir"] = $_POST["unidadesAñadir"];

// 1. Inicializamos el carrito solo si todavía no existe en la sesión

$_SESSION["carrito"] ??= []; // inicializa el carrito de compras como un arreglo vacío solo si aún no existe o su valor es nulo.
// codigo equivalente: 
/*
if (!isset($_SESSION["productosEnCarrito"])) {
    $_SESSION["productosEnCarrito"] = [];
}*/

// =========================================================================
// BLOQUE POST: Procesa acciones y redirige con HTTP 303 (PRG Pattern)
// =========================================================================
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accion = $_POST["accion"] ?? "";

    // --- ACCIÓN 1: AÑADIR PRODUCTO (Ejercicios 11 y 12) ---
    if ($accion === "anadir") {
        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $cantidad = filter_input(INPUT_POST, "cantidad", FILTER_VALIDATE_INT);
        $producto = $id ? buscarProductoPorId($productos, $id) : null;

        if (!$producto || $cantidad === false || $cantidad <= 0) {
            $_SESSION["mensaje"] = ["tipo" => "error", "texto" => "⚠️ Datos de producto o cantidad no válidos."];
        } else {
            // Sumamos lo que ya tenía en el carrito + lo que quiere añadir ahora
            $cantidadActual = $_SESSION["carrito"][$id] ?? 0;
            $nuevaCantidad = $cantidadActual + $cantidad;

            if ($nuevaCantidad > $producto["stock"]) {
                $_SESSION["mensaje"] = [
                    "tipo" => "error", 
                    "texto" => "⚠️ Stock insuficiente para '{$producto['nombre']}'. Máximo disponible: {$producto['stock']}."
                ];
            } else {
                $_SESSION["carrito"][$id] = $nuevaCantidad;
                $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => "✅ Añadido '{$producto['nombre']}' al carrito."];
            }
        }
    }

    // --- ACCIÓN 2: ACTUALIZAR CANTIDAD (Taller adicional) ---
    elseif ($accion === "actualizar") {
        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $cantidad = filter_input(INPUT_POST, "cantidad", FILTER_VALIDATE_INT);
        $producto = $id ? buscarProductoPorId($productos, $id) : null;

        if (!$producto || $cantidad === false || $cantidad < 0) {
            $_SESSION["mensaje"] = ["tipo" => "error", "texto" => "⚠️ Cantidad no válida."];
        } elseif ($cantidad === 0) {
            // Si pone 0 unidades, lo eliminamos del carrito
            unset($_SESSION["carrito"][$id]);
            $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => "🗑️ Artículo eliminado del carrito."];
        } elseif ($cantidad > $producto["stock"]) {
            $_SESSION["mensaje"] = [
                "tipo" => "error", 
                "texto" => "⚠️ No hay suficiente stock de '{$producto['nombre']}' (Máx: {$producto['stock']})."
            ];
        } else {
            $_SESSION["carrito"][$id] = $cantidad;
            $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => "✅ Cantidad actualizada."];
        }
    }

    // --- ACCIÓN 3: ELIMINAR UN ARTÍCULO (Taller adicional) ---
    elseif ($accion === "eliminar") {
        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        if ($id && isset($_SESSION["carrito"][$id])) {
            unset($_SESSION["carrito"][$id]);
            $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => "🗑️ Artículo eliminado."];
        }
    }

    // --- ACCIÓN 4: VACIAR CARRITO (Ejercicio 12) ---
    elseif ($accion === "vaciar") {
        unset($_SESSION["carrito"]);
        $_SESSION["mensaje"] = ["tipo" => "exito", "texto" => "🧹 El carrito se ha vaciado por completo."];
    }

    // REDIRECCIÓN 303 OBLIGATORIA TRAS POST (Evita duplicados al recargar con F5)
    header("Location: carrito.php", true, 303);
    exit;
}

// =========================================================================
// BLOQUE GET: Prepara los datos para dibujar el HTML
// =========================================================================
$mensaje = $_SESSION["mensaje"] ?? null;
unset($_SESSION["mensaje"]); // Lo borramos para que desaparezca al volver a recargar

$totalGeneral = 0;


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

    <!-- Mensajes de éxito o error -->
    <?php if ($mensaje): ?>
        <p style="color: <?= $mensaje['tipo'] === 'error' ? 'red' : 'green' ?>; font-weight: bold;">
            <?= htmlspecialchars($mensaje['texto']) ?>
        </p>
    <?php endif; ?>

    <?php if (empty($_SESSION["carrito"])): ?>
        <p>Tu carrito está vacío.</p>
    <?php else: ?>

    <br>
    <br>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Subtotal</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($_SESSION["productosEnCarrito"] as $p): ?>
            <tr>
                <td><?php echo $p["nombre"] ?></td>
                <td><?php echo $p["precio"] ?></td>
                <td><?php echo $_SESSION["unidadesAñadir"] ?></td>
                <td><?php echo $_SESSION["subtotal"] ?></td>
                <td>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>




<?php foreach ($_SESSION["carrito"] as $idProducto => $cantidad): ?>
                <?php 
                // Consultamos los datos reales y el precio desde el catálogo del servidor
                $producto = buscarProductoPorId($productos, $idProducto);
                if (!$producto) continue; // Por seguridad, si el producto dejó de existir

                $subtotal = $producto["precio"] * $cantidad;
                $totalGeneral += $subtotal;
                ?>
                <tr>
                    <td><?= htmlspecialchars($producto["nombre"]) ?></td>
                    <td><?= number_format($producto["precio"], 2, ',', '.') ?> €</td>
                    <td>
                        <!-- Formulario para actualizar cantidad (Taller) -->
                        <form action="carrito.php" method="post" style="display:inline;">
                            <input type="hidden" name="accion" value="actualizar">
                            <input type="hidden" name="id" value="<?= $idProducto ?>">
                            <input type="number" name="cantidad" min="1" max="<?= $producto["stock"] ?>" value="<?= $cantidad ?>" style="width: 50px;" required>
                            <button type="submit">Actualizar</button>
                        </form>
                    </td>
                    <td><?= number_format($subtotal, 2, ',', '.') ?> €</td>
                    <td>
                        <!-- Formulario para eliminar esta línea (Taller) -->
                        <form action="carrito_v2.php" method="post" style="display:inline;">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?= $idProducto ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="text-align: right;"><strong>TOTAL A PAGAR:</strong></td>
                <td colspan="2"><strong><?= number_format($totalGeneral, 2, ',', '.') ?> €</strong></td>
            </tr>
        </table>

        <br>

        <!-- Botón para vaciar todo el carrito por POST (Ejercicio 12) -->
        <form action="carrito.php" method="post">
            <input type="hidden" name="accion" value="vaciar">
            <button type="submit">Vaciar carrito</button>
        </form>
    <?php endif; ?>

</html>