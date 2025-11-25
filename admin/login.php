<?php

// Start the session
session_start();
require_once '../config/db.php';

$error = '';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //check if username exists
    $query = "SELECT * FROM admins WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $row['password'])) {

            // Set session variables
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $row['username'];

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Username not found.";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
    <div class="login-box">
        <h2>Admin Login</h2>

        <?php if ($error != "") { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <form method="post">
            <input type="text" name="username" placeholder="Enter Username" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>