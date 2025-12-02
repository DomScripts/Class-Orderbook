<?php if (isset($_GET['registered']) && $_GET['registered'] == 1): ?>
<script>
    alert("Registration successful! You can now log in.");
</script>
<?php endif; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Class Orderboo - Logink</title>
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
        /* Centered Box */
        .center-box {
            max-width: 300px;
            margin: 80px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #fafafa;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 8px;
            cursor: pointer;
            box-sizing: border-box;
        }
        .small-text {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<!-- HEADER BAR -->
<div class="header">
    <div class="logo">Orderbook - Home</div>
    <div class="nav-links">
        <a href="../../index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="../register/register.php">Register</a>
    </div>
</div>

<div class="center-box">
    <h2 style="text-align:center;">Login</h2>

    <form action="login_handler.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Log In</button>
    </form>

    <p class="small-text">
        No account? <a href="../register/register.php">Register here</a>
    </p>
</div>

</body>
</html>
