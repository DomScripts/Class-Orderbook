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
    <title>Orderbook - Portfolio</title>

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
    <div class="logo">Orderbook - Portfolio</div>
    <div class="nav-links">
        <a href="../dashboard/dashboard.php">Dashboard</a>
        <a href="portfolio.php">Portfolio</a>
        <a href="../logout/logout.php">Logout</a>
    </div>
</div>

<h1 style="text-align:center; margin-top: 20px;">Portfolio</h1>

<?php
function formatNum($value) {
    return is_numeric($value) ? number_format((float)$value, 2) : htmlspecialchars($value);
}

try {
    $stmt = $conn->prepare("
        SELECT 
            Portfolio.AssetID,
            Asset.Name AS AssetName,
            Portfolio.QuantityHeld,
            Portfolio.AverageCost,
            (Portfolio.QuantityHeld * Portfolio.AverageCost) AS TotalValue
        FROM Portfolio
        INNER JOIN Asset ON Portfolio.AssetID = Asset.AssetID
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows) {
        echo "<table>";
        echo "<tr>
                <th>Asset</th>
                <th>Quantity Held</th>
                <th>Average Cost</th>
                <th>Total Value</th>
              </tr>";

        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['AssetName']) . "</td>";
            echo "<td>" . formatNum($row['QuantityHeld']) . "</td>";
            echo "<td>" . formatNum($row['AverageCost']) . "</td>";
            echo "<td>" . formatNum($row['TotalValue']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>No portfolio data found.</p>";
    }
} catch (PDOException $e) {
    echo "<p style='color:red; text-align:center;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>

</body>
</html>
