<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

require_once('../admin/admin_functions.php');

$host = "localhost";
$database = "school_db";
$username = "root";
$db_password = "";

$connection = mysqli_connect($host, $username, $db_password, $database);

if (!$connection) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

$courId = $_POST['id'];

// Verificar si existe el profesor y el curso antes de asignarlos
$validTeacher = false;

$teacherQuery = "SELECT cour_teach_id FROM courses WHERE cour_id = '$courId'";
$teacherResult = mysqli_query($connection, $teacherQuery);
if ($teacherResult && mysqli_num_rows($teacherResult) > 0) {
    $validTeacher = true;
}

if ($validTeacher) {

    $query = "UPDATE courses SET cour_teach_id = NULL WHERE cour_id = '$courId'";
    $result = mysqli_query($connection, $query);

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
                    <h1 class="center valing-wrapper">Deleting teacher from this course...</h1>
                </div>
            <!-- including materialize js -->
            <script src="../../public/js/materialize.min.js"></script>
            </body>
        </html>
        <?php
    } else {
        echo "Error to delete the course: " . mysqli_error($connection);
    }
} else {
    echo "data invalid";
}

mysqli_close($connection);
?>
