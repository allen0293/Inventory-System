   <!-- Edit Product Details Modal -->
    <div class="modal fade " id="editProduct<?php echo $row['invt_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
        <div class="modal-header ">
            <h5 class="modal-title" id="productLabel">Edit Product Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action=<?php echo htmlspecialchars("productCode.php");?> method="post">
                
                <div class="form-floating mb-3 d-none">
                    <input type="text" name="productId" autocomplete="off" value="<?php echo $row['invt_id']; ?>" class="form-control" id="productId" placeholder="Product ID" required>
                    <label for="productId">Product ID</label>
                </div>  
                
                <div class="form-floating mb-3">
                    <input type="text" name="productName" autocomplete="off" value="<?php echo $row['name']; ?>" class="form-control" id="productName" placeholder="Product Name" required>
                    <label for="productName">Product Name</label>
                </div>  
                    
                <div class="form-floating mb-3">
                    <input type="text" name="brandName" autocomplete="off" value="<?php echo $row['brand_name']; ?>"class="form-control" id="brandName" placeholder="Brand Name" required >
                    <label for="brandName">Brand Name</label>
                </div>

                <div class="form-floating mb-3">
                        <input type="number" step="0.01" name="unitPrice" autocomplete="off" value="<?php echo $row['unit_price']; ?>" class="form-control" id="unitPrice" placeholder="Unit Price" required >
                        <label for="unitPrice">Unit Price</label>
                </div>

                <div class="d-grid">
                    <button class="btn btn-primary btn-login text-uppercase fw-bold" name="EditProduct" type="submit">Save</button>
                </div>
                <hr class="my-4">
                </form>
        </div>
        </div>
    </div>
    </div>
<!-- Add Stock Modal -->
   <div class="modal fade " id="addStock<?php echo $row['invt_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
        <div class="modal-header ">
            <h5 class="modal-title" id="productLabel">ADD STOCK</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action=<?php echo htmlspecialchars("productCode.php");?> method="post">
            <h3><?php echo $row['name']." ".$row['brand_name']; ?></h3>
                <div class="form-floating mb-3 d-none">
                    <input type="text" name="productId" autocomplete="off" value="<?php echo $row['invt_id']; ?>" class="form-control" id="productId" placeholder="Product ID" required>
                    <label for="productId">Product Name</label>
                </div>  

                <div class="form-floating mb-3 d-none">
                    <input type="text" name="productName" autocomplete="off" value="<?php echo $row['name']; ?>" class="form-control" id="productName" placeholder="Product Name" required>
                    <label for="productName">Product Name</label>
                </div>  
                    
                <div class="form-floating mb-3 d-none">
                    <input type="text" name="brandName" autocomplete="off" value="<?php echo $row['brand_name']; ?>"class="form-control" id="brandName" placeholder="Brand Name" required >
                    <label for="brandName">Brand Name</label>
                </div>

                <div class="form-floating mb-3 d-none">
                        <input type="number" name="unitPrice" autocomplete="off" value="<?php echo $row['unit_price']; ?>" class="form-control" id="unitPrice" placeholder="Unit Price" required >
                        <label for="unitPrice">Unit Price</label>
                </div>
                
                    <div class="form-floating mb-3">
                        <input type="number" name="quantity" autocomplete="off" value="<?php //echo $row['qnty']; ?>" class="form-control" id="quantity" placeholder="Quantity" required >
                        <label for="quantity">Quantity</label>
                    </div>
                <div class="d-grid">
                    <button class="btn btn-primary btn-login text-uppercase fw-bold" name="AddStock" type="submit">Save</button>
                </div>
                <hr class="my-4">
                </form>
        </div>
        </div>
    </div>
    </div>
<!-- Add Stock Modal-->

<!-- Deduct Stock Modal -->
<div class="modal fade " id="deductStock<?php echo $row['invt_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
        <div class="modal-header ">
            <h5 class="modal-title" id="productLabel">DEDUCT STOCK</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action=<?php echo htmlspecialchars("productCode.php");?> method="post">
            <h3><?php echo $row['name']." ".$row['brand_name']; ?></h3>
                <div class="form-floating mb-3 d-none">
                    <input type="text" name="productId" autocomplete="off" value="<?php echo $row['invt_id']; ?>" class="form-control" id="productId" placeholder="Product ID" required>
                    <label for="productId">Product Name</label>
                </div>  

                <div class="form-floating mb-3 d-none">
                    <input type="text" name="productName" autocomplete="off" value="<?php echo $row['name']; ?>" class="form-control" id="productName" placeholder="Product Name" required>
                    <label for="productName">Product Name</label>
                </div>  
                    
                <div class="form-floating mb-3 d-none">
                    <input type="text" name="brandName" autocomplete="off" value="<?php echo $row['brand_name']; ?>"class="form-control" id="brandName" placeholder="Brand Name" required >
                    <label for="brandName">Brand Name</label>
                </div>

                <div class="form-floating mb-3 d-none">
                        <input type="number" name="unitPrice" autocomplete="off" value="<?php echo $row['unit_price']; ?>" class="form-control" id="unitPrice" placeholder="Unit Price" required >
                        <label for="unitPrice">Unit Price</label>
                </div>
                
                    <div class="form-floating mb-3">
                        <input type="number" name="quantity" autocomplete="off" value="<?php //echo $row['qnty']; ?>" class="form-control" id="quantity" placeholder="Quantity" required >
                        <label for="quantity">Quantity</label>
                    </div>
                <div class="d-grid">
                    <button class="btn btn-primary btn-login text-uppercase fw-bold" name="deductStock" type="submit">Save</button>
                </div>
                <hr class="my-4">
                </form>
        </div>
        </div>
    </div>
    </div>
<!-- Deduct Stock Modal-->