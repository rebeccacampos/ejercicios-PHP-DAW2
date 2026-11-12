<?php
    $ciclo = 'DAW'; // comillas simples para que sea una constante
    $nombre = 'Ana';
    $modulo = 'DWCS';
?>

<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $nombre?></title> // no hace falta poner el echo (le indica que tiene que hacer el print directamente)
</head>
<body>
    <!-- NOTAS 
 
        Parte A
        Declara las variables npmbre, ciclo y modulo. Muestra sus valores dentro de una estructura HTML válida.

        Parte B 
        Escribe una misma frase de dos formas: 
        interpolando variables entre comillas dobles y concatenando con el operador punto.


        -->
        
    <h1><?php echo $nombre . ' estudia ' . $modulo . ' de ' . $ciclo?></h1> <!-- esto es lo mismo que: <?= $titulo?>-->
    <div>    
        <?php
            echo $nombre;
            echo " estudia $modulo de $ciclo"; // usamos los corchetes para poder poner un caracter seguido -> º
        
            /*Comentario de varias lineas en php */
        
        ?>

        <!--
        Contenido que cambia: 

        La zona horaria puede cambiar de entorno cliente a entorno servidor.
        Cambiar formato de fecha a Y-m-d.
        Ver como se actualiza la hora.
        -->

        <?php
            echo "</br> El día ".date('d/m/Y');
            echo " es muy caluroso.";
        ?>

        <?php
            echo "</br> A las ". date('H:i'); // muestra la hora y se actualiza automaticamente ya que hace llamada la servidor
            echo "</br> El día ". date('Y/m/d');
            echo " es muy caluroso.";
        ?>

        <!-- Localizar errores:
            -> cargar la pagina 
            -> php -l nombreArchivo
        
            Tipos de errores:
            - Parse errorr: revisar la linea indicada y la anterior
            - Undefined variable: comprobar el nombre y si se asigno un valor
            - Pagina en blanco -> consultar registro de errores de apacho

            Entorno de desarrollo -> conviene mostrar todos los errores mientras programamos. En produccion se registran pero no se muestran al usuario.     

        
        -->

    </div>
</body>

</html>