<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="/Student_Clubs_CMS/assets/css/admin.css">
</head>
<body>

<div class="topbar">
    <span class="welcome-text">Welcome, <?php echo $_SESSION['admin_username']; ?></span>

    <a href="/Student_Clubs_CMS/admin/logout.php" class="logout-btn">Logout</a>
</div>

<?php include __DIR__ . "/nav.php"; ?>

<div class="admin-content">
