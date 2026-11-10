<?php
    session_start();
    $_SESSION["entradas"] ??= 0;
    $_SESSION["entradas"]++;
    echo $_SESSION["entradas"];
    // muestra las entradas a esa pagina web ejemplo del profe en clase

    $_COOKIE["entradas"] ??=0;
    $_COOKIE["entradas"]++;
    echo "<br>" . $_COOKIE["entradas"];
    
    // ver cookies recibidas
    var_dump($_COOKIE); // solo desarrollo

    /*
    Cookie: dato que almacena y envia el navegador
    Sesión: datos del servidor asociados a un identificador
    */

    // Libera todas las variables de sesión que estén actualmente registradas. 
    // En otras palabras, vacía el array $_SESSION = array();
    // Sin embargo, la sesión en el servidor sigue existiendo.
    session_unset();

    // elimina las variables dentro del servidor sesion 
    //Destruye toda la información asociada con la sesión actual en el servidor (elimina el archivo de sesión 
    //o los registros en la base de datos donde el servidor guardaba los datos de ese usuario).
    //Resultado: La sesión actual queda completamente anulada e inutilizable.
    session_destroy();
?>

<?php
// ejemplo para entenderlo de la ia
// 1. Primero iniciamos la sesión para poder leer los datos guardados
session_start();

// 2. Comprobamos si el usuario NO está autenticado
if (!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] !== true) {
    
    // 3. Si no ha iniciado sesión, usamos header() para redirigirlo al login
    header("location: login.php", true, 303);
    
    // 4. Siempre cerramos con exit para detener la ejecución
    exit;
}

// Si sí está autenticado, el código sigue fluyendo y se muestra la página normal...
echo "Bienvenido a tu área privada, " . $_SESSION["usuario"];
?>

<?php 

/*
¿Por qué se suelen usar juntas?
Aunque session_destroy() destruye la sesión,
a veces algunas variables pueden seguir accesibles en la memoria temporal durante el transcurso de esa misma 
ejecución de PHP si no se limpian antes. Por eso, en la práctica, 
se usan juntas para hacer un cierre de sesión limpio y seguro. 

Nota adicional para un cierre de sesión perfecto: Para que el cierre sea 100% seguro, 
los desarrolladores también suelen borrar la cookie de la sesión en el navegador del usuario 
para que no queden rastros del identificador de sesión antiguo.

*/

/* Un ejemplo completo y profesional de cómo hacer un cierre de sesión (logout) seguro en PHP.

Este código no solo borra los datos del servidor, sino que también elimina la cookie del navegador 
para asegurarse de que el identificador de sesión quede totalmente invalidado. */


// 1. Iniciamos la sesión para poder acceder a sus datos y cookies
session_start();

// 2. Borramos todas las variables del array $_SESSION
$_SESSION = array();

// 3. Borramos la cookie de sesión en el navegador del usuario
// Esto es vital para que la cookie física expire inmediatamente
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),                  // Nombre de la cookie de sesión
        '',                              // Valor vacío
        time() - 42000,                  // Tiempo de expiración en el pasado (para borrarla)
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// 4. Destruimos la sesión en el servidor
session_destroy();

// 5. Redirigimos al usuario a la página de login o inicio usando header() y exit
header("location: login.php", true, 303);
exit;


?>
