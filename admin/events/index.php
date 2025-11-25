<?php
include __DIR__ . "/../reusable/header.php";
require_once __DIR__ . "/../../config/db.php";

// Fetch all events and club names
$query = "SELECT events.*, clubs.name AS club_name 
          FROM events
          LEFT JOIN clubs ON events.club_id = clubs.id
          ORDER BY events.event_date DESC";

$result = mysqli_query($connect, $query);
?>

<div class="page-header-actions">
    <h1 class="page-title">Events List</h1>
    <a href="create.php" class="btn-primary">Add New Event</a>
</div>

<div class="table-container">
    <table class="admin-table wide-table">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Poster</th>
                <th>Title</th>
                <th>Date</th>
                <th>Club</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php 
            $sn = 1;
            while ($event = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $sn++; ?></td>

                    <td>
                        <?php if ($event['poster'] != "") { ?>
                            <img src="../../uploads/event_posters/<?php echo $event['poster']; ?>"
                                width="60" height="60"
                                style="object-fit:cover; border-radius:6px;">
                        <?php } else { ?>
                            No Poster
                        <?php } ?>
                    </td>

                    <td><?php echo $event['title']; ?></td>
                    <td><?php echo $event['event_date']; ?></td>
                    <td><?php echo $event['club_name']; ?></td>
                    <td><?php echo $event['location']; ?></td>

                    <td>
                        <a href="edit.php?id=<?php echo $event['id']; ?>" class="action-btn btn-edit">Edit</a>
                        <a href="delete.php?id=<?php echo $event['id']; ?>"
                            class="action-btn btn-delete"
                            onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . "/../reusable/footer.php"; ?>