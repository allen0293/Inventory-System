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
    <?php 
        if(isset($_GET['daily'])){
            include("includes/dailySales.php");
        }else if(isset($_GET['monthly'])){
            include("includes/monthlySales.php");
        }else{
            include("includes/salesTable.php");
        }
    
    ?>
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
<?php 
