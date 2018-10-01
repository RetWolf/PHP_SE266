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
    $arr = array();
    $max = 100;
    for ($i=0; $i < $max; $i++) { 
      $arr[$i] = $i + 1;
      if ($arr[$i] % 2 === 0 && $arr[$i] % 3 === 0) {
        echo("Fizz Buzz" . "</br>");
      } else if ($arr[$i] % 2 === 0) {
        echo("Fizz" . "</br>");
      } else if ($arr[$i] % 3 === 0) {
        echo("Buzz" . "</br>");
      } else {
        echo($arr[$i]) . "</br>";
      }
    }
  ?>
</body>
</html>