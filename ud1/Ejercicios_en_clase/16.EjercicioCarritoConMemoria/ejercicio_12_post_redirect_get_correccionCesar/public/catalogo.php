<?php
// Ejercicio de sesiones: presentar el catálogo y los formularios POST.
session_start();
require_once __DIR__ . '/../src/funciones.php';
require __DIR__ . '/../src/catalogo.php';
$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Catálogo</title></head><body>
<h1>Catálogo - carrito en sesión</h1><p><a href="carrito.php">Ver carrito</a></p>
<?php if ($mensaje !== ''): ?><p><?= escapar($mensaje) ?></p><?php endif; ?>
<table border="1" cellpadding="6"><tr><th>Nombre</th><th>Precio</th><th>Stock</th><th>Comprar</th></tr>
<?php foreach ($catalogo as $p): ?><tr>
<td><?= escapar($p['nombre']) ?></td><td><?= formatoEuros($p['precio']) ?></td><td><?= $p['stock'] ?></td>
<td><form action="accion.php" method="post"><input type="hidden" name="accion" value="anadir"><input type="hidden" name="id" value="<?= $p['id'] ?>"><input type="number" name="cantidad" min="1" max="<?= $p['stock'] ?>" value="1"><button <?= $p['stock']===0?'disabled':'' ?>>Añadir</button></form></td>
</tr><?php endforeach; ?></table>
</body></html>
