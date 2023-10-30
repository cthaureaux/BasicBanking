<?php
include("navbar.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Financial Calculator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class = "bg-light">
  <div class="container mt-5 mb-5">
    <div class="card shadow">
      <h1 class="card-header text-center">Financial Calculator</h1>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mx-auto">
            <form>
              <div class="form-group">
                <label for="principal">Principal Amount:</label>
                <input type="number" class="form-control" id="principal" required>
              </div>
              <div class="form-group">
                <label for="interest">Interest Rate:</label>
                <input type="number" class="form-control" id="interest" required>
              </div>
              <div class="form-group">
                <label for="years">Years:</label>
                <input type="number" class="form-control" id="years" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Calculate</button>
              </div>
            </form>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-6 mx-auto">
            <h4 class="text-center mb-4">Results</h4>
            <table class="table">
              <tbody>
                <tr>
                  <td>Interest Earned:</td>
                  <td id="interestEarned"></td>
                </tr>
                <tr>
                  <td>Total Amount:</td>
                  <td id="totalAmount"></td>
                </tr>
                <tr>
                  <td>Monthly Payment:</td>
                  <td id="monthlyPayment"></td>
                </tr>
              </tbody>
            </table>
            <div class="alert alert-danger" id="errorDiv" style="display: none;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $('form').submit(function(event) {
        event.preventDefault();
        var principal = parseFloat($('#principal').val());
        var interest = parseFloat($('#interest').val());
        var years = parseFloat($('#years').val());
        var monthlyInterest = interest / 12 / 100;
        var months = years * 12;
        var interestEarned = (principal * interest * years) / 100;
        var totalAmount = principal + interestEarned;
        var monthlyPayment = totalAmount / months;
        if (isNaN(interestEarned) || isNaN(totalAmount) || isNaN(monthlyPayment) ||isNaN(principal) || isNaN(interest) || isNaN(years)) {
            $('#errorDiv').text('Please enter valid numbers').show();
            } else {
            $('#interestEarned').text('$' + interestEarned.toFixed(2));
            $('#totalAmount').text('$' + totalAmount.toFixed(2));
            $('#monthlyPayment').text('$' + monthlyPayment.toFixed(2));
            $('#errorDiv').hide();
        }
        });
    });
</script>
</body>
<br><br><?php
include("footer.html")
?>
</html>