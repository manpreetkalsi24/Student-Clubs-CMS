<?php
include __DIR__ . "/../reusable/header.php";
require_once __DIR__ . "/../../config/db.php";

// Check ID
if (!isset($_GET['id'])) {
    echo "Invalid event ID.";
    exit;
}

$event_id = $_GET['id'];

// Fetch existing event data
$query = "SELECT * FROM events WHERE id = $event_id LIMIT 1";
$result = mysqli_query($connect, $query);
$event = mysqli_fetch_assoc($result);

if (!$event) {
    echo "Event not found!";
    exit;
}

// Fetch clubs for dropdown
$clubs_query = "SELECT id, name FROM clubs ORDER BY name ASC";
$clubs_result = mysqli_query($connect, $clubs_query);

$message = "";

// Handle form submission
if (isset($_POST['submit'])) {

    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $date = mysqli_real_escape_string($connect, $_POST['event_date']);
    $location = mysqli_real_escape_string($connect, $_POST['location']);
    $club_id = mysqli_real_escape_string($connect, $_POST['club_id']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);

    // Handle new poster upload (optional)
    $new_poster = $event['poster'];  // Keep existing poster unless replaced

    if (isset($_FILES['poster']) && $_FILES['poster']['error'] == 0) {

        $target_dir = __DIR__ . "/../../uploads/event_posters/";
        $file_name = time() . "_" . basename($_FILES["poster"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
            $new_poster = $file_name;

            // Delete old poster if exists
            if (
                $event['poster'] != "" &&
                file_exists(__DIR__ . "/../../uploads/event_posters/" . $event['poster'])
            ) {
                unlink(__DIR__ . "/../../uploads/event_posters/" . $event['poster']);
            }
        }
    }

    // Update event data
    $update = "UPDATE events 
               SET title='$title', event_date='$date', location='$location', 
                   club_id='$club_id', description='$description', poster='$new_poster'
               WHERE id = $event_id";

    if (mysqli_query($connect, $update)) {
        header("Location: index.php?msg=Event updated successfully");
        exit();
    } else {
        $message = "Error updating event: " . mysqli_error($connect);
    }
}
?>

<a href="index.php" class="btn-back">Back to Events List</a>

<?php if ($message != "") { ?>
    <div class="success-msg"><?php echo $message; ?></div>
<?php } ?>

<div class="form-box">
    <h3>Edit Event</h3>

    <form method="post" enctype="multipart/form-data">

        <label>Event Title</label>
        <input type="text" name="title" value="<?php echo $event['title']; ?>" required>

        <label>Event Date</label>
        <input type="date" name="event_date" value="<?php echo $event['event_date'] ?? ''; ?>" required>

        <label>Location</label>
        <input type="text" name="location" value="<?php echo $event['location']; ?>" required>

        <label>Club</label>
        <select name="club_id" required>
            <?php while ($club = mysqli_fetch_assoc($clubs_result)) { ?>
                <option value="<?php echo $club['id']; ?>"
                    <?php if ($club['id'] == $event['club_id']) echo "selected"; ?>>
                    <?php echo $club['name']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Description</label>
        <textarea name="description" rows="4"><?php echo $event['description']; ?></textarea>

        <label>Current Poster</label><br>
        <?php if ($event['poster'] != "") { ?>
            <img src="../../uploads/event_posters/<?php echo $event['poster']; ?>"
                width="80" height="80"
                style="border-radius:6px; object-fit:cover; margin-bottom:10px;">
        <?php } else { ?>
            <p>No poster available</p>
        <?php } ?>

        <br>

        <label>Upload New Poster (optional)</label>
        <input type="file" name="poster" accept="image/*">

        <button type="submit" name="submit">Update Event</button>

    </form>
</div>

<?php include __DIR__ . "/../reusable/footer.php"; ?>