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
    <?php include('includes/fontawesome.php'); ?>
    <script src="js/swal.js"></script>
    <title>MARIBETH VARIETY STORE</title>
  </head>
  <body>
    <?php
      error_reporting();
      include("includes/security.php");
      include("includes/navbar.php");
      include("includes/sidebar.php");
      require_once "classes/posClass.php";
      $pos =  new POS();
      $_SESSION['redirect']=$_SERVER['PHP_SELF'];
      if(!empty($_SESSION['invalid_input'])){
        echo'<script> swal("Warning", "'.$_SESSION['invalid_input'].'", "warning"); </script>';   
        unset($_SESSION['invalid_input']);
      }if(!empty($_SESSION['deleted'])){
        echo'<script> swal("SUCCESS", "'.$_SESSION['deleted'].'", "success"); </script>';   
        unset($_SESSION['deleted']);
      }
      if(!empty($_SESSION['empty_queue'])){
        echo'<script> swal("WARNING", "'.$_SESSION['empty_queue'].'", "warning"); </script>';   
        unset($_SESSION['empty_queue']);
      }
   ?>
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h2>POINT OF SALE</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span></span>
               <h3>PRODUCTS</h3>
              </div>
              <div class="card-body shadow">
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th>Action</th>
                        <th>Product</th>
                        <th>Band Name</th>
                        <th>Price</th>
                        <th>Stock Remaining</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php 
                        $stmt = $pos->runQuery("SELECT * FROM inventory");
                        $stmt->execute();
                        $arrayPos = array();  
                        $count = $stmt->rowCount();
                        if($count > 0){
                          while($rowPos = $stmt->fetch(PDO::FETCH_ASSOC)){     
                            $arrayPos[] = $rowPos;
                        }}
                        foreach($arrayPos as $row){
                      ?>
                      <tr>
                      <td>
                      <a href="#" class="btn btn-sm btn-outline-success" 
                      data-bs-toggle="modal" 
                      data-bs-target="#pos<?php echo $row['invt_id']; ?>" >
                      <i class="fa-solid fa-circle-plus"></i> Add To Queue</a>
                      </td>
                        <td><?php echo $row['name'].' '.$row['unit_measurement']; ?></td>
                        <td><?php echo $row['brand_name']; ?></td>
                        <td><?php echo number_format($row['sell_price'],2); ?></td>
                        <td><?php echo $row['qnty']; ?></td>
                      </tr>
                      <?php include('modal/posModal.php'); ?>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div><br>
      </div>
      </div>
    </main>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="sweetalert/sweetalert2.min.js"></script>
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