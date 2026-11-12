<?php
// Datos fijos de la tienda
$stock = 5;
$precioAuriculares = 35.50;

// Opciones permitidas para la validación en PHP
$entregasPermitidas = ['normal', 'urgente'];
$pagosPermitidos = ['tarjeta', 'transferencia'];

// Variables para mantener los valores en el formulario (Sticky Form)
$clienteInput = '';
$cantidadInput = '';
$entregaInput = 'normal';
$pagoInput = 'tarjeta';
$regaloInput = false;

// Variables para el cálculo y resultados
$error = null;
$mostrarResumen = false;

$subtotal = 0;
$descuento = 0;
$subtotalConDescuento = 0;
$costeEnvio = 0;
$envioGratis = false;
$costeRegalo = 0;
$total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recoger y sanitizar datos iniciales para el formulario pegajoso
    $clienteInput = trim($_POST['cliente'] ?? '');
    $cantidadInput = $_POST['cantidad'] ?? '';
    $entregaInput = $_POST['entrega'] ?? 'normal';
    $pagoInput = $_POST['pago'] ?? 'tarjeta';
    $regaloInput = isset($_POST['regalo']); // El checkbox solo se envía en $_POST si está marcado

    // 2. Validar Nombre del Cliente
    if (empty($clienteInput)) {
        $error = '⚠️ Por favor, introduce el nombre del cliente.';
    }

    // 3. Validar Cantidad con filter_input
    $cantidadValidada = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);

    if ($error === null) {
        if ($cantidadValidada === false || $cantidadValidada === null || $cantidadValidada <= 0) {
            $error = '⚠️ Introduce una cantidad entera válida (debe ser mayor que 0).';
        } elseif ($cantidadValidada > $stock) {
            $error = "⚠️ Stock insuficiente: solo hay $stock unidades disponibles.";
        }
    }

    // 4. Validar Opciones de Entrega y Pago
    if ($error === null) {
        if (!in_array($entregaInput, $entregasPermitidas, true)) {
            $error = '⚠️ La opción de entrega seleccionada no es válida.';
        } elseif (!in_array($pagoInput, $pagosPermitidos, true)) {
            $error = '⚠️ La opción de pago seleccionada no es válida.';
        }
    }

    // 5. Procesar Cálculos si todo es válido
    if ($error === null) {
        // Subtotal de productos
        $subtotal = $cantidadValidada * $precioAuriculares;

        // Descuento del 10% si subtotal >= 100 € (aplicado solo al subtotal de productos)
        if ($subtotal >= 100) {
            $descuento = $subtotal * 0.10;
        }

        $subtotalConDescuento = $subtotal - $descuento;

        // Determinar coste de envío según la elección
        $costeEnvio = ($entregaInput === 'urgente') ? 7.00 : 3.00;

        // Extra: Envío gratuito si el subtotal tras descuento alcanza los 90 €
        if ($subtotalConDescuento >= 90) {
            $costeEnvio = 0.00;
            $envioGratis = true;
        }

        // Coste del envoltorio para regalo
        if ($regaloInput) {
            $costeRegalo = 2.00;
        }

        // Importe Total: Subtotal - Descuento + Envío + Regalo
        $total = $subtotalConDescuento + $costeEnvio + $costeRegalo;

        $mostrarResumen = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Interactiva - Auriculares</title>
</head>
<body>

    <h1>Tienda Interactiva - Compra de Auriculares</h1>
    <p>Precio por unidad: <strong>35,50 €</strong> | Stock disponible: <strong>5 unidades</strong></p>

    <!-- FORMULARIO PEGAJOSO (Sticky Form) -->
    <form action="" method="post">
        
        <p>
            <label for="cliente">Nombre del cliente:</label><br>
            <input id="cliente" name="cliente" type="text" required 
                   value="<?= htmlspecialchars($clienteInput, ENT_QUOTES, 'UTF-8') ?>">
        </p>

        <p>
            <label for="cantidad">Cantidad de auriculares:</label><br>
            <input id="cantidad" name="cantidad" type="number" min="1" max="<?= $stock ?>" required 
                   value="<?= htmlspecialchars($cantidadInput, ENT_QUOTES, 'UTF-8') ?>">
        </p>

        <p>
            <label for="entrega">Método de Entrega:</label><br>
            <select id="entrega" name="entrega">
                <option value="normal" <?= $entregaInput === 'normal' ? 'selected' : '' ?>>Normal (3,00 €)</option>
                <option value="urgente" <?= $entregaInput === 'urgente' ? 'selected' : '' ?>>Urgente (7,00 €)</option>
            </select>
        </p>

        <p>
            <strong>Forma de Pago:</strong><br>
            <label>
                <input type="radio" name="pago" value="tarjeta" <?= $pagoInput === 'tarjeta' ? 'checked' : '' ?>>
                Tarjeta
            </label><br>
            <label>
                <input type="radio" name="pago" value="transferencia" <?= $pagoInput === 'transferencia' ? 'checked' : '' ?>>
                Transferencia
            </label>
        </p>

        <p>
            <label>
                <input type="checkbox" name="regalo" value="1" <?= $regaloInput ? 'checked' : '' ?>>
                Envolver para regalo (+2,00 €)
            </label>
        </p>

        <button type="submit">Calcular Pedido</button>
    </form>

    <hr>

    <!-- MENSAJES DE ERROR -->
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $error !== null): ?>
        <div style="color: red; font-weight: bold;">
            <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
        </div>
    <?php endif; ?>

    <!-- RESUMEN DEL PEDIDO (Solo se muestra si todos los datos ingresados son válidos) -->
    <?php if ($mostrarResumen): ?>
        <h2>Resumen del Pedido</h2>
        <p>Cliente: <strong><?= htmlspecialchars($clienteInput, ENT_QUOTES, 'UTF-8') ?></strong></p>
        
        <ul>
            <li>Unidades compradas: <?= $cantidadValidada ?></li>
            <li>Subtotal de productos: <?= number_format($subtotal, 2, ',', '.') ?> €</li>
            
            <?php if ($descuento > 0): ?>
                <li style="color: green;">
                    Descuento del 10% aplicado: -<?= number_format($descuento, 2, ',', '.') ?> €
                </li>
            <?php else: ?>
                <li>Descuento: 0,00 € (No alcanza los 100,00 € de compra)</li>
            <?php endif; ?>

            <li>Forma de pago: <?= ucfirst(htmlspecialchars($pagoInput, ENT_QUOTES, 'UTF-8')) ?></li>

            <li>
                Envío (<?= htmlspecialchars($entregaInput, ENT_QUOTES, 'UTF-8') ?>): 
                <?php if ($envioGratis): ?>
                    <strong style="color: green;">0,00 € (¡Envío gratuito por superar los 90,00 € tras descuento!)</strong>
                <?php else: ?>
                    <?= number_format($costeEnvio, 2, ',', '.') ?> €
                <?php endif; ?>
            </li>

            <li>
                Envoltorio para regalo: 
                <?= $costeRegalo > 0 ? number_format($costeRegalo, 2, ',', '.') . ' €' : 'No solicitado' ?>
            </li>
        </ul>

        <h3>Importe TOTAL a pagar: <?= number_format($total, 2, ',', '.') ?> €</h3>
    <?php endif; ?>

</body>
</html>