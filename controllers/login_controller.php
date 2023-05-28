<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

$host = "localhost"; 
$database = "school_db"; 
$username = "root"; 
$db_password = ""; 

// Establecer la conexión a la base de datos
$conection = mysqli_connect($host, $username, $db_password, $database);

// Verificar la conexión
if (!$conection) {
    die("Error to connect to the database: " . mysqli_connect_error());
}

// Obtener los valores del formulario
$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM students WHERE stu_email = '$email' LIMIT 1";
$result = mysqli_query($conection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    if ($row['stu_password'] == $password) {
        $_SESSION['user_id'] = $row['stu_id'];
        $_SESSION['user_name'] = $row['stu_name'];
        $_SESSION['user_type'] = 'student';

        mysqli_free_result($result);
        mysqli_close($conection);

        header("Location: ../../views/dashboard.php");
        exit;
    }
}

$query = "SELECT * FROM teachers WHERE teach_email = '$email' LIMIT 1";
$result = mysqli_query($conection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    if ($row['teach_password'] == $password) {
        $_SESSION['user_id'] = $row['teach_id'];
        $_SESSION['user_name'] = $row['teach_name'];
        $_SESSION['user_type'] = 'professor';

        mysqli_free_result($result);
        mysqli_close($conection);

        header("Location: ../views/dashboard.php");
        exit;
    }
}

if($email === 'admin@admin.admin' && $password === 'root')
{
    $_SESSION['user_id'] = '0';
    $_SESSION['user_name'] = 'ADMIN';
    $_SESSION['user_type'] = 'ADMIN';

    mysqli_free_result($result);
    mysqli_close($conection);

    header("Location: ../views/dashboard.php");
    exit;
}

mysqli_free_result($result);
mysqli_close($conection);

// Si no se redireccionó, muestra el mensaje de error
echo "Email or password incorrect.";
?>
