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

$name = $_POST['name'];
$description = $_POST['description'];
$semester = $_POST['semester'];
$days = $_POST['days'];
$hourstart = $_POST['hourstart'];

if (empty($name) || empty($description) || empty($semester) || empty($days) || empty($hourstart)) {
    echo "Por favor, completa todos los campos obligatorios.";
    exit;
}

$query = "INSERT INTO courses (cour_name, cour_description, cour_semester, cour_days, cour_hourstart) VALUES ('$name','$description','$semester','$days','$hourstart')";

$result = mysqli_query($conection,$query);

if ($result) {
    $setTimeOut = 0.5;
    $url = '../../views/dashboard.php';
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <!-- including materialize css -->
        <link rel="stylesheet" href="../public/css/materialize.min.css">
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
                <h1 class="center valing-wrapper">Creating course...</h1>
            </div>
        <!-- including materialize js -->
        <script src="../public/js/materialize.min.js"></script>
        </body>
    </html>
    <?php
} else {
echo "Error al insertar datos: " . mysqli_error($conection);
}

mysqli_close($conection);

?>