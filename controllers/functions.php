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
?>