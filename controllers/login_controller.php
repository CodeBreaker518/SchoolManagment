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

        $setTimeOut = 0.5;
        $url = '../views/dashboard.php';
        ?>
        <!DOCTYPE html>
        <html>
        <head>
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
            <p>Loading...</p>
        </div>
        </body>
        </html>
        <?php
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

        $setTimeOut = 0.5;
        $url = '../views/dashboard.php';
        ?>
        <!DOCTYPE html>
        <html>
        <head>
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
            <p>Loading...</p>
        </div>
        </body>
        </html>
        <?php
        exit;
    }
}

$query = "SELECT * FROM admins WHERE adm_email = '$email' LIMIT 1";
$result = mysqli_query($conection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    if ($row['adm_password'] == $password) {
        $_SESSION['user_id'] = $row['adm_id'];
        $_SESSION['user_name'] = $row['adm_name'];
        $_SESSION['user_type'] = 'ADMIN';

        mysqli_free_result($result);
        mysqli_close($conection);

        $setTimeOut = 0.5;
        $url = '../views/dashboard.php';
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
                    <h1 class="center valing-wrapper">Logging In...</h1>
                </div>
            <!-- including materialize js -->
            <script src="../public/js/materialize.min.js"></script>
            </body>
        </html>
        <?php
        exit;
    }
}

mysqli_free_result($result);
mysqli_close($conection);

echo "Email or password incorrect";
header("Refresh: 1; URL=../views/login.php");
exit();
?>
