<?php   
    session_start();
    require_once "classes/user.php";
    require_once "classes/variables.php";
    $var = new Variables();
    $user = new User();
    //THIS FUNCTION WILL INSERT A NEW ACCOUNT
    if(isset($_POST["new_user"])) {
        $var->setUsername($_POST["username"]);
        $var->setPassword($_POST["password"]);
        $var->setRecoveryKey($_POST["recovery_key"]);
            $var->setPassword(password_hash($var->getPassword(), PASSWORD_BCRYPT));
            $var->setRecoveryKey(password_hash($var->getRecoveryKey(), PASSWORD_BCRYPT));
            if($user->insert_new_user($var->getUsername(),$var->getPassword(),$var->getRecoveryKey())){
                $_SESSION['login_notif']='insert success';
                $user->redirect("login.php");
            }else{
                echo 'error';
            }  
    }
    //END OF INSERT NEW ACCOUNT CODE
 
    //LOGIN USER
    if(isset($_POST["login"])){
        $var->setUsername($_POST["username"]);
        $var->setPassword($_POST["password"]);
        $stmt = $user->runQuery("SELECT * FROM user WHERE username = :username");
        $stmt->execute(array(":username"=>$var->getUsername()));
        $count = $stmt->rowCount();
        $rowUser = $stmt->fetch(PDO::FETCH_ASSOC);
        if($count > 0){
            $_SESSION['user_id']=$rowUser['user_id'];
            $_SESSION['username']=$rowUser['username'];
            $user_type = $rowUser['user_type'];
            if(password_verify($var->getPassword(),$rowUser['password'])){
                $_SESSION['login_success']=$_SESSION['username'];            
                $user->redirect("index.php");
            }else{
                $_SESSION['password_incorrect']="Password Incorrect";
                $user->redirect("login.php");
            }
        }else{
            $_SESSION['username_incorrect']="Username Incorrect";
            $user->redirect("login.php");
        }
    }

    //CHANGE PASSWORD 
    if(isset($_POST['change_pass'])){
        $var->setUsername($_SESSION['username']);
        $var->setPassword($_POST['oldPassword']);
        $var->setNewPassword($_POST['newPassword']);
        $var->setConfirmPassword($_POST['confirmPassword']);
        $stmt = $user->runQuery("SELECT password FROM user WHERE username = :username");
        $stmt->execute(array(':username' =>$var->getUsername()));
        $count=$stmt->rowCount();
        if($count>0){
            $rowUser =  $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($var->getPassword(),$rowUser['password'])){
                if($var->getNewPassword() == $var->getConfirmPassword()){
                    $var->setNewPassword(password_hash($var->getNewPassword(),PASSWORD_BCRYPT));
                    if($user->update_password($var->getUsername(),$var->getNewPassword())){
                        $_SESSION['change_pass_success']="Change Password Success";
                        $user->redirect("index.php");
                    }
                }else{
                    $_SESSION['new_confirm']="Confirm Password Did not match";
                    $user->redirect("index.php");
                }
            }else{
                $_SESSION['oldpass_incorrect']="Old Password Incorrect";
                $user->redirect("index.php");
            }
        }
    }   
    //CHANGE PASSWORD

     //CHANGE RECOVERY KEY
     if(isset($_POST['new_key'])){
        $var->setUsername($_SESSION['username']);
        $var->setPassword($_POST['password']);
        $old_key = $_POST['old_key'];
        $recovery_key = $_POST['recovery_key'];
        $stmt = $user->runQuery("SELECT * FROM user WHERE username = :username");
        $stmt->execute(array(':username' =>$var->getUsername()));
        $count=$stmt->rowCount();
        if($count>0){
            $rowUser =  $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($old_key,$rowUser['recovery_key'])){     
                if(password_verify($var->getPassword(),$rowUser['password'])){
                    $new_key = password_hash($recovery_key,PASSWORD_BCRYPT);  
                    if($user->update_recovery_key($var->getUsername(),$new_key)){
                        $_SESSION['change_key_success']="Change Recovery Success";
                        $user->redirect("index.php");
                    }
                }else{
                   $_SESSION['wrong_pass']="Password Incorrect";
                    $user->redirect("index.php");  
                }
            }else{
                $_SESSION['old_key']="Incorrect Old Recovery Key";
                $user->redirect("index.php");
            }
        }
    }   
    //CHANGE RECOVERY KEY
    
    //FORGOT PASSWORD
    if(isset($_POST['pass'])){
        $var->setUsername($_POST['username']);
        $var->setRecoveryKey($_POST['recovery_key']);
        $stmt = $user->runQuery("SELECT * FROM user WHERE username = :username");
        $stmt->execute(array(":username"=>$var->getUsername()));
        $count = $stmt->rowCount();
        if($count>0){
            $output=$stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($var->getRecoveryKey(),$output['recovery_key'])){
                $_SESSION['username_key']= $var->getUsername();
                $_SESSION['recovery_key']=$var->getRecoveryKey();
                $user->redirect("change_pass.php");
            }else{
                $_SESSION['wrong_recovery']="Wrong Recovery Key";
                $user->redirect("login.php");
            }
        }else{
            $_SESSION['incorrect_user']="Incorrect Username";
            $user->redirect("login.php");
        }
    }
    //FORGOT PASSWORD

    //NEW PASSWORD
    if(isset($_POST['new_pass'])){
        $var->setNewPassword($_POST['password']);
        $var->setUsername($_SESSION['username_key']);
        $var->setNewPassword(password_hash($var->getNewPassword(),PASSWORD_BCRYPT));
        $user->update_new_password($var->getUsername(),$var->getNewPassword());
        unset($_SESSION['username_key']);
        unset($_SESSION['recovery_key']);
        $_SESSION['password_reset']="Password Reset";
        $user->redirect("login.php");
    }
    //NEW PASSWORD

    //Export excel Sales Record
