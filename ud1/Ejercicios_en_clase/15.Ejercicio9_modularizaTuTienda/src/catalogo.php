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



/*
Ejercicio 10 · Revisión de seguridad
•  Envía nombre vacío, cantidad negativa y entrega inventada.
•  Comprueba que el servidor rechaza cada caso.
•  Introduce caracteres especiales en el nombre.
•  Busca un precio recibido por POST: ¿debería confiarse en él?
•  Añade mensajes específicos sin revelar datos internos

1. Introducción de caracteres especiales en el nombre (Protección XSS)
¿Qué ocurre en tu código?
En tu tabla estás usando htmlspecialchars($p["nombre"]).

¿Es seguro?Sí, es totalmente seguro. Si alguien introdujera en la base de datos o en un formulario un nombre con etiquetas HTML o scripts maliciosos (por ejemplo, <script>alert('hack')</script>), htmlspecialchars convierte los caracteres especiales en entidades HTML inofensivas (&lt;script&gt;...). El navegador los mostrará como texto plano en la pantalla en lugar de ejecutarlos.

2. Comprobación del servidor (ID inventado, vacío o negativo)
El gran error de seguridad en desarrollo web es fiarse de lo que el usuario introduce en el navegador.

ID inventado (no existente): Si un usuario busca un ID que no existe (por ejemplo, ?IDbuscar=9999), tu función buscarProducto() devuelve null.

Mejora en index.php: Actualmente haces echo "Producto a buscar: " . $encontrado;. Si $encontrado es null, en las versiones modernas de PHP esto genera un aviso (Deprecated: Implicit conversion from null to string). Deberías controlarlo así:

PHP
$encontrado = buscarProducto($productos, $productoBuscar);
if ($encontrado !== null) {
    echo "Producto a buscar: " . htmlspecialchars($encontrado);
} else {
    echo "⚠️ El producto indicado no existe.";
}
Cantidad o precio negativo / vacío: Aunque en tu formulario HTML uses atributos como min="0" y required, cualquier usuario puede modificarlos fácilmente desde el inspector del navegador (F12) o enviar peticiones falsas mediante herramientas como Postman.

Por eso, la validación en PHP (filter_input y comprobar que no sean negativos con >= 0) es obligatoria para garantizar que el servidor rechace valores absurdos o malintencionados.

3. ¿Debería confiarse en un precio recibido por POST (o GET)?
Respuesta contundente: ¡NUNCA!

¿Por qué? Si en una tienda online real calcularas el total de una compra cogiendo el precio que el cliente envía desde un formulario (oculto o visible), el usuario podría modificar ese precio en el navegador y comprar un ordenador de 1000€ por 0,01€.

La regla de oro: El cliente solo envía el ID del producto y la cantidad. El servidor debe buscar ese ID en su catálogo o base de datos interna ($productos) para obtener el precio real y hacer los cálculos de forma segura.

4. Añadir mensajes específicos sin revelar datos internos
Cuando ocurre un error (como el error fatal de PHP que viste antes con la ruta D:\rebeccacampos\xampp\...), mostrar esos datos en una web pública es un riesgo de seguridad porque le da pistas a un atacante sobre la estructura interna de tu servidor.

Mal ejemplo (revela datos internos):Fatal error: Uncaught TypeError in D:\rebeccacampos\xampp\htdocs\... on line 51

Buen ejemplo (mensaje amigable y seguro):
Para el usuario final debes mostrar mensajes claros y controlados (como los que ya estás poniendo con emojis: ⚠️ Indica un precio máximo válido o ⚠️ El producto no existe), y registrar los errores técnicos de forma interna en los archivos de registro (logs) de PHP/Apache, ocultándolos al público.


*/


?>

