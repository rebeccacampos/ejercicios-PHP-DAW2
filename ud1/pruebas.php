<?php 

function precioConIva(float $preciobase, float $iva) {
    return $preciobase*$iva;
}

echo precioConIva(100, 1.21);

?>

