<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    include("includes/header.php");
    if(!$_SESSION['username_key'] && !$_SESSION['recovery_key']){
        header('Location: login.php');
    }
?>
<body>
    <div style="width: 900px; margin:auto;">
        <div class="container">
            <div class="card mt-5">
                <h5 class="card-header">CHANGE PASSWORD</h5>
                <div class="card-body">
                <form action="code.php" method="post">                    
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="recovery_key" required >
                        <label for="floatingInput">New Password</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck" onclick="showPass3()" >
                        <label class="form-check-label" for="rememberPasswordCheck">
                        Show Password
                        </label>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-login text-uppercase fw-bold" name="new_pass" type="submit">Submit</button>
                    </div>
                    <hr class="my-4">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    function showPass3() { 
  var x = document.getElementById("password");

  if (x.type === "password") {
    x.type = "text";

  } else {
    x.type = "password";
  }
}
</script>