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

if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
  $tempFilePath = $_FILES['profile_picture']['tmp_name'];

  $profilePictureData = file_get_contents($tempFilePath);

  $profilePictureData = mysqli_real_escape_string($conection, $profilePictureData);

  if ($userRole == 'student') {
    $query = "UPDATE students SET stu_profilepicture = '$profilePictureData' WHERE stu_id = '$userID'";
  } elseif ($userRole == 'professor') {
    $query = "UPDATE teachers SET teach_profilepicture = '$profilePictureData' WHERE teach_id = '$userID'";
  } elseif ($userRole == 'ADMIN') {
    $query = "UPDATE admins SET adm_profilepicture = '$profilePictureData' WHERE adm_id = '$userID'";
  } else {
    echo "Rol de usuario inválido.";
    exit();
  }

  $result = mysqli_query($conection, $query);

  if ($result) {
    header("Location: ../views/dashboard.php");
    exit();
  } else {
    echo "Error while trying to update image " . mysqli_error($conection);
  }
} else {
  echo "There's no image selected";
  header("Refresh: 1; URL=../views/dashboard.php");
}

mysqli_close($conection);
?>
