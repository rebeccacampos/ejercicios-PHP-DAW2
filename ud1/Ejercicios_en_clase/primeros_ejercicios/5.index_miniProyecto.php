<?php
    $ciclo = 'DAW'; // comillas simples para que sea una constante
    $nombre = 'Ana';
    $modulo = 'DWCS';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Proyecto</title>
</head>
<body>

    <h1>
        <?= 'Nombre: ' . $nombre . ' / Ciclo: ' . $ciclo . ' / Modulo: ' . $modulo . "</br> Hoy es:  " . date('d/m/Y'); ?>
    </h1> <!-- ejemplo usando forma abreviada:  <?= $titulo?>-->
    <div>    
        <?php
            // ejemplo, lo mismo pero usando echo
            echo 'Nombre: ' . $nombre . ' / Ciclo: ' . $ciclo . ' / Modulo: ' . $modulo;
            echo "</br> Hoy es:  " . date('d/m/Y');
        ?>
    </div>
</body>

<!-- NOTAS 

- HTML completo: doctype. head, tittle y body
- Nombre, ciclo y módulo almacenados en variables
- La feca actual mediante date('d/m/Y')
- Salida con echo y con la forma abreviada  -->

</html>