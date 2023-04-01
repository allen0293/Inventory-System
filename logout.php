<?php
date_default_timezone_set('Asia/Manila');
 session_start();

  if(isset($_POST['logout'])){
     session_destroy();
     unset($_SESSION['username']); 
     unset($_SESSION['user_id']); 
     unset($_SESSION['redirect']);
     header('Location: login.php');
  }

?>