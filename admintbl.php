<?php
header('Content-Type: application/json');


$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "customer table"; 

$DBconnect = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if (!$DBconnect) {
    die(json_encode(array("error" => "Connection failed: " . mysqli_connect_error())));
}

$sql_table = "SELECT id, admin_name, admin_email, Phone, Details FROM admin_db"; // Adjust if necessary
$result_table = mysqli_query($DBconnect, $sql_table);


if ($result_table) {
    $data = array();
    while ($row = mysqli_fetch_assoc($result_table)) {
        $data[] = array(
            "id" => $row["id"],
            "admin_name" => $row["admin_name"],
            "admin_email" => $row["admin_email"],
            "Phone" => $row["Phone"],
            "Details" => $row["Details"],
        );
    }
    mysqli_free_result($result_table);
    echo json_encode(array("data" => $data));
} else {
    $error = mysqli_error($DBconnect);
    echo json_encode(array("error" => "Error: " . $error));
}

mysqli_close($DBconnect);
?>