<?php
require_once __DIR__ . "/../../config/db.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Clubs Website</title>

    <!-- Frontend CSS -->
    <link rel="stylesheet" href="/Student_Clubs_CMS/assets/css/style.css">
</head>
<body>

<header class="site-header">
    <div class="header_container">

        <!-- LEFT SIDE (Logo) -->
        <div class="header-left">
            <a href="index.php" class="logo-area">
                <img src="/Student_Clubs_CMS/uploads/logo.png" alt="Site Logo" class="logo-img">
                <span class="logo-text">Student Clubs</span>
            </a>
        </div>

        <!-- CENTER NAVIGATION -->
        <nav class="header-nav">
            <a href="index.php">Home</a>
            <a href="clubs.php">Clubs</a>
            <a href="events.php">Events</a>
        </nav>

        <!-- RIGHT SIDE -->
        <div class="header-auth">
            <?php if (!empty($_SESSION['user_logged_in'])) { ?>

                <span class="user-greet">Hi, <?php echo $_SESSION['user_name']; ?></span>
                <a href="logout.php" class="auth-btn">Logout</a>

            <?php } else { ?>

                <a href="login.php" class="auth-btn">Login</a>
                <a href="register.php" class="auth-btn">Register</a>

            <?php } ?>
        </div>

    </div>
</header>
