<?php

session_start();
require_once "../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request.");
}

$email = trim($_POST["email"]);
$password = $_POST["password"];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

try {
    $stmt = $conn->prepare("SELECT TraderID, Email, PasswordHash FROM Trader WHERE Email = :email");
    $stmt->execute([
        ":email" => $email
    ]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("Invalid email or password.");
    }

    if (!password_verify($password, $user["PasswordHash"])) {
        die("Invalid email or password.");
    }

    $_SESSION["TraderID"] = $user["TraderID"];
    $_SESSION["Email"] = $user["Email"];

    header("Location: ../dashboard/dashboard.php");
    exit;
} catch (PDOException $e) {
    die("Login failed: " . $e->getMessage());
}
