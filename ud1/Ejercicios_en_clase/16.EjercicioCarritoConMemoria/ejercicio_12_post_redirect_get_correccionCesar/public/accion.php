<?php
// Acciones de carrito; nunca imprimir HTML antes de header().
session_start();
require_once __DIR__ . '/../src/funciones.php';
require __DIR__ . '/../src/catalogo.php';
$_SESSION['carrito'] ??= [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: catalogo.php', true, 303); exit;
}
$accion = is_string($_POST['accion'] ?? null) ? $_POST['accion'] : '';
$destino = 'carrito.php';
if ($accion === 'anadir') {
    $idTexto = $_POST['id'] ?? null;
    $cantidadTexto = $_POST['cantidad'] ?? null;
    $id = is_string($idTexto) ? filter_var($idTexto,FILTER_VALIDATE_INT) : false;
    $producto = $id !== false ? buscarProducto($catalogo,$id) : null;
    // Sólo se permite añadir/actualizar cantidades enteras positivas.
    $cantidad = is_string($cantidadTexto) ? filter_var($cantidadTexto,FILTER_VALIDATE_INT) : false;
    if ($producto === null) {
        $_SESSION['mensaje'] = 'Producto inexistente.';
    } elseif ($cantidad === false || $cantidad < 1) {
        $_SESSION['mensaje'] = 'La cantidad debe ser un entero positivo.';
    } else {
        $actual = (int)($_SESSION['carrito'][$id] ?? 0);
        $nuevo = ($accion === 'anadir') ? $actual+$cantidad : $cantidad;
        if ($nuevo > $producto['stock']) {
            $_SESSION['mensaje'] = 'No hay existencias suficientes.';
        } else {
            $_SESSION['carrito'][$id] = $nuevo;
            $_SESSION['mensaje'] = 'Carrito actualizado correctamente.';
        }
    }
}
elseif ($accion === 'vaciar') {
    $_SESSION['carrito'] = [];
    $_SESSION['mensaje'] = 'Carrito vaciado.';
}

else {
    $_SESSION['mensaje'] = 'Acción no permitida.';
}
// Patrón POST / Redirect / GET: recargar no reenvía el formulario.
header('Location: ' . $destino, true, 303);
exit;
