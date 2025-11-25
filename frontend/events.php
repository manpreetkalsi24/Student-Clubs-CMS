<?php include __DIR__ . "/reusable/header.php"; ?>

<div class="container">

    <h1>All Events</h1>

    <?php
    // Fetch all events and their clubs
    $query = "SELECT events.*, clubs.name AS club_name 
          FROM events 
          LEFT JOIN clubs ON events.club_id = clubs.id
          ORDER BY events.event_date DESC";

    $result = mysqli_query($connect, $query);
    ?>

    <div class="cards-grid">

        <?php while ($event = mysqli_fetch_assoc($result)) { ?>

            <div class="card">

                <?php if ($event['poster'] != "") { ?>
                    <img src="/Student_Clubs_CMS/uploads/event_posters/<?php echo $event['poster']; ?>"
                        width="100%" height="150"
                        style="object-fit:cover; border-radius:8px;">
                <?php } else { ?>
                    <div style="background:#eee; height:150px; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                        No Poster
                    </div>
                <?php } ?>

                <h3><?php echo $event['title']; ?></h3>

                <p><strong>Date:</strong> <?php echo $event['event_date']; ?></p>
                <p><strong>Location:</strong> <?php echo $event['location']; ?></p>

                <p style="min-height:50px;">
                    <?php echo substr($event['description'], 0, 70); ?>...
                </p>

                <a href="event.php?id=<?php echo $event['id']; ?>"
                    style="color:#0A3D62; font-weight:bold;">
                    View Event
                </a>

            </div>

        <?php } ?>

    </div>
</div>

    <?php include __DIR__ . "/reusable/footer.php"; ?>