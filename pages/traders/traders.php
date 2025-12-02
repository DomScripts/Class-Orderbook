<?php
require_once "../../config/database.php";

session_start();
if (!isset($_SESSION['TraderID'])) {
    header("Location: ../login/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Orderbook - Traders</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 0;
            margin: 0;
        }

        /* -- HEADER BAR -- */
        .header {
            background-color: #333;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .logo {
            color: white;
            font-size: 18px;
            font-weight: bold;
        }
        .nav-links a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-size: 16px;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
         /* -- TABLE -- */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #efefef;
        }
    </style>
</head>
<body>

<!-- HEADER BAR -->
<div class="header">
    <div class="logo">Orderbook - Strategy</div>
    <div class="nav-links">
        <a href="../dashboard/dashboard.php">Dashboard</a>
        <a href="../strategy/strategy.php">Strategy</a>
        <a href="traders.php">Traders</a>
        <a href="../portfolio/portfolio.php">Portfolio</a>
        <a href="../logout/logout.php">Logout</a>
    </div>
</div>

<h1 style="text-align:center; margin-top: 20px;">Traders</h1>
</body>
</html>
