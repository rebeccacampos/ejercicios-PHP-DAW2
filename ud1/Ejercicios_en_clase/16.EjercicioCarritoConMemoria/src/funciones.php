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

