<?php
include __DIR__ . "/reusable/header.php";

// Validate club ID
if (!isset($_GET['id'])) {
    echo "<h2>Invalid Club ID</h2>";
    include __DIR__ . "/reusable/footer.php";
    exit;
}

$club_id = intval($_GET['id']);

// Fetch club details
$club_query = "SELECT * FROM clubs WHERE id = $club_id LIMIT 1";
$club_result = mysqli_query($connect, $club_query);
$club = mysqli_fetch_assoc($club_result);

if (!$club) {
    echo "<h2>Club Not Found</h2>";
    include __DIR__ . "/reusable/footer.php";
    exit;
}

// Store redirect for users who click join before login
if (!isset($_SESSION['user_logged_in'])) {
    $_SESSION['redirect_after_login'] = "club.php?id=" . $club_id;
}

if (isset($_POST['register_member'])) {

    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $role = mysqli_real_escape_string($connect, $_POST['role']);
    $photo = "";

    // photo upload
    if (!empty($_FILES['profile_photo']['name'])) {
        $photo = time() . "_" . basename($_FILES['profile_photo']['name']);
        move_uploaded_file(
            $_FILES['profile_photo']['tmp_name'],
            __DIR__ . "/../uploads/member_photos/" . $photo
        );
    }

    // Insert into members table
    $insert = "INSERT INTO members (club_id, name, role, profile_photo)
               VALUES ('$club_id', '$name', '$role', '$photo')";

    if (mysqli_query($connect, $insert)) {

        // Prevent re-submission on refresh
        header("Location: club.php?id=$club_id&joined=1");
        exit();

    } else {
        $error_msg = "Error: " . mysqli_error($connect);
    }
}

?>

<div class="club-container">

    <!--  LEFT SIDE  -->
    <div class="club-left">

        <h2>About <?php echo $club['name']; ?></h2>

        <img src="/Student_Clubs_CMS/uploads/club_logos/<?php echo $club['logo']; ?>" class="club-detail-logo">

        <p class="club-description">
            <?php echo $club['description']; ?>
        </p>

        <h2>Club Events</h2>

        <?php
        $events_query = "SELECT * FROM events WHERE club_id = $club_id ORDER BY event_date DESC";
        $events_result = mysqli_query($connect, $events_query);
        ?>

        <div class="cards-grid">
            <?php while ($event = mysqli_fetch_assoc($events_result)) { ?>

                <div class="card">
                    <div class="poster_img">
                        <?php if ($event['poster']) { ?>
                            <img src="/Student_Clubs_CMS/uploads/event_posters/<?php echo $event['poster']; ?>">
                        <?php } ?>
                    </div>

                    <h3><?php echo $event['title']; ?></h3>
                    <p><strong>Date:</strong> <?php echo $event['event_date']; ?></p>
                    <p style="margin-bottom: 20px;"><?php echo substr($event['description'], 0, 70); ?>...</p>

                    <a href="event.php?id=<?php echo $event['id']; ?>" class="link-more">
                        View Event
                    </a>
                </div>

            <?php } ?>
        </div>

    </div>

    <!--  RIGHT SIDE  -->
    <div class="club-right">

        <h3>Club Members</h3>

        <?php
        $members_query = "SELECT * FROM members WHERE club_id = $club_id ORDER BY name ASC";
        $members_result = mysqli_query($connect, $members_query);
        ?>

        <div class="members-grid">
            <?php while ($member = mysqli_fetch_assoc($members_result)) { ?>

                <div class="member-card">

                    <?php if ($member['profile_photo']) { ?>
                        <img class="member-photo"
                            src="/Student_Clubs_CMS/uploads/member_photos/<?php echo $member['profile_photo']; ?>">
                    <?php } else { ?>
                        <div class="member-photo placeholder"></div>
                    <?php } ?>

                    <div class="member-info">
                        <h3><?php echo $member['name']; ?></h3>
                        <p><?php echo $member['role']; ?></p>
                    </div>

                </div>

            <?php } ?>
        </div>

        <!-- Join Button -->
        <?php if (!isset($_SESSION['user_logged_in'])) { ?>
            <a href="login.php" class="join-btn">Become a Member</a>
        <?php } else { ?>
            <a href="#joinForm" class="join-btn">Become a Member</a>
        <?php } ?>


        <!-- JOIN FORM (Only for Logged-in Users) -->
        <?php if (isset($_SESSION['user_logged_in'])) { ?>

            <div id="joinForm" class="join-form-section">

                <!-- Success Message -->
                <?php if (isset($_GET['joined']) && $_GET['joined'] == 1) { ?>
                    <div class="success-box">You are now a member of this club!</div>
                <?php } ?>

                <?php if (isset($error_msg)) { ?>
                    <div class="error-box"><?php echo $error_msg; ?></div>
                <?php } ?>

                <h2>Become a Member</h2>

                <form method="post" enctype="multipart/form-data" class="member-form">

                    <label>Your Name</label>
                    <input type="text" name="name" required>

                    <label>Your Role</label>
                    <input type="text" name="role" required>

                    <label>Profile Photo (Optional)</label>
                    <input type="file" name="profile_photo">

                    <button type="submit" name="register_member" class="join-submit-btn">
                        Join Club
                    </button>

                </form>
            </div>

        <?php } ?>

    </div>

</div>

<?php include __DIR__ . "/reusable/footer.php"; ?>
