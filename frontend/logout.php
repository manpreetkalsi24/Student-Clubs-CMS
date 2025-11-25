<?php
session_start();

// Destroy user session
session_unset();
session_destroy();

// Redirect to homepage
header("Location: index.php");
exit();
?>
