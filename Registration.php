<?php
$fullname = $_POST["fname"];
$Password = $_POST["fpassword"];
$email = $_POST["femail"];
$phone = $_POST["fphone"];
$address = $_POST["faddress"];
$hash= password_hash($Password, PASSWORD_DEFAULT);

$conn = new mysqli('localhost', 'root', '', 'customer table');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("INSERT INTO customer (fname, fpassword, femail, fphone, faddress) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $fullname, $hash, $email, $phone, $address);

if ($stmt->execute() === TRUE) {
    ?>
<script type="text/javascript">
window.location = "index.html";
</script>      
    <?php
} else {
   die("Error: ". $stmt->error) ;
}
echo "Generated hash: ".$hash; 


$stmt->close();
$conn->close();
?>
