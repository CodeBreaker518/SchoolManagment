<?php
// Datos de conexión a la base de datos
$host = "localhost"; // Cambia esto si tu servidor MySQL no está en localhost
$database = "school_db"; // Reemplaza "nombre_basedatos" con el nombre de tu base de datos, incluyendo la ruta relativa a la carpeta "db"
$username = "root"; // Reemplaza "usuario_mysql" con tu nombre de usuario de MySQL
$password = ""; // Reemplaza "contraseña_mysql" con tu contraseña de MySQL

// Establecer la conexión a la base de datos
$conn = mysqli_connect($host, $username, $password, $database);

// Verificar si la conexión fue exitosa
if (!$conn) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}else {
    echo "Conexión exitosa a la base de datos.";
}
?>