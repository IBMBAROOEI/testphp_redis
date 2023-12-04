<?php

include_once "Database.php";

if($_SERVER['REQUEST_METHOD'] ==='POST' && isset($_POST['submit'])){


  $mobile_number=$_POST['mobile_number'];

  $product_id=$_POST['product_id'];

 
  $databaseObj = new Database();

   // Check if the user already has the product in their cart
   $exists = $databaseObj->checkProductExists($mobile_number, $product_id);
    

   if ($exists) {
    echo '<script>alert("این محصول را قبلاً به سبد خرید خود اضافه کرده‌اید.")</script>';
    echo '<script>window.location.href = "product.php";</script>';

exit();

   } else {
       $databaseObj->createData($mobile_number, $product_id);
       echo '<script>alert("محصول با موفقیت به سبد خرید شما اضافه شد!")</script>';
       echo '<script>window.location.href = "product.php";</script>';
     
   }
}

  
?>
