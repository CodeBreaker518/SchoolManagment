<?php
  session_start(); //Inicia una sesion o reanuda una que ya este abierta en los datos del navegador

  if (!isset($_SESSION['user_id'])) { //verifica que el id exista en la base de datos (es decir, que el usuario haya iniciado sesion)
    header("Location: login.php"); // true = redirije al usuario a login.php
    exit;
}
?>

<?php
// Establecer la conexión a la base de datos
$host = 'localhost';
$dbName = 'school_db';
$user = 'root';
$password = '';

try {
  // Se establece la conexion a la Db utilizando la clase 'PDO'
  $dsn = "mysql:host=$host;dbname=$dbName";
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Consulta para obtener los estudiantes
  $studentsQuery = "SELECT * FROM students";
  $studentsStmt = $pdo->query($studentsQuery);
  $students = $studentsStmt->fetchAll(PDO::FETCH_ASSOC);

  // Consulta para obtener los cursos
  $coursesQuery = "SELECT * FROM courses";
  $coursesStmt = $pdo->query($coursesQuery);
  $courses = $coursesStmt->fetchAll(PDO::FETCH_ASSOC);

  // Consulta para obtener los profesores
  $teachersQuery = "SELECT * FROM teachers";
  $teachersStmt = $pdo->query($teachersQuery);
  $teachers = $teachersStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  echo "Error de conexión: " . $e->getMessage();
  die();
}

// Cerrar la conexión a la base de datos
$pdo = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- reset css -->
  <link rel="stylesheet" href="../public/css/reset.css">
  <!-- including materialize css -->
  <link rel="stylesheet" href="../public/css/materialize.min.css">
  <!-- including materialize icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!-- styles.css -->
  <link rel="stylesheet" href="../public/css/dashboard.css">
  <link rel="stylesheet" href="../public/css/styles.css">

  <title>Document</title>
</head>
<body>
  
  <!-- reanude session -->
  
  <main class="main-container">
    <aside class="side-bar">
      <div class="logo-img">
        <img class="logo-ug responsive-img" src="https://intranet3.ugto.mx/ServicioSocial/img/logo_ug.c96b0c58.png" alt="">
      </div>
      <div class="collection">
        <?php if($_SESSION['user_type'] === 'ADMIN'):?>
        <a href="#!" class="collection-item">Main</a>
        <a href="#!" class="collection-item students-link">Students</a>
        <a href="#!" class="collection-item courses-link">Courses</a>
        <a href="#!" class="collection-item professors-link">professors</a>
        <a href="#!" class="collection-item">About us</a>
        <?php elseif($_SESSION['user_type'] === 'professor'):?>
        <a href="#!" class="collection-item">Main</a>
        <a href="#!" class="collection-item courses-link">My Courses</a>
        <a href="#!" class="collection-item">About us</a>
        <?php elseif($_SESSION['user_type'] === 'student'):?>
        <a href="#!" class="collection-item">Main</a>
        <a href="#!" class="collection-item courses-link">My Courses</a>
        <a href="#!" class="collection-item">About us</a>
        <?php endif;?>
      </div>
    </aside>
    <div class="right-content">
      <nav class="navbar" id="navbar">
        <div class="user-information">
          <div class="show-sidebar">
            <i class="material-icons">menu</i>
          </div>
          <div class="user-info-container">
            <p class="user-name"><?php echo $_SESSION['user_name']; ?></p>
              <img class="user-image responsive-img" src="../public/assets/images/13efee56-6b8f-419f-8d68-6ca4b26e4784.jpg" alt="">
            </div>
          </div>
      </nav>

