<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Disney Votes</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
</head>
<body>
  <?php 
    include '../../utils/dbConnect.php';
    include '../../utils/disneyInfo.php';

    $results = getDisneyInfo();
  ?>
  <div class="container">
    <h1>Vote for your favorite Disney Character</h1>
    <div class="row">
      <?php foreach ($results as $result): ?>
      <?php
        $name = $result['DisneyCharacterName'];
        $id = $result['DisneyCharacterID'];
        $img = $result['DisneyCharacterImage'];
      ?>
      <div class="col-sm">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="./images/<?php echo $img; ?>" alt="<?php echo $name; ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $name; ?></h5>
            <button class="btn btn-primary" data-idx="<?php echo $id; ?>">Vote</button>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <h3 id="status"></h3>
    <div style="height:400px; width:600px">
      <canvas id="chart"></canvas>
    </div>
  </div>
  <script>
    const postData = (url, data) => {
      return fetch(url, {
          method: "POST",
          body: data,
      })
      .then(response => response.json());
    }
    const createChart = () => {
      fetch('../../utils/disneyVoteData.php')
      .then(response => response.json())
      .then(json => {
        const ctx = document.getElementById('chart');
        ctx.chart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: json[0],
                    datasets: [
                      {
                        label: "Number of Votes",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f"],
                        data: json[1],
                        borderWidth: 10
                      }
                    ]
                  },
                  options: {
                    legend: { display: false },
                    title: {
                      display: false,
                      text: 'Number of Votes By Disney Character'
                    },
                    scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true
                              }
                          }]
                      }
                  }
              });
      })
      .catch(err => console.error(err));
    }
    const updateChart = () => {
      fetch('../../utils/disneyVoteData.php', {
        cache: 'no-cache'
      })
      .then(response => response.json())
      .then(json => {
        const ctx = document.getElementById('chart');
        ctx.chart.data.datasets[0].data = json[1];
        ctx.chart.update();
      })
      .catch(err => console.error(err));
    }
    const buttons = document.querySelectorAll('button');
    const status = document.getElementById('status');
    const clickHandler = e => {
      const formData = new FormData();
      formData.append('id', e.target.dataset.idx);
      postData(`../../utils/disneyVote.php`, formData)
      .then(data => {
        status.innerText = data;
        updateChart();
      })
      .catch(err => console.error(err));
      
    }
    for(button of buttons) {
      button.addEventListener("click", clickHandler);
    }
    createChart();
  </script>
</body>
</html>