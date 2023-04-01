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
               <h2>INVENTORY</h2>
                <button type="button" class="btn btn-sm btn btn-outline-success"
                 style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .5rem;"
                 data-bs-toggle="modal" 
                 data-bs-target="#product">
                  ADD NEW PRODUCT
                </button>
                <a href="code.php?exportInventory" class="btn btn-sm btn btn-outline-success">Export</a>
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
                        <th>Action</th>
                        <th>Product Name</th>
                        <th>Band Name</th>
                        <th>Unit Price</th>
                        <th>Stock</th>
                        <th>Sold Stock</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php 
                        $stmt = $pro->runQuery("SELECT * FROM inventory");
                        $stmt->execute();
                        $arrayProduct = array();  
                        $count = $stmt->rowCount();
                        if($count > 0){
                          while($rowProduct = $stmt->fetch(PDO::FETCH_ASSOC)){     
                            $arrayProduct[] = $rowProduct;
                        }}
                        foreach($arrayProduct as $row){
                    
                      ?>
                      <tr>
                      <td><a href="#" class=" btn btn-sm btn-outline-info"  data-bs-toggle="modal"data-bs-target="#editProduct<?php echo $row['invt_id']; ?>">Edit</a>
                      <a href="#" class="btn btn-sm btn-outline-success" style="text-decoration: none ;"data-bs-toggle="modal" data-bs-target="#addStock<?php echo $row['invt_id']; ?>" >Add Stock</a>
                      <a href="#" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#deductStock<?php echo $row['invt_id']; ?>" >Deduct Stock</a>
                      <a class="btn btn-sm btn-outline-danger confirmation "style="text-decoration: none ;" href="productCode.php?deleteProduct=<?php echo $row['invt_id'];?>">Delete</a>
                      </td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['brand_name']; ?></td>
                        <td><?php echo number_format($row['unit_price'],2);  ?></td>
                        <td><?php echo $row['qnty']; ?></td>
                        <td><?php echo $row['sold_qnty']; ?></td>
                      </tr>
                      <?php include('modal/productModal.php'); ?>
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
      <!-- Product Modal -->
        <div class="modal fade " id="product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="productLabel">ADD NEW PRODUCT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action=<?php echo htmlspecialchars("productCode.php");?> method="post">
                    
                    <div class="form-floating mb-3">
                        <input type="text" name="productName" autocomplete="off" class="form-control" id="productName" placeholder="Product Name" required>
                        <label for="productName">Product Name</label>
                    </div>  
                        
                    <div class="form-floating mb-3">
                        <input type="text" name="brandName" autocomplete="off" class="form-control" id="brandName" placeholder="Brand Name" required >
                        <label for="brandName">Brand Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" step="0.01" autocomplete="off" name="unitPrice" class="form-control" id="unitPrice" placeholder="Unit Price" required >
                        <label for="unitPrice">Unit Price</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="quantity" autocomplete="off" class="form-control" id="quantity" placeholder="Quantity" required >
                        <label for="quantity">Quantity</label>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary btn-login text-uppercase fw-bold" name="addProduct" type="submit">Save</button>
                    </div>
                    <hr class="my-4">
                    </form>
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