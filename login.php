<?php
session_start();


$email = $_POST["femail"];
$Password = $_POST["fpassword"];


$conn = new mysqli('localhost', 'root', '', 'customer table');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("SELECT fpassword FROM customer WHERE femail = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
  
    $stmt->bind_result($hashedPass);
    $stmt->fetch();

   
    if (password_verify($Password, $hashedPass)) {
        
        $_SESSION['femail'] = $email;
        echo 'Sign in successful, please wait';

        ?>
        <script type="text/javascript">
        window.location = "http://localhost/NIC3%20TECH/Home.html";
        </script>
        <?php
    } else {
       
        echo 'Wrong email or password';
        ?>
        <script type="text/javascript">
        alert('Wrong email or password');
        window.location = "http://localhost/NIC3%20TECH/index.html";
        </script>
        <?php
    }
} else {
   
    echo 'Wrong email or password';
    ?>
    <script type="text/javascript">
    alert('Wrong email or password');
    window.location = "http://localhost/NIC3%20TECH/index.html";
    </script>
    <?php
}

$stmt->close();
$conn->close();
?>