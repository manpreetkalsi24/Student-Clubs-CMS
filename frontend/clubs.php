<?php include __DIR__ . "/reusable/header.php"; ?>

<div class="container">
    <h1>All Clubs</h1>

    <?php
    // Fetch all clubs
    $clubs_query = "SELECT * FROM clubs ORDER BY name ASC";
    $clubs_result = mysqli_query($connect, $clubs_query);
    ?>

    <div class="cards-grid">

        <?php while ($club = mysqli_fetch_assoc($clubs_result)) { ?>

            <div class="card">

                <?php if ($club['logo'] != "") { ?>
                    <img src="/Student_Clubs_CMS/uploads/club_logos/<?php echo $club['logo']; ?>"
                        width="100%" height="150"
                        style="object-fit:cover; border-radius:8px;">
                <?php } else { ?>
                    <div style="background:#eee; height:150px; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                        No Logo
                    </div>
                <?php } ?>

                <h3><?php echo $club['name']; ?></h3>

                <p style="min-height:50px;margin-bottom:20px;">
                    <?php echo substr($club['description'], 0, 80); ?>...
                </p>

                <a href="club.php?id=<?php echo $club['id']; ?>"
                    style="color:#0A3D62; font-weight:bold;">
                    View Club
                </a>
            </div>

        <?php } ?>

    </div>
</div>

<?php include __DIR__ . "/reusable/footer.php"; ?>