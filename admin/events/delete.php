<?php
require_once __DIR__ . "/../../config/db.php";

// Validate ID
if (!isset($_GET['id'])) {
    die("Invalid event ID.");
}

$event_id = $_GET['id'];

// Fetch poster filename
$query = "SELECT poster FROM events WHERE id = $event_id LIMIT 1";
$result = mysqli_query($connect, $query);
$event = mysqli_fetch_assoc($result);

if (!$event) {
    die("Event not found.");
}

// Delete poster file if exists
if ($event['poster'] != "") {
    $poster_path = __DIR__ . "/../../uploads/event_posters/" . $event['poster'];
    if (file_exists($poster_path)) {
        unlink($poster_path);
    }
}

// Delete event record
$delete_query = "DELETE FROM events WHERE id = $event_id";

if (mysqli_query($connect, $delete_query)) {
    header("Location: index.php?msg=deleted");
    exit();
} else {
    echo "Error deleting event: " . mysqli_error($connect);
}
?>
