
<?php 

function isStudentEnrolled($studentId, $courseId)
{
    $host = "localhost";
    $database = "school_db";
    $username = "root";
    $db_password = "";

    $connection = mysqli_connect($host, $username, $db_password, $database);

    if (!$connection) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $studentId = mysqli_real_escape_string($connection, $studentId);
    $courseId = mysqli_real_escape_string($connection, $courseId);

    $query = "SELECT * FROM records WHERE rec_stu_id = '$studentId' AND rec_cour_id = '$courseId'";

    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        mysqli_close($connection);
        return true;
    } else {
        mysqli_close($connection);
        return false;
    }
}

function isTeacherEnrolled($teacherId, $courseId)
{
    $host = "localhost";
    $database = "school_db";
    $username = "root";
    $db_password = "";

    $connection = mysqli_connect($host, $username, $db_password, $database);

    if (!$connection) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $teacherId = mysqli_real_escape_string($connection, $teacherId);
    $courseId = mysqli_real_escape_string($connection, $courseId);

    $query = "SELECT * FROM courses WHERE cour_teach_id = '$teacherId' AND cour_id = '$courseId'";

    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        mysqli_close($connection);
        return true;
    } else {
        mysqli_close($connection);
        return false;
    }
}

?>