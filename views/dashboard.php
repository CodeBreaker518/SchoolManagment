<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['loggedin'])) {
    // El usuario ha iniciado sesión, redirigir a la página de inicio
    header("Location: ../views/dashboard.php");
    exit();
} else {
  header("Location: ../views/login.php");
  exit();
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
  <link rel="stylesheet" href="../public/css/styles.css">

  <title>Document</title>
</head>
<body>
  
  <!-- reanude session -->
  <?php
    session_start();
  ?>
  
  <main class="main-container">
    <aside class="side-bar">
      <div class="logo-img">
        <img src="../public/images/13efee56-6b8f-419f-8d68-6ca4b26e4784.jpg" alt="">
      </div>
      <div class="collection">
        <a href="#!" class="collection-item">Main</a>
        <a href="#!" class="collection-item">Teachers</a>
        <a href="#!" class="collection-item">Courses</a>
        <a href="#!" class="collection-item">Students</a>
        <a href="#!" class="collection-item active">About us</a>
      </div>
    </aside>
    <div class="right-content">

      <nav class="navbar" id="navbar">
        <div class="user-information">
        <p class="user-name"><?php echo $_SESSION['user_name']; ?></p>
          <img class="user-image" src="../public/images/13efee56-6b8f-419f-8d68-6ca4b26e4784.jpg" alt="">
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
  <script src="../public/js/app.js"></script>
  <!-- including materialize js -->
  <script src="../public/js/materialize.min.js"></script>
</body>
</html>