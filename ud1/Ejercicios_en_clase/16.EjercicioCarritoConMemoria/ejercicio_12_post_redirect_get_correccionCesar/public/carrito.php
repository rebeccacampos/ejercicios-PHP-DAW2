<?php
// Carrito almacenado en $_SESSION como id => unidades.
session_start();
require_once __DIR__ . '/../src/funciones.php';
require __DIR__ . '/../src/catalogo.php';
$carrito = $_SESSION['carrito'] ?? [];
$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);
$total = 0;
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Carrito</title></head><body>
<h1>Carrito de la compra</h1><p><a href="catalogo.php">Volver al catálogo</a></p>
<?php if ($mensaje !== ''): ?><p><?= escapar($mensaje) ?></p><?php endif; ?>
<table border="1" cellpadding="6"><tr><th>Producto</th><th>Precio</th><th>Unidades</th><th>Subtotal</th></tr>
<?php foreach ($carrito as $id => $cantidad):
$p = buscarProducto($catalogo,(int)$id);
if ($p === null) continue; // Revalidar contra el catálogo del servidor.
$linea = calcularSubtotal($p['precio'],$cantidad);
$total += $linea;
?><tr><td><?= escapar($p['nombre']) ?></td><td><?= formatoEuros($p['precio']) ?></td><td><?= $cantidad ?></td><td><?= formatoEuros($linea) ?></td></tr>
<?php endforeach; ?>
</table><p><strong>Total: <?= formatoEuros($total) ?></strong></p>
<form method="post" action="accion.php"><input type="hidden" name="accion" value="vaciar"><button>Vaciar carrito</button></form>
</body></html>
