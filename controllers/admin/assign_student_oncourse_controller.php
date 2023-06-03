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
$stuId = $_POST['student'];

$validStudent = false;
$validCourse = false;

$studentQuery = "SELECT * FROM students WHERE stu_id = '$stuId'";
$studentResult = mysqli_query($conection, $studentQuery);
if($studentResult && mysqli_num_rows($studentResult) > 0)
{
    $validStudent = true;
}

$courseQuery = "SELECT * FROM courses WHERE cour_id = '$courId'";
$courseResult = mysqli_query($conection, $courseQuery);
if ($courseResult && mysqli_num_rows($courseResult) > 0) {
    $validCourse = true;
}

if($validCourse && $validStudent)
{
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
}

mysqli_close($conection);

?>
