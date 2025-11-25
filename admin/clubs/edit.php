<?php 
include __DIR__ . "/../reusable/header.php"; 
require_once __DIR__ . "/../../config/db.php";

// Get ID
if(!isset($_GET['id'])) {
    echo "Invalid club ID.";
    exit;
}

$club_id = $_GET['id'];

// Fetch existing club data
$query = "SELECT * FROM clubs WHERE id = $club_id LIMIT 1";
$result = mysqli_query($connect, $query);
$club = mysqli_fetch_assoc($result);

if(!$club){
    echo "Club not found!";
    exit;
}

$message = "";

// If form is submitted
if(isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);

    
    $new_logo = $club['logo']; 

    if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {

        $target_dir = "../../uploads/club_logos/";
        $file_name = time() . "_" . basename($_FILES["logo"]["name"]);
        $target_file = $target_dir . $file_name;

        if(move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)){
            $new_logo = $file_name;

        
            if($club['logo'] != "" && file_exists("../../uploads/club_logos/" . $club['logo'])){
                unlink("../../uploads/club_logos/" . $club['logo']);
            }
        }
    }

    // Update database
    $update = "UPDATE clubs 
               SET name='$name', description='$description', logo='$new_logo' 
               WHERE id = $club_id";

    if(mysqli_query($connect, $update)){
        header("Location: index.php?msg=Club updated successfully");
        exit();
    } else {
        $message = "Error updating club: " . mysqli_error($connect);
    }
}
?>

<a href="index.php" class="btn-back">Back to Clubs List</a>

<?php if($message != "") { ?>
    <div class="success-msg"><?php echo $message; ?></div>
<?php } ?>

<div class="form-box">
    <h3>Edit Club</h3>

    <form method="post" enctype="multipart/form-data">

        <label>Club Name</label>
        <input type="text" name="name" value="<?php echo $club['name']; ?>" required>

        <label>Description</label>
        <textarea name="description" rows="4" required><?php echo $club['description']; ?></textarea>

        <label>Current Logo</label><br>
        <?php if($club['logo'] != "") { ?>
            <img src="../../uploads/club_logos/<?php echo $club['logo']; ?>" 
                 width="80" height="80" 
                 style="object-fit:cover; border-radius:6px; margin-bottom:10px;">
        <?php } else { ?>
            <p>No logo available</p>
        <?php } ?>

        <br>
        <label>Upload New Logo (optional)</label>
        <input type="file" name="logo" accept="image/*">

        <button type="submit" name="submit">Update Club</button>

    </form>
</div>

<?php include "../reusable/footer.php"; ?>
