<?php
session_start();
include 'Database.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $conn = $db->getConnection();
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['matric'];
            header("Location: read.php");
            exit();
        }
    }
    $error = "Invalid matric or password.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fdf6ff; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 25px rgba(150,150,150,0.1); width: 350px; border-top: 6px solid #d1c4e9; }
        h2 { color: #6a1b9a; text-align: center; margin-bottom: 25px; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 2px solid #efefef; border-radius: 10px; box-sizing: border-box; }
        input[type="submit"] { background: #b39ddb; color: white; border: none; font-weight: bold; cursor: pointer; margin-top: 20px; transition: 0.3s; }
        input[type="submit"]:hover { background: #9575cd; transform: scale(1.02); }
        .error { color: #dc2626; font-size: 13px; text-align: center; background: #fee2e2; padding: 10px; border-radius: 8px; }
        .footer-link { text-align: center; margin-top: 20px; font-size: 14px; color: #777; }
        .footer-link a { color: #9575cd; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Login</h2>
        <?php if($error) echo "<p class='error'>$error</p>"; ?>
        <form action="userlogin.php" method="post">
            <input type="text" name="matric" placeholder="Matric" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Sign In">
        </form>
        <div class="footer-link">
            New here? <a href="registration.php">Register Account</a>
        </div>
    </div>
</body>
</html>
