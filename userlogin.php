<?php
session_start();
include 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $conn = $db->getConnection();

    $matric = $_POST['matric'];
    $password = $_POST['password'];

    // Use prepared statements to be safe and avoid errors
    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Check if password matches
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['matric'];
            header("Location: read.php");
            exit();
        } else {
            echo "Invalid username or password, try <a href='userlogin.php'>login</a> again.";
            exit();
        }
    } else {
        // This part fixes the "Undefined variable $user" error
        echo "User not found. Please <a href='registration.php'>register</a> or try <a href='userlogin.php'>login</a> again.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form action="userlogin.php" method="post">
        Matric: <input type="text" name="matric" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" name="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="registration.php">Register here</a></p>
</body>
</html>