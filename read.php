<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: userlogin.php");
    exit();
}

include 'Database.php';
$db = new Database();
$conn = $db->getConnection();

$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<body>
    <table border="1">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th colspan="2">Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['matric']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td><a href="update.php?matric=<?php echo $row['matric']; ?>">Update</a></td>
            <td><a href="delete.php?matric=<?php echo $row['matric']; ?>" onclick="return confirm('Delete this user?')">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br><a href="logout.php">Logout</a>
</body>
</html>