<?php
session_start();

if (!isset($_SESSION["TraderID"])) {
    header("Location: ../login/login.php");
    exit;
}
?>

<!DOCTYPE>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome!</h1>
    <p>You are logged in as: <?php echo htmlspecialchars($_SESSION["Email"]); ?></p>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>
