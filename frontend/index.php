<?php include __DIR__ . "/reusable/header.php";

$subscribe_message = "";

if (isset($_POST['subscribe_email'])) {
    $email = mysqli_real_escape_string($connect, $_POST['subscribe_email']);

    mysqli_query($connect, "INSERT INTO subscribers (email) VALUES ('$email')");

    $subscribe_message = "Thank you for subscribing!";
}
?>

<!-- HERO SECTION -->
<div class="hero">
    <div class="hero-content">
        <h1>Welcome to Student Clubs Portal</h1>
        <h2>Explore Student Clubs & Events</h2>
        <p>Join communities, attend events, meet new friends, and grow your skills.</p>
        <a href="clubs.php" class="hero-btn">Browse Clubs</a>
        <a href="events.php" class="hero-btn secondary">Upcoming Events</a>
    </div>
</div>

<div class="container">
    <section class="featured-clubs">
        <h2>Featured Clubs</h2>

        <?php
        $clubs = mysqli_query($connect, "SELECT * FROM clubs LIMIT 3");
        ?>

        <div class="cards-grid">
            <?php while ($club = mysqli_fetch_assoc($clubs)) { ?>
                <div class="card">
                    <div class="club-img-box">
                        <img src="/Student_Clubs_CMS/uploads/club_logos/<?php echo $club['logo']; ?>" alt="Club Logo">
                    </div>

                    <h3><?php echo $club['name']; ?></h3>
                    <a href="club.php?id=<?php echo $club['id']; ?>">View Club</a>
                </div>
            <?php } ?>
        </div>
    </section>

    <section class="upcoming-events">

        <h2>Upcoming Events</h2>

        <?php
        $events = mysqli_query($connect, "SELECT * FROM events ORDER BY event_date ASC LIMIT 3");
        ?>

        <div class="cards-grid">
            <?php while ($event = mysqli_fetch_assoc($events)) { ?>
                <div class="card">

                    <div class="club-img-box">
                        <img src="/Student_Clubs_CMS/uploads/event_posters/<?php echo $event['poster']; ?>" alt="Event Poster">
                    </div>

                    <h3><?php echo $event['title']; ?></h3>
                    <p class="event-date"><?php echo $event['event_date']; ?></p>

                    <a href="event.php?id=<?php echo $event['id']; ?>" class="event-btn">
                        View Event
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>

    <section class="subscribe-section">
        <h2>Stay Updated!</h2>
        <p>Subscribe to get the latest updates about clubs, events, and activities.</p>

        <?php if ($subscribe_message != "") { ?>
            <div class="subscribe-success">
                <?= $subscribe_message ?>
            </div>
        <?php } ?>

        <form method="post" class="subscribe-form">
            <input type="email" name="subscribe_email" placeholder="Enter your email" required>
            <button type="submit">Subscribe Now</button>
        </form>
    </section>

    <?php include __DIR__ . "/reusable/footer.php"; ?>