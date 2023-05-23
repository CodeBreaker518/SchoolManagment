<!-- signup.php -->
<html>
<head>
   <!-- including materialize css -->
  <link rel="stylesheet" href="../public/css/materialize.min.css">
  <!-- including materialize icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!-- styles.css -->
  <link rel="stylesheet" href="../public/css/styles.css">
  <!-- international telephone input plugin CSS -->
  <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
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
            <form action="signup_controller.php" method="POST">
              <div class="input-field">
                <select id="rol" name="rol" required>
                  <option value="" disabled selected>Select an option</option>
                  <option value="student">Student</option>
                  <option value="professor">Professor</option>
                </select>
                <label>Role</label>
              </div>
              <!-- Fields for "Student" option -->
              <div id="student-fields" style="display: none;">
                <div class="input-field">
                  <input type="text" id="name" name="name" required>
                  <label for="name">Name</label>
                </div>
                <div class="input-field">
                  <input type="tel" id="phone" name="phone" required>
                </div>
              </div>
              <!-- Fields for "Professor" option -->
              <div id="professor-fields" style="display: none;">
                <div class="input-field">
                  <input type="text" id="name" name="name" required>
                  <label for="name">Name</label>
                </div>
                <div class="input-field">
                  <input type="text" id="profession" name="profession" required>
                  <label for="profession">Profession</label>
                </div>
                <div class="input-field">
                  <input type="tel" id="phone" name="phone" required>
                </div>
              </div>
              <!-- Common fields for both options -->
              <div class="input-field">
                <input type="email" id="email" name="email" required>
                <label for="email">Email</label>
              </div>
              <div class="input-field">
                <input type="password" id="password" name="password" required>
                <label for="password">Password</label>
              </div>
              <button class="btn waves-effect waves-light" type="submit" name="action">Sign Up</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    </div>
  </div>

  <!-- international telephone input plugin JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <!-- app.js -->
  <script src="../public/js/app.js"></script>
  <!-- including materialize js -->
  <script src="../public/js/materialize.min.js"></script>
</body>
</html>
