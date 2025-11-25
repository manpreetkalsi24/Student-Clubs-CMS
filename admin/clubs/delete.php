<?php
require_once __DIR__ . "/../../config/db.php";

// Check if ID exists
if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$club_id = $_GET['id'];

// Fetch club to delete logo
$query = "SELECT logo FROM clubs WHERE id = $club_id LIMIT 1";
$result = mysqli_query($connect, $query);
$club = mysqli_fetch_assoc($result);

if (!$club) {
    die("Club not found.");
}

if ($club['logo'] != "") {
    $logo_path = "../../uploads/club_logos/" . $club['logo'];
    if (file_exists($logo_path)) {
        unlink($logo_path);
    }
}

// Delete club record from DB
$delete_query = "DELETE FROM clubs WHERE id = $club_id";

if (mysqli_query($connect, $delete_query)) {
    header("Location: index.php?msg=deleted");
    exit;
} else {
    echo "Error deleting club: " . mysqli_error($connect);
}
?>
