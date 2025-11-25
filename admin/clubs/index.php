<?php
include __DIR__ . "/../reusable/header.php";
require_once __DIR__ . "/../../config/db.php";

// Fetch all clubs
$query = "SELECT * FROM clubs ORDER BY id DESC";
$result = mysqli_query($connect, $query);
?>


<div class="page-header-actions">
    <h1 class="page-title">Clubs List</h1>
    <a href="create.php" class="btn-primary">Add New Club</a>
</div>

<div class="table-container">
    <table class="admin-table wide-table">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Logo</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sn = 1;
            while ($club = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $sn++; ?></td>

                    <td>
                        <?php if ($club['logo'] != "") { ?>
                            <img src="../../uploads/club_logos/<?php echo $club['logo']; ?>"
                                width="60" height="60" style="object-fit:cover; border-radius:5px;">
                        <?php } else { ?>
                            No Image
                        <?php } ?>
                    </td>

                    <td><?php echo $club['name']; ?></td>
                    <td>
                        <?php
                        echo strlen($club['description']) > 80
                            ? substr($club['description'], 0, 80) . "..."
                            : $club['description'];
                        ?>
                    </td>

                    <td>
                        <a href="edit.php?id=<?php echo $club['id']; ?>" class="action-btn btn-edit">Edit</a>
                        <a href="delete.php?id=<?php echo $club['id']; ?>" class="action-btn btn-delete"
                            onclick="return confirm('Are you sure you want to delete this club?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . "/../reusable/footer.php"; ?>