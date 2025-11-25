<?php 
include __DIR__ . "/../reusable/header.php"; 
require_once __DIR__ . "/../../config/db.php";

$query = "
    SELECT event_photos.*, events.title AS event_title 
    FROM event_photos 
    LEFT JOIN events ON event_photos.event_id = events.id
    ORDER BY event_photos.id ASC
";
$result = mysqli_query($connect, $query);
?>

<div class="page-header-actions">
    <h1 class="page-title">Event Photo Gallery</h1>
    <a href="upload.php" class="btn-primary">Upload Photos</a>
</div>

<div class="table-container">
<table class="admin-table wide-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Event</th>
            <th>Photo</th>
            <th>Uploaded At</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['event_title']; ?></td>

            <td>
                <img src="/Student_Clubs_CMS/uploads/event_gallery/<?php echo $row['photo']; ?>" 
                     width="70" height="70" style="border-radius:6px; object-fit:cover;">
            </td>

            <td><?php echo $row['created_at']; ?></td>

            <td>
                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this photo?');" class="action-btn btn-delete">
                    Delete
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>

<?php include __DIR__ . "/../reusable/footer.php"; ?>
