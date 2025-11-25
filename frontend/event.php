<?php
include __DIR__ . "/reusable/header.php";
// Check ID
if (!isset($_GET['id'])) {
    echo "<h2>Invalid Event ID</h2>";
    include __DIR__ . "/reusable/footer.php";
    exit;
}

$event_id = $_GET['id'];

// Fetch event details
$query = "SELECT events.*, clubs.name AS club_name
          FROM events 
          LEFT JOIN clubs ON events.club_id = clubs.id
          WHERE events.id = $event_id
          LIMIT 1";

$result = mysqli_query($connect, $query);
$event = mysqli_fetch_assoc($result);

if (!$event) {
    echo "<h2>Event Not Found</h2>";
    include __DIR__ . "/reusable/footer.php";
    exit;
}
?>

<div class="container">

    <h1><?php echo $event['title']; ?></h1>

    <!-- Poster -->
    <div class="event_banner">
        <?php if ($event['poster'] != "") { ?>
            <img src="/Student_Clubs_CMS/uploads/event_posters/<?php echo $event['poster']; ?>" alt="Event Poster">
        <?php } ?>
    </div>

    <!-- Event Details -->
    <div class="card" style="padding:20px;">
        <p><strong>Club:</strong> <?php echo $event['club_name']; ?></p>
        <p><strong>Date:</strong> <?php echo $event['event_date']; ?></p>
        <p><strong>Location:</strong> <?php echo $event['location']; ?></p>

        <h3>Description</h3>
        <p style="font-size:16px; line-height:1.6;">
            <?php echo nl2br($event['description']); ?>
        </p>
        <a href="event_registration.php?event_id=<?php echo $event_id; ?>"
            style="display:inline-block; padding:12px 18px; background:#0A3D62; color:white; 
          border-radius:6px; text-decoration:none; margin-top:20px;">
            Register For This Event
        </a>
    </div>

    <br>
    <hr><br>

    <!-- Event Photo Gallery  -->

    <h2>Event Photo Gallery</h2>

    <?php
    $photos = mysqli_query(
        $connect,
        "SELECT * FROM event_photos WHERE event_id = $event_id ORDER BY id DESC"
    );
    ?>

    <div class="gallery-grid">
        <?php if (mysqli_num_rows($photos) == 0) { ?>
            <p>No photos uploaded for this event yet.</p>
        <?php } else { ?>
            <?php while ($photo = mysqli_fetch_assoc($photos)) { ?>
                <img src="/Student_Clubs_CMS/uploads/event_gallery/<?php echo $photo['photo']; ?>"
                    alt="Event gallery image">
            <?php } ?>
        <?php } ?>
    </div>

</div>
<?php include __DIR__ . "/reusable/footer.php"; ?>