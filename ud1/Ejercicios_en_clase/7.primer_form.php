<?php
    // valida que estemos enviando los datos mediante el metodo post
    // EJEMPLO DEL PROFE
        /*
            $cantidad = $_POST["cantidad"] ?? "";
            $cantidadValidada = filter_input(
                INPUT_POST,
                "cantidad",
                FILTER_VALIDATE_INT
            );
            if ($cantidadValidada === false ||
                $cantidadValidada === null  ||
                $cantidadValidada <=0) {
                    ...
                }
        */

    // datos de la tienda que no varian
    $stock = 5;
    $precioAuriculares = 35.50;

    // variables que nos permiten registrar lo que introduce el usuario
    $cantidad = 0;
    $nombreCliente = '';

    // variables que me permiten calcular en función de los datos que introduce el usuario
    $subtotal = 0;
    $total = 0;
    $descuento = 0;

    $entregaSeleccion = "";
    $recargoEntregaSeleccion = 0;

    $pagoSeleccion = "";
    $esRegalo = false;
    $textoEsRegalo = '';

    $totalExtras = 0;

    $error = '';

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // para conservar los valores introducidos después de enviar el formulario
        $nombreCliente = htmlspecialchars($_POST['cliente'] ?? ''); // filtra el nombre para transformar codigo html en caracteres especiales 
        $cantidad = $_POST['cantidad']; 
        
        $entregaSeleccion = $_POST['entrega'] ?? '';
        $entregasPermitidas = ['normal', 'urgente'];

        $pagoSeleccion = $_POST['pago'] ?? '';
        $esRegalo = isset($_POST['regalo']); // utiliza el name y devuelve true si está seleccionado y false si está sin seleccionar
        
        echo "El método utilizado es POST" . "<hr>";

        $nombreCliente = htmlspecialchars(trim($_POST['cliente'] ?? '')); // filtra el nombre para transformar codigo html en caracteres especiales 
        $cantidad = $_POST['cantidad']; // recoge lo que manda el formulario mediante el metodo post con name="cantidad"
        
        $cantidadValidada = filter_input(INPUT_POST, "cantidad", FILTER_VALIDATE_INT); // Para validar la cantidad -> filter_input(tipo_de_entrada, nombre_de_la_variable, filtro)

        if ($cantidadValidada === false || 
                $cantidadValidada === null ) {
            $error = '⚠️ Introduce una cantidad entera válida.';
        } 
        elseif ($cantidad > $stock) {
            $error = "⚠️ Stock inválido: no hay suficientes existencias, cambie la cantidad";
        } 
        elseif ($cantidad <=0) {
            $error = "⚠️ Introduce una cantidad válida, no se pueden comprar 0 unidades"; 
        } 
        elseif ($nombreCliente === '') {
            $error = '⚠️ Indique un nombre de cliente válido';
        }
        elseif ((!in_array($entregaSeleccion, $entregasPermitidas, true))) {
            // el valor seleccionado no está en el array de tipos de entrega permitidos
            $error = '⚠️ El tipo de entrega no es válido, cambie la opción';

        } elseif ($pagoSeleccion !== 'tarjeta' && $pagoSeleccion !== 'transferencia') {
            $error = '⚠️ El tipo de pago no es válido';
        }
        else {
            
            echo '✅ El cliente ' . htmlspecialchars($nombreCliente) . ' ha solicitado ' . $cantidadValidada . ' unidades.';
            $subtotal = $cantidad * $precioAuriculares; // precio sin aplicar descuento ni recargos
            $total = $subtotal;

            // aplicamos los recargos y el descuento si aplica
            // calculo del descuento
            if ($subtotal >= 100) {
                $descuento = 0.1 * $subtotal;
            }
            
            // Extra: envío gratuito si el subtotal tras descuento alcanza 90 €.
            $subtotalTrasDescuento = $subtotal - $descuento; 

            // calculo de recargo por entrega por defecto es cero
            if ($subtotalTrasDescuento < 90) {
                if ($entregaSeleccion === 'normal') {
                    // sumamos 3 euros
                    $recargoEntregaSeleccion = 3;
                    $total = $subtotal + $recargoEntregaSeleccion;
                    $totalExtras = $recargoEntregaSeleccion;
                    
                } elseif ($entregaSeleccion === 'urgente') {
                    // sumamos 7 euros
                    $recargoEntregaSeleccion = 7;
                    $total = $subtotal + $recargoEntregaSeleccion;
                    $totalExtras = $recargoEntregaSeleccion;
                }
            } 
            
            // calculo si es para regalo
            if ($esRegalo === false) {
                $textoEsRegalo = 'No';
            } else {
                $textoEsRegalo = 'Si';
                $totalExtras = $totalExtras + 2;
            }

            
    }

    $total = $subtotal - $descuento + $totalExtras;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda interactiva - auriculares</title>
