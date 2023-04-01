<?php 
    require_once "database.php";
    class User{
        private $conn;
        //Constructor
        public function __construct(){
            $database = new Database();
            $db =  $database->dbConnection();
            $this->conn = $db;
        }
        //Execute Queries SQL
        public function runQuery($sql){
            $stmt =  $this->conn->prepare($sql);
            return $stmt;
        }
        //INSERT NEW ACCCOUNT
        public function insert_new_user($username,$password,$recovery_key){
            try {
                $stmt = $this->conn->prepare("INSERT INTO user(username, password, recovery_key) VALUES(:username, :password,:recovery_key)");
                $stmt->bindparam(":username", $username);
                $stmt->bindparam(":password", $password);
                $stmt->bindparam(":recovery_key", $recovery_key);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //INSERT NEW ACCOUNT

        //UPDATE USER PASSWORD
        public function update_password($username, $newpass){
            try {
                $stmt = $this->conn->prepare("UPDATE user SET password = :newpass WHERE username = :username");
                $stmt->bindParam(":newpass", $newpass);
                $stmt->bindParam(":username", $username);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //UPDATE USER PASSWORD

         //UPDATE RECOVERY KEY
         public function update_recovery_key($username, $new_key){
            try {
                $stmt = $this->conn->prepare("UPDATE user SET recovery_key = :new_key WHERE username = :username");
                $stmt->bindParam(":new_key", $new_key);
                $stmt->bindParam(":username", $username);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        //UPDATE RECOVERY KEY

         //CODE FOR FOROGT PASSWORD
         public function update_new_password($username,$new_pass){   
            try{
                $stmt = $this->conn->prepare("UPDATE user SET password = :new_pass WHERE username = :username");
                $stmt->bindParam(":username",$username);
                $stmt->bindParam(":new_pass",$new_pass);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        //CODE FOR FORGOT PASSWORD
        
        //REDIRECT URL METHOD
        public function redirect($url){
            header("location:$url");
        }
    }


?>