<!DOCTYPE html>
<html lang="en">
<!-- 
Actividade 2.1- Implementación de algoritmos 
básicos con PHP

Imos a usar o recurso dispoñible en formato PDF (3.AlgoritmosYestructurasDeProgramacion.pdf)).

Aínda que en programación Web non o imos utilizar, 
mentres non vemos como ler datos de formularios web, 
lede este recurso (https://parzibyte.me/blog/posts/php-leer-datos-teclado/) 
que vos da exemplos de como ler datos de teclado 
con fscanf. 

Para executar o arquivo, desde o terminal de VS Code, 
teredes que usar:  php -f nomeArquivo.php

A continuación: 

1- Crea un script php que solicite a altura en cm 
e mostre un documento HTML 5, 
para unha altura determinada de cm,
o número de polgadas e pés que lle corresponde.

2- Crea un script php que solicite x 
e que mostre un documento HTML 5, 
para un valor x dado, 
a saída de f(x) do algoritmo 5.3 do documento de exemplo.

3- Crea un script php que solicite os valores a, b e c
e que se mostre un documento HTML 5, 
para os valores dados a, b, c, 
calcula seguindo o algoritmo 5.4 do documento de exemplo. 

Podes comprobar se o teu script funciona correctamente comparando con recursos coma este: 
https://es.calcuworld.com/calculadoras-matematicas/ecuaciones-segundo-grado/

-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>
        <!--
            Algoritmo 5.2 Calcular una altura en pulgadas (1 pulgada=2.54 cm) 
            y pies (1 pie=12 pulgadas), a partir de la altura en centrimetros,
            que se introduce por el teclado.

            Inicio
                1- IMPRIMIR 'Introduce la altura en centimetros: '
                2- LEER: altura
                3- CALCULAR pulgadas=altura=2:54
                4- CALCULAR pies=pulgadas=12
                5- IMPRIMIR 'La altura en pulgadas es: ', pulgadas
                6- IMPRIMIR 'La altura en pies es : ', pies
            Fin
        --> 
        <?php 
            // 1- IMPRIMIR 'Introduce la altura en centimetros: '
            echo "Introduce la altura en centrimetros: ";
            // 2- LEER: altura
            fscanf(STDIN, "%d", $altura);   // no funciona desde el navegador ya que STDIN sirve para leer datos introducidos en la terminal
        ?>
        <p><?php  
             // 3- CALCULAR pulgadas=altura/2,54
             $pulgadas = $altura/2.54;
             // 5- IMPRIMIR 'La altura en pulgadas es: ', pulgadas
            echo "La altura en pulgadas es: " . $pulgadas;            
        ?></p>

        <p><?php  
            // 4- CALCULAR pies=pulgadas/12
            $pies = $pulgadas / 12;
            // 6- IMPRIMIR 'La altura en pies es : ', pies
            echo "La altura en pies es: " . $pies;        
        ?></p>          
    </h3>   

    <h3>
        <!-- Algoritmo 5.3 
            Calculo del valor de la funcion 
            f(x) = 0 si x <= 0, f(x) = x^2 si x > 0.
            Inicio
                1- LEER x
                2- HACER f=0
                3- Si x>0
                    HACER f=x2
                Fin Si
                4- IMPRIMIR 'El valor de la funcion es: ', f
            Fin
        -->
            <?php 
                // leer X
                echo "Introduce el valor de X: ";
                fscanf(STDIN, "%d", $x);
                $f = 0;

                if ($x > 0) {
                    $f = $x**2;
                }
                echo 'El valor de la funcion es: ', $f;
            ?>
    </h3>
    <h3>
        <!-- 
        Algoritmo 5.4 Calculo de las raices de la ecuacion de segundo grado 
        Ax^2 + Bx + C = 0,
        distinguiendo los casos de raices reales y complejas.
        Inicio
            1- LEER A,B y C
            2- CALCULAR D=B^2-4*A*C
            3- CALCULAR AA=2*A
            4- Si D>=0
                CALCULAR DD= raiz cuadrada de D
                x1=(-B+DD)/AA
                x2=(-B-DD)/AA
                IMPRIMIR 'La ecuaci¶on tiene ra¶³ces reales:', x1, x2
            Si no
                CALCULAR 
                    DD=raiz cuadrada de -D
                    Re=-B/AA
                    Im=DD/A2
                IMPRIMIR 'La ecuaci¶on tiene ra¶³ces complejas conjugadas:'
                IMPRIMIR 'Parte real:', Re
                IMPRIMIR 'Parte imaginaria:', Im
            Fin Si
        Fin -->
        <?php  
            // leer a, b, c
            echo "Indica a, b y c (en este orden y en formato decimal): ";
            fscanf(STDIN, "%f,%f,%f", $a, $b, $c); // %d -> para numeros enteros y %f -> para numeros decimales
            $d = $b**2-4*$a*$c;
            $aa = 2*$a;

            if ($d >= 0) {
                $dd = sqrt($d);
                $x1 = (-$b+$dd)/$aa;
                $x2 = (-$b-$dd)/$aa;

                echo "La ecuación tiene raíces reales: <br> " . "\n";
                echo "x1 = " . $x1 . "\n <br>";
                echo "x2 = " . $x2;
            } else {
                $dd = sqrt(-$d);
                $Re = -$b/$aa;
                $Im = $dd/$aa;

                echo "La ecuación tiene raíces complejas conjugadas: " . "\n";
                echo "Parte real: " . $Re;
                echo "Parte imaginaria: " . $Im;
            }
        ?>
    </h3>
</body>
</html>