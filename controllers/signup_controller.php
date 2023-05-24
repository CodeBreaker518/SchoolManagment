<?php

$host = "localhost"; // Cambia esto si tu servidor MySQL no está en localhost
$database = "school_db"; // Reemplaza "nombre_basedatos" con el nombre de tu base de datos, incluyendo la ruta relativa a la carpeta "db"
$username = "root"; // Reemplaza "usuario_mysql" con tu nombre de usuario de MySQL
$db_password = ""; // Reemplaza "contraseña_mysql" con tu contraseña de MySQL
// Establecer la conexión a la base de datos
$conection = mysqli_connect($host, $username, $db_password, $database);

// Verificar la conexión
if (!$conection) {
  die("Error to connect to the database: " . mysqli_connect_error());
}

// Obtener los valores del formulario
$name = $_POST['name'];
$phone = $_POST['phone'];
$profession = $_POST['profession'];
$email = $_POST['email'];
$password = $_POST['password'];
$rol = $_POST['rol'];

if($rol == 'student')
{
    $query = "INSERT INTO students (stu_name, stu_phone, stu_email, stu_password) VALUES ('$name', '$phone', '$email', '$password')";
}elseif($rol == 'professor')
{
    $query = "INSERT INTO teachers (teach_name, teach_phone, teach_email, teach_password, teach_profession) VALUES ('$name', '$phone', '$email', '$password', '$profession')";
}else
{
    echo'Insersion invalida';
    exit;
}

// Crear la consulta SQL de inserción

// Ejecutar la consulta
$result = mysqli_query($conection, $query);

// Verificar si la inserción fue exitosa
if ($result) {
  echo "Datos insertados correctamente";
} else {
  echo "Error al insertar datos: " . mysqli_error($conection);
}

// Cerrar la conexión a la base de datos
mysqli_close($conection);
?>
