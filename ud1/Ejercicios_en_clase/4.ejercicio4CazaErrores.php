<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- 
Corrige este codigo hasta que funcione y anota qué errores encontraste y qué mensaje mostraba php.
-->

<?php $nombre = "Mario" // falta ;
    $edad = 17;
    if ($edad >= 18) {
        echo "Hola " . $nombre . ", eres mayor de edad"; // corchetes mal puestos
        else {
            echo "Hola " . $nombre . ", eres menor de edad" // falta ;
        }
    }
?>

<?php 
    $nombre = "Mario";
    $edad = 17;
    if ($edad >= 18) {
        echo "Hola " . $nombre . ", eres mayor de edad";
    } else {
            echo "Hola " . $nombre . ", eres menor de edad";
        }
?>
</body>
</html>