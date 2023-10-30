<?php
// uses mysqli
// include the database connection file
include 'db_connection.php';

// check if user is logged in as an admin
include 'LoginCheck.php';

    // check if the "Save Changes" button has been clicked
    if (isset($_POST['save_changes'])) {
        // redirect to the same page to refresh the list of announcements
        //header("Location: update_announcement.php");
        header("Location: ".$_SERVER['PHP_SELF']);
    }

// fetch all announcements from the database
$sql = "SELECT * FROM announcements";
$result = mysqli_query($db, $sql);
$announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);

// handle form submission for updating an announcement
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $announcementID = $_POST['announcementID'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $datePosted = $_POST['datePosted'];

    // update announcement in the database
    $stmt = mysqli_prepare($db, "UPDATE announcements SET title=?, description=?, datePosted=? WHERE announcementID=?");
    mysqli_stmt_bind_param($stmt, 'sssi', $title, $description, $datePosted, $announcementID);
    if (mysqli_stmt_execute($stmt)) {
        // redirect to the same page to refresh the list of announcements
        header("Location: ".$_SERVER['PHP_SELF']);
    } else {
        $error_message = "There was an error updating the announcement.";
    }
}
?>

<!-- HTML code to display a table with all announcements and an edit button -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Edit Announcements</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
            <nav class="navbar navbar-expand-lg navbar-dark bg-info ">
            <div class='container'>
                <a class="navbar-brand" href="index.php">Admin Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link" href="admin_homepage.php">Admin Dashboard</a>
                    <a class="nav-item nav-link" href="manage_bankaccount.php">View Bank Accounts</a>
                    <a class="nav-item nav-link" href="manage_announcements.php">Manage Announcements</a>
                    <a class="nav-item nav-link" href="manage_transactions.php">Manage Transactions</a>
                    <a class="nav-item nav-link" href="manage_users.php">Manage Users</a>
                    <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
            </div>
            </div>
        </nav>
    <div class="container">
    <h1 class="text-center mt-5">Edit Announcements</h1>

    <table class="table table-hover border">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date Posted</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php foreach ($announcements as $announcement) { ?>
            <tr>
                <td><?php echo $announcement['announcementID']; ?></td>
                <td><?php echo $announcement['title']; ?></td>
                <td><?php echo $announcement['description']; ?></td>
                <td><?php echo date("m/d/Y", strtotime($announcement['datePosted'])); ?></td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal<?php echo $announcement['announcementID']; ?>">
                        Edit
                    </button>
                </td>
            </tr>
            <!-- Modal for editing an announcement -->
            <div class="modal fade" id="editModal<?php echo $announcement['announcementID']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title">Edit Announcement</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <?php if (isset($error_message)) { ?>
                                <div class="alert alert-danger"><?php echo $error_message; ?></div>
                            <?php } ?>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="hidden" name="announcementID" value="<?php echo $announcement['announcementID']; ?>">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $announcement['title']; ?>" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" maxlength="255"><?php echo $announcement['description']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="datePosted">Date Posted:</label>
                                    <input type="date" class="form-control" id="datePosted" name="datePosted" value="<?php echo date('Y-m-d'); ?>" readonly>
                                </div>
                                <button type="submit" class="btn btn-primary" name="save_changes">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </table>
    <br>
        <a href="manage_announcements.php" class="btn btn-primary mt-5">Back to Manage Announcements</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $("#meditModal").modal({backdrop: true});
  });
});
</script>
</body>

<?php
    //include footer
    include 'footer.html';
?>
</html>

