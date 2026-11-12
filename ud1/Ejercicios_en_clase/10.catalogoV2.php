<!DOCTYPE html>
<html lang="en">

<!-- POR TERMINAR--> 

<!-- Taller adicional · Inventario filtrable
    •  Amplía el catálogo del ejercicio 3 con la propiedad «categoría».
    •  Añade dos filtros GET: categoría y precio máximo.
    •  Muestra el stock total y el valor del inventario filtrado.
    •  El filtro vacío debe mostrar todos los productos.
    •  No repitas HTML de filas: utiliza foreach. -->

<!-- Taller · Pistas y casos de prueba
    •  ¿Qué dos claves nuevas necesita cada registro?
    •  Si la categoría no está elegida, ¿qué condición puedes omitir?
    •  Precio máximo 0 y precio máximo negativo no son equivalentes.
    •  Los valores GET pueden estar ausentes: compruébalos.
    •  Probar: sin filtros; una categoría; un máximo; ambos filtros -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    // Construye un catálogo con 5 productos.
    // Cada uno debe tener id, nombre, precio y stock.
    
    $productos = [
        ["id"=>1, "nombre"=>"auriculares", "precio"=>45.5, "stock"=>6],
        ["id"=>2, "nombre"=>"teclado", "precio"=>200, "stock"=>2],
        ["id"=>3, "nombre"=>"ratón", "precio"=>30.20, "stock"=>1],
        ["id"=>4, "nombre"=>"pantalla", "precio"=>120, "stock"=>5],
        ["id"=>5, "nombre"=>"pendrive", "precio"=>20, "stock"=>2]
    ];
    ?>

    <!-- Muestra una tabla HTML con todos los campos. -->

    <h1>Información de los productos</h1>
    <table style="border: 1px solid black; border-collapse: collapse; padding: 8px; ">
        <tr style="border: 1px solid black; border-collapse: collapse; padding: 8px; ">
            <th style="padding: 5px"><?= "ID" ?></th>
            <th style="padding: 5px"><?= "NOMBRE" ?></th>
            <th style="padding: 5px"><?= "PRECIO" ?></th>
            <th style="padding: 5px"><?= "STOCK" ?></th>
            <th style="padding: 5px"><?= "STOCK < 3"?></th>
            <th style="padding: 5px"><?= "Precio del stock"?></th>
        </tr>
        <?php 

        $valorTotalInventario = 0;
        
        foreach ($productos as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p["id"]) ?></td>
                <td><?= htmlspecialchars($p["nombre"]) ?></td>
                <td><?= htmlspecialchars($p["precio"]) ?></td>
                <td><?= htmlspecialchars($p["stock"]) ?></td>
                <!-- Destaca los productos con stock menor que 3.-->
                <td><?php if ($p["stock"] < 3) {
                    echo "⚠️";
                } else {
                    echo "✅";
                }?></td>
                <!-- Calcula el valor total de las existencias.  -->
                <td><?php $valorStock = $p['stock']*$p['precio']; 
                    echo $valorStock; 
                    $valorTotalInventario +=$valorStock;
                ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <table border="1px solid black" style="border-collapse: collapse;">
        <tr><th>Valor total del inventario</th></tr>
        <tr><td><?= $valorTotalInventario ?></td></tr>
    </table>

    <br>
    <hr>
    <br>

    <!-- Ejercicio 4 · Filtrar productos -> Añade un formulario GET con precio máximo. -->
    <?php 
        $productosMenorPrecioMax = $productos;
        $precioMaximo = 0;
        $enviado = isset( $_GET['precioMaximo']); //  devuelve true si la variable $var está definida y no es NULL, y false si no lo está. 
    
        // el get se manda siempre, para comprobar si una variable ha sido metida utilizamos el isset($_GET('precioMaximo');) si da verdadero es que se envio con valor
        if ($enviado) {
            // ya lo cogemos con el filter input $precioMaximo = $_GET['precioMaximo'] ?? 0; // recoge lo que manda el formulario mediante el metodo post con name="cantidad"
            //echo $precioMaximo;
            
            // Valida que el valor recibido es numérico y no negativo.
            $precioMaximo = filter_input(INPUT_GET, "precioMaximo", FILTER_VALIDATE_INT); // Para validar la cantidad -> filter_input(tipo_de_entrada, nombre_de_la_variable, filtro)
            // devuelve el valor si es int y sino devuelve null

            if ($precioMaximo > 0) {
                $productosMenorPrecioMax = [];
                foreach ($productos as $item) {
                    if ($item["precio"]<= $precioMaximo) {  
                        $productosMenorPrecioMax[] = $item;
                    }
                }
            } else { echo "⚠️ El precio no puede ser negativo";}
        }
    ?>

    <form action="" method="get"> <!--dejando el action así redirige a la misma página-->
        <p>
            <label for="precioMaximo"><strong>Indica el precio máximo:</strong></label>
            <input id="precioMaximo" name="precioMaximo" type="number" min="0" required>
        </p>
        <button type="submit">Calcular</button>
    </form>

    <!-- Muestra solo los productos con precio <= máximo. -->
    <?php if($precioMaximo == 0 || $precioMaximo == null): ?>
        <h1>Productos en función del precio máximo</h1>
        <table style="border: 1px solid black; border-collapse: collapse; padding: 8px; ">
            <tr style="border: 1px solid black; border-collapse: collapse; padding: 8px; ">
                <th style="padding: 5px"><?= "ID" ?></th>
                <th style="padding: 5px"><?= "NOMBRE" ?></th>
                <th style="padding: 5px"><?= "PRECIO" ?></th>
                <th style="padding: 5px"><?= "STOCK" ?></th>
                <th style="padding: 5px"><?= "STOCK < 3"?></th>
                <th style="padding: 5px"><?= "Precio del stock"?></th>
            </tr>
            <?php 

            $valorTotalInventario = 0;
            
            foreach ($productosMenorPrecioMax as $pr): ?>
                <tr>
                    <td><?= htmlspecialchars($pr["id"]) ?></td>
                    <td><?= htmlspecialchars($pr["nombre"]) ?></td>
                    <td><?= htmlspecialchars($pr["precio"]) ?></td>
                    <td><?= htmlspecialchars($pr["stock"]) ?></td>
                    <!-- Destaca los productos con stock menor que 3.-->
                    <td><?php if ($pr["stock"] < 3) {
                        echo "⚠️";
                    } else {
                        echo "✅";
                    }?></td>
                    <!-- Calcula el valor total de las existencias.  -->
                    <td><?php $valorStock = $pr['stock']*$pr['precio']; 
                        echo $valorStock; 
                        $valorTotalInventario +=$valorStock;
                    ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif ?>
    <br>

    <?php if($precioMaximo == 0 || $precioMaximo == null) {
        echo "⚠️ Indica un precio máximo válido";
    } ?>

</body>
</html>