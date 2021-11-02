<?php

 if($page == page_url('sales')){
    $dashboard = "";
    $sales = "active";
    $products = "";
    $suppliers = "";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
  }else if($page == page_url('products')){
    $dashboard = "";
    $sales = "";
    $products = "active";
    $suppliers = "";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
  }else if($page == page_url('stocks')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $stocks = "active";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
  }
?>
 <div class="sidebar-sticky pt-3">
  	<h6 class="d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Department Of MITCS</span>
    </h6>
    <ul class="nav flex-column">
    
      <?php if($_SESSION["role"] == 0){?>
       
        <li class="nav-item">
        <a class="nav-link h6 <?=$sales?>" href="index.php?page=<?=page_url('products')?>">
          <span class="fa fa-shopping-cart"></span>
          Employee Leave Transactions Admin Officer
        </a>
      </li>
      <li class="nav-item">
          <a class="nav-link h6 <?=$products?>" href="index.php?page=<?=page_url('stocks')?>">
            <span class="fa fa-cubes"></span>
            Employee Leave Transactions Department Head
          </a>
        </li>
      <?php } ?>
    </ul>

   
</div>