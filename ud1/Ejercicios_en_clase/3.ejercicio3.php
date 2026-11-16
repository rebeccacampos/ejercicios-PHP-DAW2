<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        // operadores aritmeticos: + - * / % **
        // operadores logicos: = >= < == === !=     
        $edad = 45;
        if ($edad == 45.0) echo "=45 <br>"; // no compara tipo pero si valor
        if ($edad === 45.0) echo "=45?  <br>"; // compara tipo y valor
        if ($edad !== 45.0) echo "<>45?  <br> <hr>"; // que es de distinto tipo -> true

        /* Ejercicio 3 -> Calculadora de precio
        
        Define $precio = 80 y $cantidad = 3.
        1. Calcula el subtotal 
        2. Si el subtotal es de 200€ o más, aplica un 10% de descuento.
        3. Muestra subtotal, descuento y total final.

        Prueba despues con otros valores.
        Extra: evita mostrar decimales innecesarios usando round()        
        */

        $precio = 80;
        $cantidad = 3;
        $eurosDescontados = 0;

        $subtotal = $precio * $cantidad;
        $precioPagar = $subtotal;

        if ($subtotal >= 200) {
            $eurosDescontados = 0.1 * $subtotal;
            $precioPagar = $subtotal - $eurosDescontados;
        } 

        echo "Cantidad total " . $subtotal . "<br> Con un descuento de " . $eurosDescontados . "<br> Total a pagar: " . $precioPagar

        /* Buenas practicas: Sangrar los bloques, un nombre debe explicar el dato, comentar el porqué y no lo obvio*/
    ?>
</body>
</html>