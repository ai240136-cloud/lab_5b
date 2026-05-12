<?php
include 'Database.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $conn = $db->getConnection();
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        $message = "Success! <a href='userlogin.php' style='color:#6a1b9a; text-decoration:underline;'>Login here</a>";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: #fdf6ff; /* Soft pastel purple background */
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }
        .card { 
            background: white; 
            padding: 40px; 
            border-radius: 20px; 
            box-shadow: 0 10px 25px rgba(150, 150, 150, 0.1); 
            width: 350px; 
            border-top: 6px solid #d1c4e9; /* Pastel lavender top border */
        }
        h2 { color: #6a1b9a; text-align: center; margin-bottom: 25px; }
        input, select { 
            width: 100%; 
            padding: 12px; 
            margin: 10px 0; 
            border: 2px solid #efefef; 
            border-radius: 10px; 
            box-sizing: border-box; 
            transition: 0.3s; 
        }
        input:focus { border-color: #d1c4e9; outline: none; }
        input[type="submit"] { 
            background: #b39ddb; 
            color: white; 
            border: none; 
            font-weight: bold; 
            cursor: pointer; 
            margin-top: 20px; 
            transition: 0.3s ease;
        }
        input[type="submit"]:hover { background: #9575cd; transform: scale(1.02); }
        .msg { 
            text-align: center; 
            color: #4a148c; 
            padding: 10px; 
            background: #f3e5f5; 
            border-radius: 8px; 
            margin-bottom: 15px; 
            font-size: 14px;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
        .login-link a { 
            color: #9575cd; 
            text-decoration: none; 
            font-weight: bold; 
        }
        .login-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Registration</h2>
        
        <?php if($message) echo "<div class='msg'>$message</div>"; ?>
        
        <form action="registration.php" method="post">
            <input type="text" name="matric" placeholder="Matric Number" required>
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="password" name="password" placeholder="Create Password" required>
            <select name="role" required>
                <option value="">Select Access Level</option>
                <option value="lecturer">Lecturer</option>
                <option value="student">Student</option>
            </select>
            <input type="submit" value="Register Now">
        </form>

        <div class="login-link">
            Already registered? <a href="userlogin.php">Login here</a>
        </div>
    </div>
</body>
</html>
