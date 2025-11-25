<?php
include __DIR__ . "/../reusable/header.php";
require_once __DIR__ . "/../../config/db.php";

// Check ID
if (!isset($_GET['id'])) {
    echo "Invalid member ID.";
    exit;
}

$member_id = $_GET['id'];

// Fetch member data
$query = "SELECT * FROM members WHERE id = $member_id LIMIT 1";
$result = mysqli_query($connect, $query);
$member = mysqli_fetch_assoc($result);

if (!$member) {
    echo "Member not found!";
    exit;
}

// Fetch clubs for dropdown
$clubs_query = "SELECT id, name FROM clubs ORDER BY name ASC";
$clubs_result = mysqli_query($connect, $clubs_query);

$message = "";

// Handle form submit
if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $role = mysqli_real_escape_string($connect, $_POST['role']);
    $club_id = mysqli_real_escape_string($connect, $_POST['club_id']);

    // Handle photo upload
    $new_photo = $member['profile_photo'];

    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {

        $target_dir = __DIR__ . "/../../uploads/member_photos/";
        $file_name = time() . "_" . basename($_FILES["profile_photo"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
            $new_photo = $file_name;

            // Delete old photo
            if (
                $member['profile_photo'] != "" &&
                file_exists(__DIR__ . "/../../uploads/member_photos/" . $member['profile_photo'])
            ) {
                unlink(__DIR__ . "/../../uploads/member_photos/" . $member['profile_photo']);
            }
        }
    }

    // Update DB
    $update = "UPDATE members 
               SET name='$name', role='$role', club_id='$club_id', profile_photo='$new_photo'
               WHERE id = $member_id";

    if (mysqli_query($connect, $update)) {
        // $message = "Member updated successfully!";
        header("Location: index.php?msg=updated");
        exit();
    } else {
        $message = "Error updating member: " . mysqli_error($connect);
    }
}
?>

<a href="index.php" class="btn-back">Back to Members List</a>

<?php if ($message != "") { ?>
    <div class="success-msg"><?php echo $message; ?></div>
<?php } ?>

<div class="form-box">
    <h3>Edit Member</h3>

    <form method="post" enctype="multipart/form-data">

        <label>Member Name</label>
        <input type="text" name="name" value="<?php echo $member['name']; ?>" required>

        <label>Role / Position</label>
        <input type="text" name="role" value="<?php echo $member['role']; ?>" required>

        <label>Club</label>
        <select name="club_id" required>
            <option value="">-- Select Club --</option>
            <?php while ($club = mysqli_fetch_assoc($clubs_result)) { ?>
                <option value="<?php echo $club['id']; ?>"
                    <?php if ($club['id'] == $member['club_id']) echo "selected"; ?>>
                    <?php echo $club['name']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Current Photo</label><br>
        <?php if ($member['profile_photo'] != "") { ?>
            <img src="../../uploads/member_photos/<?php echo $member['profile_photo']; ?>"
                width="80" height="80"
                style="object-fit:cover; border-radius:50%; margin-bottom:10px;">
        <?php } else { ?>
            <p>No photo available</p>
        <?php } ?>

        <br>

        <label>Upload New Photo (optional)</label>
        <input type="file" name="profile_photo" accept="image/*">

        <button type="submit" name="submit">Update Member</button>

    </form>
</div>

<?php include __DIR__ . "/../reusable/footer.php"; ?>