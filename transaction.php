<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/swal.js"></script>
    <title>MARIBETH VARIETY STORE</title>
  </head>
  <body>
    <?php
      error_reporting(0);
      include("includes/security.php");
      include("includes/navbar.php");
      include("includes/sidebar.php");
      require_once "classes/productClass.php";
      $pro =  new Product();
      $_SESSION['redirect']=$_SERVER['PHP_SELF'];
      if(!empty($_SESSION['inventory_notif'])){
        echo'<script> swal("SUCCESS", "'.$_SESSION['inventory_notif'].'", "success"); </script>';   
        unset($_SESSION['inventory_notif']);
      }if(!empty($_SESSION['update_success'])){
        echo'<script> swal("SUCCESS", "'.$_SESSION['update_success'].'", "success"); </script>';   
        unset($_SESSION['update_success']);
      }if(!empty($_SESSION['stockAdded'])){
        echo'<script> swal("SUCCESS", "'.$_SESSION['stockAdded'].'", "success"); </script>';   
        unset($_SESSION['stockAdded']);
      }if(!empty($_SESSION['stockDeducted'])){
        echo'<script> swal("SUCCESS", "'.$_SESSION['stockDeducted'].'", "success"); </script>';   
        unset($_SESSION['stockDeducted']);
      }
      if(!empty($_SESSION['deleted'])){
        echo'<script> swal("SUCCESS", "'.$_SESSION['deleted'].'", "success"); </script>';   
        unset($_SESSION['deleted']);
      }
   ?>
    <main class="mt-5 pt-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card shadow">
              <div class="card-header">
               <h2>TRANSACTION</h2>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th>Transaction Id</th>
                        <th>Total Amount</th>
                        <th>Cash</th>
                        <th>Change</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php 
                        $stmt = $pro->runQuery("SELECT * FROM transaction");
                        $stmt->execute();
                        $arrayProduct = array();  
                        $count = $stmt->rowCount();
                        if($count > 0){
                          while($rowProduct = $stmt->fetch(PDO::FETCH_ASSOC)){     
                            $arrayProduct[] = $rowProduct;
                        }}
                        foreach($arrayProduct as $row){
                          $date = new DateTime($row['trans_date']);
                          $date = $date->format('F d Y');
                    
                      ?>
                      <tr>
                        <td><?php echo $row['trans_id']; ?></td>
                        <td><?php echo number_format($row['total_amount'],2); ?></td>
                        <td><?php echo number_format($row['cash'],2);  ?></td>
                        <td><?php echo $row['trans_change']; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><a href="receipt.php?transaction=<?php echo $row['trans_id']; ?>" target="_blank" class=" btn btn-sm btn-outline-info">Print Receipt</a>

                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </main>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>

    <script>
      // JQuery confirmation
      $('.confirmation').on('click', function () {
          return confirm('Are you sure you want do delete this Product? You might not get an Accurate data if you delete it');
      });

      $(document).ready(function () {
      $(".data-table").each(function (_, table) {
        $(table).DataTable();
      });
    });

  </script>
 </body>
</html>