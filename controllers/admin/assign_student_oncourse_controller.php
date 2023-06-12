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
    // Verificar si el registro ya existe
    $existingRecordQuery = "SELECT * FROM records WHERE rec_cour_id = '$courId' AND rec_stu_id = '$stuId'";
    $existingRecordResult = mysqli_query($conection, $existingRecordQuery);
    if ($existingRecordResult && mysqli_num_rows($existingRecordResult) > 0) {
        // Registro duplicado, mostrar mensaje de error breve y redirigir al dashboard
        echo "Error: El registro ya existe.";
        header("Refresh: 1; URL=../../views/dashboard.php");
        exit();
    }
    $query = "INSERT INTO records (rec_cour_id, rec_stu_id) VALUES ('$courId','$stuId')";
    $result = mysqli_query($conection, $query);
    
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
                <h1 class="center valing-wrapper">Saving changes...</h1>
            </div>
        <!-- including materialize js -->
        <script src="../public/js/materialize.min.js"></script>
        </body>
    </html>
    <?php
    } else {
        echo "Error al editar el curso: " . mysqli_error($conection);
    }
}

mysqli_close($conection);

?>
