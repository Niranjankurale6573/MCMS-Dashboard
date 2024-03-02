

<?php
$con=mysqli_connect("$server","root","","dashboard");


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


$quer="SELECT `Sector_Type`, COUNT(*) AS sectorcont FROM attachement_2 GROUP BY `Sector_Type` HAVING COUNT(*) = ( SELECT MAX(sectorcont) FROM ( SELECT COUNT(*) AS sectorcont FROM attachement_2 GROUP BY `Sector_Type` ) AS counts );";
$que=mysqli_query($con,$quer);

if ($que->num_rows > 0) {
  while ($row = $que->fetch_assoc()) {
    $name[]= $row['Sector_Type'];
    $num[] = $row['sectorcont'];
  }
}
$coun="SELECT COUNT(*)  FROM attachement_2";
$ct=mysqli_query($con,$coun);

if ($ct->num_rows > 0) {
  while ($row = $ct->fetch_assoc()) {
    $cunt[]= $row['COUNT(*)'];
  }
}

?>
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
        width: 70vw;
        height: 40px;
        background: #1A1A1A;
        color: rgba(54, 162, 235, 1);
      }
      .chartMenu p {
        padding: 10px;
        font-size: 20px;
      }
      .chartCard {
        width: 70vw;
        height: calc(100vh - 40px);
        background: rgba(54, 162, 235, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .chartBox {
        width: 600px;
        padding: 20px;
        border-radius: 20px;
        border: solid 3px rgba(54, 162, 235, 1);
        background: white;
      }
    </style>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">MSCS</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
      </ul>
    </nav><!-- End Icons Navigation -->
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <a href="tables-data.php">
              <i class="bi bi-circle"></i><span>Matrics Tables</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="charts-chartjs.php">
              <i class="bi bi-circle"></i><span>Chart Visualization</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">
            <!-- Sales Card -->
            <div class="col-xxl-6 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Registered<span>| Society</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi-file-earmark-person-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                      <?php echo $cunt[0]  ?>
                      </h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-6 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Poppular <span>| Sector</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi-bookmark-heart-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php echo $name[0];  ?>
                      </h6>
                      <span class="text-success small pt-1 fw-bold"><?php echo $num[0];  ?></span> <span class="text-muted small pt-2 ps-1">registrations</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Revenue Card -->
            <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">No of Registered Society under MSCS act  <span>| Year wise</span></h5>
                  <!-- Line Chart -->
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
</script>
<!-- End Line Chart -->
    </div>
        </div>
          </div><!-- End Reports -->
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">About <span>|us</span></h5>
                  <p>
                  An Act to consolidate and amend the law relating to co-operative societies, with objects not confined to one State and serving the interests of members in more than one State, to facilitate the voluntary formation and democratic functioning of co-operatives as people's institutions based on self-help and mutual aid and to enable them to promote their economic and social betterment and to provide functional autonomy ,was being felt necessary by the various cooperative societies, and federation of various cooperative societies as well as by the Government. In order to achieve the objective The Multi State Cooperative Societies Bill was introduced in the Parliament.The bill having been passed by both the Houses of Parliament received the assent of the President on 3rd July 2002 and it came on the Statute Book as The Multi State Cooperative Societies ACT 2002 (39 of 2002).  </p>
                  <!--<?php
$conn=mysqli_connect("127.0.0.1:3308","root","","dashboard");
if($conn){
    // echo "connected";
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Constants for pagination
$resultsPerPage = 5;
$currentpage = isset($_GET['page']) ? $_GET['page'] : 1;
$startFrom = ($currentpage - 1) * $resultsPerPage;

// Query to retrieve data with pagination
$sql = "SELECT `Sr`, `Name_of_Society`, `Address`, `State`, `District`, `Date_of_Registration`, `Areaof_Operation`, `Sector_Type`
        FROM `attachement_2`
        LIMIT $startFrom, $resultsPerPage";
$result = $conn->query($sql);

// Query to count total rows for pagination
$totalResults = $conn->query("SELECT COUNT(*) AS total FROM `attachement_2`")->fetch_assoc()['total'];
$totalPages = ceil($totalResults / $resultsPerPage);

// Display data rows
if ($result->num_rows > 0) {
    echo '<table borade=2px>';
    echo '<tr><th>Sr</th><th>Name of Society</th><th>Address</th><th>State</th><th>District</th><th>Date of Registration</th><th>Area of Operation</th><th>Sector Type</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['Sr'] . '</td>';
        echo '<td>' . $row['Name_of_Society'] . '</td>';
        echo '<td>' . $row['Address'] . '</td>';
        echo '<td>' . $row['State'] . '</td>';
        echo '<td>' . $row['District'] . '</td>';
        echo '<td>' . $row['Date_of_Registration'] . '</td>';
        echo '<td>' . $row['Areaof_Operation'] . '</td>';
        echo '<td>' . $row['Sector_Type'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    // Display pagination links
    echo '<div class="pagination">';
    if ($currentpage > 1) {
        echo '<a href="?page=' . ($currentpage - 1) . '">Previous</a>';
    }
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="?page=' . $i . '">' . $i . '</a>';
    }
    if ($currentpage < $totalPages) {
        echo '<a href="?page=' . ($currentpage + 1) . '">Next</a>';
    }
    echo '</div>';
} else {
    echo 'No results found.';
}

// Close the database connection
$conn->close();
?>-->
                </div>

              </div>
            </div><!-- End Recent Sales -->
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
          <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Multi State Cooperative Societies<span>|ACT, 2002 </span></h5>
                <p>An Act to consolidate and amend the law relating to co-operative societies, with objects not confined to one State and serving the interests of members in more than one State, to facilitate the voluntary formation and democratic functioning of co-operatives as people's institutions based on self-help and mutual aid and to enable them to promote their economic and social betterment and to provide functional autonomy ,was being felt necessary by the various cooperative societies, and federation of various cooperative societies as well as by the Government. In order to achieve the objective</p>
            </div><!-- End activity item-->
          </div>
            </div><!-- End Recent Activity -->

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>MSCS</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://mscs.dac.gov.in/">MSCS</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
</html>