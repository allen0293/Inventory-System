<?php 
    require_once "database.php";

    class Product{
        private $conn;

        public function __construct(){
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }

        //Execute Queries SQL
        public function runQuery($sql){
            $stmt =  $this->conn->prepare($sql);
            return $stmt;
        }
        //INSERT NEW PRODUCT RECORD
        public function insertProduct($productName,$brandName,$unitPrice,$selling_price,$qnty,$measurement,$supplier){
            try {
                $stmt = $this->conn->prepare("INSERT INTO inventory(name, brand_name, unit_price, sell_price, qnty, unit_measurement, supplier) 
                VALUES(:productName, :brandName, :unitPrice, :selling_price, :qnty, :measurement, :supplier )");
                $stmt->bindparam(":productName", $productName);
                $stmt->bindparam(":brandName", $brandName);
                $stmt->bindparam(":unitPrice", $unitPrice);
                $stmt->bindparam(":selling_price", $selling_price);
                $stmt->bindparam(":qnty", $qnty);
                $stmt->bindparam(":measurement", $measurement);
                $stmt->bindparam(":supplier", $supplier);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //INSERT NEW PRODUCT RECORD
        
        //UPDATE Product Details
        public function updateProductDetails($invt_id, $productName, $brandName,$unitPrice, $selling_price, $measurement, $supplier){
            try {
                $stmt = $this->conn->prepare("UPDATE inventory SET name = :name, brand_name = :brandName, unit_price = :unitPrice,
                sell_price = :selling_price, unit_measurement = :measurement, supplier = :supplier
                WHERE invt_id = :invt_id");
                $stmt->bindParam(":invt_id", $invt_id);
                $stmt->bindParam(":name", $productName);
                $stmt->bindParam(":brandName", $brandName);
                $stmt->bindparam(":unitPrice", $unitPrice);
                $stmt->bindparam(":selling_price", $selling_price);
                $stmt->bindparam(":measurement", $measurement);
                $stmt->bindparam(":supplier", $supplier);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //UPDATE Product Details

         //ADD Product QUANTITY
         public function AddProductStock($invt_id,$qnty){
            try {
                $stmt = $this->conn->prepare("UPDATE inventory SET qnty=qnty+:qnty WHERE invt_id = :invt_id");
                $stmt->bindParam(":invt_id", $invt_id);    
                $stmt->bindParam(":qnty",$qnty);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //ADD Product QUANTITY

        //MINUS Product QUANTITY
        public function minusProductStock($invt_id,$qnty){
            try {
                $stmt = $this->conn->prepare("UPDATE inventory SET qnty=qnty-:qnty WHERE invt_id = :invt_id");
                $stmt->bindParam(":invt_id", $invt_id);    
                $stmt->bindParam(":qnty",$qnty);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //MINUS Product QUANTITY

        //ADD SOLD STOCK 
        public function AddSoldStock($invt_id,$qnty){
            try {
                $stmt = $this->conn->prepare("UPDATE inventory SET sold_qnty=sold_qnty+:qnty WHERE invt_id = :invt_id");
                $stmt->bindParam(":invt_id", $invt_id);    
                $stmt->bindParam(":qnty",$qnty);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //ADD SOLD STOCK
        
        //MINUS SOLD STOCK 
        public function MinusSoldStock($invt_id,$qnty){
            try {
                $stmt = $this->conn->prepare("UPDATE inventory SET sold_qnty=sold_qnty-:qnty WHERE invt_id = :invt_id");
                $stmt->bindParam(":invt_id", $invt_id);    
                $stmt->bindParam(":qnty",$qnty);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //MINUS SOLD STOCK

         //DELETE PRODUCT
         public function deleteProduct($invt_id){
            try{
                $stmt = $this->conn->prepare("DELETE FROM inventory WHERE invt_id=:invt_id");
                $stmt->bindParam(":invt_id", $invt_id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        //DELETE PRODUCT
        
        public function redirect($url){
            header("location:$url");
        }
    }
?>