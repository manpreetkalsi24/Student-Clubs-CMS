<?php
session_start();
require_once "../config/db.php";

$error = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            if (isset($_SESSION['redirect_after_login'])) {
                $url = $_SESSION['redirect_after_login'];
                unset($_SESSION['redirect_after_login']);
                header("Location: $url");
                exit();
            }

            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Login</title>
    <link rel="stylesheet" href="/Student_Clubs_CMS/assets/css/style.css">

</head>

<body>
    <div class="login-form-container">

        <div class="form-box">
            <h2>User Login</h2>

            <?php if ($error != "") { ?>
                <div class="error"><?php echo $error; ?></div>
            <?php } ?>

            <form method="post">
                <input type="email" name="email" placeholder="Enter Email" required>
                <input type="password" name="password" placeholder="Enter Password" required>

                <button type="submit" name="login">Login</button>

                <div class="link">
                    Don't have an account? <a href="register.php">Register</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>