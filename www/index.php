<!DOCTYPE html>
<html>
<body>

<?php
echo "My first PHP script!";
?>

<?php
$servername = "127.0.0.1";
$username = "root";
$password = "1qazxsw2";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>

</body>
</html>
