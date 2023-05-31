<?php

$host = "localhost";
$database = "school_db";
$username = "root";
$db_password = "";

$conection = mysqli_connect($host, $username, $db_password, $database);

// Verificar la conexión
if (!$conection) {
  die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Obtener los valores del formulario
$name = $_POST['name'];
$phone = $_POST['phone'];
$profession = $_POST['profession'];
$email = $_POST['email'];
$password = $_POST['password'];
$rol = $_POST['rol'];

// Ruta de la imagen por defecto
$defaultProfilePicture = "../public/assets/images/13efee56-6b8f-419f-8d68-6ca4b26e4784.jpg";

// Leer el contenido de la imagen
$profilePictureData = file_get_contents($defaultProfilePicture);
$profilePictureData = mysqli_real_escape_string($conection, $profilePictureData);

if($rol == 'student')
{
    $query = "INSERT INTO students (stu_name, stu_phone, stu_email, stu_password, stu_profilepicture) VALUES ('$name', '$phone', '$email', '$password', '$profilePictureData')";
}elseif($rol == 'professor')
{
    $query = "INSERT INTO teachers (teach_name, teach_phone, teach_email, teach_password, teach_profession, teach_profilepicture) VALUES ('$name', '$phone', '$email', '$password', '$profession', '$profilePictureData')";
}else
{
    echo 'Inserción inválida';
    exit;
}

// Ejecutar la consulta
$result = mysqli_query($conection, $query);

// Verificar si la inserción fue exitosa
if ($result) {
  $setTimeOut = 0.5;
  $url = '../views/login.php';
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
} else {
  echo "Error al insertar datos: " . mysqli_error($conection);
}

// Cerrar la conexión a la base de datos
mysqli_close($conection);
?>
