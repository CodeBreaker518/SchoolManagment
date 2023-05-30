<?php
// Archivo logout.php

// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión u otra página de tu elección
$setTimeOut = 0.5;
$url = '../views/login.php';
header("refresh: $setTimeOut; url=$url");
echo('Loading...');
exit;
?>
