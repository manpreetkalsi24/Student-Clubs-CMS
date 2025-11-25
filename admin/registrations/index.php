<?php 
include __DIR__ . "/../reusable/header.php"; 
require_once __DIR__ . "/../../config/db.php";

// Fetch all registrations with event titles
$query = "SELECT event_registrations.*, events.title AS event_title
          FROM event_registrations
          LEFT JOIN events ON event_registrations.event_id = events.id
          ORDER BY event_registrations.created_at DESC";

$result = mysqli_query($connect, $query);
?>

<h2>Event Registrations</h2>

<table class="admin-table">
    <tr>
        <th>Sr. No.</th>
        <th>Event</th>
        <th>Name</th>
        <th>Email</th>
        <th>Registered At</th>
    </tr>

    <?php 
    $sn=1;
    while($reg = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $reg['event_title']; ?></td>
            <td><?php echo $reg['name']; ?></td>
            <td><?php echo $reg['email']; ?></td>
            <td><?php echo $reg['created_at']; ?></td>
        </tr>
    <?php } ?>
</table>

<?php include __DIR__ . "/../reusable/footer.php"; ?>
