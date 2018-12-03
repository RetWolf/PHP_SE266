<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Matt Conway | SE266</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1>Matt Conway</h1>
    <p>I will be editing the file structure for the assignments soon so I can create a more helpful table</p>
    <a href="https://github.com/RetWolf/PHP_SE266">My GitHub Repo</a><br />
    <a href="http://php.net/docs.php">Official PHP Docs</a><br />
    <a href="https://phptherightway.com/">PHP The Right Way - Online Book</a><br />
    <a href="https://stackoverflow.com/">Stack Overflow</a><br />
    <?php
      $file = "index.php";
      $mod_date = date("F d Y h:i:s A", filemtime($file));
      echo("Last Modified: {$mod_date}");
    ?>
    <table class="table">
      <thead>
        <tr>
          <th>Assignment Demo</th>
          <th>Zipped Solution</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $dir = "./zipped_solutions";
          if (! is_dir($dir)) { echo("Invalid directory path"); }
          $solutions = array();
          $demos = array(
            "http://ict.neit.edu/001433733/public_html/SE266/week1/creditcard_form.php",
            "#",
            "http://ict.neit.edu/001433733/public_html/SE266/week2/",
            "http://ict.neit.edu/001433733/public_html/SE266/week3/",
            "http://ict.neit.edu/001433733/public_html/SE266/week4",
            "http://ict.neit.edu/001433733/public_html/SE266/week5",
            "http://ict.neit.edu/001433733/public_html/SE266/week6/timecardPrototype/",
            "http://ict.neit.edu/001433733/public_html/SE266/week6/timecardImplementation/",
            "http://ict.neit.edu/001433733/public_html/SE266/week8/disneyVotes/",
            "http://ict.neit.edu/001433733/public_html/SE266/week9/",
          );
          $assignments = array(
            "Credit Card Form",
            "Utility Files",
            "Lab 2 - Actors",
            "Lab 3 - Corps",
            "Lab 4 - Searching & Sorting",
            "Lab 5 - Schools",
            "Lab 6 - Timecard Prototype",
            "Lab 6 - Timecard Implementation",
            "Lab 8 - Disney Votes",
            "Final Exam - Country Data"
          );
          foreach (scandir($dir) as $file) {
            if ("." === $file) continue;
            if (".." === $file) continue;

            $solutions[] = $file;
          }
          
          for ($i=0; $i < sizeof($solutions); $i++) { 
            echo(
              "<tr>
                <td>
                  <a href='{$demos[$i]}'>{$assignments[$i]}</a>
                </td>
                <td>
                  <a href='./zipped_solutions/{$solutions[$i]}'>{$solutions[$i]}</a>
                </td>
              </tr>"
            );
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>