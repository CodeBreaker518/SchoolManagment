<?php
  session_start(); //Inicia una sesion o reanuda una que ya este abierta en los datos del navegador

  if (isset($_SESSION['user_id'])) { //verifica que el id exista en la base de datos (es decir, que el usuario haya iniciado sesion)
    header("Location: dashboard.php"); // true = redirije al usuario a login.php
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- including materialize css -->
  <link rel="stylesheet" href="../public/css/materialize.min.css">
  <!-- including materialize icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!-- Font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- styles.css -->
  <link rel="stylesheet" href="../public/css/styles.css">
  <link rel="stylesheet" href="../public/css/login.css">
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
  <title>Log In</title>
</head>
<body>
  <div class="form-container">
    <div class="form-card">
      <div class="container">
        <div class="row">
          <div class="col s12 m6 offset-m3">
            <div class="card">
              <div class="card-content">
                <span class="card-title">Log In</span>
                <form action="../controllers/login_controller.php" method="POST">
                  <div class="input-field">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label>
                  </div>
                  <div class="input-field">
                    <input type="password" id="password" name="password" required>
                    <i class="toggle-password fa-sharp fa-solid fa-eye"></i>
                    <label for="password">Password</label>
                  </div>
                  <div class="card-action">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Log In
                      <i class="material-icons right">send</i>
                    </button>
                  </div>
                </form>
                <div class="card-action">
                  <p>Doesn't have an account? <a class="sign-up-hyper" href="../views/signup.php">Sign Up</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  


  <!-- app.js -->
  <script src="../public/js/login.js"></script>
  <!-- including materialize js -->
  <script src="../public/js/materialize.min.js"></script>
</body>
</html>

