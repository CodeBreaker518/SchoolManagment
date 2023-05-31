<!-- signup.php -->
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
   <!-- including materialize css -->
  <link rel="stylesheet" href="../public/css/materialize.min.css">
  <!-- including materialize icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!-- styles.css -->
  <link rel="stylesheet" href="../public/css/styles.css">
  <link rel="stylesheet" href="../public/css/signup.css">
  <!-- Font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>Sign Up</title>
</head>
<body>
  <div class="form-container">
    <div class="form-card">
      <div class="container">
        <div class="row">
          <div class="col s12 m6 offset-m3">
            <div class="card">
              <div class="card-content">
                <span class="card-title">Sign Up</span>
                <form action="../controllers/signup_controller.php" method="POST">
                  <div class="input-field">
                    <select id="rol" name="rol" required>
                      <option value="" disabled selected>Select an option</option>
                      <option value="student">Student</option>
                      <option value="professor">Professor</option>
                    </select>
                    <label>Are you?...</label>
                  </div>
                  <!-- Common fields for both student & professor -->
                  <div class="input-field">
                      <input type="text" id="name" name="name" required>
                      <label for="name">Name</label>
                    </div>
                  <div class="input-field">
                      <input type="tel" id="phone" name="phone" required>
                      <label for="phone">Phone</label>
                  </div>
                  <!-- Extra Field for "Professor" option -->
                  <div id="professor-fields" style="display: none;">
                    <div class="input-field">
                      <input type="text" id="profession" name="profession" required>
                      <label for="profession">Profession</label>
                    </div>
                  </div>
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
  <!-- app.js -->
  <script src="../public/js/signup.js"></script>
  <!-- including materialize js -->
  <script src="../public/js/materialize.min.js"></script>
</body>
</html>
