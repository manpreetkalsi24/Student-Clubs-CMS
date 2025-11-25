<?php
session_start();
require_once "../config/db.php";

$error = "";
$success = "";

if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $q = "INSERT INTO users (name, email, password)
          VALUES ('$name', '$email', '$password')";

    if (mysqli_query($connect, $q)) {
        $success = "Account created successfully! Please login.";
    } else {
        $error = "Email already exists.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="/Student_Clubs_CMS/assets/css/style.css">
</head>

<body>
    <div class="login-form-container">
        <div class="form-box">
            <h2>Create Account</h2>

            <?php if ($error != "") { ?>
                <div class="error"><?php echo $error; ?></div>
            <?php } ?>

            <?php if ($success != "") { ?>
                <div class="success"><?php echo $success; ?></div>
            <?php } ?>

            <form method="post">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="password" name="password" placeholder="Create Password" required>

                <button type="submit" name="register">Register</button>

                <div class="link">
                    Already have an account? <a href="login.php">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>