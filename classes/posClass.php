<?php 
    require_once "database.php";

    class POS{
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
        //INSERT POS RECORD
        public function insertPos($productId,$unitPrice,$qnty,$total){
            try {
                $stmt = $this->conn->prepare("INSERT INTO pos(invt_id, unit_price, qnty, total, date_process, status) VALUES(:productId, :unitPrice, :qnty, :total, NOW(), 'pending')");
                $stmt->bindparam(":productId", $productId);
                $stmt->bindparam(":unitPrice", $unitPrice);
                $stmt->bindparam(":qnty", $qnty);
                $stmt->bindparam(":total", $total);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //INSERT POS RECORD
        
        //UPDATE PREOCESSED ITEMS
        public function updateProcessedItems(){
            try {
                $stmt = $this->conn->prepare("UPDATE pos set status='completed' WHERE status='pending'");
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //UPDATE PREOCESSED ITEMS

        //INSERT TRANSACTION RECORD
        public function insertTransaction($cash,$total_amount,$trans_change){
            try {
                $stmt = $this->conn->prepare("INSERT INTO transaction(cash, total_amount, trans_change, trans_date) VALUES(:cash, :total_amount, :trans_change, NOW())");
                $stmt->bindparam(":cash", $cash);
                $stmt->bindparam(":total_amount", $total_amount);
                $stmt->bindparam(":trans_change", $trans_change);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //INSERT TRANSACTION RECORD 


        //UPDATE TRANSACTION ID IN POS TABLE
        public function updateTransIdOnPos(){
            try {
                $stmt = $this->conn->prepare("UPDATE pos set trans_id=(SELECT trans_id from transaction GROUP BY trans_id DESC LIMIT 1) WHERE trans_id=0");
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //UPDATE TRANSACTION ID IN POS TABLE

        //SELECT TRANSACTION ID
        public function selectTransactionId(){
            try {
                $stmt = $this->conn->prepare("SELECT trans_id from transaction GROUP BY trans_id DESC LIMIT 1");
                $stmt->execute();
                $trans_no=$stmt->fetch(PDO::FETCH_ASSOC);
                return $trans_no['trans_id'];
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //SELECT TRANSACTION ID

         //Check queue table
         public function checkQueueTable(){
            try {
                $stmt = $this->conn->prepare("SELECT * FROM pos WHERE status='pending'");
                $stmt->execute();
                $count = $stmt->rowCount();
                return $count;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //Check queue table

        //daily sales to be display in Dashboard
        public function dailySales(){
            try {
                $stmt = $this->conn->prepare("SELECT sum(total_amount) as total FROM transaction WHERE date(trans_date)=date(NOW()) ");
                $stmt->execute();
                $sales=$stmt->fetch(PDO::FETCH_ASSOC);
                return $sales['total'];
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //daily sales to be display in Dashboard

          //monthly sales to be display in Dashboard
          public function monthSales(){
            try {
                $stmt = $this->conn->prepare("SELECT sum(total_amount) as total FROM transaction 
                WHERE monthname(trans_date) = monthname(NOW()) 
                AND YEAR(trans_date) = YEAR(NOW())");
                $stmt->execute();
                $sales=$stmt->fetch(PDO::FETCH_ASSOC);
                return $sales['total'];
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //monthly sales to be display in Dashboard

         //monthly sales to be display in Dashboard
         public function grossProfit(){
            try {
                $stmt = $this->conn->prepare("SELECT SUM((pos.unit_price - inventory.unit_price) * pos.qnty) AS total_profit FROM pos INNER JOIN inventory ON pos.invt_id = inventory.invt_id");
                $stmt->execute();
                $sales=$stmt->fetch(PDO::FETCH_ASSOC);
                return $sales['total_profit'];
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //monthly sales to be display in Dashboard



         //DELETE POS RECORD
         public function deletePOS($pos_id){
            try{
                $stmt = $this->conn->prepare("DELETE FROM pos WHERE pos_id=:pos_id");
                $stmt->bindParam(":pos_id", $pos_id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        //DELETE POS RECORD
        
        public function redirect($url){
            header("location:$url");
        }
    }
?>