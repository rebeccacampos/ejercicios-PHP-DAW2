<?php
session_start();

// 1. Eliminamos únicamente la variable del carrito de la sesión
unset($_SESSION["carrito"]);

// (Opcional) Si quisieras destruir toda la sesión por completo, usarías:
// session_destroy();

// 2. Redirigimos de vuelta al catálogo (o al carrito vacío) usando PRG
header("location: catalogo_ia.php", true, 303);
exit;
?>