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

$courId = $_POST['cour-id'];
$stuId = $_POST['teach-id'];

$query = "INSERT INTO records (rec_cour_id, rec_stu_id) VALUES ('$courId','$stuId')";

$result = mysqli_query($conection, $query);

if ($result) {
    $setTimeOut = 0.5;
    $url = '../../views/dashboard.php';
    header("refresh: $setTimeOut; url=$url");
    echo('Guardando cambios...');
} else {
    echo "Error al editar el curso: " . mysqli_error($conection);
}

mysqli_close($conection);

?>
