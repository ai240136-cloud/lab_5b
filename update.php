<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: userlogin.php");
    exit();
}

include 'Database.php';
$db = new Database();
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET name='$name', role='$role' WHERE matric='$matric'";
    if ($conn->query($sql) === TRUE) {
        header("Location: read.php");
        exit();
    }
} else {
    $matric = $_GET['matric'];
    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Update User</h2>
    <form action="update.php" method="post">
        Matric: <input type="text" name="matric" value="<?php echo $user['matric']; ?>" readonly><br>
        Name: <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br>
        Access Level: <input type="text" name="role" value="<?php echo $user['role']; ?>" required><br>
        <input type="submit" value="Update"> <a href="read.php">Cancel</a>
    </form>
</body>
</html>