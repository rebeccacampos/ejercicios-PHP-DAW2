<!DOCTYPE html>
<html lang="en">

<!-- 

CATALOGO
1. Crear catalogo.php con al menos 5 productos
2. Muestra los productos como una lista HTML
3. Añade un sexto producto sin reconstruir todo el array
4. Muestra cuántos productos tiene el catálogo
5. Cambia el nombre de uno de los productos

PRECIOS Y STOCK
1. Crea un array de 5 precios y otro de 5 cantidades
2. Recórrelos con for e imprime número, precio y stock
3. Calcula cuanto valdria todo el inventario
4. Añade un aviso para las unidades con stock menor que 3

Extra: mostrar datos de manera tabulada
-->


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Productos del catálogo</h2>
    
    <p>
        <?php 
            $productos = ["Termo", "Vaso", "Copa", "Mesa", "Trapo"];
            $cantidadProductos = count($productos);
            echo "La cantidad de productos que hay en el catálogo es $cantidadProductos."; 
        ?>
    </p>

    <ol>
    <?php 
        $productos[] = "goma"; // añade goma al final del array
        $productos[4] = "silla"; // sustituye en el array el elemento de la posición 4

        

        $precios = [10, 5, 3, 50, 2];
        $cantidades = [50, 30, 2, 30, 10];
        $valorTotalInventario = 0;

        for ($i=0; $i < 5 ; $i++) { 
            
            echo "<li><strong>" . htmlspecialchars($productos[$i]) . "</strong></li>";
            echo " <br> El precio del producto <strong>$productos[$i]</strong> es $precios[$i] 
            y la cantidad en stock es de $cantidades[$i] <br><br><br>";

            // calculo del valor de todo el inventario
            $valorTotalInventario += $precios[$i] * $cantidades[$i];

            if ($cantidades[$i] < 3) {
                echo "⚠️ El stock de este producto es menor a tres <br><br><br> ";
            }
        }

        echo "<br> <strong>El valor total del inventario es $valorTotalInventario</strong>";
    ?>
    </ol>    

    <h2>Resumen:</h2>
    <table style="border: 1px solid red; border-collapse: collapse; padding: 8px; ">
        <tr style="border: 1px solid red; border-collapse: collapse; padding: 8px; ">
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Valor</th>
            <th>Estado</th>
        </tr>
        
        <?php 
            for ($i=0; $i < 5 ; $i++) { 
                
                echo "<tr>" . 
                
                "<td>" . htmlspecialchars($productos[$i]) . "</td>" .
                "<td>" . htmlspecialchars($precios[$i]) . "</td>" . 
                "<td>" . htmlspecialchars($cantidades[$i]) . "</td>" 
                . "</tr>";
            } 
        ?>
    </table>
</body>
</html>