<?php

include_once("database.php");
$databaseObj = new Database();
$result = $databaseObj->displayData();

function sortProductsByMaxQuntity($a, $b)
{
    return $b['quntity'] - $a['quntity'];
}

function sortbynewcreate_at($a, $b)
{
    return strtotime($b['create_at']) - strtotime($a['create_at']);
}




$databaseObj = new Database();
$result = $databaseObj->displayData();

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];

    if ($sort == 'quntity') {
        if (is_array($result)) {
            usort($result, 'sortProductsByMaxQuntity');
        } else {
            echo "";
        }
    }

    

    if ($sort == 'create_at') {
        if (is_array($result)) {
            usort($result, 'sortbynewcreate_at');
        } else {
            echo "";
        }
    }
}

// displayProducts($result);



?>
<!DOCTYPE html>
<html>
<head>
<style>
        .card-img-top {
            object-fit: cover;
            height: 200px; /* ارتفاع دلخواه برای تصاویر */
        }
    </style>
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
   



<div class="container">
  <div class="row">

<div class="col-10">

<div class="row">
<?php

foreach ($result as $elements) {
    echo '<div class="col-lg-4">';
    echo '<div class="card" style="width: 18rem;">';
    echo '<h5>'.$elements['id']. '</h5>';
    echo '<img class="card-img-top" alt="" src="image/' . $elements['Image'] . '">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $elements['NAME_PRODUCT'] . '</h5>';
    echo '<p class="card-text">' . $elements['Code_product'] . '</p>';
    echo ' تعداد<p class="card-text">' . $elements['quntity'] . '</p>';
    echo '</div>';
    echo '<ul class="list-group list-group-flush">';
   
    echo '<li class="list-group-item">' . $elements['Original_price'] . '</li>';
    echo 'درصد تخفیف<li class="list-group-item">' . $elements['discount_percentage'] . '</li>';
    echo '</ul>';
    echo '<div class="card-body">';
    echo '
    
    <!-- Button trigger modal -->

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal' . $elements['id'] . '">
    ثبت سفارش 
    </button>

 

<!-- Modal -->

<div class="modal fade" id="exampleModal' . $elements['id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">ثبت سفارش</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      





<form action="cart.php"  method="POST">



<input type="hidden" name="product_id" value="' . $elements['id'] . '">



<div class="row">
<label  class="col-form-label">شماره موبایل</label>
<div class="col-sm-6">
  <input type="text" class="form-control" name="mobile_number" >
</div>
</div>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
        <button type="submit"  name="submit" class="btn btn-primary">ثبت سفارش</button>
       
      </div>
    </div>
    </form>
  </div>
</div>
        
    ';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

?>
</div>

</div>



<div class="col-2">
<div class="row">
<div class="col">
<form action="showproduct.php" method="get">
              <select name="sort" onchange="this.form.submit()">
              <lable>نمایش محصولات </lable>
                <option value=""></option>
  
  
  
                <option value="quntity" <?php if(isset($_GET['sort']) && $_GET['sort'] === 'quntity') echo 'selected'; ?>>بیشترین قیمت</option>
                
              </select>
            </form>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>