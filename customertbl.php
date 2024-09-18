<?php
header('Content-Type: application/json');

// Database connection
$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "customer table";

$DBconnect = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if (!$DBconnect) {
    die(json_encode(array("error" => "Connection failed: " . mysqli_connect_error())));
}

$sql_table = "SELECT id, fname, femail, fphone, faddress, fpassword FROM customer ORDER BY id";
$result_table = mysqli_query($DBconnect, $sql_table);

if ($result_table) {
    $data = array();
    while ($row = mysqli_fetch_assoc($result_table)) {
        $data[] = array(
            "id" => $row["id"],
            "fname" => $row["fname"],
            "femail" => $row["femail"],
            "fphone" => $row["fphone"],
            "faddress" => $row["faddress"],
            "fpassword" => $row["fpassword"],

        );
    }
    mysqli_free_result($result_table);
    echo json_encode(array("data" => $data));
} else {
    echo json_encode(array("error" => "Error: " . mysqli_error($DBconnect)));
}


mysqli_close($DBconnect);
?>