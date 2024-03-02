

<?php
$con=mysqli_connect("127.0.0.1:3308","root","","dashboard");

$sql = "SELECT Date_of_Registration, COUNT(*) FROM attachement_2 GROUP BY State";
//use this--------------------------------------------------------------------------------------------------------------------------------------------------------------
// SELECT District, COUNT(*) FROM attachement_2 GROUP BY State='Maharashtra';
$result = $con->query($sql);
// Generate the bar graph using retrieved data
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $date[]= $row['Date_of_Registration'];
    $count[] = $row['COUNT(*)'];
  }
}



?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Charts</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
      }
      .chartMenu {
        width: 100vw;
        height: 40px;
        background: #1A1A1A;
        color: rgba(54, 162, 235, 1);
      }
      .chartMenu p {
        padding: 10px;
        font-size: 20px;
      }
      .chartCard {
        width: 100vw;
        height: calc(100vh - 40px);
        background: rgba(54, 162, 235, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .chartBox {
        width: 700px;
        padding: 20px;
        border-radius: 20px;
        border: solid 3px rgba(54, 162, 235, 1);
        background: white;
      }
    </style>
  </head>
  <body>



    <div class="chartMenu">
     <!-- <p>State Chart (Chart JS <span id="chartVersion"></span>)</p>-->
    </div>
   
      <div class="chartBox">
        <canvas id="myChart"></canvas>
      
           
    
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script>

const date1=<?php echo json_encode($date); ?>;
        console.log(date1); 
  const count=<?php echo json_encode($count); ?>;
        console.log(count); 
    // setup 

    const datapoint=count
    const labels = date1;
const data = {
  labels: labels,
  datasets: [{
    label: 'No of Registered Society under MSCS act year wise',
    data: count,
    fill: false,
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.1
  }]
};

    // config 
    const config = {
  type: 'line',
  data: data,
};

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );

    // Instantly assign Chart.js version
   // const chartVersion = document.getElementById('chartVersion');
    //chartVersion.innerText = Chart.version;


// function filterData()
//     {
//         const date2=[...date]
//         console.log(date2);
//         const startdate=document.getElementById('startdate');
//         const enddate=document.getElementById('enddate');
//         //Index value
//         const indexstart=date2.indexOf(startdate.value);
//         //console.log(indexstart)
//         const indexend=date2.indexOf(enddate.value);

//         //slice the array
//         const filterDate=date2.slice(indexstart,indexend + 1);
//         console.log(filterData);

//         //replace chart label
//         myChart.config.data.labels= filterDate;


//         //datapoint
//         const datapoint2=[...datapoint];
//         const filterDatapoint=datapoint2.slice(indexstart,indexend + 1);
//         myChart.config.data.datasets[0].data=filterDatapoint;

//         myChart.update();
//     }
    </script>

  </body>
</html>