if(isset($_GET['exportSales'])){
	$stmt = $user->runQuery("SELECT inventory.name, 
    inventory.brand_name, 
    pos.unit_price, 
    pos.qnty, 
    pos.total, 
    pos.date_process
    FROM `pos` 
    INNER JOIN inventory 
    ON pos.invt_id = inventory.invt_id 
    WHERE status ='completed'");
    $stmt->execute(); 
    $arrayPos = array();
    $total = 0;  
    $count = $stmt->rowCount();
    if($count > 0){
        while($rowPos = $stmt->fetch(PDO::FETCH_ASSOC)){     
        $arrayPos[] = $rowPos;
    }}
    $output = fopen('php://output','w');
    fputcsv($output,array('Name','Brand','Unit Price','Quantity','Total','Date'));
    if($count>0){
        foreach($arrayPos as $row){
            fputcsv($output,$row);
        }
    }
	header('Content-Type:text/csv; charset=utf8');
	header('Content-Disposition:attachment;filename=Sales Record_'.date('m-d-Y').'.csv');
}

 //Export excel Monthly Sales Record
 if(isset($_GET['exportMonth'])){
	$stmt = $user->runQuery("SELECT 
    inventory.name, 
    inventory.brand_name, 
    pos.unit_price, 
    pos.qnty, 
    pos.total, 
    pos.date_process
    FROM `pos` 
    INNER JOIN inventory 
    ON pos.invt_id = inventory.invt_id 
    WHERE status ='completed' 
    AND monthname(pos.date_process) = monthname(NOW())
    AND YEAR(pos.date_process)=YEAR(NOW())");
    $stmt->execute(); 
    $arrayPos = array();
    $total = 0;  
    $count = $stmt->rowCount();
    if($count > 0){
        while($rowPos = $stmt->fetch(PDO::FETCH_ASSOC)){     
        $arrayPos[] = $rowPos;
    }}
    $output = fopen('php://output','w');
    fputcsv($output,array('Name','Brand','Unit Price','Quantity','Total','Date'));
    if($count>0){
        foreach($arrayPos as $row){
            fputcsv($output,$row);
        }
    }
	header('Content-Type:text/csv; charset=utf8');
	header('Content-Disposition:attachment;filename=Sales Record_'.date('m-d-Y').'.csv');
}



if(isset($_GET['exportInventory'])){
	$stmt = $user->runQuery("SELECT name, brand_name, qnty, sold_qnty FROM inventory");
    $stmt->execute();
    $arrayProduct = array();  
    $count = $stmt->rowCount();
    while($rowProduct = $stmt->fetch(PDO::FETCH_ASSOC)){     
    $arrayProduct[] = $rowProduct;
    }
    $output = fopen('php://output','w');
    fputcsv($output,array('Name','Brand','Stock','Sold Stock'));
    if($count>0){
        foreach($arrayProduct as $row){
            fputcsv($output,$row);
        }
    }
	header('Content-Type:text/csv; charset=utf8');
	header('Content-Disposition:attachment;filename=Inventory_'.date('m-d-Y').'.csv');
}

?>