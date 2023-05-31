<?php
  session_start(); //Inicia una sesion o reanuda una que ya este abierta en los datos del navegador

  if (!isset($_SESSION['user_id'])) { //verifica que el id exista en la base de datos (es decir, que el usuario haya iniciado sesion)
    header("Location: login.php"); // true = redirije al usuario a login.php
    exit;
  }
  require_once '../controllers/dashboard_controller.php';

  require_once"../controllers/get_profile_picture_controller.php"; // Ruta del controlador PHP

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

  <title>Dasboard</title>
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
        <a href="#!" class="collection-item main-link active">Main</a>
        <a href="#!" class="collection-item students-link">Students</a>
        <a href="#!" class="collection-item courses-link">Courses</a>
        <a href="#!" class="collection-item professors-link">professors</a>
        <a href="#!" class="collection-item about-us-link">About us</a>
        <?php elseif($_SESSION['user_type'] === 'professor'):?>
        <a href="#!" class="collection-item main-link active">Main</a>
        <a href="#!" class="collection-item courses-link">My Courses</a>
        <a href="#!" class="collection-item about-us-link">About us</a>
        <?php elseif($_SESSION['user_type'] === 'student'):?>
        <a href="#!" class="collection-item main-link active">Main</a>
        <a href="#!" class="collection-item courses-link">My Courses</a>
        <a href="#!" class="collection-item about-us-link">About us</a>
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
              <img class="user-image" src="data:image/jpeg;base64,<?php echo base64_encode($imageData); ?>" alt="user image" />
          </div>
        </div>
        <div class="user-menu" id="user-menu">
          <ul class="menu">
            <li class="menu-item modal-trigger" data-target="modal2"><a href="#modal2">Change image</a></li>
            <li class="menu-item"><a>Change password</a></li>
            <li class="menu-item"><a href="../controllers/logout_controller.php">Log Out</a></li>
          </ul>
        </div>
        <div id="modal2" class="modal change-photo-container">
          <div class="current-photo">
           <img src="data:image/jpeg;base64,<?php echo base64_encode($imageData); ?>" alt="user image" />
          </div>
          <div class="modal-content change-photo-title">
            <h4>Change Photo</h4>
          </div>
          <div class="change-photo-section">
            <p>Please upload a photo</p>
            <form class="update-photo-form" action="../controllers/edit_profile_picture_controller.php" enctype="multipart/form-data" method="POST">
              <div class="file-field input-field">
                <div class="btn btn-add-file">
                  <span>File</span>
                  <input type="file" class="upload-image-input" name="profile_picture">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text">
                </div>
              </div>
              <button class="btn waves-effect waves-light upload-image-btn" type="submit" name="action">Agree
                <i class="material-icons right">send</i>
              </button>
            </form>
          </div>
        </div>
      </nav>

