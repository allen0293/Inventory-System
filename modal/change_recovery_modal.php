<!-- Modal -->
<div class="modal fade " id="recovery-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="staticBackdropLabel">Change Recovery Key</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form action="code.php" method="post">
              
              <div class="form-floating mb-3">
                <input type="text" name="old_key" class="form-control" id="floatingInput" placeholder="Old Recovery Key" required autocomplete="off">
                <label for="floatingInput">Old Recovery key</label>
              </div>  

              <div class="form-floating mb-3">
                <input type="text" name="recovery_key" class="form-control" id="floatingInput" placeholder="New Recovery Key" required autocomplete="off">
                <label for="floatingInput">New Recovery key</label>
              </div>  

              <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required >
                <label for="password">Password</label>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck" onclick="showPass4()" >
                <label class="form-check-label" for="rememberPasswordCheck">
                Show Password
                </label>
              </div>

              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" name="new_key" type="submit">Submit</button>
              </div>
              <hr class="my-4">
            </form>
      </div>
    </div>
  </div>
</div>
<script>
  function showPass4() { 
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>