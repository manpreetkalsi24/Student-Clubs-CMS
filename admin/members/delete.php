<?php
require_once __DIR__ . "/../../config/db.php";

// Check if ID is provided
if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$member_id = $_GET['id'];

// Fetch member photo to delete file
$query = "SELECT profile_photo FROM members WHERE id = $member_id LIMIT 1";
$result = mysqli_query($connect, $query);
$member = mysqli_fetch_assoc($result);

if (!$member) {
    die("Member not found.");
}

// Delete photo if exists
if ($member['profile_photo'] != "") {
    $photo_path = __DIR__ . "/../../uploads/member_photos/" . $member['profile_photo'];

    if (file_exists($photo_path)) {
        unlink($photo_path);
    }
}

// Delete member record
$delete_query = "DELETE FROM members WHERE id = $member_id";

if (mysqli_query($connect, $delete_query)) {
    header("Location: index.php?msg=deleted");
    exit();
} else {
    echo "Error deleting member: " . mysqli_error($connect);
}
