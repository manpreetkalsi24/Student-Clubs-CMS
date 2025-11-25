<?php 
include __DIR__ . "/../reusable/header.php"; 
require_once __DIR__ . "/../../config/db.php";

$message = "";

// Fetch clubs for dropdown
$club_query = "SELECT id, name FROM clubs ORDER BY name ASC";
$clubs_result = mysqli_query($connect, $club_query);

// Form submission
if(isset($_POST['submit'])) {

    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $date = mysqli_real_escape_string($connect, $_POST['event_date']);
    $location = mysqli_real_escape_string($connect, $_POST['location']);
    $club_id = mysqli_real_escape_string($connect, $_POST['club_id']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);

    // Handle poster upload
    $poster = "";

    if(isset($_FILES['poster']) && $_FILES['poster']['error'] == 0) {

        $target_dir = __DIR__ . "/../../uploads/event_posters/";
        $file_name = time() . "_" . basename($_FILES["poster"]["name"]);
        $target_file = $target_dir . $file_name;

        if(move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)){
            $poster = $file_name;
        }
    }

    // Insert into DB
    $query = "INSERT INTO events (title, event_date, location, club_id, description, poster)
              VALUES ('$title', '$date', '$location', '$club_id', '$description', '$poster')";

    if(mysqli_query($connect, $query)){
        header("Location: index.php?msg=Event added successfully");
        exit();
        
    } else {
        $message = "Error: " . mysqli_error($connect);
    }
}
?>

<a href="index.php" class="btn-back">Back to Events List</a>

<?php if($message != "") { ?>
    <div class="success-msg"><?php echo $message; ?></div>
<?php } ?>

<div class="form-box">
    <h3>Create Event</h3>

    <form method="post" enctype="multipart/form-data">

        <label>Event Title</label>
        <input type="text" name="title" required>

        <label>Event Date</label>
        <input type="date" name="event_date" required>

        <label>Location</label>
        <input type="text" name="location" required>

        <label>Club</label>
        <select name="club_id" required>
            <option value="">-- Select Club --</option>
            <?php while($club = mysqli_fetch_assoc($clubs_result)) { ?>
                <option value="<?php echo $club['id']; ?>">
                    <?php echo $club['name']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Description (optional)</label>
        <textarea name="description" rows="4"></textarea>

        <label>Event Poster</label>
        <input type="file" name="poster" accept="image/*">

        <button type="submit" name="submit">Add Event</button>

    </form>
</div>

<?php include __DIR__ . "/../reusable/footer.php"; ?>
