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

// Obtener el ID y rol del usuario (ajusta esto según tu lógica de obtención de datos de usuario)
$userID = $_SESSION['user_id'];
$userRole = $_SESSION['user_type'];
$newpassword = $_POST['newpassword'];

  if ($userRole == 'student') {
    $query = "UPDATE students SET stu_passwors = '$newpassword' WHERE stu_id = '$userID'";
  } elseif ($userRole == 'professor') {
    $query = "UPDATE teachers SET teach_password = '$newpassword' WHERE teach_id = '$userID'";
  } elseif ($userRole == 'ADMIN') {
    $query = "UPDATE admins SET adm_profilepicture = '$newpassword' WHERE adm_id = '$userID'";
  } else {
    echo "Rol de usuario inválido.";
    exit();
  }

  $result = mysqli_query($conection, $query);

  // Verificar si la actualización fue exitosa
  if ($result) {
    // Redireccionar al usuario a una página de éxito o a su perfil
    header("Location: ../views/dashboard.php");
    exit();
  } else {
    echo "Error al actualizar la imagen de perfil: " . mysqli_error($conection);
  }
} else {
  echo "No se ha seleccionado ninguna imagen.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conection);
?>
