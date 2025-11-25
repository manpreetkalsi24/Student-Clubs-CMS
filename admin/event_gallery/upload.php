<?php 
include __DIR__ . "/../reusable/header.php"; 
require_once __DIR__ . "/../../config/db.php";

$message = "";

// Fetch events list
$events = mysqli_query($connect, "SELECT id, title FROM events ORDER BY title ASC");

if (isset($_POST['submit'])) {
    $event_id = $_POST['event_id'];
    $files = $_FILES['photos'];

    for ($i = 0; $i < count($files['name']); $i++) {
        if ($files['error'][$i] == 0) {

            $dir = __DIR__ . "/../../uploads/event_gallery/";
            $file_name = time() . "_" . basename($files["name"][$i]);
            $path = $dir . $file_name;

            if (move_uploaded_file($files["tmp_name"][$i], $path)) {
                mysqli_query($connect,
                    "INSERT INTO event_photos (event_id, photo) VALUES ($event_id, '$file_name')");
            }
        }
    }

    header("Location: index.php?uploaded=1");
    exit;
}
?>

<a href="index.php" class="btn-back">Back to Gallery</a>

<div class="form-box">
    <h3>Upload Event Photos</h3>

    <form method="post" enctype="multipart/form-data">

        <label>Select Event</label>
        <select name="event_id" class="input" required>
            <option value="">-- Select Event --</option>
            <?php while ($ev = mysqli_fetch_assoc($events)) { ?>
                <option value="<?php echo $ev['id']; ?>">
                    <?php echo $ev['title']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Upload Photos (You can select Multiple Photos)</label>
        <input type="file" name="photos[]" class="input" multiple required>

        <button type="submit" name="submit" class="btn-primary">Upload Photos</button>
    </form>
</div>

<?php include __DIR__ . "/../reusable/footer.php"; ?>
