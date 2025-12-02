<html>
<head>
    <title>Register - Class Orderbook</title>
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
        }
        button {
            width: 100%;
            padding: 8px;
            cursor: pointer;
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
        <a href="../login/login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</div>

<div class="center-box">
    <h2 style="text-align:center;">Register</h2>

    <form action="register_handler.php" method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>        

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Create Account</button>
    </form>

    <p class="small-text">
        Already have an account? <a href="../login/login.php">Login here</a>
    </p>
</div>

</body>
</html>
