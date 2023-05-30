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

$profilepicture = $_POST['profile_picture'];
$rol = $_POST['rol'];
$id = $_POST['id']; // Suponemos que el ID se envía mediante un campo oculto en el formulario

if ($rol == 'student') {
    $query = "UPDATE students SET stu_profilepicture = '$profilepicture' WHERE stu_id = '$id'";
} elseif ($rol == 'professor') {
    $query = "UPDATE teachers SET teach_profilepicture = '$profilepicture' WHERE teach_id = '$id'";
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
