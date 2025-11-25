<?php include __DIR__ . "/reusable/header.php"; ?>

<h1 class="page-title">Dashboard</h1>
<p class="page-subtitle">Services of Student Clubs CMS</p>

<div class="dashboard-grid">

    <a href="/Student_Clubs_CMS/admin/clubs/index.php" class="card-link">
        <div class="card">
            <h2>Clubs</h2>
            <p>Manage student clubs</p>
        </div>
    </a>

    <a href="/Student_Clubs_CMS/admin/members/index.php" class="card-link">
        <div class="card">
            <h2>Members</h2>
            <p>View & manage members</p>
        </div>
    </a>

    <a href="/Student_Clubs_CMS/admin/events/index.php" class="card-link">
        <div class="card">
            <h2>Events</h2>
            <p>Manage clubs events</p>
        </div>
    </a>

    <a href="/Student_Clubs_CMS/admin/event_gallery/index.php" class="card-link">
        <div class="card">
            <h2>Events Gallery</h2>
            <p>Upload photos for Events</p>
        </div>
    </a>

    <a href="/Student_Clubs_CMS/admin/registrations/index.php" class="card-link">
        <div class="card">
            <h2>Registrations</h2>
            <p>View event registrations</p>
        </div>
    </a>

</div>


<?php include __DIR__ . "/reusable/footer.php"; ?>