<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: userlogin.php"); exit(); }
include 'Database.php';
$db = new Database();
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric']; $name = $_POST['name']; $role = $_POST['role'];
    $sql = "UPDATE users SET name='$name', role='$role' WHERE matric='$matric'";
    if ($conn->query($sql) === TRUE) { header("Location: read.php"); exit(); }
} else {
    $matric = $_GET['matric'];
    $user = $conn->query("SELECT * FROM users WHERE matric='$matric'")->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Details</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fdf6ff; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 25px rgba(150,150,150,0.1); width: 350px; border-top: 6px solid #d1c4e9; }
        h2 { color: #6a1b9a; text-align: center; margin-bottom: 25px; }
        input, select { width: 100%; padding: 12px; margin: 10px 0; border: 2px solid #efefef; border-radius: 10px; box-sizing: border-box; }
        .btn-upd { background: #b39ddb; color: white; border: none; font-weight: bold; cursor: pointer; margin-top: 20px; transition: 0.3s; width: 100%; }
        .btn-upd:hover { background: #9575cd; transform: scale(1.02); }
        .cancel { display: block; text-align: center; margin-top: 15px; color: #999; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Update User</h2>
        <form action="update.php" method="post">
            <label style="font-size: 12px; color: #999;">Matric (Read Only)</label>
            <input type="text" name="matric" value="<?= $user['matric'] ?>" readonly style="background: #f9f9f9;">
            <input type="text" name="name" value="<?= $user['name'] ?>" placeholder="Full Name" required>
            <select name="role">
                <option value="lecturer" <?= $user['role']=='lecturer'?'selected':'' ?>>Lecturer</option>
                <option value="student" <?= $user['role']=='student'?'selected':'' ?>>Student</option>
            </select>
            <input type="submit" value="Save Changes" class="btn-upd">
            <a href="read.php" class="cancel">Go Back</a>
        </form>
    </div>
</body>
</html>
