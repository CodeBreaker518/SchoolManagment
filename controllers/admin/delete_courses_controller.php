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
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

$id = $_POST['id']; // Supongamos que el ID del registro a eliminar se envía mediante un formulario POST
echo $id;
$query = "DELETE FROM courses WHERE cour_id = '$id'";

$result = mysqli_query($conection, $query);

if ($result) {
    $setTimeOut = 0.5;
    $url = '../../views/dashboard.php';
    header("refresh: $setTimeOut; url=$url");
    echo('Eliminando...');
} else {
    echo "Error al eliminar datos: " . mysqli_error($conection);
}

mysqli_close($conection);

?>
