<?php
//uses PDO
include('db_connection.php');
include('LoginCheck.php');
include 'admin_navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Bank Account Information</title>
    <!-- Add Bootstrap links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <h1 class="text-center my-5">Bank Account Information</h1>
    <div class="container">
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Account Number</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT users.userID, users.firstName, users.lastName, users.email, accounts.accountNumber, accounts.balance FROM users INNER JOIN accounts ON users.userID = accounts.userID";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['userID'] . "</td>";
                        echo "<td>" . $row['firstName'] . "</td>";
                        echo "<td>" . $row['lastName'] . "</td>";
                        echo "<td><a href='mailto:" . $row['email'] . "'><i class='fas fa-envelope'></i></a> " . $row['email'] . "</td>";
                        echo "<td>" . $row['accountNumber'] . "</td>";
                    
                        if ($row['balance'] < 100) {
                            echo '<td class="text-danger"><i class="fas fa-dollar-sign"></i>' . $row['balance'] . '</td>';
                        } else {
                            echo '<td><i class="fas fa-dollar-sign"></i>' . $row['balance'] . '</td>';
                        }
                    
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No accounts found</td></tr>";
                }

                $db->close();
                ?>
            </tbody>
        </table>

        <a href="admin_homepage.php" class="btn btn-primary mt-3">Back to Dashboard</a>
    </div>
</body>
<?php
include 'footer.html';
?>
</html>