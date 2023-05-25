<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

$host = "localhost"; // Cambia esto si tu servidor MySQL no está en localhost
$database = "school_db"; // Reemplaza "nombre_basedatos" con el nombre de tu base de datos, incluyendo la ruta relativa a la carpeta "db"
$username = "root"; // Reemplaza "usuario_mysql" con tu nombre de usuario de MySQL
$db_password = ""; // Reemplaza "contraseña_mysql" con tu contraseña de MySQL
// Establecer la conexión a la base de datos
$conection = mysqli_connect($host, $username, $db_password, $database);

// Verificar la conexión
if (!$conection) 
{
    die("Error to connect to the database: " . mysqli_connect_error());
}

// Obtener los valores del formulario
$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM students WHERE stu_email = '$email' LIMIT 1";
$result = mysqli_query($conection, $query);

if ($result && mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_assoc($result);

    if ($row['stu_password'] == $password) 
    {
        $_SESSION['user_id'] = $row['stu_id'];
        $_SESSION['user_name'] = $row['stu_name'];

        mysqli_free_result($result);
        mysqli_close($conection);

        header("Location: ../views/dashboard.php");
        exit;
    }
}

$query = "SELECT * FROM teachers WHERE teach_email = '$email' LIMIT 1";
$result = mysqli_query($conection, $query);

if ($result && mysqli_num_rows($result) > 0) 
{
    $row = mysqli_fetch_assoc($result);
    
    if ($row['teach_password'] == $password) 
    {
        $_SESSION['user_id'] = $row['teach_id'];
        $_SESSION['user_name'] = $row['teach_name'];
        
        mysqli_free_result($result);
        mysqli_close($conection);
        
        header("Location: ../views/dashboard.php"); // Redirige al dashboard del profesor
        exit;
    }
}

echo"email or password incorrect";

mysqli_free_result($result);

mysqli_close($conection);
?>
