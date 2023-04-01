<?php 
date_default_timezone_set('Asia/Manila');
session_start();
error_reporting();
require_once('tcpdf_min/tcpdf.php');  
require_once "classes/posClass.php";
$pos = new POS();
if(!$_SESSION['amount']){
    echo"<script>window.location.replace('POS.php');</script>";
  }
function pdf($content){  
    require_once('tcpdf_min/tcpdf.php');  
    $obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetTitle("MARIBETH VARIETY STORE");  
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $obj_pdf->SetDefaultMonospacedFont('helvetica');  
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
    $obj_pdf->setPrintHeader(false);  
    $obj_pdf->setPrintFooter(true);  
    $obj_pdf->SetAutoPageBreak(TRUE, 10);  
    $obj_pdf->SetFont('helvetica', '', 11);  
    $obj_pdf->AddPage('P','A5'); 
    
    $obj_pdf->writeHTML($content);  
    $tDate = date("F j, Y h:i:sa");
    $obj_pdf->Cell(0, 10, 'Date : '.$tDate, 0, false, 'R', 0, '', 0, false, 'T', 'M');
    ob_end_clean();
    $obj_pdf->Output('receipt.pdf', 'I');  
}


if(isset($_POST["receipt"]))  
 {  
        if(!$_SESSION['amount']){
        echo"<script>window.location.replace('POS.php');</script>";
      }
      $content = '';  
      $content .= '
        <h2 align="center">MARIBETH VARIETY STORE</h2>
        <h4 align="center">Receipt</h4> 
        <table border="1" cellspacing="0" cellpadding="3" align="center" style="font-size: 11px;">
                            <thead>
                              <tr style="font-weight: bold;">                                                             
                              <th>Product Name</th>
                              <th>Band Name</th>
                              <th>Unit Price</th>
                              <th>Quantity</th>
                              <th>Total</th>                    
                            </tr>
                            </thead>
                            ';  
      $content .= fetch_receipt();  
      $content .= '</table> ';  
      $pos->updateProcessedItems();
      pdf($content);
      unset($_SESSION['amount']);
 }  

 function fetch_receipt(){
    $pos = new POS();
    $output='';
        $stmt = $pos->runQuery("SELECT pos.pos_id, inventory.invt_id, inventory.name, inventory.brand_name, pos.unit_price, pos.qnty, pos.total, pos.status 
        FROM `pos` 
        INNER JOIN inventory 
        ON pos.invt_id = inventory.invt_id 
        WHERE status = 'pending'");
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
           $output .='
                <tr> 
                <td>'.$row['name'].'</td>
                <td>'.$row['brand_name'].'</td>
                <td>'.number_format($row['unit_price'],2).'</td>
                <td>'.$row['qnty'].'</td>
                <td>'.number_format($row['total'],2).'</td>      
              </tr>  
              ';
            }
            $change = $_SESSION['amount']-$total;
            $pos->insertTransaction($_SESSION['amount'],$total,$change);
            $pos->updateTransIdOnPos();
            $output .='
                <tfoot>
                <tr>
                    <th colspan="5" style="text-align:right"><b>Total:</b> '.number_format($total,2).'</th>
                </tr>
                <tr>
                    <th colspan="5" style="text-align:right"><b>Tendered Cash:</b> '.number_format($_SESSION['amount'],2).'</th>
                </tr>
                <tr>
                    <th colspan="5" style="text-align:right"><b>Change:</b> '.number_format($change,2).'</th>
                </tr>
            </tfoot>
            ';
            $trans_no = $pos->selectTransactionId();
            $output .='Transaction no: '.$trans_no.'';
            return $output; 
 }
?>