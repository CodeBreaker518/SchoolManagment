<?php
$host = "localhost";
$database = "school_db";
$username = "root"; 
$password = ""; 

// Establecer la conexión a la base de datos
$conn = mysqli_connect($host, $username, $password, $database);

// Verificar si la conexión fue exitosa
if (!$conn) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}else {
    echo "Conexión exitosa a la base de datos.";
}
?>