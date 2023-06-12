<?php
function getProfessorName($teacherId) {
    $host = "localhost";
    $database = "school_db";
    $username = "root";
    $db_password = "";

    $connection = mysqli_connect($host, $username, $db_password, $database);

    if (!$connection) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $query = "SELECT teach_name FROM teachers WHERE teach_id = '$teacherId'";

    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $teacherName = $row['teach_name'];
        mysqli_close($connection);
        return $teacherName;
    } else {
        mysqli_close($connection);
        return "Unknown";
    }
}

function getProfessorCourses($teacherId)
{
    $host = "localhost";
    $database = "school_db";
    $username = "root";
    $db_password = "";

    $connection = mysqli_connect($host, $username, $db_password, $database);

    if (!$connection) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $query = "SELECT cour_name FROM courses WHERE cour_teach_id = '$teacherId'";

    $result = mysqli_query($connection, $query);

    $courses = array(); // Crear un arreglo para almacenar los cursos

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $courName = $row['cour_name'];
            $courses[] = $courName; // Agregar el curso al arreglo
        }
        mysqli_close($connection);
        return $courses;
    } else {
        mysqli_close($connection);
        return "Unknown";
    }
}

function getStudentCourses($studentId)
{
    $host = "localhost";
    $database = "school_db";
    $username = "root";
    $db_password = "";

    $connection = mysqli_connect($host, $username, $db_password, $database);

    if (!$connection) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $query = "SELECT cour_name FROM courses INNER JOIN records ON courses.cour_id = records.rec_cour_id WHERE records.rec_stu_id = '" . $studentId . "'";

    $result = mysqli_query($connection, $query);

    $courses = array(); // Crear un arreglo para almacenar los cursos

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $courName = $row['cour_name'];
            $courses[] = $courName; // Agregar el curso al arreglo
        }
        mysqli_close($connection);
        return $courses;
    } else {
        mysqli_close($connection);
        return "Unknown";
    }
}

function getAssignedTeacherId($courseId) {
    $host = "localhost";
    $database = "school_db";
    $username = "root";
    $db_password = "";

    $connection = mysqli_connect($host, $username, $db_password, $database);

    if (!$connection) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $query = "SELECT cour_teach_id FROM courses WHERE cour_id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $courseId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $assignedTeacherId = $row['cour_teach_id'];
        mysqli_close($connection);
        return $assignedTeacherId;
    } else {
        mysqli_close($connection);
        return null;
    }
}

function getTeacherById($teacherId)
{
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

        // Consulta para obtener los datos del profesor por su ID
        $query = "SELECT * FROM teachers WHERE teach_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$teacherId]);
        $teacher = $stmt->fetch(PDO::FETCH_ASSOC);

        // Cerrar la conexión a la base de datos
        $pdo = null;

        return $teacher;
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        die();
    }
}
function getStudentById($studentId)
{
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

        // Consulta para obtener los datos del estudiante por su ID
        $query = "SELECT * FROM students WHERE stu_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$studentId]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        // Cerrar la conexión a la base de datos
        $pdo = null;

        return $student;
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        die();
    }
}




?>
