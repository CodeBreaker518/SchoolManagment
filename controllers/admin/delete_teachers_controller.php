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

$query = "DELETE FROM teachers WHERE teach_id = '$id'";

$result = mysqli_query($conection, $query);

if ($result) {
    $setTimeOut = 0.5;
    $url = '../../views/dashboard.php';
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <!-- including materialize css -->
        <link rel="stylesheet" href="../../public/css/materialize.min.css">
            <title>Loading...</title>
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
                <h1 class="center valing-wrapper">Deleting teacher..</h1>
            </div>
        <!-- including materialize js -->
        <script src="../../public/js/materialize.min.js"></script>
        </body>
    </html>
    <?php
} else {
    echo "Error al eliminar datos: " . mysqli_error($conection);
}

mysqli_close($conection);

?>