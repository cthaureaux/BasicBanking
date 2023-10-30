<?php
include('db_connection.php');
include('LoginCheck.php');
include 'admin_navbar.php';

if (isset($_POST['save_changes'])) {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Check if email already exists in the database
    $stmt = $db->prepare("SELECT userID FROM users WHERE email = ? AND userID != ?");
    $stmt->bind_param("si", $email, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists, display danger alert
        echo "<div class='alert alert-danger text-center' role='alert'><b>Error:</b> The email entered is already in use. Please choose another email.</div>";
    } else {
        // Update user details in database - prevents SQL injections using bind_param
        $stmt = $db->prepare("UPDATE users SET firstName=?, lastName=?, email=? WHERE userID=?");
        $stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);
        if ($stmt->execute()) {
            // User information updated successfully, display success alert
            echo "<div class='alert alert-success text-center' role='alert'>User information updated successfully.</div>";
        } else {
            // Error updating user information, display danger alert
            echo "<div class='alert alert-danger text-center' role='alert'><b>Error</b> updating user information.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bank Customers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5">Bank Customer List</h1>
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT userID, firstName, lastName, email FROM users ORDER BY userID ASC";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['userID'] . "</td>";
                        echo "<td>" . $row['firstName'] . "</td>";
                        echo "<td>" . $row['lastName'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>";
                        echo "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#editModal" . $row['userID'] . "'>Edit</button>";
                        echo "</td>";
                        echo "</tr>";
                        
                        // Edit user modal
                        echo "<div class='modal fade' id='editModal" . $row['userID'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>";
                        echo "<div class='modal-dialog' role='document'>";
                        echo "<div class='modal-content'>";
                        echo "<div class='modal-header bg-light'>";
                        echo "<h5 class='modal-title' id='editModalLabel'>Edit User Details</h5>";
                        echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                        echo "<span aria-hidden='true'>&times;</span>";
                        echo "</button>";
                        echo "</div>";
                        echo "<form method='POST'>";
                        echo "<div class='modal-body'>";
                        echo "<div class='form-group'>";
                        echo "<label for='first_name'>First Name</label>";
                        echo "<input type='text' class='form-control' id='first_name' name='first_name' value='" . $row['firstName'] . "' required>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='last_name'>Last Name</label>";
                        echo "<input type='text' class='form-control' id='last_name' name='last_name' value='" . $row['lastName'] . "' required>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='email'>Email</label>";
                        echo "<input type='email' class='form-control' id='email' name='email' value='" . $row['email'] . "'required>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='modal-footer'>";
                        echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
                        echo "<button type='submit' class='btn btn-primary' name='save_changes'>Save changes</button>";
                        echo "<input type='hidden' name='user_id' value='" . $row['userID'] . "'>";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                }
                } else {
                echo "<tr><td colspan='5' class='text-center'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <a href="manage_users.php" class="btn btn-primary mb-5">Back to Manage Users</a> <br><br>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- dark overlay when modal popups -->
    <script>
        $(document).ready(function(){
          $("#myBtn").click(function(){
            $("#editModal").modal({backdrop: static});
          });
        });
    </script>
</body>
<?php
    include('footer.html');
?>
</html>