<?php 
session_start();
require_once "classes/variables.php";
require_once "classes/productClass.php";
$var = new Variables();
$pro = new Product();

//Add Product
if(isset($_POST['addProduct'])){
    $var->setProductName(ucwords($_POST['productName']));
    $var->setBrandName(ucwords($_POST['brandName']));
    $var->setUnitPrice($_POST['unitPrice']);
    $var->setQnty($_POST['quantity']);
    if($pro->insertProduct($var->getProductName(), $var->getBrandName(), $var->getunitPrice(), $var->getQnty())){
        $_SESSION['insert_success']="New Product Added";
        $pro->redirect("inventory.php");
    }else{
        die("error");
    }
}
//Add Product

//UPDATE PRODUCT DETAILS
if(isset($_POST['EditProduct'])){
    $var->setProductId($_POST['productId']);
    $var->setProductName(ucwords($_POST['productName']));
    $var->setBrandName(ucwords($_POST['brandName']));
    $var->setUnitPrice($_POST['unitPrice']);
    if($pro->updateProductDetails($var->getProductId(), $var->getProductName(), $var->getBrandName(), $var->getunitPrice())){
        $_SESSION['update_success']="Product Details Updated";
        $pro->redirect("inventory.php");
    }else{
        die('error');
    }
}

//UPDATE PRODUCT DETAILS

//ADD STOCK CODE
if(isset($_POST['AddStock'])){
    $var->setProductId($_POST['productId']);
    $var->setQnty(abs($_POST['quantity']));
    
    if($pro->AddProductStock($var->getProductId(), $var->getQnty())){
        $_SESSION['stockAdded']="Stock Added";
        $pro->redirect("inventory.php");
    }
}
//ADD STOCK CODE

//DEDUCT STOCK CODE
if(isset($_POST['deductStock'])){
    $var->setProductId($_POST['productId']);
    $var->setQnty(abs($_POST['quantity']));
    
    if($pro->minusProductStock($var->getProductId(), $var->getQnty())){
        $_SESSION['stockDeducted']="Stock Deducted";
        $pro->redirect("inventory.php");
    }
}
//DEDUCT STOCK CODE

//delete
if(isset($_GET['deleteProduct'])){
    $var->setProductId($_GET['deleteProduct']);
    if($pro->deleteProduct($var->getProductId())){
        $_SESSION['deleted']="Record Deleted";
        $pro->redirect("inventory.php");
    }
}


?>