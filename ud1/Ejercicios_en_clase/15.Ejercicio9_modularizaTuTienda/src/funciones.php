<?php

// funcion para validar el precio máximo
function validarPrecioMaximo()
{
    $enviado = isset($_GET['precioMaximo']); //  devuelve true si la variable $var está definida y no es NULL, y false si no lo está. 
    $validacion = filter_input(INPUT_GET, "precioMaximo", FILTER_VALIDATE_INT); // Para validar la cantidad -> filter_input(tipo_de_entrada, nombre_de_la_variable, filtro)
    // el get se manda siempre, para comprobar si una variable ha sido metida utilizamos el isset($_GET('precioMaximo');) si da verdadero es que se envio con valor
    if ($enviado && $validacion !== false && $validacion !== null) { // asi se incluye el caso en que el usuario introduzca un 0 como cuando no envíe nada o escriba letras inválidas. 
        // ya lo cogemos con el filter input $precioMaximo = $_GET['precioMaximo'] ?? 0; // recoge lo que manda el formulario mediante el metodo post con name="cantidad"
        //echo $precioMaximo;
        $precioMaximo = $_GET['precioMaximo'];
        // Valida que el valor recibido es numérico y no negativo.
        return $precioMaximo;
    }
}


// funcion filtrar productos por precio máximo
function filtrarPorPrecioMax(array $productos, float $precioMax)
{
    if ($precioMax > 0) {
        $productosMenorPrecioMax = [];
        foreach ($productos as $item) {
            if ($item["precio"] <= $precioMax) {
                $productosMenorPrecioMax[] = $item;
            }
        }
        return $productosMenorPrecioMax;
    } else {
        return  null;
    }
}


// funcion para validar el ID introducido por el usuario
function validarIDUsuario()
{
    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["IDbuscar"])) { // con isset ya sabemos que no va a ser nul 
        $productoBuscar = $_GET["IDbuscar"];

        return $productoBuscar;
    }
    // Si no se cumple el if (no es GET o no existe IDbuscar), devolvemos 0
    return 0;
}

function validarIDUsuarioVersion2()
{
    // Validamos directamente que sea un número entero de forma segura
    $productoBuscar = filter_input(INPUT_GET, "IDbuscar", FILTER_VALIDATE_INT);

    // Si es un número válido (incluso si es 0), lo devolvemos
    if ($productoBuscar !== false && $productoBuscar !== null) {
        return $productoBuscar;
    }

    // Si no se envió, está vacío o no es un número válido, devolvemos 0 por defecto
    return 0;
}


//print_r($productoBuscar);
function buscarProducto(array $productosArray, ?int $id = 0)
{
    // El ?int permite que acepte enteros o null de forma limpia
    // Si llega null, lo forzamos a 0 para que la búsqueda funcione bien
    if ($id === null) {
        $id = 0;
    }

    foreach ($productosArray as $pro) {
        if ($pro["id"] === $id) {
            return $pro["nombre"];
        }
    }
    return null;
}



function puedeComprar(array $productos, int $IDproducto, int $cantidad): bool
{

    foreach ($productos as $p) {

        if ($p["id"] === $IDproducto) {

            if ($p["stock"] >= $cantidad) {
                return true;
            } else {
                return false;
            }
        }
    }
    return false;
}
