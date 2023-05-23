<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['loggedin'])) {
  header("Location: ../views/login.php");
  exit();
}
// Resto del código de tu página de inicio de sesión (login.php)
// Aquí puedes mostrar el formulario de inicio de sesión y manejar la autenticación
?>
