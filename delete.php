<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: userlogin.php");
    exit();
}

include 'Database.php';
$db = new Database();
$conn = $db->getConnection();

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $sql = "DELETE FROM users WHERE matric='$matric'";
    $conn->query($sql);
}
header("Location: read.php");
exit();
?>