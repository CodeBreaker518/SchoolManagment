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

$profilepicture = $_FILES['profile_picture']['tmp_name'];
$profilepictureData = file_get_contents($profilepicture);
$profilepictureType = $FILES['profile_picture']['type'];

$rol = $_POST['rol'];
$id = $_POST['id']; // Suponemos que el ID se envía mediante un campo oculto en el formulario

if ($rol == 'student') {
    $query = "UPDATE students SET stu_profilepicture = '$profilepictureData', stu_profilepicture_type = '$profilepictureType' WHERE stu_id = '$id'";
} elseif ($rol == 'professor') {
    $query = "UPDATE teachers SET teach_profilepicture = '$profilepictureData', teach_profilepicture_type = '$profilepictureType' WHERE teach_id = '$id'";
} else {
    echo 'Inserción inválida';
    exit;
}

$result = mysqli_query($conection, $query);

if ($result) {
    $setTimeOut = 0.5;
    $url = '../views/dashboard.php';
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    <title>Saving changes...</title>
    <style>
        #loadingContainer {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #fff;
        }

        .spinner {
        width: 50px;
        height: 50px;
        border: 3px solid #ccc;
        border-top-color: #333;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-bottom: 10px;
        }

        @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
        }
    </style>
    <meta http-equiv="refresh" content="<?php echo $setTimeOut; ?>;url=<?php echo $url; ?>">
    </head>
    <body>
    <div id="loadingContainer">
        <div class="spinner"></div>
        <p>Saving changes...</p>
    </div>
    </body>
    </html>
    <?php
} else {
    echo "Error al editar el perfil: " . mysqli_error($conection);
}

mysqli_close($conection);

?>
