<?php 
include __DIR__ . "/../reusable/header.php"; 
require_once __DIR__ . "/../../config/db.php";

// Initialize message
$message = "";

if(isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);

    // Handle Image Upload
    $logo = "";

    if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {

        $target_dir = "../../uploads/club_logos/";
        $file_name = time() . "_" . basename($_FILES["logo"]["name"]);
        $target_file = $target_dir . $file_name;

        // Move uploaded file
        if(move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)){
            $logo = $file_name;
        }
    }

    // Insert into database
    $query = "INSERT INTO clubs (name, description, logo) 
              VALUES ('$name', '$description', '$logo')";

    if(mysqli_query($connect, $query)){
        // $message = "Club added successfully!";
        header("Location: index.php?msg=Club added Successfully");
        exit();
    } else {
        $message = "Error: " . mysqli_error($connect);
    }
}
?>

<a href="index.php" class="btn-back">Back to Club List</a>

<?php if($message != "") { ?>
    <div class="success-msg"><?php echo $message; ?></div>
<?php } ?>

<div class="form-box">
    <h3>Add New Club</h3>

    <form method="post" enctype="multipart/form-data">

        <label>Club Name</label>
        <input type="text" name="name" required>

        <label>Description</label>
        <textarea name="description" rows="4" required></textarea>

        <label>Club Logo</label>
        <input type="file" name="logo" accept="image/*">

        <button type="submit" name="submit">Add Club</button>

    </form>
</div>


<?php include __DIR__ .  "/../reusable/footer.php"; ?>
