<?php
$host = "localhost";
$database = "school_db";
$username = "root";
$db_password = "";

$conection = mysqli_connect($host, $username, $db_password, $database);

// Verificar si hay errores de conexión
if (mysqli_connect_errno()) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si el usuario ha iniciado sesión
$userId = $_SESSION['user_id'];
$userRole = $_SESSION['user_type'];

// Traer imagen dependiendo del rol
if ($userRole == 'student') {
    $sql = "SELECT stu_profilepicture FROM students WHERE stu_id = $userId";
} elseif ($userRole == 'professor') {
    $sql = "SELECT teach_profilepicture FROM teachers WHERE teach_id = $userId";
} elseif ($userRole == 'ADMIN'){
    $sql = "SELECT adm_profilepicture FROM admins WHERE adm_id = $userId";
}else {
    echo "Rol de usuario inválido.";
    exit();
}

$result = mysqli_query($conection, $sql);
if ($result) {
    // Verificar si se encontró la imagen del usuario
    if (mysqli_num_rows($result) > 0) {
        // Recupera la fila del resultado de la consulta
        $row = mysqli_fetch_assoc($result);

        // Determina el nombre de la columna según el rol
        if ($userRole == 'student') {
            $imageData = $row['stu_profilepicture'];
        } elseif ($userRole == 'professor') {
            $imageData = $row['teach_profilepicture'];
        } elseif ($userRole == 'ADMIN') {
            $imageData = $row['adm_profilepicture'];
        }

        // Cierre el resultado
        mysqli_free_result($result);
    } else {
        echo "There's no image for the actual user";
        exit;
    }
} else {
    echo "Error en la consulta: " . mysqli_error($conection);
    exit;
}

$conection->close();
?>
