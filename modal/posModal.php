<!-- Add to Que Modal -->
   <div class="modal fade " id="addStock<?php echo $row['invt_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
        <div class="modal-header ">
            <h5 class="modal-title" id="productLabel">ADD TO QUE</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action=<?php echo htmlspecialchars("POSCode.php");?> method="post">
            <h5><strong>Product Name:</strong> <?php echo $row['name'];?></h5>
            <h5><strong>Brand:</strong> <?php echo $row['brand_name'];?></h5>
            <h5><strong>Price:</strong> <?php echo $row['unit_price'];?></h5>
                <div class="form-floating mb-3 d-none">
                    <input type="text" name="productId" value="<?php echo $row['invt_id']; ?>" class="form-control" id="productId" placeholder="Product ID" required>
                    <label for="productId">Product Name</label>
                </div>  

                <div class="form-floating mb-3 d-none">
                        <input type="number" name="unitPrice" value="<?php echo $row['unit_price']; ?>" class="form-control" id="unitPrice" placeholder="Unit Price" required >
                        <label for="unitPrice">Unit Price</label>
                </div>

                <div class="form-floating mb-3 d-none">
                    <input type="number" name="stock" value="<?php echo $row['qnty']; ?>" class="form-control" id="stock" placeholder="stock" required >
                    <label for="stock">stock</label>
                </div>
                
                <div class="form-floating mb-3">
                    <input type="number"  name="quantity" autocomplete="off" value="<?php //echo $row['qnty']; ?>" class="form-control" id="quantity" placeholder="Quantity" required >
                    <label for="quantity">Quantity</label>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary btn-login text-uppercase fw-bold" name="addToQue" type="submit">Add To Que</button>
                </div>
                <hr class="my-4">
                </form>
        </div>
        </div>
    </div>
    </div>
<!-- Add to Que Modal-->
