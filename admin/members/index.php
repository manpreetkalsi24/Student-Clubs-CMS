<?php
include __DIR__ . "/../reusable/header.php";
require_once __DIR__ . "/../../config/db.php";

// Fetch all members and club names using JOIN
$query = "SELECT members.*, clubs.name AS club_name 
          FROM members 
          LEFT JOIN clubs ON members.club_id = clubs.id
          ORDER BY members.id DESC";

$result = mysqli_query($connect, $query);
?>

<div class="page-header-actions">
    <h1 class="page-title">Members List</h1>
    <a href="create.php" class="btn-primary">Add New Member</a>
</div>

<div class="table-container">
    <table class="admin-table wide-table">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Role</th>
                <th>Club</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php 
             $sn = 1;
            while ($member = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $sn++; ?></td>

                    <td>
                        <?php if ($member['profile_photo'] != "") { ?>
                            <img src="../../uploads/member_photos/<?php echo $member['profile_photo']; ?>"
                                width="60" height="60" style="object-fit:cover; border-radius:50%;">
                        <?php } else { ?>
                            No Photo
                        <?php } ?>
                    </td>

                    <td><?php echo $member['name']; ?></td>
                    <td><?php echo $member['role']; ?></td>
                    <td><?php echo $member['club_name']; ?></td>

                    <td>
                        <a href="edit.php?id=<?php echo $member['id']; ?>" class="action-btn btn-edit">Edit</a>
                        <a href="delete.php?id=<?php echo $member['id']; ?>"
                            class="action-btn btn-delete"
                            onclick="return confirm('Are you sure you want to delete this member?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . "/../reusable/footer.php"; ?>