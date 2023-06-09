 <main class="mt-5 pt-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <h4 class="me-3 ">SALES Record</h4>
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
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Band Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Date Purchased</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php 
                        $stmt = $pos->runQuery("SELECT pos.pos_id, inventory.invt_id, inventory.name, inventory.brand_name, inventory.unit_measurement, pos.unit_price, pos.qnty, pos.total, pos.status, pos.date_process, pos.date_process
                        FROM `pos` 
                        INNER JOIN inventory 
                        ON pos.invt_id = inventory.invt_id 
                        WHERE status ='completed' 
                        AND date(pos.date_process) = date(NOW()) 
                        ORDER BY pos_id DESC");
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
                          $date = new DateTime($row['date_process']);
                          $date = $date->format('F d Y');
                      ?>
                      <tr>
                      <td><?php echo $row['invt_id']; ?></td>
                        <td><?php echo $row['name'].' '.$row['unit_measurement']; ?></td>
                        <td><?php echo $row['brand_name']; ?></td>
                        <td><?php echo number_format($row['unit_price'],2); ?></td>
                        <td><?php echo $row['qnty']; ?></td>
                        <td><?php echo number_format($row['total'],2); ?></td>
                        <td><?php echo $date; ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                          <th colspan="6" style="text-align:right">Sub Total:</th>
                          <th><?php echo number_format($total,2); ?></th>
                      </tr>
                      <tr>
                          <th colspan="6" style="text-align:right">VAT:</th>
                          <th>12%</th>
                      </tr>
                      <tr>
                          <th colspan="6" style="text-align:right">Total:</th>
                          <th><?php echo number_format($total+($total*0.12),2); ?></th>
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
    </main>