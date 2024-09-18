<?php
session_start();
$email = $_POST["admin_email"];
$Password = $_POST["admin_password"];


$conn = new mysqli('localhost', 'root', '', 'customer table');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT admin_email, admin_password FROM admin_db WHERE admin_email = ? AND admin_password = ?");
$stmt->bind_param("ss", $email, $Password);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->fetch();
    $_SESSION['admin_email'] = $email;
    echo'Sign in sucessfull please wait';

    ?>
    <script type="text/javascript">
    window.location = "http://localhost/NIC3%20TECH/employee.html";
    </script>
    <?php
} else { echo 'wrong email or password'
    ?>
    <script type="text/javascript">

    window.location = "http://localhost/NIC3%20TECH/index.html";
    alert('wrong email or password');
    </script>
    <?php
}
$_SESSION[ 'valid_user']= $email;
session_destroy();
$stmt->close();
$conn->close();
?>