<?php
$conn=mysqli_connect("127.0.0.1:3308","root","","dashboard");
if($conn){
    // echo "connected";
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Constants for pagination
$resultsPerPage = 10;
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Key metrics</title>
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
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link " data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-data.html" class="active">
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
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Key Metrics</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Matrics_Tables</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">MCMS Registration Data</h5>
              

              <!-- Table with stripped rows -->
              <h6 style="text-align: right;">Enter the Name of Society</h6>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name of Society</th>
                    <th scope="col">Address</th>
                    <th scope="col">State</th>
                    <th scope="col">District</th>
                    <th scope="col">Date of Registration</th>
                    <th scope="col">Area of Operation</th>
                    <th scope="col">Sector Type</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($result->num_rows > 0) {
   
    while ($row = $result->fetch_assoc()) {

                  ?>
                  <tr>
                    <th scope="row"><?php echo $row['Sr']; ?></th>
                    <td><?php echo $row['Name_of_Society']; ?></td>
                    <td><?php echo $row['Address']; ?></td>
                    <td><?php echo $row['State']; ?></td>
                    <td><?php echo $row['District']; ?></td>
                    <td><?php echo $row['Date_of_Registration']; ?></td>
                    <td><?php echo $row['Areaof_Operation']; ?></td>
                    <td><?php echo $row['Sector_Type']; ?></td>
                  </tr>
                  <?php }  ?> 
                </tbody>
               
             </table>
             <?php
    // Display pagination links
    echo '<div class="pagination">';
    if ($currentpage > 1) {
        echo '<a href="?page=' . ($currentpage - 1) . '">Previous &nbsp;</a>  ';
    }
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="?page=' . $i . '">&nbsp;' . $i . '&nbsp;</a>';
    }
    if ($currentpage < $totalPages) {
        echo '<a href="?page=' . ($currentpage + 1) . '">&nbsp;Next</a>';
    }
    echo '</div>';
} else {
    echo 'No results found.';
}
?>
              
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
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