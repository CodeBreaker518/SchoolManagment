<?php
  session_start(); //Inicia una sesion o reanuda una que ya este abierta en los datos del navegador

  if (!isset($_SESSION['user_id'])) { //verifica que el id exista en la base de datos (es decir, que el usuario haya iniciado sesion)
    header("Location: login.php"); // true = redirije al usuario a login.php
    exit;
  }
  require_once '../controllers/dashboard_controller.php';

  require_once "../controllers/get_profile_picture_controller.php"; // Ruta del controlador PHP

  require_once "../controllers/admin/admin_functions.php";
  
  require_once "../controllers/functions.php";
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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css"></link>
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
  <title>Dasboard</title>
</head>
<body style="overflow:auto;">
  
  <!-- reanude session -->
  
  <main class="main-container"> 
    <aside class="side-bar">
      <div class="logo-img">
        <img class="logo-ug responsive-img" src="../public/assets/images/logo_ug.c96b0c58.png" alt="">
      </div>
      <div class="collection">
        <?php if($_SESSION['user_type'] === 'ADMIN'):?>
        <a href="#!" class="collection-item main-link active">
          <i class="fa-solid fa-house"></i>
          Main
        </a>
        <a href="#!" class="collection-item students-link">
          <i class="fa-solid fa-people-group"></i>
          Students
        </a>
        <a href="#!" class="collection-item courses-link">
          <i class="fa-solid fa-book"></i>
          Courses
        </a>
        <a href="#!" class="collection-item professors-link">
          <i class="fa-solid fa-user-graduate"></i>
          professors
        </a>
        <a href="#!" class="collection-item about-us-link">
          <i class="fa-solid fa-circle-info"></i>
          About us
        </a>

        <?php elseif($_SESSION['user_type'] === 'professor'):?>

        <a href="#!" class="collection-item main-link active">
          <i class="fa-solid fa-house"></i>
          Main
        </a>
        <a href="#!" class="collection-item courses-link">
          <i class="fa-solid fa-book"></i>
          My Courses
        </a>
        <a href="#!" class="collection-item about-us-link">
          <i class="fa-solid fa-circle-info"></i>
          About us
        </a>

        <?php elseif($_SESSION['user_type'] === 'student'):?>
        
        <a href="#!" class="collection-item main-link active">
          <i class="fa-solid fa-house"></i>
          Main
        </a>
        <a href="#!" class="collection-item courses-link">
          <i class="fa-solid fa-book"></i>
          My Courses
        </a>
        <a href="#!" class="collection-item about-us-link">
          <i class="fa-solid fa-circle-info"></i>
          About us
        </a>
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
            <li class="menu-item modal-trigger" data-target="modal9"><a href="#modal9">Change password</a></li>
            <li class="menu-item"><a href="../controllers/logout_controller.php">Log Out</a></li>
          </ul>
        </div>
      </nav>

      <section class="dashboard-container">
        <?php if($_SESSION['user_type'] === 'ADMIN'):?>

          <div class="main-content content-section" style="display: block;">
            <!-- Contenido para la opción "Main" -->
            <div class="main-content-section">
              <strong>SCHOOL MANAGMENT</strong>
              <h4>Final proyect for the Web Aplications subject. <br> Develop a website that allows to manage a school system for Students, Teachers & Courses</h4>
              <div class="technologies">
                <h5>Technologies used</h5>
                <strong>For the Front end: (developed by Diego)</strong>
                <ul class="custom-list">
                  <li>-HTML</li>
                  <li>-CSS</li>
                  <li>-JavaScript</li>
                  <li>-Materialize</li>
                </ul>

                <strong>For the Back end: (developed by Jair)</strong>
                <ul class="custom-list">
                  <li>-MYSQL</li>
                  <li>-MyPHPAdmin</li>
                  <li>-PHP</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="students-content content-section" style="display: none;">
            <ul class="collapsible popout">
              <?php foreach ($students as $student): ?>
                <li>
                  <div class="collapsible-header">
                    <div class="stu-name">
                      <?php echo $student['stu_name']; ?>
                    </div>
                      <div class="icons">
                        <button class="waves-effect waves-light btn red modal-trigger delete-students-btn" data-target="modal7" data-id="<?php echo $student['stu_id']; ?>"><i class="material-icons">delete</i>
                        </button>
                      </div>
                  </div>
                  
                  <div class="collapsible-body">
                    <span>Student ID: <?php echo $student['stu_id']; ?></span><br>
                    <span>Email: <?php echo $student['stu_email']; ?></span><br>
                    <span>Phone: <?php echo $student['stu_phone']; ?></span><br>
                    <div class="student-courses">
                      <span class="student-courses-title">Courses studying:</span>
                      <br>
                      <div class="student-courses-container">
                        <?php
                          $studentCoursesName = getStudentCourses($student['stu_id']);
                          if ($studentCoursesName === "Unknown") { 
                            echo 'Not assigned';
                          } else { 
                            echo '<select>';
                            echo '<option disabled selected> Courses </option>';
                            foreach ($studentCoursesName as $course) {
                              echo '<option disabled>' . $course . '</option>';
                            }
                            echo '</select>';
                          } 
                        ?>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="courses-content content-section" style="display: none;">
            <ul class="collapsible popout">
              <?php foreach ($courses as $course): ?>
                <li>
                  <div class="collapsible-header">
                    <div class="courname">
                      <?php echo $course['cour_name']; ?>
                    </div>
                    <div class="icons">
                      <button class="waves-effect waves-light btn green modal-trigger asign-teacher-btn"  data-target="modal3" data-id="<?php echo $course['cour_id']; ?>">+<i class="fa-solid fa-user-graduate"></i>
                      </button>
                      <button class="waves-effect waves-light btn red modal-trigger delete-teacher-course-btn"  data-target="modal10" data-id="<?php echo $course['cour_id']; ?>">X<i class="fa-solid fa-user-graduate"></i>
                      </button>
                      <button class="waves-effect waves-light btn green modal-trigger asign-student-btn"  data-target="modal4" data-id="<?php echo $course['cour_id']; ?>">+<i class="fa-solid fa-people-group"></i>
                      </button>
                      <button class="waves-effect waves-light btn red modal-trigger delete-student-btn"  data-target="modal11" data-id="<?php echo $course['cour_id']; ?>">X<i class="fa-solid fa-people-group"></i>
                      </button>
                      <button class="waves-effect waves-light btn amber accent-4 modal-trigger edit-courses-btn"  data-target="modal5" data-id="<?php echo $course['cour_id']; ?>"><i class="material-icons">edit</i>
                      </button>
                      <button class="waves-effect waves-light btn red modal-trigger delete-courses-btn" data-target="modal6" data-id="<?php echo $course['cour_id']; ?>"><i class="material-icons">delete</i>
                      </button>
                    </div>
                  </div>
                  <div class="collapsible-body">
                    <span>Course ID: <?php echo $course['cour_id']; ?></span><br>
                    <span>Description: <?php echo $course['cour_description']; ?></span><br>
                    <span>Semester: <?php echo $course['cour_semester']; ?></span><br>
                    <span>Days: <?php echo $course['cour_days']; ?></span><br>
                    <span>HourStart: <?php echo $course['cour_hourstart']; ?></span><br>
                    <span>Professor: 
                      <?php 
                        $professorexists = getProfessorName($course['cour_teach_id']);
                        if($professorexists === "Unknown") 
                        { 
                          echo 'not assigned'; 
                        }else 
                        { 
                          echo getProfessorName($course['cour_teach_id']); 
                        } 
                      ?> 
                    </span><br>

                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
            <a class="btn-floating btn-large red btn modal-trigger btn-add-course" href="#modal1"><i class="material-icons">add</i></a>
            <!-- Modal Structure -->
            
          </div>

          <div class="professors-content content-section" style="display: none;">
            <ul class="collapsible popout">
              <?php foreach ($teachers as $teacher): ?>
                <li>
                  <div class="collapsible-header">
                    <div class="teach-name">
                      <?php echo $teacher['teach_name']; ?>
                    </div>
                    <div class="icons">
                        <button class="waves-effect waves-light btn red modal-trigger delete-teachers-btn" data-target="modal8" data-id="<?php echo $teacher['teach_id']; ?>"><i class="material-icons">delete</i>
                      </button>
                    </div>
                  </div>
                  <div class="collapsible-body">
                    <span>Professor ID: <?php echo $teacher['teach_id']; ?></span><br>
                    <span>Email: <?php echo $teacher['teach_email']; ?></span><br>
                    <span>Profession: <?php echo $teacher['teach_profession']; ?></span><br>
                    <span>Phone: <?php echo $teacher['teach_phone']; ?></span><br>
                    <div class="professor-courses">
                      <span class="professor-courses-title">Courses teaching:</span>
                      <br>
                      <div class="professor-courses-container">
                        <?php 
                          $courses = getProfessorCourses($teacher['teach_id']);
                          if ($courses === "Unknown") { 
                            echo 'Not assigned'; 
                          } else { 
                            echo '<select>';
                            echo '<option disabled selected> Courses </option>';
                            foreach ($courses as $course) {
                              echo '<option disabled>' . $course . '</option>';
                            }
                            echo '</select>';
                          } 
                        ?> 
                      </div>
                    </div>
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
            <div class="main-content-section">
              <strong>SCHOOL MANAGMENT</strong>
              <h4>Final proyect for the Web Aplications subject. <br> Develop a website that allows to manage a school system for Students, Teachers & Courses</h4>
              <div class="technologies">
                <h5>Technologies used</h5>
                <strong>For the Front end: (developed by Diego)</strong>
                <ul class="custom-list">
                  <li>-HTML</li>
                  <li>-CSS</li>
                  <li>-JavaScript</li>
                  <li>-Materialize</li>
                </ul>

                <strong>For the Back end: (developed by Jair)</strong>
                <ul class="custom-list">
                  <li>-MYSQL</li>
                  <li>-MyPHPAdmin</li>
                  <li>-PHP</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="courses-content content-section" style="display: none;">
            <ul class="collapsible popout">
              <?php foreach ($courses as $course): ?>
                <?php $studentId = $_SESSION['user_id']; if (isStudentEnrolled($studentId, $course['cour_id'])): ?> 
                  <li>
                    <div class="collapsible-header"><?php echo $course['cour_name']; ?></div>
                    <div class="collapsible-body">
                      <span>Description: <?php echo $course['cour_description']; ?></span><br>
                      <span>Semester: <?php echo $course['cour_semester']; ?></span><br>
                      <span>Days: <?php echo $course['cour_days']; ?></span><br>
                      <span>Hour: <?php echo $course['cour_hourstart']; ?></span><br>
                    </div>
                  </li>
                <?php endif; ?>
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
            <div class="main-content-section">
              <strong>SCHOOL MANAGMENT</strong>
              <h4>Final proyect for the Web Aplications subject. <br> Develop a website that allows to manage a school system for Students, Teachers & Courses</h4>
              <div class="technologies">
                <h5>Technologies used</h5>
                <strong>For the Front end: (developed by Diego)</strong>
                <ul class="custom-list">
                  <li>-HTML</li>
                  <li>-CSS</li>
                  <li>-JavaScript</li>
                  <li>-Materialize</li>
                </ul>

                <strong>For the Back end: (developed by Jair)</strong>
                <ul class="custom-list">
                  <li>-MYSQL</li>
                  <li>-MyPHPAdmin</li>
                  <li>-PHP</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="courses-content content-section" style="display: none;">
            <ul class="collapsible popout">
              <?php foreach ($courses as $course): ?>
                <?php $teacherId = $_SESSION['user_id']; if (isteacherEnrolled($teacherId, $course['cour_id'])): ?>
                  <li>
                    <div class="collapsible-header"><?php echo $course['cour_name']; ?></div>
                    <div class="collapsible-body">
                      <span>Description: <?php echo $course['cour_description']; ?></span><br>
                      <span>Semester: <?php echo $course['cour_semester']; ?></span><br>
                      <span>Days: <?php echo $course['cour_days']; ?></span><br>
                      <span>Hour: <?php echo $course['cour_hourstart']; ?></span><br>
                    </div>
                  </li>
                <?php endif; ?>
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

