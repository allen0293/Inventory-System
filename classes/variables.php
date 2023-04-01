<?php 
    class Variables{
        private $user_id,$username,$password,$confirmPass,$newPassword,$recovery_key;
        private $productId,$productName, $brandName,$qnty,$unitPrice,$posId,$amount;
        
        //User ID  Setter and Getter
        public function getUserId(){
            return $this->user_id;
        }
        public function setUserId($user_id){
            $this->user_id = $user_id;
        }
        //User ID  Setter and Getter

        //Username  Setter and Getter
        public function getUsername(){
            return $this->username;
        }
        public function setUsername($username){
                $this->username = $username;
        }
        //Username  Setter and Getter

        //Password  Setter and Getter
        public function getPassword(){
            return $this->password;
        }
        public function setPassword($passowrd){
            $this->password = $passowrd;
        }
        //Password  Setter and Getter

        //Old Password Setter and Getter
        public function getConfirmPassword(){
            return $this->confirmPass;
        }
        public function setConfirmPassword($confirmPass){
            $this->confirmPass = $confirmPass;
        }
        //Old Password Setter and  Getter

        //New Password Setter and Getter
        public function getNewPassword(){
            return $this->newPassword;
        }
        public function setNewPassword($newPassword){
            $this->newPassword = $newPassword;
        }

        //Recovery Key Setter and Getter
        public function getRecoveryKey(){
            return $this->recovery_key;
        }
        public function setRecoveryKey($recovery_key){
            $this->recovery_key = $recovery_key;
        }
        //Recovery Key Setter and Getter

        //Product Id Setter and Getter
        public function getProductId(){
            return $this->productId;
        }
        public function setProductId($productId){
            $this->productId = $productId;
        }
        //Product Id Setter and Getter

        //Product Name Setter and Getter
          public function getProductName(){
            return $this->productName;
        }
        public function setProductName($productName){
            $this->productName = $productName;
        }
        //Product Name Setter and Getter

        //Brand Name Setter and Getter
        public function getBrandName(){
            return $this->brandName;
        }
        public function setBrandName($brandName){
            $this->brandName = $brandName;
        }
        //Barnd Name Setter and Getter

        //Quantity Setter and Getter
        public function getQnty(){
            return $this->qnty;
        }
        public function setQnty($qnty){
            $this->qnty = $qnty;
        }
        //Quantity Setter and Getter

        //Quantity Setter and Getter
        public function getunitPrice(){
            return $this->unitPrice;
        }
        public function setUnitPrice($unitPrice){
            $this->unitPrice = $unitPrice;
        }
        //Quantity Setter and Getter

        //POS Setter and Getter
        public function getPosId(){
            return $this->posId;
        }
        public function setPosId($posId){
            $this->posId = $posId;
        }
        //POS Setter and Getter

        //Amount Setter and Getter
        public function getAmount(){
            return $this->amount;
        }
        public function setAmount($amount){
            $this->amount = $amount;
        }
        //Amount Setter and Getter
    }


?>