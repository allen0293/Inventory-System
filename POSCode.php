<?php 
session_start();
require_once "classes/variables.php";
require_once "classes/productClass.php";
require_once "classes/posClass.php";
$var = new Variables();
$pro = new Product();
$pos = new POS();

//ADD TO QUE
if(isset($_POST['addToQue'])){
$var->setProductId($_POST['productId']);
$var->setunitPrice($_POST['unitPrice']);
$var->setQnty($_POST['quantity']);
$stock = $_POST['stock'];
$total = $var->getQnty()*$var->getunitPrice();
    if($var->getQnty()>$stock || $var->getQnty() < 0){
        $_SESSION['invalid_input']="invalid input try again";
        $pos->redirect("POS.php");
    }else{
        if($pos->insertPos($var->getProductId(), $var->getunitPrice(), $var->getQnty(), $total)){
            $pro->minusProductStock($var->getProductId(), $var->getQnty());
            $pro->AddSoldStock($var->getProductId(), $var->getQnty());
            $pos->redirect("POS.php");
        }else{
            die('error');
        }
    }   
}

//ADD TO QUE
if(isset($_POST['amountendered'])){
    $count = $pos->checkQueueTable();
    if($count > 0 ){
        $_SESSION['amount'] = $_POST['amount'];
        $pos->redirect("payment.php");
    }
    else{
        $_SESSION['empty_queue']="Queue is Empty";
        $pos->redirect("POS.php");
    }
}   

//delete
if(isset($_GET['posId'])){
    $var->setPosId($_GET['posId']);
    $var->setProductId($_GET['invtId']);
    $var->setQnty($_GET['qnty']);
    if($pos->deletePOS($var->getPosId())){
        $pro->AddProductStock($var->getProductId(), $var->getQnty());
        $pro->MinusSoldStock($var->getProductId(), $var->getQnty());
        $_SESSION['deleted']="Record Deleted";
        $pro->redirect("POS.php");
    }
}




?>