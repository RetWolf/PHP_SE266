<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Fizz Buzz</title>
</head>
<body>
  <?php
    $max = 100;
    for ($i=0; $i < $max; $i++) {
      $num = $i + 1;
      if ($num % 2 === 0 && $num % 3 === 0) {
        echo("Fizz Buzz" . "</br>");
      } else if ($num % 2 === 0) {
        echo("Fizz" . "</br>");
      } else if ($num % 3 === 0) {
        echo("Buzz" . "</br>");
      } else {
        echo($num . "</br>");
      }
    }
  ?>
</body>
</html>