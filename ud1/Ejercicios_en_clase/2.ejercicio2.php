<!DOCTYPE html>
<html lang="en">
<!-- Crear variables nombre edad ciclo y si estas matriculado 
Muestra una ficha con HTML y PHP, por ejemplo:
Nombre: Ana
Edad: 18
Ciclo: DAW

Después cambia solo los valores de las variables y comprueba que la salida se actualiza.
Extra: construye una frase usando concatenación.
-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ficha de alumno:</h1>
    <?php 
        $nombre = "Rebecca";
        $edad = 27;
        $ciclo = "DAW";
    ?>
    <?php 
       echo "Nombre: " . $nombre . "<br>";
       echo "Edad: " . $edad . "<br>";
       echo "Ciclo: " . $ciclo . "<br>";
       echo "<hr>";
       echo "La alumna " . $nombre . " tiene " . $edad . " años y cursa el ciclo " . $ciclo;
    ?>
    
</body>
</html>