<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/swal.js"></script>
    <title>MARIBETH VARIETY STORE</title>
  </head>
  <body class="bg-light">
  <?php
    include("includes/security.php");
    include('includes/navbar.php');
    include('includes/sidebar.php');
    require_once "classes/posClass.php";
    $pos = new POS();
    $_SESSION['redirect']=$_SERVER['PHP_SELF'];


  ?>
    <main class="mt-5 pt-3 ">
      <?php
      //NOTIFICATION
      if(!empty($_SESSION['login_success'])){
        echo'<script> swal("Login Success", "Welcome '.$_SESSION["login_success"].'", "success"); </script>';   
        unset($_SESSION['login_success']);
      }if(!empty($_SESSION['oldpass_incorrect'])){
          echo'<script> swal("Incorrect Password", "'.$_SESSION["oldpass_incorrect"].'", "warning"); </script>';   
          unset($_SESSION['oldpass_incorrect']);
      }if(!empty($_SESSION['new_confirm'])){
        echo'<script> swal("Incorrect Password", "'.$_SESSION["new_confirm"].'", "warning"); </script>';   
        unset($_SESSION['new_confirm']);
      }if(!empty($_SESSION['change_pass_success'])){
        echo'<script> swal("Success!", "'.$_SESSION["change_pass_success"].'", "success"); </script>';   
        unset($_SESSION['change_pass_success']);
      }if(!empty($_SESSION['change_key_success'])){
        echo'<script> swal("Success!", "'.$_SESSION["change_key_success"].'", "success"); </script>';   
        unset($_SESSION['change_key_success']);
      }if(!empty($_SESSION['old_key'])){
        echo'<script> swal("Wrong Input", "'.$_SESSION["old_key"].'", "warning"); </script>';   
        unset($_SESSION['old_key']);
      }if(!empty($_SESSION['wrong_pass'])){
        echo'<script> swal("Wrong Input", "'.$_SESSION["wrong_pass"].'", "warning"); </script>';   
        unset($_SESSION['wrong_pass']);
      }
      //NOTIFICATION
      ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Dashboard</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card bg-primary text-white h-100">
              <div class="col d-flex justify-content-center">
                  <div class="card-body py-5 fs-3">Sales Today</div>
                  <div class="text-md py-5 font-weight-bold text-white fs-3 px-2"><?php echo number_format($pos->dailySales(),2)?></div>
              </div>
              <a href="sales.php?daily" class=" text-decoration-none text-white">
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
              </a>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="card bg-info text-white h-100">
               <div class="col d-flex justify-content-center">
                  <div class="card-body py-5 fs-3">Sales This Month</div>
                  <div class="text-md py-5 font-weight-bold fs-3 px-2"><?php echo number_format($pos->monthSales(),2)?></div>
              </div>
              <a href="sales.php?monthly" class=" text-decoration-none text-white">
                <div class="card-footer d-flex">
                  View Details
                  <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                  </span>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
              <div class="card h-100">
                <div class="card-header">
                  <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                    Daily Sales
                </div>
                <div class="card-body">
                  <canvas id="dailySales" width="400" height="200"></canvas>
                </div>
              </div>
            </div>

          <div class="col-md-6 mb-3">
              <div class="card h-100">
                <div class="card-header">
                  <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                   Monthly Sales
                </div>
                <div class="card-body">
                  <canvas id="monthlySales" width="400" height="200"></canvas>
                </div>
              </div>
            </div>
        </div>
      </div>
    </main>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/chart.min.js"></script>
  </body>
</html>
<?php 

//daily Sales
$dailyStmt = $pos->runQuery("SELECT date(trans_date) as trans_date, sum(total_amount) as sales_perday 
FROM transaction WHERE trans_date >= LAST_DAY(NOW() - INTERVAL 1 MONTH) + INTERVAL 1 DAY
AND trans_date <= LAST_DAY(NOW())  
GROUP BY date(trans_date)");
$dailyStmt->execute();
foreach ($dailyStmt as $row) {
  $day[] = $row['trans_date'];
  $sales_perday[] = $row['sales_perday'];
}
//daily Sales


//monthly Sales
$monthlyStmt= $pos->runQuery("SELECT sum(total) as total, monthname(date_process) as MONTHNAME 
FROM pos 
WHERE Year(date_process) = YEAR(NOW()) group by monthname(date_process) ORDER BY date_process");
$monthlyStmt->execute();
    foreach ($monthlyStmt as $data) {
      $month[] = $data['MONTHNAME'];
      $sales[] = $data['total'];
    }
//monthly Sales
?>
<script src="./js/script.js"></script>
  <script>
    
  const dailySales = document.getElementById('dailySales').getContext('2d');
    const Chart1 = new Chart(dailySales, {
      type: 'bar',
      data: {
          labels: <?php echo json_encode($day) ?>,
          datasets: [{
              label: 'Daily SALES',
              data: <?php echo json_encode($sales_perday)?>,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });

    const monthlySales = document.getElementById('monthlySales').getContext('2d');
    const Chart2 = new Chart(monthlySales, {
      type: 'bar',
      data: {
          labels: <?php echo json_encode($month) ?>,
          datasets: [{
              label: 'MONTHLY SALES',
              data: <?php echo json_encode($sales)?>,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
  </script>
