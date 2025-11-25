<style>
    .main-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>

<?php
include __DIR__ . "/reusable/header.php";

require_once "../config/db.php";

// If user is not logged in
if (!isset($_SESSION['user_logged_in'])) {

    $_SESSION['redirect_after_login'] = "event_registration.php?event_id=" . $_GET['event_id'];

    header("Location: login.php");
    exit();
}

// Validate event_id
if (!isset($_GET['event_id']) || empty($_GET['event_id'])) {
    echo "<h2>Invalid Request</h2>";
    include __DIR__ . "/reusable/footer.php";
    exit;
}


$event_id = intval($_GET['event_id']);

// Fetch event
$event_q = mysqli_query($connect, "SELECT * FROM events WHERE id=$event_id LIMIT 1");

if (mysqli_num_rows($event_q) == 0) {
    echo "<h2>Event not found</h2>";
    include __DIR__ . "/reusable/footer.php";
    exit;
}

$event = mysqli_fetch_assoc($event_q);

$message = "";

// REGISTER USER
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);

    $insert = "INSERT INTO event_registrations (event_id, name, email)
               VALUES ($event_id, '$name', '$email')";

    if (mysqli_query($connect, $insert)) {
        $message = "You have successfully registered!";
    } else {
        $message = "Error: " . mysqli_error($connect);
    }
}
?>

<div class="container register_container">

    <h1 class="register_text">Register for: <?php echo $event['title']; ?></h1>

    <?php if ($message != "") { ?>
        <div class="card" style="background:#d4edda; color:#155724; padding:15px; margin-bottom:20px;">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <div class="card" style="max-width:500px;">
        <form method="post">

            <label>Name</label>
            <input type="text" name="name" required style="width:100%; padding:10px; margin-bottom:10px;">

            <label>Email</label>
            <input type="email" name="email" required style="width:100%; padding:10px; margin-bottom:10px;">

            <button name="submit"
                style="padding:12px; width:100%; background:#0A3D62; color:white; border:none; border-radius:6px;">
                Register Now
            </button>

        </form>
    </div>
</div>

<?php include __DIR__ . "/reusable/footer.php"; ?>