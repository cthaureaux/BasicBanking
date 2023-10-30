<?php
include 'LoginCheck.php';
include 'db_connection.php';
include 'admin_navbar.php';
include 'footer.html';

// Query all users from the database
$sql = "SELECT userID, firstName, lastName FROM users ORDER BY lastName ASC";
$result = mysqli_query($db, $sql);

// Count the number of users in the database
$num_users = mysqli_num_rows($result);

// Check if a specific user is selected and get their transactions
if (isset($_GET['userID']) && is_numeric($_GET['userID'])) {
  $userID = $_GET['userID'];

  // Query the user's name from the database
  $sql = "SELECT firstName, lastName FROM users WHERE userID = $userID";
  $result = mysqli_query($db, $sql);
  $user = mysqli_fetch_assoc($result);

  // Query the transactions for the selected user
  $sql = "SELECT t.transactionID, t.transactionType, t.amount, a.accountNumber
          FROM transactions t
          INNER JOIN accounts a ON t.accountNumber = a.accountNumber
          WHERE a.userID = $userID
          ORDER BY t.transactionID DESC";
  $result = mysqli_query($db, $sql);
  $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Transactions</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="bg-overlay"></div>
  <div class="container mt-3">
    <h1>Manage Transactions</h1>

    <?php if (!isset($transactions)): ?>
      <h2>Select User: <?php echo $num_users; ?> total users</h2>
      <ul>
        <?php while ($user = mysqli_fetch_assoc($result)): ?>

        <li class = "mt-3"style="list-style-type: none;">
            <a href="?userID=<?php echo $user['userID']; ?>">
            <i class="fas fa-user"></i>
                <?php echo $user['firstName'] . ' ' . $user['lastName']; ?>
            </a>
        </li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <h2>User Transactions: <?php echo $user['firstName'] . ' ' . $user['lastName']; ?></h2>
      <?php if (empty($transactions)): ?>
    <div class="alert alert-danger text-center mt-4" role="alert">
        There are no transactions for this user.
    </div>
      <?php else: ?>
        <table class="table table-hover table-bordered mt-3 mb-5">
          <thead class="thead-light">
            <tr>
              <th>Transaction ID</th>
              <th>Transaction Type</th>
              <th>Amount</th>
              <th>Account Number</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($transactions as $transaction): ?>
              <tr>
                <td><?php echo $transaction['transactionID']; ?></td>
                <td>
                  <?php
                    if ($transaction['transactionType'] == 'Deposit') {
                      echo '<i class="fas fa-plus" style="color: green;"></i> ';
                    } else if ($transaction['transactionType'] == 'Withdrawal'){
                      echo '<i class="fas fa-minus" style="color: red;"></i> ';
                    }
                    echo $transaction['transactionType'];
                  ?>
                </td>
                <td>$<?php echo $transaction['amount']; ?></td>
                <td><?php echo $transaction['accountNumber']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table><br>
      <?php endif; ?>
    <?php endif; ?>

  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNSBXTs" crossorigin="anonymous"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>