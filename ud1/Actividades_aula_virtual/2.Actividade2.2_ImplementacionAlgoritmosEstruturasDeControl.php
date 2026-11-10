<!DOCTYPE html>
<html lang="en">
<!-- 
Actividade 2.2- Implementación de algoritmos básicos con estruturas de control
Requisitos do completado
Seguimos co recurso en formato PDF por se deixa de estar dispoñible.

1) Crea un script php que amose nun documento HTML 5, 
para un nº n dado resolva o algoritmo 5.8

2) Crea un script php que amose nun documento HTML 5, 
para un nº n dado resolva o algoritmo 5.9

3) Crea un script php que amose un documento HTML 5 cunha lista desordenada HTML, 
para un nº n  dado e resolva o algoritmo 5.10 do mesmo documento

4) Crea un script php que amose nun documento HTML 5 a tirada dun dado axudándote da función rand(). 
A tirada débese repetir ata que saia un 5. Conta o nº de tiradas que se necesitaron para obter o 5. 
Mostra o valor de cada tirada e finalmente o nº de tiradas no documento HTML5.

5) Crea un script php que, dada a cualificación numérica (con posibles decimais) dun/a alumno/a , 
obteña a cualificación en formato cadea de texto de a
-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3><?php 
        /* 1) Algoritmo 5.8
        Dado un entero, n, calcular la suma de los n primeros números impares.
        Inicio
            LEER n
            HACER suma=0
            Para i=1, 3,5,...,2*n-1
            HACER suma=suma+i
            Fin Para
            IMPRIMIR’Lasuma vale:’, suma
        Fin */
        echo "Indica un numero entero: ";
        fscanf(STDIN, "%d", $n);
        $n = (int)$n; // lo convierte a un numero entero
        $suma = 0;

        for ($i=1; $i < $n; $i++) {
            $suma = $suma+i;
        }

        echo "La suma vale: ", $suma;

    ?></h3>

    <h3><?php 
        /* 2) Algoritmo 5.9 Dado un entero, n, calcular
        Inicio
            LEER n
            HACER suma=1
            HACER ter=1
            Para k=1, 2,...,n
                HACER ter=ter/2
                HACER suma=suma+ter
            Fin Para
            IMPRIMIR 'La suma vale: ', suma
        Fin
        */
    ?></h3>

    <h3><?php 
        /* 3) 
        Algoritmo 5.10 - Dado un numero natural, n, imprimir la lista de sus divisores, en orden decreciente.
        Inicio
            LEERn
            IMPRIMIR’Listadedivisoresdelnumero: ’,n
        Para i=ParteEntera(n/2) hasta 2 (incremento-1)
            Si resto(n/i)=0
                IMPRIMIR i
            FinSi
        FinPara
        IMPRIMIR 1
        Fin */
    ?></h3>
    
</body>
</html>