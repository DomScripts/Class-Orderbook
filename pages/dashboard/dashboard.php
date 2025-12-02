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
    <title>Dashboard</title>
    <meta http-equiv="refresh" content="3">

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

        /* -- FILTER BAR -- */
        .filter-bar {
            width: 90%;
            margin: 16px auto;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 12px;
        }
        .filter-bar label {
            font-weight: bold;
        }
        select {
            padding: 6px;
            font-size: 14px;
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
    <div class="logo">Orderbook - Dashboard</div>
    <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="../portfolio/portfolio.php">Portfolio</a>
        <a href="../logout/logout.php">Logout</a>
    </div>
</div>

<h1 style="text-align:center; margin-top: 20px;">Orderbook</h1>

<?php
function formatNum($value) {
    if (is_numeric($value)) {
        return number_format((float)$value, 5);
    }

    return htmlspecialchars($value);
}

$columnNames = [
    'bid_price' => 'Bid Price',
    'bid_qty' => 'Big Quantity',
    'ask_price' => 'Ask Price',
    'ask_qty' => 'Ask Quantity'
];

// --- Load asset list for dropdown ---
try {
    $assetStmt = $conn->prepare("SELECT AssetID, Symbol, Name FROM Asset ORDER BY Name, Symbol");
    $assetStmt->execute();
    $assets = $assetStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p style='color:red; text-align:center;'>Error loading assets: " . htmlspecialchars($e->getMessage()) . "</p>";
    $assets = [];
}

$selectedAsset = $_GET['asset_id'] ?? null;
if ($selectedAsset === null) {
    $stmt = $conn->query("SELECT AssetID FROM Asset ORDER BY AssetID ASC LIMIT 1");
    $selectedAsset = $stmt->fetchColumn();
}

// Fetch all assets for the dropdown
$assets = $conn->query("SELECT AssetID, Symbol FROM Asset ORDER BY AssetID ASC")->fetchAll(PDO::FETCH_ASSOC);
?>


<form method="GET" style="text-align:center; margin-top: 10px;">
    <label for="asset_id">Asset:</label>
    <select name="asset_id" id="asset_id" onchange="this.form.submit()">
        <?php foreach ($assets as $asset): ?>
            <option value="<?= $asset['AssetID'] ?>"
                <?= ($asset['AssetID'] == $selectedAsset) ? 'selected' : '' ?>>
                <?= htmlspecialchars($asset['Symbol']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<?php
try {
    if ($selectedAsset) {
        $stmt = $conn->prepare("SELECT bid_price, bid_qty, ask_price, ask_qty FROM MarketData WHERE AssetID = :asset ORDER BY Timestamp DESC LIMIT 50");
        $stmt->execute([':asset' => $selectedAsset]);
    } else {
        $stmt = $conn->prepare("SELECT bid_price, bid_qty, ask_price, ask_qty FROM MarketData ORDER BY Timestamp DESC LIMIT 50");
        $stmt->execute();
    }

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
    if ($rows) {
        echo "<table>";
        echo "<tr>";
        foreach ($rows[0] as $col => $val) {
            if ($col === 'AssetID') continue;
            echo "<th>" . htmlspecialchars($columnNames[$col] ?? $col) . "</th>";
        }
        echo "</tr>";

        foreach ($rows as $row) {
            echo "<tr>";
            foreach ($row as $col=>$val) {
                if ($col === 'AssetID') continue;
                echo "<td>" . formatNum($val) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>No MarketData found.</p>";
    }
} catch (PDOException $e) {
    echo "<p style='color:red; text-align:center;'>Error: " . $e->getMessage() . "</p>";
}
?>

</body>
</html>
