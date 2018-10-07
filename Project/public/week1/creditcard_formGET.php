<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Credit Card Interest</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="get">
      <div class="form-group">
        <label>Amount Owed<input type="text" class="form-control" name="amountOwed" value="<?php echo isset($_GET['amountOwed']) ? $_GET['amountOwed'] : "" ?>"></label>
        <label>Interest Rate<input type="text" class="form-control" name="interestRate" value="<?php echo isset($_GET['interestRate']) ? $_GET['interestRate'] : "" ?>"></label>
        <label>Monthly Payment<input type="text" class="form-control" name="monthlyPayment" value="<?php echo isset($_GET['monthlyPayment']) ? $_GET['monthlyPayment'] : "" ?>"></label>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit">Calculate the Costs</button>
      </div>
    </form>
  </div>
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th>Month</th>
          <th>Interest Paid</th>
          <th>Owed</th>
        </tr>
      </thead>
      <tbody>
      <?php
        if(isset($_GET['amountOwed'])) {
          if($_GET['amountOwed'] !== "" && $_GET['interestRate'] !== "" && $_GET['monthlyPayment'] !== "") {
            $startingAmount = $_GET['amountOwed'];
            $month = 0;
            $interestPaid = 0;  
            $totalInterest = 0;
            while ($_GET['amountOwed'] > 0) {
              $month++;
              $interestPaid = money_format("%.2i", round($interestPaid = $_GET['amountOwed'] * $_GET['interestRate'] / 100 / 12, 2));
              $_GET['amountOwed'] = money_format("%.2i", round($_GET['amountOwed'] += $interestPaid - $_GET['monthlyPayment'], 2));
              $totalInterest += $interestPaid;
              echo(
              "<tr>
                <td>{$month}</td>
                <td>\${$interestPaid}</td>"
                .($_GET['amountOwed'] > 0 ? "<td>\${$_GET['amountOwed']}</td>" : "<td></td>").
              "</tr>"
              );
            }
            $totalCost = round($startingAmount + $totalInterest, 2);
          }
        }
      ?>
      </tbody>
    </table>
    <?php echo(isset($totalCost) ? "<p>The total cost over {$month} months was \${$totalCost}</p>" : "") ?>
  </div>
</body>
</html>