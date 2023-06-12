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

  $modalCoursesQuery = "SELECT * FROM courses";
  $modalCoursesStmt = $pdo->query($modalCoursesQuery);
  $modalCourses = $modalCoursesStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  echo "Error de conexión: " . $e->getMessage();
  die();
}

// Cerrar la conexión a la base de datos
$pdo = null;
?>