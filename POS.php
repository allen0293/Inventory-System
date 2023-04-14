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
                        <th>Product Name</th>
                        <th>Band Name</th>
                        <th>Unit Price</th>
                        <th>Stock Remaining</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php 
                        $stmt = $pos->runQuery("SELECT * FROM inventory where qnty > 0  ");
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
                      <a href="#" class="btn btn-sm btn-outline-success" style="text-decoration: none ;" data-bs-toggle="modal" data-bs-target="#addStock<?php echo $row['invt_id']; ?>" ><i class="fa-solid fa-circle-plus"></i> Add To Queue</a>
                      </td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['brand_name']; ?></td>
                        <td><?php echo number_format($row['unit_price'],2); ?></td>
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

        <!--QUEUE TABLE-->
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <h4 class="me-3 ">ON QUEUE</h4>
                <button type="button" class="btn btn-sm btn btn-outline-success"
                 style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .5rem;"
                 data-bs-toggle="modal" 
                 data-bs-target="#payment">
                 <i class="fa-solid fa-money-bill"></i> Complete Payment
                </button>
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
                        <th>Product Name</th>
                        <th>Band Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php 
                        $stmt = $pos->runQuery("SELECT pos.pos_id, inventory.invt_id, inventory.name, inventory.brand_name, pos.unit_price, pos.qnty, pos.total, pos.status 
                        FROM `pos` 
                        INNER JOIN inventory 
                        ON pos.invt_id = inventory.invt_id 
                        WHERE status ='pending'");
                        $stmt->execute();
                        $arrayPos = array();
                        $total = 0;  
                        $count = $stmt->rowCount();
                        if($count > 0){
                          while($rowPos = $stmt->fetch(PDO::FETCH_ASSOC)){     
                            $arrayPos[] = $rowPos;
                        }}
                        foreach($arrayPos as $row){
                          $total = $total + $row['total'];
                      ?>
                      <tr>
                        <td>
                        <a class="btn btn-sm btn-outline-danger confirmation" href="POSCode.php?posId=<?php echo $row['pos_id'];?>&invtId=<?php echo $row['invt_id'];?>&qnty=<?php echo $row['qnty'];?>"><i class="fa-solid fa-trash"></i> Delete</a>
                        </td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['brand_name']; ?></td>
                        <td><?php echo number_format($row['unit_price'],2); ?></td>
                        <td><?php echo $row['qnty']; ?></td>
                        <td><?php echo number_format($row['total'],2); ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                          <th colspan="5" style="text-align:right">Total:</th>
                          <th id="totalTable"><?php echo number_format($total,2); ?></th>
                      </tr>
                  </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      <!-- Payment Modal -->
   <div class="modal fade " id="payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
        <div class="modal-header ">
            <h5 class="modal-title" id="productLabel">COMPLETE PAYMENT</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action=<?php echo htmlspecialchars("POSCode.php");?> method="post">              
                <div class="form-floating mb-3">
                    <input type="number"  name="amount" autocomplete="off"  class="form-control" id="amount" placeholder="Amount" required >
                    <label for="amount">Amount</label>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary btn-login text-uppercase fw-bold" name="amountendered" id="amountendered" type="submit">submit</button>
                </div>
                <hr class="my-4">
                </form>
        </div>
        </div>
    </div>
    </div>
<!-- Add to Que Modal-->
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
   
    const amountEnteredInput = document.getElementById('amount');
    const totalTable = document.getElementById("totalTable").innerHTML;
    const submitButton = document.getElementById('amountendered');


    submitButton.disabled = true;

    amountEnteredInput.addEventListener('input', () => {
  if (amountEnteredInput.value === '' || parseFloat(amountEnteredInput.value) < parseFloat(totalTable)) {
    submitButton.disabled = true;
  } else {
    submitButton.disabled = false;
  }
});
  </script>
 </body>
</html>