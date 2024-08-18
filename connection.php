<?php
$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "rodrigo_industriesdb"; // Replace with your actual database name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
}
catch(PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>