</head>
<body>
    <h1>Compra de auriculares</h1>
    <p>Precio por unidad: <?php echo $precioAuriculares . "€" ?> | Stock disponible <?php echo $stock ?> unidades</p>
    <form action="" method="post"> <!--dejando el action así redirige a la misma página-->
        <p>
            <label for="cantidad"><strong>Cantidad de auriculares que desea:</strong></label>
            <input id="cantidad" name="cantidad" type="number" min="0" required value = "<?= $cantidad?>">
        </p>

        <p>
            <label for="cliente"><strong>Nombre del cliente:</strong></label>
            <input id="cliente" name="cliente" type="text" value = "<?= $nombreCliente?>" >
        </p>

        <p>
            <label for="entrega"><strong>Tipo de entrega:</strong></label>
            <select id="entrega" name="entrega">
                <option value="normal">Normal (3€)</option>
                <option value="urgente">Urgente (7€)</option>
            </select>
        </p>

        <p>
            <strong>Escoge la forma de pago:</strong>
            <label><input type="radio" name="pago" value="tarjeta" <?= $pagoSeleccion === 'tarjeta' ? 'checked' : '' ?>>Tarjeta</label> <!-- usamos el atributo checked para indicar la seleccion previa del usuario -->
            <label><input type="radio" name="pago" value="transferencia" <?= $pagoSeleccion === 'transferencia' ? 'checked' : '' ?>>Transferencia</label> 
        </p>

        <p>
            <label>
                <input type="checkbox" name="regalo" value="1" <?= $esRegalo ? 'checked' : '' ?>> Envolver para regalo (+2 €)
            </label>
        </p>

        <button type="submit">Calcular</button>
    </form>
    <hr>
<!--
«name» identifica el dato enviado; «id» enlaza con label.
«action» indica el destino; «method» indica cómo se envía 
-->

<?php if ($error === ''): ?>
    <hr>
    <h1> Venta a cliente <?php echo $nombreCliente ?> </h1>
    <ul>
        <li>Stock (disponibles en la tienda): <?php echo $stock . '€' ?></li>
        <li>Precio: <?php echo $precioAuriculares . '€' ?></li>
        <hr>
        <li>Tipo de entrega: <?php echo $entregaSeleccion ?></li>
        <li>Forma de pago: <?php echo $pagoSeleccion ?></li>
        <li>Unidades a comprar: <?php echo $cantidad ?></li>
        <hr>
        <li>Descuento: <?php echo $descuento . '€' ?></li>
        <li>Recargo por tipo de entrega: <?php echo $recargoEntregaSeleccion . '€' ?> </li>
        <li>Envolver para regalo (+2€): <?php echo $textoEsRegalo ?></li>
        <li>Total extras: <?php echo $totalExtras . '€' ?></li>
        <hr>
        <li>Subtotal (antes de recargos y descuentos): <?php echo $subtotal . '€' ?></li>
        <li>Importe total (después de recargos y descuentos): <strong><?php echo $total . '€'?></strong></li>
    </ul>
