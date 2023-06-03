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


$courId = $_POST['id'];
$teachId = $_POST['teacher'];

// Verificar si existe el profesor y el curso antes de asignarlos
$validTeacher = false;
$validCourse = false;

$teacherQuery = "SELECT * FROM teachers WHERE teach_id = '$teachId'";
$teacherResult = mysqli_query($conection, $teacherQuery);
if ($teacherResult && mysqli_num_rows($teacherResult) > 0) {
    $validTeacher = true;
}

$courseQuery = "SELECT * FROM courses WHERE cour_id = '$courId'";
$courseResult = mysqli_query($conection, $courseQuery);
if ($courseResult && mysqli_num_rows($courseResult) > 0) {
    $validCourse = true;
}

if ($validTeacher && $validCourse) {
    $query = "UPDATE courses SET cour_teach_id = '$teachId' WHERE cour_id = '$courId'";
    $result = mysqli_query($conection, $query);

    if ($result) {
        $setTimeOut = 0.5;
        $url = '../../views/dashboard.php';
        header("refresh: $setTimeOut; url=$url");
        echo('Guardando cambios...');
    } else {
        echo "Error al editar el curso: " . mysqli_error($conection);
    }
} else {
    echo "Profesor o curso inválido. Verifica los datos ingresados.";
}

mysqli_close($conection);

?>