<?php
include __DIR__ . "/../reusable/header.php";
require_once __DIR__ . "/../../config/db.php";

$message = "";

// Fetch clubs for dropdown
$club_query = "SELECT id, name FROM clubs ORDER BY name ASC";
$clubs_result = mysqli_query($connect, $club_query);

// Handle Form Submission
if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $role = mysqli_real_escape_string($connect, $_POST['role']);
    $club_id = mysqli_real_escape_string($connect, $_POST['club_id']);

    // Handle Profile Photo Upload
    $photo = "";

    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {

        $target_dir = "../../uploads/member_photos/";
        $file_name = time() . "_" . basename($_FILES["profile_photo"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
            $photo = $file_name;
        }
    }

    // Insert into DB
    $query = "INSERT INTO members (name, role, club_id, profile_photo) 
              VALUES ('$name', '$role', '$club_id', '$photo')";

    if (mysqli_query($connect, $query)) {
        header("Location: index.php?msg=Member added successfully");
        exit();
    } else {
        $message = "Error: " . mysqli_error($connect);
    }
}
?>

<a href="index.php" class="btn-back">Back to Members List</a>

<?php if ($message != "") { ?>
    <div class="success-msg"><?php echo $message; ?></div>
<?php } ?>

<div class="form-box">
    <h3>Add Member</h3>

    <form method="post" enctype="multipart/form-data">

        <label>Member Name</label>
        <input type="text" name="name" required>

        <label>Role / Position</label>
        <input type="text" name="role" required>

        <label>Club</label>
        <select name="club_id" required>
            <option value="">-- Select Club --</option>
            <?php while ($club = mysqli_fetch_assoc($clubs_result)) { ?>
                <option value="<?php echo $club['id']; ?>">
                    <?php echo $club['name']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Profile Photo</label>
        <input type="file" name="profile_photo" accept="image/*">

        <button type="submit" name="submit">Add Member</button>

    </form>
</div>

<?php include __DIR__ . "/../reusable/footer.php"; ?>