<?php
// Archivo logout.php

// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión u otra página de tu elección
$setTimeOut = 0.5;
$url = '../views/login.php';
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
            <h1 class="center valing-wrapper">Logging Out...</h1>
        </div>
     <!-- including materialize js -->
    <script src="../public/js/materialize.min.js"></script>
    </body>
</html>
<?php
exit;
?>

