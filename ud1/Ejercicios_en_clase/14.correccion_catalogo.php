<?php

$catalogo = [

    ["id" => 1, "nombre" => "Auriculares", "precio" => 35.50, "stock" => 5, "categoria" => "Audio"],

    ["id" => 2, "nombre" => "Ratón inalámbrico", "precio" => 19.50, "stock" => 2, "categoria" => "Periféricos"],

    ["id" => 3, "nombre" => "Teclado", "precio" => 42.00, "stock" => 8, "categoria" => "Periféricos"],

    ["id" => 4, "nombre" => "Webcam", "precio" => 29.90, "stock" => 1, "categoria" => "Vídeo"],

    ["id" => 5, "nombre" => "Monitor 24 pulgadas", "precio" => 159.99, "stock" => 4, "categoria" => "Monitores"],

    ["id" => 6, "nombre" => "Cable USB < y &", "precio" => 8.50, "stock" => 15, "categoria" => "Accesorios"],

];



// Funciones independientes de HTML y de las variables globales $_GET/$_POST.

function buscarProducto(array $catalogo, int $id): ?array
{

    foreach ($catalogo as $producto) {

        if ($producto['id'] === $id) return $producto;
    }

    return null;
}

function calcularSubtotal(float $precio, int $cantidad): float
{

    return round($precio * $cantidad, 2);
}

function calcularDescuento(float $subtotal): float
{

    return $subtotal >= 100 ? round($subtotal * 0.10, 2) : 0.0;
}

function calcularEnvio(string $modalidad = 'normal'): float
{

    return $modalidad === 'urgente' ? 7.0 : 3.0;
}

function formatoEuros(float $valor): string
{

    return number_format($valor, 2, ',', '.') . ' €';
}

function escapar(string $texto): string
{

    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}





$errores = [];

$resultado = null;

$nombre = '';

$idTexto = '';

$cantidadTexto = '1';

$entrega = 'normal';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Una petición POST puede contener arrays: comprobar que son cadenas.

    $nombre = is_string($_POST['nombre'] ?? null) ? trim($_POST['nombre']) : '';

    $idTexto = is_string($_POST['id'] ?? null) ? $_POST['id'] : '';

    $cantidadTexto = is_string($_POST['cantidad'] ?? null) ? $_POST['cantidad'] : '';

    $entrega = is_string($_POST['entrega'] ?? null) ? $_POST['entrega'] : '';



    if ($nombre === '') $errores[] = 'Debes indicar el nombre.';

    if (strlen($nombre) > 100) $errores[] = 'El nombre es demasiado largo.';

    if (!in_array($entrega, ['normal', 'urgente'], true)) $errores[] = 'Modalidad de entrega no válida.';

    $id = filter_var($idTexto, FILTER_VALIDATE_INT);

    $cantidad = filter_var($cantidadTexto, FILTER_VALIDATE_INT);

    if ($id === false) $errores[] = 'Identificador de producto incorrecto.';

    if ($cantidad === false || $cantidad <= 0) $errores[] = 'La cantidad debe ser un entero positivo.';

    $producto = $id !== false ? buscarProducto($catalogo, $id) : null;

    if ($producto === null) $errores[] = 'El producto no existe.';

    if ($producto !== null && $cantidad !== false && $cantidad > $producto['stock']) {

        $errores[] = 'Cantidad superior al stock disponible.';
    }

    // No se lee $_POST['precio']: el precio es propiedad del catálogo.

    if ($errores === []) {

        $subtotal = calcularSubtotal($producto['precio'], $cantidad);

        $descuento = calcularDescuento($subtotal);

        $costeEnvio = calcularEnvio($entrega);

        $resultado = [
            'nombre' => $nombre,
            'producto' => $producto['nombre'],
            'subtotal' => $subtotal,

            'descuento' => $descuento,
            'envio' => $costeEnvio,

            'total' => round($subtotal - $descuento + $costeEnvio, 2)
        ];
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 9 - Tienda modular</title>
</head>

<body>

    <h1>Ejercicio 9 - Tienda modular</h1>

    <form method="post">

        <p><label>Nombre <input name="nombre" value="<?= escapar($nombre) ?>"></label></p>

        <p><label>Producto <select name="id">

                    <?php foreach ($catalogo as $p): ?>

                        <option value="<?= $p['id'] ?>" <?= $idTexto === (string)$p['id'] ? 'selected' : '' ?>><?= escapar($p['nombre']) ?> (<?= formatoEuros($p['precio']) ?>)</option>

                    <?php endforeach; ?>

                </select></label></p>

        <p><label>Cantidad <input type="number" name="cantidad" value="<?= escapar($cantidadTexto) ?>"></label></p>

        <p><label>Entrega <select name="entrega">
                    <option value="normal" <?= $entrega === 'normal' ? 'selected' : '' ?>>Normal</option>
                    <option value="urgente" <?= $entrega === 'urgente' ? 'selected' : '' ?>>Urgente</option>
                </select></label></p>

        <button>Calcular compra</button>
    </form>

    <?php foreach ($errores as $error): ?><p style="color:#a00"><?= escapar($error) ?></p><?php endforeach; ?>

    <?php if ($resultado !== null): ?>

        <h2>Resumen de la compra</h2>

        <p>Cliente: <?= escapar($resultado['nombre']) ?> · Producto: <?= escapar($resultado['producto']) ?></p>

        <p>Subtotal: <?= formatoEuros($resultado['subtotal']) ?></p>

        <p>Descuento: <?= formatoEuros($resultado['descuento']) ?></p>

        <p>Envío: <?= formatoEuros($resultado['envio']) ?></p>

        <p><strong>Total: <?= formatoEuros($resultado['total']) ?></strong></p>

    <?php endif; ?>

</body>

</html>