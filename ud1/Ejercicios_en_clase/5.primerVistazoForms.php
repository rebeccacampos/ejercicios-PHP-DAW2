<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- formulario.html -->
    <form action="saludo.php" method="post">
    <input name="nombre">
    <button>Enviar</button> 
    </form>
    <!-- en saludo.php
    $nombre = $_POST["nombre"] ?? ""; // Post no manda la info en la url (más seguro)
    echo "Hola, " . htmlspecialchars($nombre); // Convierte caracteres que tienen un significado especial en HTML, como <, >, &, ", y ', en sus entidades HTML equivalentes (&lt;, &gt;, &amp;, &quot;, &#039;) para que se muestren como texto y no como código ejecutable en el navegador -->
</html>