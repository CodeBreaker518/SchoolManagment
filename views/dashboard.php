<?php
  session_start(); //Inicia una sesion o reanuda una que ya este abierta en los datos del navegador

  if (!isset($_SESSION['user_id'])) { //verifica que el id exista en la base de datos (es decir, que el usuario haya iniciado sesion)
    header("Location: login.php"); // true = redirije al usuario a login.php
    exit;
  }
  require_once '../controllers/dashboard_controller.php';

  require_once "../controllers/get_profile_picture_controller.php"; // Ruta del controlador PHP

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
<body style="overflow:auto;">
  
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
            <i class="material-icons show-sidebar-btn">menu</i>
          </div>
          <div class="user-info-container">
            <p class="user-name"><?php echo $_SESSION['user_name']; ?></p>
              <img class="user-image" src="data:image/jpeg;base64,<?php echo base64_encode($imageData); ?>" alt="user image" />
          </div>
        </div>
        <div class="user-menu" id="user-menu">
          <ul class="menu">
            <li class="menu-item modal-trigger" data-target="modal2"><a href="#modal2">Change profile picture</a></li>
            <li class="menu-item"><a>Change password</a></li>
            <li class="menu-item"><a href="../controllers/logout_controller.php">Log Out</a></li>
          </ul>
        </div>
        <div id="modal2" class="modal change-photo-container">
          <div class="current-photo">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($imageData); ?>" alt="user image" />
          </div>
          <div class="modal-content change-photo-title">
            <h4>Change Profile Picture</h4>
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
                  <div class="stu-name">
                    <div class="collapsible-header"><?php echo $student['stu_name']; ?>
                    <div class="icons">
                    <form action="../controllers/admin/delete_students_controller.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $student['stu_id']; ?>">

                        <button class="waves-effect waves-light btn red " type="submit" name="action">
                            <i class="material-icons ">delete</i>
                        </button>
                    </form>
                  </div>
                  </div>
                  </div>
                  
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
                  <div class="collapsible-header">
                    <div class="courname">
                      <?php echo $course['cour_name']; ?>
                    </div>
                    <div class="icons">
                      <form action="../controllers/admin/delete_courses_controller.php" method="POST">
                          <input type="hidden" name="id" value="<?php echo $course['cour_id']; ?>">
                          <button class="waves-effect waves-light btn red" type="submit" name="action">
                              <i class="material-icons">delete</i>
                          </button>
                      </form>
                    </div>
                  </div>
                  <div class="collapsible-body">
                    <span>Course ID: <?php echo $course['cour_id']; ?></span><br>
                    <span>Description: <?php echo $course['cour_description']; ?></span><br>
                    <span>Semester: <?php echo $course['cour_semester']; ?></span><br>
                    <span>Days: <?php echo $course['cour_days']; ?></span><br>
                    <span>HourStart: <?php echo $course['cour_hourstart']; ?></span><br>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
            <a class="btn-floating btn-large red btn modal-trigger btn-add-course" href="#modal1"><i class="material-icons">add</i></a>
            <!-- Modal Structure -->
            <div id="modal1" class="modal">
              <div class="card-content card-courses">
                <span class="card-title">Register courses</span>
                <form action="../controllers/admin/create_courses_controller.php" method="POST">
                  <div class="input-field">
                      <input type="text" id="name" name="name" required>
                      <label for="name">Name</label>
                    </div>
                  <div class="input-field">
                      <input type="text" id="description" name="description" required>
                      <label for="description">Description</label>
                  </div>
                  <div class="input-field col s12">
                    <select name="semester">
                      <option value="" disabled selected>Semester...?</option>
                      <option value="January-June">January-June</option>
                      <option value="August-December">August-December</option>
                    </select>
                  </div>
                  <div class="input-field col s12">
                    <select name="days">
                      <option value="" disabled selected>Days...?</option>
                      <option value="Monday-Thursday">Monday-Thursday</option>
                      <option value="Tuesday-Friday">Tuesday-Friday</option>
                      <option value="Wednesday">Wednesday</option>
                      <option value="Saturday">Saturday</option>
                    </select>
                  </div>
                  <div class="input-field col s12">
                    <select name="hourstart">
                      <option value="" disabled selected>Hour...?</option>
                      <option value="08:00 a.m.">08:00 a.m.</option>
                      <option value="10:00 a.m.">10:00 a.m.</option>
                      <option value="12:00 p.m.">12:00 p.m.</option>
                      <option value="02:00 p.m.">02:00 p.m.</option>
                      <option value="04:00 p.m.">04:00 p.m.</option>
                    </select>
                  </div>
                  <div class="card-action">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Register
                      <i class="material-icons right">send</i>
                    </button>
                  </div>
                </form>
                <div class="card-action">
                </div>
              </div>
              <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
              </div>
            </div>
          </div>

          <div class="professors-content content-section" style="display: none;">
            <ul class="collapsible">
              <?php foreach ($teachers as $teacher): ?>
                <li>
                  <div class="teach-name">
                    <div class="collapsible-header"><?php echo $teacher['teach_name']; ?>
                    <div class="icons">
                    <form action="../controllers/admin/delete_teachers_controller.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $teacher['teach_id']; ?>">

                        <button class="waves-effect waves-light btn red" type="submit" name="action">
                            <i class="material-icons">delete</i>
                        </button>
                    </form>
                  </div>
                  </div>
                  </div>
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
            <div class="container about-us-content">
              <div class="row">
                <div class="col xl1 l1 m1 s12">
                </div>


                <div class="col xl5 l5 m5 s12">
                  <div class="card sticky-action">
                    <div class="card-image">
                      <img src="../public/assets/images/diegonft.jpg" alt="diegonft image">
                      <span class="card-title">Diego Perez Perez</span>
                      <a class="material-icons btn red btn-large btn-floating halfway-fab pulse activator">info_outline</a>
                    </div>
    
                    <div class="card-content">
                      <p>
                      </p>
                    </div>
    
                    <div class="card-reveal center">
                      <span class="card-title"><i class="right">X</i></span>
                        <h4>About Me</h4>
                        <h5>Student in the University of Guanajuato, I'm 20, a passionate front-end developer, studying for a degree in systems engineering</h5>
                    </div>
    
                    <div class="card-action">
                      <a href="https://www.github.com/CodeBreaker518" target="_blank">
                        <img src="../public/assets/icons/github.png" alt="">
                        Github</a>
                    </div>

                  </div>
                </div>

                <div class="col xl5 l5 m5 s12">
                  <div class="card sticky-action">
                    <div class="card-image">
                      <img src="../public/assets/images/jairnft.jpg" alt="diegonft image">
                      <span class="card-title">Jair Chavez Islas</span>
                      <a class="material-icons btn red btn-large btn-floating halfway-fab pulse activator">info_outline</a>
                    </div>
    
                    <div class="card-content">
                      <p>
                      </p>
                    </div>
    
                    <div class="card-reveal center">
                      <span class="card-title"><i class="right">X</i></span>
                        <h4>About Me</h4>
                        <h5>I am a student in the University of Guanajuato, I'm 21, I'm studying to be a backend-developer and Ethical hacker</h5>
                    </div>
    
                    <div class="card-action">
                      <a href="https://www.github.com/Jair0305" target="_blank">
                        <img src="../public/assets/icons/github.png" alt="">
                        Github</a>
                    </div>
                  </div>
                </div>


                <div class="col xl1 l1 m1 s12 ">
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
            <div class="container about-us-content">
              <div class="row">
                <div class="col xl1 l1 m1 s12">
                </div>


                <div class="col xl5 l5 m5 s12">
                  <div class="card sticky-action">
                    <div class="card-image">
                      <img src="../public/assets/images/diegonft.jpg" alt="diegonft image">
                      <span class="card-title">Diego Perez Perez</span>
                      <a class="material-icons btn red btn-large btn-floating halfway-fab pulse activator">info_outline</a>
                    </div>
    
                    <div class="card-content">
                      <p>
                      </p>
                    </div>
    
                    <div class="card-reveal center">
                      <span class="card-title"><i class="right">X</i></span>
                        <h4>About Me</h4>
                        <h5>Student in the University of Guanajuato, I'm 20, a passionate front-end developer, studying for a degree in systems engineering</h5>
                    </div>
    
                    <div class="card-action">
                      <a href="https://www.github.com/CodeBreaker518" target="_blank">
                        <img src="../public/assets/icons/github.png" alt="">
                        Github</a>
                    </div>

                  </div>
                </div>

                <div class="col xl5 l5 m5 s12">
                  <div class="card sticky-action">
                    <div class="card-image">
                      <img src="../public/assets/images/jairnft.jpg" alt="diegonft image">
                      <span class="card-title">Jair Chavez Islas</span>
                      <a class="material-icons btn red btn-large btn-floating halfway-fab pulse activator">info_outline</a>
                    </div>
    
                    <div class="card-content">
                      <p>
                      </p>
                    </div>
    
                    <div class="card-reveal center">
                      <span class="card-title"><i class="right">X</i></span>
                        <h4>About Me</h4>
                        <h5>I am a student in the University of Guanajuato, I'm 21, I'm studying to be a backend-developer and Ethical hacker</h5>
                    </div>
    
                    <div class="card-action">
                      <a href="https://www.github.com/Jair0305" target="_blank">
                        <img src="../public/assets/icons/github.png" alt="">
                        Github</a>
                    </div>
                  </div>
                </div>


                <div class="col xl1 l1 m1 s12 ">
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
            <div class="container about-us-content">
              <div class="row">
                <div class="col xl1 l1 m1 s12">
                </div>


                <div class="col xl5 l5 m5 s12">
                  <div class="card sticky-action">
                    <div class="card-image">
                      <img src="../public/assets/images/diegonft.jpg" alt="diegonft image">
                      <span class="card-title">Diego Perez Perez</span>
                      <a class="material-icons btn red btn-large btn-floating halfway-fab pulse activator">info_outline</a>
                    </div>
    
                    <div class="card-content">
                      <p>
                      </p>
                    </div>
    
                    <div class="card-reveal center">
                      <span class="card-title"><i class="right">X</i></span>
                        <h4>About Me</h4>
                        <h5>Student in the University of Guanajuato, I'm 20, a passionate front-end developer, studying for a degree in systems engineering</h5>
                    </div>
    
                    <div class="card-action">
                      <a href="https://www.github.com/CodeBreaker518" target="_blank">
                        <img src="../public/assets/icons/github.png" alt="">
                        Github</a>
                    </div>

                  </div>
                </div>

                <div class="col xl5 l5 m5 s12">
                  <div class="card sticky-action">
                    <div class="card-image">
                      <img src="../public/assets/images/jairnft.jpg" alt="diegonft image">
                      <span class="card-title">Jair Chavez Islas</span>
                      <a class="material-icons btn red btn-large btn-floating halfway-fab pulse activator">info_outline</a>
                    </div>
    
                    <div class="card-content">
                      <p>
                      </p>
                    </div>
    
                    <div class="card-reveal center">
                      <span class="card-title"><i class="right">X</i></span>
                        <h4>About Me</h4>
                        <h5>I am a student in the University of Guanajuato, I'm 21, I'm studying to be a backend-developer and Ethical hacker</h5>
                    </div>
    
                    <div class="card-action">
                      <a href="https://www.github.com/Jair0305" target="_blank">
                        <img src="../public/assets/icons/github.png" alt="">
                        Github</a>
                    </div>
                  </div>
                </div>


                <div class="col xl1 l1 m1 s12 ">
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