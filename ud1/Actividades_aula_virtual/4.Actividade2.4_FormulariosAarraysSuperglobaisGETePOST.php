<!DOCTYPE html>
<html lang="en">
<!-- 
Actividade 2.4- Formularios e arrays superglobais $_GET e $_POST
Requisitos do completado
1- Crea un formulario que permita seleccionar prendas e unha cor similar á da imaxe. 
Permítese seleccionar máis dunha peza e só unha cor.  Selecciona o método HTTP GET ou POST máis adecuado. Axudándote do script PHP que amosa os valores introducidos que vimos nos contidos, engade as modificacións necesarias para que se mostren os datos recibidos.

Para a cor, amosa o valor recibido e unha cor de fondo que coincida con esa cor mediante estilos CSS inline.
Podes ver exemplos de CSS inline na URL https://www.hostinger.es/tutoriales/tipos-de-estilos-css. 
Busca qué propiedade CSS necesitas para cambiar a cor de fondo.


2. Crea un script PHP cun formulario HTML5 como o da imaxe inferior para permitir realizar 
as reservas do almorzo nun restaurante.
Debe usar elementos <label> vinculados explicitamente aos elementos html correspondentes mediante o atributo for.
Será procesado polo mesmo script
A data é un campo obrigatorio. A data mínima e o valor mostrado deberán ser a data de hoxe. 
Teremos que introducila manualmente en formato YYYY-MM-DD. A data máxima será o último día deste mes.
A hora debe permitir valores entre as 13:00 e as 15:00. O valor mostrado debe ser 13:00
A terraza debe estar seleccionada por defecto
A lista de alérxenos só pode permitir seleccionar os elementos visibles na imaxe. 
Poden seleccionarse varios elementos. O primeiro debe ter o atributo value baleiro e estar deshabilitado.


3. Facilítase o script zodiaco_enunciado.php que contén un formulario HTML 
que permite introducir día e mes de nacemento mediante etiquetas <select>.
O formulario HTML carece de atributo action, polo que será procesado polo mesmo 
script PHP que contén o formulario HTML.

O script conta cun array $zodiaco que ten por clave numérica o número de mes (1 para xaneiro, 
2 para febreiro, etc.).

$zodiaco = array(
         //   xaneiro  
            1 => array(20 => CAPRICORNIO,
                "else" => ACUARIO),
           // febreiro
            2 => array(19 => ACUARIO,
                "else" => PISCIS),

O valor de cada clave numérica é á súa vez un array asociativo. A primeira clave é numérica, 
indicando o día de corte no mes a partir do cal, o signo do zodiaco cambia.

Por exemplo, os nacidos ata o 20 de xaneiro incluído son CAPRICORNIO, 
a partir dese día de xaneiro, son ACUARIO e así sucesivamente.

Completa o array  $zodiaco cos meses que faltan. Podes axudarte desta URL.

 
4. EXTRA Substitúe as etiquetas <option> por código PHP que cree e amose na saída HTML 
os elementos <option> correspondentes, seleccionando un en concreto 
se a variable do método POST existe e está inicializada a algo distinto de NULL

-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>