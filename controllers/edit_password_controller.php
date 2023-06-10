<?php
session_start();

$host = "localhost";
$database = "school_db";
$username = "root";
$db_password = "";

$conection = mysqli_connect($host, $username, $db_password, $database);

// Verificar la conexión
if (!$conection) {
  die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

$userID = $_SESSION['user_id'];
$userRole = $_SESSION['user_type'];
$newpassword = $_POST['newpassword'];

  if ($userRole == 'student') {
    $query = "UPDATE students SET stu_password = '$newpassword' WHERE stu_id = '$userID'";
  } elseif ($userRole == 'professor') {
    $query = "UPDATE teachers SET teach_password = '$newpassword' WHERE teach_id = '$userID'";
  } elseif ($userRole == 'ADMIN') {
    $query = "UPDATE admins SET adm_password = '$newpassword' WHERE adm_id = '$userID'";
  } else {
    echo "Rol de usuario inválido.";
    exit();
  }

  $result = mysqli_query($conection, $query);

  if ($result) {
    echo "Password Changed!";
    header("Refresh: 1; URL=../views/dashboard.php");
    session_destroy();
    exit();
  } else {
    echo "Error changing the password";
    header("Refresh: 1; URL=../views/dashboard.php");
    mysqli_error($conection); 
}

// Cerrar la conexión a la base de datos
mysqli_close($conection);
?>
