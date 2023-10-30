<?php 
include('db_connection.php');
include('LoginCheck.php');

$userData=[];

$userID = $_SESSION["userID"];
$sql = "SELECT * FROM users INNER JOIN accounts ON users.userID = accounts.userID WHERE users.userID = $userID";

$res=$db->query($sql);

if($res->num_rows>0){
    $userData=$row=$res->fetch_assoc();
}
?>

<html>
    <head>
        <title>Account Details</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    </head>
    <body class="bg-light">
        <?php include "navbar.php"; ?>
        <div class='container mt-5'>
            <div class='row'>
                <div class='col-md-9 mx-auto'>
                    <h2 class='mb-4'>Checking Account Details</h2><hr>
                    <div class="card" style = "box-shadow: -7px 15px 10px rgba(0, 0, 0, 0.20); background: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);">
                        <div class="card-body">
                            <h3 class="text-muted mb-4">User</h3>
                            <p class="font-weight-bold">User ID: <?php echo $userData["userID"]; ?></p>
                            <p class="font-weight-bold">First Name:  <?php echo $userData["firstName"]; ?></p>
                            <p class="font-weight-bold">Last Name: <?php echo $userData["lastName"]; ?></p>
                            <p class="font-weight-bold">Email: <?php echo $userData["email"]; ?></p>
                            <hr>
                            <h3 class="text-muted mb-4">Account</h3>
                            <p class="font-weight-bold">Account Number: <?php echo $userData["accountNumber"]; ?></p>
                            <p class="font-weight-bold">Balance: $<?php echo $userData["balance"]; ?></p>
                            <?php if($userData["balance"] < 100): ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    Your account balance is below $100. Please <a href="transactions.php" class="alert-link">add funds</a>.
                                </div>
                            <?php endif; ?>
                        <a href="calculator.php" class="btn btn-primary">Financial Calculator</a><br>
                        </div>
                    </div>
                    <!-- 
                     -->
                </div>
            </div>
        </div>
    </body>
<?php
include('sidebar.php');
    include 'footer.html';
?>
</html>