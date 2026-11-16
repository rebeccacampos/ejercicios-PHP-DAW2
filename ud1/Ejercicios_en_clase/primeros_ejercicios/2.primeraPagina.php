<?php
    $titulo = 'Mi primera página';
    $nombre = 'Ana';
    $curso = 2;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo?></title>
</head>
<body>

    <h1><?php echo $titulo ?></h1> <!-- esto es lo mismo que: <?= $titulo?>-->
    <div>    
        <?php
            echo $nombre;
            echo " estudia {$curso}º de DAW"; // usamos los corchetes para poder poner un caracter seguido -> º
        ?>
    </div>
</body>

<!-- NOTAS 
 
- PHP determina el tipo a partir del valor asignado. Lenguaje de tipado dinámico y débilmente tipado
- Habitos desde el principio: sangrÍa coherente, nombres claros y una instruccion por linea
- Nomenclatura:
    Variables: $camelCase
    Objetos: $ObjectCase
    Constantes: CONSTANTE

Contenido que cambia: 

La zona horaria puede cambiar de entorno cliente a entorno servidor.
Cambiar formato a Y-m-d
-->

</html>