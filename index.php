<!DOCTYPE html>
<html>
<head>
    <title>Class Orderbook - Home</title>
    <style>
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
    </style>   
</head>
<body>

<!-- HEADER BAR -->
<div class="header">
    <div class="logo">Orderbook - Home</div>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="pages/login/login.php">Login</a>
        <a href="pages/register/register.php">Register</a>
    </div>
</div>

<!-- Main Content --->
<main style="padding: 20px;">
    <h1>Welcome to the Orderbook </h1>
    <p>This is a simple project simulating a high-frequency trading firm's internal data dashboard.</p>
    <p>Please <a href="pages/login/login.php">log in</a> to access your trader dashboard.</p>
</main>

</body>
</html>
