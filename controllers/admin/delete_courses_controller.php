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
    die("Error to connect to the database: " . mysqli_connect_error());
}

$name = $_DELETE['name'];
$description = $_POST['description'];
$date = $_POST['date'];
$time = $_POST['hour'];

$query = "INSERT INTO courses (cour_name, cour_description, cour_date, cour_hour) VALUES ('$name','$description','$date','$time')";

$result = mysqli_query($conection,$query);

if ($result) {
    $setTimeOut = 0.5;
    $url = '../../views/dashboard.php';
    header("refresh: $setTimeOut; url=$url");
    echo('Loading...');
} else {
echo "Error al insertar datos: " . mysqli_error($conection);
}

mysqli_close($conection);

?>