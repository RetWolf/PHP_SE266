<?php
  // Initialize our chartData array
  $chartData = array();
  $chartData[0] = array();
  $chartData[1] = array();
  // Organize data for use in our chart
  foreach($results as $val) {
    array_push($chartData[0], $val["Region"]);
    array_push($chartData[1], $val["Population(thousands)"]);
  }
  // Encode in a json string
  // We do this rather than using fetch to reduce DB calls.
  // We already have the data on the server, why grab the same data just formatted differently on the client?
  $chartData = json_encode($chartData);
?>

<div style="width:700px">
  <canvas id="chart"></canvas>
</div>
<script>
  // Javascript can interprete the JSON string and convert it to an array of arrays.
  const data = <?php echo $chartData; ?>;
  // Create our chart with the provided data.
  const ctx = document.getElementById('chart');
        ctx.chart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: data[0],
            datasets: [
              {
                label: "Population(thousands)",
                backgroundColor: ["#1A535C","#4ECDC4","#CDCDCD","#FF6B6B","#FFE66D","#320D6D","#FFBFB7","#700353","#4C1C00","#214E34","#364156"],
                data: data[1],
                borderWidth: 2
              }
            ]
          },
          options: {
            legend: { display: true },
            title: {
              display: true,
              text: 'Population in thousands'
            },
          }
      });
</script>