<!-- FALTA MAIN Y ABOUT US EN TODA ESTA SECCION -->
      <section class="dashboard-container">

        <?php if($_SESSION['user_type'] === 'ADMIN'):?>

          <div class="main-content content-section" style="display: block;">
            <!-- Contenido para la opción "Main" -->
            <h1>Main Content</h1>
            <p>Este es el contenido para la opción "Main".</p>
          </div>

          <div class="students-content content-section" style="display: none;">
            <ul class="collapsible">
              <?php foreach ($students as $student): ?>
                <li>
                  <div class="collapsible-header"><?php echo $student['stu_name']; ?></div>
                  <div class="collapsible-body">
                    <span>Student ID: <?php echo $student['stu_id']; ?></span><br>
                    <span>Email: <?php echo $student['stu_email']; ?></span><br>
                    <span>Phone: <?php echo $student['stu_phone']; ?></span><br>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="courses-content content-section" style="display: none;">
            <ul class="collapsible">
              <?php foreach ($courses as $course): ?>
                <li>
                  <div class="collapsible-header"><?php echo $course['cour_name']; ?></div>
                  <div class="collapsible-body">
                    <span>Course ID: <?php echo $course['cour_id']; ?></span><br>
                    <span>Description: <?php echo $course['cour_description']; ?></span><br>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
            <a class="btn-floating btn-large red btn modal-trigger btn-add-course" href="#modal1"><i class="material-icons">add</i></a>
            <!-- Modal Structure -->
            <div id="modal1" class="modal">
              <div class="card-content">
                <span class="card-title">Sign Up</span>
                <form action="../controllers/admin/create_courses_controller.php" method="POST">
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
                    <input type="time" id="hour" name="hour" required>
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
              <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
              </div>
            </div>
          </div>

          <div class="professors-content content-section" style="display: none;">
            <ul class="collapsible">
              <?php foreach ($teachers as $teacher): ?>
                <li>
                  <div class="collapsible-header"><?php echo $teacher['teach_name']; ?></div>
                  <div class="collapsible-body">
                    <span>Professor ID: <?php echo $teacher['teach_id']; ?></span><br>
                    <span>Email: <?php echo $teacher['teach_email']; ?></span><br>
                    <span>Profession: <?php echo $teacher['teach_profession']; ?></span><br>
                    <span>Phone: <?php echo $teacher['teach_phone']; ?></span><br>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="about-us-content content-section" style="display: none;">
            <!-- Contenido para la opción "About Us" -->
            <div class="description">
              <h1>About Us...</h1>
            </div>
            <div class="aboutus-content">
              <div class="row">
                <div class="col s12 m7">
                  <div class="card diego-card">
                    <div class="card-image">
                      <img src="../public/assets/images/diegonft.jpg">
                      <span class="card-title">Diego Perez Perez</span>
                    </div>
                    <div class="card-content">
                      <p>
                        Student of the University of Guanajuato, I'm 20, a passionate front-end developer studying for a degree in systems engineering
                      </p>
                    </div>
                    <div class="card-action">
                      <a href="https://github.com/CodeBreaker518" target="_blank">
                        <img src="../public/assets/icons/github.png" alt="github png">
                      </a>
                      <a href="https://github.com/CodeBreaker518" target="_blank">
                        <p>CodeBreaker518</p>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="col s12 m7 ">
                  <div class="card jair-card">
                    <div class="card-image">
                      <img src="../public/assets/images/jairnft.jpg">
                      <span class="card-title">Jair Chavez Islas</span>
                    </div>
                    <div class="card-content">
                      <p>I am a student in the University of Guanajuato, I'm 21, I'm studying to be a backend-developer and Ethical hacker</p>
                    </div>
                    <div class="card-action">
                      <a href="https://github.com/Jair0305" target="_blank">
                        <img src="../public/assets/icons/github.png" alt="github png">
                      </a>
                      <a href="https://github.com/Jair0305" target="_blank">
                        <p>Jair0305</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <?php elseif($_SESSION['user_type'] === 'student'):?>

          <div class="main-content content-section" style="display: block;">
            <!-- Contenido para la opción "Main" -->
            <h1>Main Content</h1>
            <p>Este es el contenido para la opción "Main".</p>
          </div>

          <div class="courses-content content-section" style="display: none;">
            <ul class="collapsible">
              <?php foreach ($courses as $course): ?>
                <li>
                  <div class="collapsible-header"><?php echo $course['cour_name']; ?></div>
                  <div class="collapsible-body">
                    <span>Course ID: <?php echo $course['cour_id']; ?></span><br>
                    <span>Description: <?php echo $course['cour_description']; ?></span><br>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="about-us-content content-section" style="display: none;">
            <!-- Contenido para la opción "About Us" -->
            <div class="description">
              <h1>About Us...</h1>
            </div>
            <div class="aboutus-content">
              <div class="row">
                <div class="col s12 m7">
                  <div class="card diego-card">
                    <div class="card-image">
                      <img src="../public/assets/images/diegonft.jpg">
                      <span class="card-title">Diego Perez Perez</span>
                    </div>
                    <div class="card-content">
                      <p>
                        Student of the University of Guanajuato, I'm 20, a passionate front-end developer studying for a degree in systems engineering
                      </p>
                    </div>
                    <div class="card-action">
                      <a href="https://github.com/CodeBreaker518" target="_blank">
                        <img src="../public/assets/icons/github.png" alt="github png">
                      </a>
                      <a href="https://github.com/CodeBreaker518" target="_blank">
                        <p>CodeBreaker518</p>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="col s12 m7 ">
                  <div class="card jair-card">
                    <div class="card-image">
                      <img src="../public/assets/images/jairnft.jpg">
                      <span class="card-title">Jair Chavez Islas</span>
                    </div>
                    <div class="card-content">
                      <p>I am a student in the University of Guanajuato, I'm 21, I'm studying to be a backend-developer and Ethical hacker</p>
                    </div>
                    <div class="card-action">
                      <a href="https://github.com/Jair0305" target="_blank">
                        <img src="../public/assets/icons/github.png" alt="github png">
                      </a>
                      <a href="https://github.com/Jair0305" target="_blank">
                        <p>Jair0305</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        <?php elseif($_SESSION['user_type'] === 'professor'):?>

          <div class="main-content content-section" style="display: block;">
            <!-- Contenido para la opción "Main" -->
            <h1>Main Content</h1>
            <p>Este es el contenido para la opción "Main".</p>
          </div>

          <div class="courses-content content-section" style="display: none;">
            <ul class="collapsible">
              <?php foreach ($courses as $course): ?>
                <li>
                  <div class="collapsible-header"><?php echo $course['cour_name']; ?></div>
                  <div class="collapsible-body">
                    <span>Course ID: <?php echo $course['cour_id']; ?></span><br>
                    <span>Description: <?php echo $course['cour_description']; ?></span><br>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="about-us-content content-section" style="display: none;">
            <!-- Contenido para la opción "About Us" -->
            <div class="description">
              <h1>About Us...</h1>
            </div>
            <div class="aboutus-content">
              <div class="row">
                <div class="col s12 m7">
                  <div class="card diego-card">
                    <div class="card-image">
                      <img src="../public/assets/images/diegonft.jpg">
                      <span class="card-title">Diego Perez Perez</span>
                    </div>
                    <div class="card-content">
                      <p>
                        Student of the University of Guanajuato, I'm 20, a passionate front-end developer studying for a degree in systems engineering
                      </p>
                    </div>
                    <div class="card-action">
                      <a href="https://github.com/CodeBreaker518" target="_blank">
                        <img src="../public/assets/icons/github.png" alt="github png">
                      </a>
                      <a href="https://github.com/CodeBreaker518" target="_blank">
                        <p>CodeBreaker518</p>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="col s12 m7 ">
                  <div class="card jair-card">
                    <div class="card-image">
                      <img src="../public/assets/images/jairnft.jpg">
                      <span class="card-title">Jair Chavez Islas</span>
                    </div>
                    <div class="card-content">
                      <p>I am a student in the University of Guanajuato, I'm 21, I'm studying to be a backend-developer and Ethical hacker</p>
                    </div>
                    <div class="card-action">
                      <a href="https://github.com/Jair0305" target="_blank">
                        <img src="../public/assets/icons/github.png" alt="github png">
                      </a>
                      <a href="https://github.com/Jair0305" target="_blank">
                        <p>Jair0305</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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