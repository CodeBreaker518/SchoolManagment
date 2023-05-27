<?php
  session_start();

  // Verificar si el usuario ha iniciado sesión
  if (!isset($_SESSION['user_id'])) {
    // El usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header("Location: login.php");
    exit;
}
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
        <a href="#!" class="collection-item">Teachers</a>
        <a href="#!" class="collection-item active">Courses</a>
        <a href="#!" class="collection-item">Students</a>
        <a href="#!" class="collection-item">About us</a>
        <?php elseif($_SESSION['user_type'] === 'professor'):?>
        <a href="#!" class="collection-item">Main</a>
        <a href="#!" class="collection-item active professor_courses">My Courses</a>
        <a href="#!" class="collection-item">About us</a>
        <?php elseif($_SESSION['user_type'] === 'student'):?>
        <a href="#!" class="collection-item">Main</a>
        <a href="#!" class="collection-item active student_courses">My Courses</a>
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

      <section class="dashboard-container">

        <div class="dashboard-content">
          <ul class="collapsible">
            <li>
              <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
              <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
            </li>
            <li>
              <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
              <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
            </li>
            <li>
              <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
              <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
            </li>
          </ul>
        </div>

      </section>
    </div>

  </main>

  <!-- app.js -->
  <script src="../public/js/dashboard.js"></script>
  <!-- including materialize js -->
  <script src="../public/js/materialize.min.js"></script>
</body>
</html>