<!-- FALTA MAIN Y ABOUT US EN TODA ESTA SECCION -->
      <section class="dashboard-container">

        <?php if($_SESSION['user_type'] === 'ADMIN'):?>
          <div class="students-content" style="display: none;">
            <ul class="collapsible">
              <?php foreach ($students as $student): ?>
                <li>
                  <div class="collapsible-header"><?php echo $student['stu_name']; ?></div>
                  <div class="collapsible-body">
                    <span>Student ID: <?php echo $student['stu_id']; ?></span><br>
                    <span>Email: <?php echo $student['stu_email']; ?></span><br>
                    <span>Phone: <?php echo $student['stu_phone']; ?></span><br>

                    <!-- Agrega más información del estudiante aquí -->
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="courses-content" style="display: none;">
            <ul class="collapsible">
              <?php foreach ($courses as $course): ?>
                <li>
                  <div class="collapsible-header"><?php echo $course['cour_name']; ?></div>
                  <div class="collapsible-body">
                    <span>Course ID: <?php echo $course['cour_id']; ?></span><br>
                    <span>Description: <?php echo $course['cour_description']; ?></span><br>
                    <!-- Agrega más información del curso aquí -->
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
            <a class="btn-floating btn-large red btn modal-trigger" href="#modal1"><i class="material-icons">add</i></a>
            <!-- Modal Structure -->
            <div id="modal1" class="modal">
              <div class="modal-content">
                <div class="form-container">
                  <div class="form-card">
                    <div class="container">
                      <div class="row">
                        <div class="col s12 m6 offset-m3">
                          <div class="card">
                            <div class="card-content">
                              <span class="card-title">Sign Up</span>
                              <form action="../controllers/courses_controller.php" method="POST">
                                <div class="input-field">
                                  <select id="rol" name="rol" required>
                                    <option value="" disabled selected>Select an option</option>
                                    <option value="student">Student</option>
                                    <option value="professor">Professor</option>
                                  </select>
                                  <label>Are you?...</label>
                                </div>
                                <div class="input-field">
                                    <input type="text" id="name" name="name" required>
                                    <label for="name">Name</label>
                                  </div>
                                <div class="input-field">
                                    <input type="text" id="description" name="description" required>
                                    <label for="description">Description</label>
                                </div>
                                <div class="input-field">
                                  <input type="date" id="date" name="date" required>
                                  <label for="date">Date</label>
                                </div>
                                <div class="input-field">
                                  <input type="hour" id="hour" name="hour" required>
                                    <i class="toggle-hour fa-sharp fa-solid fa-eye"></i>
                                  <label for="hour">Hour</label>
                                </div>
                                <div class="card-action">
                                  <button class="btn waves-effect waves-light" type="submit" name="action">Sign Up
                                    <i class="material-icons right">send</i>
                                  </button>
                                </div>
                              </form>
                              <div class="card-action">
                                <p>Already have an account? <a href="../views/login.php">Log In</a></p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
              </div>
            </div>
          </div>

          <div class="professors-content" style="display: none;">
            <ul class="collapsible">
              <?php foreach ($teachers as $teacher): ?>
                <li>
                  <div class="collapsible-header"><?php echo $teacher['teach_name']; ?></div>
                  <div class="collapsible-body">
                    <span>Professor ID: <?php echo $teacher['teach_id']; ?></span><br>
                    <span>Email: <?php echo $teacher['teach_email']; ?></span><br>
                    <span>Profession: <?php echo $teacher['teach_profession']; ?></span><br>
                    <span>Phone: <?php echo $teacher['teach_phone']; ?></span><br>
                    <!-- Agrega más información del profesor aquí -->
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

        <?php elseif($_SESSION['user_type'] === 'student'):?>

          <div class="courses-content" style="display: none;">
            <ul class="collapsible">
              <?php foreach ($courses as $course): ?>
                <li>
                  <div class="collapsible-header"><?php echo $course['cour_name']; ?></div>
                  <div class="collapsible-body">
                    <span>Course ID: <?php echo $course['cour_id']; ?></span><br>
                    <span>Description: <?php echo $course['cour_description']; ?></span><br>
                    <!-- Agrega más información del curso aquí -->
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

        <?php elseif($_SESSION['user_type'] === 'professor'):?>

          <div class="courses-content" style="display: none;">
            <ul class="collapsible">
              <?php foreach ($courses as $course): ?>
                <li>
                  <div class="collapsible-header"><?php echo $course['cour_name']; ?></div>
                  <div class="collapsible-body">
                    <span>Course ID: <?php echo $course['cour_id']; ?></span><br>
                    <span>Description: <?php echo $course['cour_description']; ?></span><br>
                    <!-- Agrega más información del curso aquí -->
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

        <?php endif?>
          
        

      </section>
    </div>

  </main>

  <!-- app.js -->
  <script src="../public/js/dashboard.js"></script>
  <!-- including materialize js -->
  <script src="../public/js/materialize.min.js"></script>
</body>
</html>