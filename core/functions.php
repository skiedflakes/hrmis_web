<?php

	function page_url($page){
		return md5(base64_encode($page));
	}

	function enCrypt($data){
		return base64_encode($data);
	}

	function deCrypt($data){
		return base64_decode($data);
	}

	function get_customer_name($customer_id, $conn){
		$customer_data = mysqli_fetch_array(mysqli_query($conn, "SELECT customer_name FROM tbl_customers WHERE customer_id = '$customer_id'"));
		return $customer_data[0];
	}

	function get_detail_amount($sales_id, $conn){
		$sales_data = mysqli_query($conn, "SELECT * FROM tbl_sales_order a INNER JOIN tbl_sales_order_detail b WHERE a.sales_order_id = b.sales_order_id AND a.sales_order_id = '$sales_id' AND a.status = 1 GROUP BY a.sales_order_id");
		while($row = mysqli_fetch_array($sales_data)){
			$p_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tbl_products WHERE product_id = '$row[product_id]'"));
			$discount = $p_data["is_discountable"] == 1 && $row["is_discounted"] == 1?$p_data["price"]*.20:0;
	        $vat = $p_data["is_vatable"] == 1?$p_data["price"]*.12:0;
	        $price = $p_data["price"];

	        $total_price = $row["quantity"] * $price;
	        $total_vat = $row["quantity"] * $vat;
	        $total_discount = $row["quantity"] * $discount;
	        $total_amount = ($total_price + $total_vat)-$total_discount;

	        return number_format($total_amount,2); 

		}
	}

	function get_balance_qty($product_id, $date, $conn){
		$get_stock_qty = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(quantity) as qty FROM `tbl_stocks` WHERE date_added <= '$date' AND product_id = '$product_id'"));

		return $get_stock_qty[0]?$get_stock_qty[0]:0;
	}

	function stock_in_qty($product_id, $date, $conn){
		$stock_in_qty = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(quantity) as qty FROM `tbl_stocks` WHERE date_added = '$date' AND product_id = '$product_id'"));

		return $stock_in_qty[0]?$stock_in_qty[0]:0;
	}

	function stock_out_qty($product_id, $date, $conn){
		$stock_out_qty = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(b.quantity) as qty FROM `tbl_sales_order` a INNER JOIN `tbl_sales_order_detail` b WHERE a.sales_order_id = b.sales_order_id AND a.status = 1 AND b.date_added <= '$date' AND b.product_id = '$product_id'"));

		return $stock_out_qty[0]?$stock_out_qty[0]:0;
	}

	function get_remaining_qty($product_id, $date, $conn){
		$sold_qty = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(b.quantity) as qty FROM `tbl_sales_order` a INNER JOIN `tbl_sales_order_detail` b WHERE a.sales_order_id = b.sales_order_id AND a.status = 1 AND b.date_added <= '$date' AND b.product_id = '$product_id'"));

		$get_stock_qty = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(quantity) as qty FROM `tbl_stocks` WHERE date_added <= '$date' AND product_id = '$product_id'"));

		$total_remaining_qty = $get_stock_qty[0] - $sold_qty[0];

		return $total_remaining_qty?$total_remaining_qty:0;
	}

	function check_balance_qty($product_id, $conn){
		$get_stock_qty = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(quantity) as qty, sum(sold_quantity) as s_qty FROM `tbl_stocks` WHERE product_id = '$product_id'"));
		$total_qty = $get_stock_qty[0] - $get_stock_qty[1];

		return $total_qty?$total_qty:0;
	}

?>