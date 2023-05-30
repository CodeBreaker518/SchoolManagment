<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

$host = "localhost";
$database = "school_db";
$username = "root";
$db_password = "";

$conection = mysqli_connect($host, $username, $db_password, $database);

if (!$conection) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

$profilepicture = $_FILES['profile_picture']['tmp_name'];
$profilepictureData = file_get_contents($profilepicture);
$profilepictureType = $FILES['profile_picture']['type'];

$rol = $_POST['rol'];
$id = $_POST['id']; // Suponemos que el ID se envía mediante un campo oculto en el formulario

if ($rol == 'student') {
    $query = "UPDATE students SET stu_profilepicture = '$profilepictureData', stu_profilepicture_type = '$profilepictureType' WHERE stu_id = '$id'";
} elseif ($rol == 'professor') {
    $query = "UPDATE teachers SET teach_profilepicture = '$profilepictureData', teach_profilepicture_type = '$profilepictureType' WHERE teach_id = '$id'";
} else {
    echo 'Inserción inválida';
    exit;
}

$result = mysqli_query($conection, $query);

if ($result) {
    $setTimeOut = 0.5;
    $url = '../../views/dashboard.php';
    header("refresh: $setTimeOut; url=$url");
    echo('Guardando cambios...');
} else {
    echo "Error al editar el perfil: " . mysqli_error($conection);
}

mysqli_close($conection);

?>
