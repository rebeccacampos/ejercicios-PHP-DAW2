<?php
    /* NOTAS 
 
        Objetivo
        Encuentra cuatro problemas. Corrige primero los errores de sintaxis y despues los de resultado.

        Metodo:
        1. Ejecuta php -l
        2. Corrige el primer error
        3. Repite hasta validar.
        4. Comprueba la página

    */

    $nombre = 'Lucia';
    $curso = 2;

    echo '<h1>Hola $Nombre</h1>';
    echo "<p> Curso: {$curso}º</p>";

    /*errores: falta el ; despues de lucia, variable nombre en mayusculas, 
    con las comillas simples en la linea 18 no va a identificar la variable
    en la linea 19 faltan los corchetes*/

   /* Localizar errores:
            -> cargar la pagina 
            -> php -l nombreArchivo
        
            Tipos de errores:
            - Parse errorr: revisar la linea indicada y la anterior
            - Undefined variable: comprobar el nombre y si se asigno un valor
            - Pagina en blanco -> consultar registro de errores de apacho

            Entorno de desarrollo -> conviene mostrar todos los errores mientras programamos. En produccion se registran pero no se muestran al usuario.     

        
        */

    $nombre = 'Lucia';
    $curso = 2;

    echo "<h1>Hola $nombre</h1>";
    echo "<p> Curso: {$curso}º</p>"
?>

