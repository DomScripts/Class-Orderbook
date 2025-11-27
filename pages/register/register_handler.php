<?php

require_once "../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid Acess");
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");

if ($name === "" || $email === "" || $password === "") {
    die("All fields are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $check = $conn->prepare("SELECT TraderID FROM Trader WHERE Email = :email LIMIT 1");
    $check->execute([":email" => $email]);

    if ($check->rowCount() > 0) {
        die("Email already registered.");
    }

    $stmt = $conn->prepare("INSERT INTO Trader (Name, Email, PasswordHash) VALUES (:name, :email, :password)");

    $stmt->execute([
        ":name" => $name,
        ":email" => $email,
        ":password" => $hashedPassword
    ]);

    header("Location: ../login/login.php?registered=1");
    exit;
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
