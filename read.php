<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: userlogin.php"); exit(); }
include 'Database.php';
$db = new Database();
$conn = $db->getConnection();
$result = $conn->query("SELECT matric, name, role FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fdf6ff; padding: 40px; display: flex; justify-content: center; }
        .container { width: 100%; max-width: 850px; background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border-top: 6px solid #d1c4e9; }
        h2 { color: #6a1b9a; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #f3e5f5; color: #6a1b9a; padding: 15px; text-align: left; border-radius: 10px 10px 0 0; }
        td { padding: 15px; border-bottom: 1px solid #f3e5f5; color: #555; }
        tr:hover { background: #fcfaff; }
        .btn-upd { color: #9575cd; text-decoration: none; font-weight: bold; margin-right: 15px; }
        .btn-del { color: #ef5350; text-decoration: none; font-weight: bold; }
        .logout { float: right; background: #b39ddb; color: white; padding: 8px 15px; border-radius: 10px; text-decoration: none; font-size: 13px; font-weight: bold; transition: 0.3s; }
        .logout:hover { background: #9575cd; }
    </style>
</head>
<body>
    <div class="container">
        <a href="logout.php" class="logout">Logout</a>
        <h2>User Management</h2>
        <table>
            <tr><th>Matric</th><th>Name</th><th>Role</th><th>Actions</th></tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['matric'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['role'] ?></td>
                <td>
                    <a href="update.php?matric=<?= $row['matric'] ?>" class="btn-upd">Update</a>
                    <a href="delete.php?matric=<?= $row['matric'] ?>" class="btn-del" onclick="return confirm('Delete this user?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
