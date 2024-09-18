<?php
header('Content-Type: application/json');

// Database connection
$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "database_db";

$DBconnect = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if (!$DBconnect) {
    die(json_encode(array("error" => "Connection failed: " . mysqli_connect_error())));
}

$sql_table = "SELECT id, employee_name, employee_salary, employee_age FROM employee ORDER BY id";
$result_table = mysqli_query($DBconnect, $sql_table);

if ($result_table) {
    $data = array();
    while ($row = mysqli_fetch_assoc($result_table)) {
        $data[] = array(
            "id" => $row["id"],
            "employee_name" => $row["employee_name"],
            "employee_salary" => $row["employee_salary"],
            "employee_age" => $row["employee_age"]
        );
    }
    mysqli_free_result($result_table);
    echo json_encode(array("data" => $data));
} else {
    echo json_encode(array("error" => "Error: " . mysqli_error($DBconnect)));
}

// Close the database connection
mysqli_close($DBconnect);
?>