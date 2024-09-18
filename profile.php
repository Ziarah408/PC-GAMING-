<?php
session_start();
header('Content-Type: application/json');

$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "customer table";

$DBconnect = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if (!$DBconnect) {
    die(json_encode(array("error" => "Connection failed: " . mysqli_connect_error())));
}
$query_user = "SELECT femail FROM customer where femail=".$_SESSION['valid_user'];
?>

  <?php echo $row_user['femail'];

mysqli_close($DBconnect);
?>