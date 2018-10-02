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
    <form action="creditcard_form.php" method="POST">
      <label>Amount Owed: <input type="text" name="amountOwed" value="<?php echo isset($_POST['amountOwed']) ? $_POST['amountOwed'] : "" ?>"></label>
      <label>Interest Rate: <input type="text" name="interestRate" value="<?php echo isset($_POST['interestRate']) ? $_POST['interestRate'] : "" ?>"></label>
      <label>Monthly Payment: <input type="text" name="monthlyPayment" value="<?php echo isset($_POST['monthlyPayment']) ? $_POST['monthlyPayment'] : "" ?>"</label>
      <button type="submit">Calculate Damage</button>
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
        if(isset($_POST['amountOwed'])) {
          $startingAmount = $_POST['amountOwed'];
          $month = 0;
          $interestPaid = 0;
          $totalInterest = 0;
          while ($_POST['amountOwed'] > 0) {
            $month++;
            $interestPaid = round($interestPaid = $_POST['amountOwed'] * $_POST['interestRate'] / 100 / 12, 2);
            $_POST['amountOwed'] = round($_POST['amountOwed'] += $interestPaid - $_POST['monthlyPayment'], 2);
            $totalInterest += $interestPaid;
            echo(
            "<tr>
              <td>{$month}</td>
              <td>\${$interestPaid}</td>"
              .($_POST['amountOwed'] > 0 ? "<td>\${$_POST['amountOwed']}</td>" : "<td></td>").
            "</tr>"
            );
          }
          $totalCost = round($startingAmount + $totalInterest, 2);
        }
      ?>
      </tbody>
    </table>
    <?php echo("<p>The total cost over {$month} months was \${$totalCost}</p>"); ?>
  </div>
</body>
</html>