<?php
// Script to register a user to the Listen service.

// To diagnose problems
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "listen";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$registrationResult = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["f_name"];
    $last_name = $_POST["l_name"];
    $dob = $_POST["dob"];
    $nhs_number = $_POST["nhs_number"];
    $health_condition = $_POST["h_condition"];
    $contact_number = $_POST["c_number"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password === $confirm_password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, dob, nhs_number, health_condition, contact_number, email, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiisss", $first_name, $last_name, $dob, $nhs_number, $health_condition, $contact_number, $email, $password_hash);

        if ($stmt->execute()) {
            $registrationResult = 'success';
        } else {
            $registrationResult = 'error';
        }
        $stmt->close();
    } else {
        $registrationResult = 'password_mismatch';
    }
}

$conn->close();
?>