<?php else: ?>
    <p style="color: red;"><?php echo $error ?></p>
<?php endif; ?>


</body>


<!-- 
PARTE 1

Objetivo: introducir datos en una página HTML y procesarlos con PHP.
Reto: convertir el ejercicio de compra anterior en una calculadora interactiva.
Necesitas Apache con PHP y un editor de código.

EJERCICIO TIENDA INTERACTIVA:

Crea un formulario que pida:
• Nombre del cliente (texto).
• Cantidad de auriculares (número).
Datos fijos en PHP: precio = 35,50 €; stock = 5.
Si la cantidad es válida y hay stock, muestra nombre, subtotal y total.
Aplica un 10 % de descuento cuando el subtotal sea ≥ 100 €.
Si la cantidad es inválida o supera el stock, muestra un aviso

Pistas para resolverlo:
• Usa method="post" y action="" para enviar al mismo archivo.
• Comprueba $_SERVER['REQUEST_METHOD'] === 'POST'.
• Lee el nombre con $_POST['cliente'] ?? ''.
• Valida la cantidad con filter_input(..., FILTER_VALIDATE_INT).
• Comprueba cantidad > 0 y cantidad <= stock.
• Al imprimir el nombre, utiliza htmlspecialchars(...)

Comprueba y amplía:
    Prueba A: Ana, 3 unidades → subtotal 106,50 €; total 95,85 €.
    Prueba B: Luis, 6 unidades → stock insuficiente.
    Prueba C: cantidad 0 → cantidad no válida.
    Prueba D: escribe <script> en el nombre: no debe interpretarse como HTML. -> usar htmlspecialchars()
    Extra: conserva los valores introducidos después de enviar el formulario. -> usar el post en el value de los campos de los formularios para que si tras enviar quiere volver mantenga el valor
-->

<!-- PARTE 2 

Antes de continuar
Revisa que tu archivo compra.php:
• Recibe nombre y cantidad mediante POST.
• Rechaza cantidades no válidas y superiores al stock.
• Calcula el descuento del 10 % a partir de 100 €.
• Muestra los datos sin interpretar HTML introducido.
• Conserva los valores tras enviar el formulario.

Orden de los cálculos
1. Validar nombre y cantidad.
2. Validar entrega, pago y regalo.
3. Calcular subtotal y descuento de productos.
4. Añadir gastos de envío y envoltorio.
5. Mostrar el desglose y el total.
Total = subtotal − descuento + envío + regalo

Ejercicio · Personaliza tu pedido
Amplía compra.php sin crear una segunda página.
Añade tres controles:
• Entrega: normal (3 €) o urgente (7 €).
• Pago: tarjeta o transferencia (radio).
• Envoltorio para regalo: +2 € (checkbox).
Mantén nombre, cantidad, stock y descuento.

Requisitos de la solución
Práctica · criterios de comprobación
• Enviar el formulario mediante POST.
• Validar en PHP que entrega y pago sean opciones permitidas.
• Aplicar el descuento solo al subtotal de productos.
• Sumar después envío y envoltorio.
• Mostrar todas las elecciones y el total.
• No mostrar el resumen si algún dato es inválido.

Pruebas obligatorias
Caso A: Ana, 3 uds., urgente, tarjeta, regalo. -> Subtotal 106,50 €; descuento 10,65 €; extras 9€. TOTAL: 104,85 €.
Caso B: Luis, 1 ud., normal, transferencia, sin regalo. TOTAL: 38,50 €.
Caso C: 6 unidades → error por falta de stock.

Ampliación y cierre
Extra: conserva las opciones elegidas tras enviar.
Extra: envío gratuito si el subtotal tras descuento alcanza 90 €.

¿Por qué un checkbox puede no aparecer en $_POST?
¿Por qué todos los radio del grupo comparten name?
¿Por qué volvemos a validar las opciones en PHP?
-->

</html>