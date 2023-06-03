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




?>