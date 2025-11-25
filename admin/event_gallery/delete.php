<?php
require_once __DIR__ . "/../../config/db.php";

$id = $_GET['id'];

$photo = mysqli_query($connect, "SELECT photo FROM event_photos WHERE id = $id");
$row = mysqli_fetch_assoc($photo);

$file = __DIR__ . "/../../uploads/event_gallery/" . $row['photo'];

if (file_exists($file)) {
    unlink($file);
}

mysqli_query($connect, "DELETE FROM event_photos WHERE id = $id");

header("Location: index.php?deleted=1");
exit;
