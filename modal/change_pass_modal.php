<!-- Modal -->
<div class="modal fade" id="change-pass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form action="code.php" method="post">
              
            <div class="form-floating mb-3">
                <input type="password" name="oldPassword" class="form-control" id="oldPassword" placeholder="Old Password" required>
                <label for="oldPassword">Old Password</label>
              </div>  

              <div class="form-floating mb-3">
                <input type="password" name="newPassword" class="form-control" id="newPassword" placeholder="New Password" required >
                <label for="newPassword">New Password</label>
              </div>

              <div class="form-floating mb-3">
                <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Password" required >
                <label for="confirmPassword">Confirm Password</label>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck" onclick="showPass3()" >
                <label class="form-check-label" for="rememberPasswordCheck">
                Show Password
                </label>
              </div>

              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" name="change_pass" type="submit">Save</button>
              </div>
              <hr class="my-4">
            </form>
      </div>
    </div>
  </div>
</div>
<script>
    function showPass3() { 
  var x = document.getElementById("oldPassword");
  var y = document.getElementById("newPassword");
  var z = document.getElementById("confirmPassword");

  if (x.type === "password") {
    x.type = "text";
    y.type = "text";
    z.type = "text";
  } else {
    x.type = "password";
    y.type = "password";
    z.type = "password";
  }
}
</script>