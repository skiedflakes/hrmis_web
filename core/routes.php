<?php
	
	$pages = $_GET["page"];
	if($pages == page_url("dashboard")){
		require '../main/pages/dashboard.php';
	}else if($pages == page_url("sales")){
		require '../main/pages/sales.php';
	}else if($pages == page_url("products")){
		require '../main/pages/products.php';
	}else if($pages == page_url("suppliers")){
		require '../main/pages/suppliers.php';
	}else if($pages == page_url("stocks")){
		require '../main/pages/stocks.php';
	}else if($pages == page_url("customers")){
		require '../main/pages/customers.php';
	}else if($pages == page_url("receipt")){
		require '../main/pages/receipt.php';
	}else if($pages == page_url("sales_report")){
		require '../main/pages/sales_report.php';
	}else if($pages == page_url("inventory_report")){
		require '../main/pages/inventory_report.php';
	}else{
		require '../main/pages/404.php';
	}

?>