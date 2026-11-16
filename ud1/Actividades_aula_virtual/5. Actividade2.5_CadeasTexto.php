<!DOCTYPE html>
<html lang="en">
<!--
Actividade 2.5-Cadeas de texto
Requisitos do completado

a) Modifica o script util_cadenas_enunciado.php  e completa a función es_palindromo 
para que reciba unha cadea e devolva un valor booleano indicando se a cadea é un palíndromo ou non.

Usa os arrays de caracteres non permitidos deberán substituírse 
polo seu correspondente carácter permitido (a mesma posición na matriz)

$no_permitidos = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹");
$permitidos = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
  
Os símbolos eliminables pódense substituír por unha cadea baleira "":

  $eliminables = array(' ', ',', '.', ';', ':', '-', '´', '\"', '\'', '¡', '¿', '!', '?');
b)Nun script PHP diferente, use esa función para aplicala aos elementos da seguinte matriz:

$array_pruebas = array(
    "abccba",
    "abcba",
    "",
    " 1 ",
    "ab- -ba",
    "dabale arroz a la zorra el abad",
    "No subas,abusón",
    "Adán no cede con Eva y Yavé no cede con nada",
    23832,
    // Negativos
    "ab",
    "abc"
);

Para cada posición da matriz de proba, debe aplicarse a función es_palindromo e amosarase unha mensaxe indicando se a cadea é un palíndromo ou non. Aplica unha clase CSS para cambiar a cor da fonte nun caso ou outro.

c) Finalmente crea un script PHP que conteña un formulario HTML que será procesado polo propio script donde un usuario poida engadir nun campo de texto unha entrada que será enviada con POST e comprobar si se introduciu un palíndromo o no.
-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $no_permitidos = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹");
        $permitidos = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
        $eliminables = array(' ', ',', '.', ';', ':', '-', '´', '\"', '\'', '¡', '¿', '!', '?');

        /* Completa la función  que reciba un string y devuelva un valor booleano indicando si se trata de un palíndromo o no
        Utiliza los  arrays de caracteres no permitidos que deberán ser reemplazados por su correspondiente carácter permitido (misma posición)
        * Los  símbolos eliminables podrán ser sustituidos por cadena vacía ""
        *  */

        /*
        function es_palindromo(...) {
            //Ayuda: Ámbito de las variables
            //https://www.php.net/manual/es/language.variables.scope.php
        }*/
    ?>
    
</body>
</html>