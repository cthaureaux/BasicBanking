<html>
<head>
  <title>Your Transaction History</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<style>
    .center { /* puts image in Center of page*/
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
    }
    .img-hover {
      box-shadow: 0 5px 8px 5px rgba(0, 0, 0, .25);
      transition: all 0.6s ease;
    }
    .img-hover:hover{
        transform: scale(1.1);
    }
</style>

<body class = "bg-light">
<?php include "navbar.php";?>

<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card =" style="box-shadow: 0 5px 8px 5px rgba(0, 0, 0, .15);">
				<div class="card-header">
                <h1>Past Transactions</h1>
                </div>
				<div class="card-body">
                     <form action="results.php" method="post">
				        <div class="form-group">
                            <label for="searchtype">I am looking for:</label>
                            <select class="form-control" name="searchtype" required>
                            <option value="" disabled selected>Select History Option</option>
                            <option value="Deposit">Past Deposits
                            <option value="Withdraw">Past Withdrawals
                            <option value="all">All Account Transactions
                            </select>
                         </div>
                        <button type="submit" name="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
		</div>
	</div>
</div>

<div class="container mt-5 mb-5">
    <img src="images/money2.jpg" class="center img-hover"><br><br>
</div>

<?php
    include 'footer.html';
?>
</body>

<?php 
    include('LoginCheck.php');
?>
</html>