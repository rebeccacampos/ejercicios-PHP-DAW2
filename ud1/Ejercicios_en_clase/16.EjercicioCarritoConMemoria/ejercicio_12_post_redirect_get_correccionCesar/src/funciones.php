<?php
// Funciones independientes de HTML y de las variables globales $_GET/$_POST.
function buscarProducto(array $catalogo, int $id): ?array {
    foreach ($catalogo as $producto) {
        if ($producto['id'] === $id) return $producto;
    }
    return null;
}
function calcularSubtotal(float $precio, int $cantidad): float {
    return round($precio * $cantidad, 2);
}
function calcularDescuento(float $subtotal): float {
    return $subtotal >= 100 ? round($subtotal * 0.10, 2) : 0.0;
}
function calcularEnvio(string $modalidad = 'normal'): float {
    return $modalidad === 'urgente' ? 7.0 : 3.0;
}
function formatoEuros(float $valor): string {
    return number_format($valor, 2, ',', '.') . ' €';
}
function escapar(string $texto): string {
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}
