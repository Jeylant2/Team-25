<?php
// Script to login a user to the Listen service

// To diagnose problems
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "listen";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["email"], $_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (empty($email) || empty($password)) {
            echo "Please return to the login page and enter both your email and password credentials.";
        } else {


            $stmt = $conn->prepare("SELECT email, password_hash FROM users WHERE email = ?");
            if (!$stmt) {
                echo "Prepare failed: " . $conn->error;
                exit;
            }
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['password_hash'])) {

                    $_SESSION['user_email'] = $user['email'];
                    header("Location: dashboard.html");
                    exit;
                } else {
                    echo "Login failed: Incorrect email or password provided.";
                }
            } else {
                echo "Login failed: User not found.";
            }
        }
    } else {
        echo "Please return to the login page and enter both your email and password details.";
    }
}
$conn->close();
?>
