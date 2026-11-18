<?php

// actualiza la lista de productos en el carrito
function existeProductoyStock(array $productosCatalogo, int $id, int $cantidadComprar) {
    // Compruebo que el producto existe y que existe stock suficiente. 
    foreach($productosCatalogo as $p) {
        if ($p["id"] === $id && $p["stock"] > $cantidadComprar) {
            return $p; // encuentra el producto, devuelve sus datos
        } 
    }

    return 0; // recorrió todo y no existe el producto con stock suficiente 
}


/*
 * Busca un producto por su ID en el catálogo.
 * Devuelve el array del producto si existe, o null si no existe.
 */
function buscarProductoPorId(array $catalogo, int $id): ?array {
    foreach ($catalogo as $producto) {
        if ($producto["id"] === $id) {
            return $producto; // Lo encontró, devuelve sus datos
        }
    }
    return null; // Recorrió todo y no existe
}


function actualizarProducto($productosArray, $id, $valorActualizar, $nuevoValor) {
    $producto = buscarProductoPorId($productosArray, $id);
    if ($producto != null) {
        $producto[$valorActualizar] = $nuevoValor;
    }
}

function limpiarCarritoV1(array &$arrayCarrito) { // el & pasa la variable por referencia y modifica la variable original
    //unset($_SESSION[$arrayCarrito]); // borra unicamente esta variable de sesion pero está mal porque pide como parametro un texto no puede ser array
    $arrayCarrito = [];
}

function limpiarCarritoV2(string $nombreClave) {
    // Si existe la variable dentro de $_SESSION, la borramos
    if (isset($_SESSION[$nombreClave])) {
        unset($_SESSION[$nombreClave]);
    }
}

/*

Funciones y Métodos para Limpiar el Carrito / Sesión

unset($_SESSION["carrito"])   
    Qué hace: Borra únicamente la variable o clave indicada del array de sesión (en este caso, vacía el carrito).
    Cuándo usarlo: Para vaciar la compra del usuario manteniendo el resto de datos de la sesión intactos.   
session_unset()  
    Qué hace: Vacía y borra todas las variables que hay dentro de $_SESSION a la vez.
    Cuándo usarlo: Cuando quieres limpiar todo el almacenamiento temporal del usuario sin destruir la sesión por completo.   
session_destroy()   
    Qué hace: Destruye por completo la sesión actual en el servidor y borra su identificación.   
    Cuándo usarlo: Al cerrar sesión (Log out).   


*/