<!-------------------------------------------------------------- MODALS  ---------------------------------------------------------------------->
  <div id="modal1" class="modal modal-create-courses">
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
          <select name="semester" requires>
            <option value="" disabled selected>Semester...?</option>
            <option value="January-June">January-June</option>
            <option value="August-December">August-December</option>
          </select>
        </div>
        <div class="input-field col s12">
          <select name="days" required>
            <option value="" disabled selected>Days...?</option>
            <option value="Monday-Thursday">Monday-Thursday</option>
            <option value="Tuesday-Friday">Tuesday-Friday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Saturday">Saturday</option>
          </select>
        </div>
        <div class="input-field col s12">
          <select name="hourstart" required>
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
  
  <div id="modal3" class="modal assign-teacher">
    <div class="card-content card-courses">
      <span class="card-title">Choose a teacher for this course</span>
      <form id="assignTeacherForm" action="../controllers/admin/assign_teacher_oncourse_controller.php" method="POST">
        <input type="hidden" name="id" id="assignTeacherCourseIdInput" value="">
        <div class="input-field col s12">
          <select name="teacher" required>
            <option value="" disabled selected>Teachers</option>
            <?php foreach ($teachers as $teacher):
              $teacherId = $teacher['teach_id'];
              $isAssigned = false;
              foreach ($modalCoursesStmt as $courseModal):
                $courseId = $courseModal['cour_id'];
                $assignedTeacherId = getAssignedTeacherId($courseId);
                if ($assignedTeacherId !== null && $assignedTeacherId == $teacherId) {
                  $isAssigned = true;
                  break;
                }
              endforeach;
              if ($isAssigned):
            ?>
              <option value="<?php echo $teacherId; ?>" disabled>
                <?php echo $teacher['teach_name']; ?> (assigned)
              </option>
            <?php else: ?>
              <option value="<?php echo $teacherId; ?>"><?php echo $teacher['teach_name']; ?></option>
            <?php endif;
            endforeach; ?>
          </select>
        </div>
        <div class="card-action">
          <button class="btn waves-effect waves-light" type="submit" name="action">Register
            <i class="material-icons right">send</i>
          </button>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>


  <div id="modal4" class="modal assign-student">
    <div class="card-content card-courses">
      <span class="card-title">Choose a student for this course</span>
      <form action="../controllers/admin/assign_student_oncourse_controller.php" method="POST">
        <input type="hidden" name="id" id="assignStudentCourseIdInput" value="">
        <div class="input-field col s12">
          <select name="student" required>
            <option value="" disabled selected>Students</option>
          <?php foreach ($students as $student): ?>          
            <option value="<?php echo $student['stu_id']; ?>"><?php echo $student['stu_name']; ?></option>
          <?php endforeach; ?>
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

  <div id="modal5" class="modal modal-edit-courses">
    <div class="card-content card-courses">
      <span class="card-title">Change the course</span>
      <form action="../controllers/admin/edit_courses_controller.php" method="POST">
      <input type="hidden" name="id" id="editCourseIdInput" value="">
        <div class="input-field">
            <input type="text" id="name" name="name" required>
            <label for="name">Name</label>
          </div>
        <div class="input-field">
            <input type="text" id="description" name="description" required>
            <label for="description">Description</label>
        </div>
        <div class="input-field col s12">
          <select name="semester" requires>
            <option value="" disabled selected>Semester...?</option>
            <option value="January-June">January-June</option>
            <option value="August-December">August-December</option>
          </select>
        </div>
        <div class="input-field col s12">
          <select name="days" required>
            <option value="" disabled selected>Days...?</option>
            <option value="Monday-Thursday">Monday-Thursday</option>
            <option value="Tuesday-Friday">Tuesday-Friday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Saturday">Saturday</option>
          </select>
        </div>
        <div class="input-field col s12">
          <select name="hourstart" required>
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

  <div id="modal6" class="modal detele-course">
    <div class="card-content card-courses">
      <span class="card-title">Are you sure?</span>
      <form action="../controllers/admin/delete_courses_controller.php" method="POST">
        <input type="hidden" name="id" id="deleteCourseIdInput" value="">
        <div class="input-field col s12 yes-no-btns">
          <button class="btn waves-effect waves-light green" type="submit" name="action">YES
          </button>
          <a href="#!" class="no-btn btn waves-effect waves-light modal-close red">NO</a>
        </div>
        <div class="card-action">
        </div>
      </form>
      <div class="card-action">
      </div>
    </div>
    <div class="modal-footer">
    </div>
  </div>
  
  <div id="modal7" class="modal detele-student">
    <div class="card-content card-courses">
      <span class="card-title">Are you sure?</span>
      <form action="../controllers/admin/delete_students_controller.php" method="POST">
        <input type="hidden" name="id" id="deleteStudentIdInput" value="">
        <div class="input-field col s12 yes-no-btns">
          <button class="btn waves-effect waves-light green" type="submit" name="action">YES
          </button>
          <a href="#!" class="no-btn btn waves-effect waves-light modal-close red">NO</a>
        </div>
        <div class="card-action">
        </div>
      </form>
      <div class="card-action">
      </div>
    </div>
    <div class="modal-footer">
    </div>
  </div>
  
  <div id="modal8" class="modal detele-teacher">
    <div class="card-content card-courses">
      <span class="card-title">Are you sure?</span>
      <form action="../controllers/admin/delete_teachers_controller.php" method="POST">
        <input type="hidden" name="id" id="deleteTeacherIdInput" value="">
        <div class="input-field col s12 yes-no-btns">
          <button class="btn waves-effect waves-light green" type="submit" name="action">YES
          </button>
          <a href="#!" class="no-btn btn waves-effect waves-light modal-close red">NO</a>
        </div>
        <div class="card-action">
        </div>
      </form>
      <div class="card-action">
      </div>
    </div>
    <div class="modal-footer">
    </div>
  </div>

  <div id="modal9" class="modal change-password">
    <div class="modal-content change-password-title">
      <h5>Change password</h4>
    </div>
    <div class="change-password-section">
      <p>Enter a new Password</p>
        <form class="change-password-form col s12" action="../controllers/edit_password_controller.php" method="POST">
            <div class="input-field col s12">
              <input type="password" id="password" name="newpassword" required>
              <i class="toggle-password fa-sharp fa-solid fa-eye"></i>
              <label for="password">New password</label>
            </div>
            <div class="change-password-container">
              <button class="btn waves-effect waves-light change-password-btn" type="submit" name="action">Agree
                <i class="material-icons right">send</i>
              </button>
            </div>
        
        </form>
    </div>
  </div>

  <div id="modal10" class="modal detele-teacher">
    <div class="card-content card-courses">
      <span class="card-title">Are you sure to delete teacher from this course?</span>
      <form action="../controllers/admin/delete_teacher_from_course.php" method="POST">
        <input type="hidden" name="id" id="deleteTeacherCourseIdInput" value="">
        <div class="input-field col s12 yes-no-btns">
          <button class="btn waves-effect waves-light green" type="submit" name="action">YES
          </button>
          <a href="#!" class="no-btn btn waves-effect waves-light modal-close red">NO</a>
        </div>
        <div class="card-action">
        </div>
      </form>
      <div class="card-action">
      </div>
    </div>
    <div class="modal-footer">
    </div>
  </div>

  <div id="modal11" class="modal delete_student_from_course">
  <div class="card-content card-courses">
    <span class="card-title">Choose a student to delete from the course</span>
    <form id="deleteStudentForm" action="../controllers/admin/delete_students_from_courses_controller.php" method="POST">
      <input type="hidden" name="id" id="deleteStudentCourseInput" value="">
      <div class="input-field col s12">
        <select name="student" required>
            <option value="" disabled selected>Students</option>
          <?php foreach ($students as $student): ?>          
            <option value="<?php echo $student['stu_id']; ?>"><?php echo $student['stu_name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="card-action">
        <button class="btn waves-effect waves-light" type="submit" name="action">Delete
          <i class="material-icons right">send</i>
        </button>
      </div>
    </form>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
  </div>
</div>

  <!-- app.js -->
  <script src="../public/js/dashboard.js"></script>
  <!-- including materialize js -->
  <script src="../public/js/materialize.min.js"></script>
</body>
</html>