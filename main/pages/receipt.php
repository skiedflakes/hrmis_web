<?php
  $sales_id = isset($_GET['sales_id'])?$_GET["sales_id"]:0;
  $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tbl_sales_order WHERE sales_order_id = '$sales_id'"));
?>
<div class="main">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><a href="index.php?page=<?=page_url('sales')?>">Sales</a> / <span class="text-muted">Print Receipt</span></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="h5 mr-5">
        <i class="fa fa-user mr-1"></i> Welcome: <?=$_SESSION["name"];?>
      </div>
      <div class="h5">
        <i class="far fa-calendar mr-1"></i> <?=date("F d, Y");?>
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-12">
      <a href="index.php?page=<?=page_url('sales')?>" class="btn btn-outline-primary mb-3"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <div class="col-12">
      <div class="container">
        <div class="btn-group col-2 offset-9 mb-3">
          <button type="button" class="btn btn-outline-success" onclick="print_receipt()"><i class="fa fa-print"></i> Print</button>
        </div>
        <div id="receipt_container" class="row">
            <div class="well col-10 offset-1">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <address>
                            <strong>RAFFA PHARMA CORP.</strong>
                            <br>
                            Calle Gomez, Purok Balatong, Brgy. Dos Hermanas, Talisay City, 6115
                            <br>
                            <!-- <abbr title="Phone">P:</abbr> (213) 484-6829 -->
                          <p>
                              <em>Receipt #: <?=$data["receipt_no"]?></em>
                          </p>
                        </address>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <p>
                            <em>Date: <?=date("F d, Y", strtotime($data["date_added"]))?></em>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center font-weight-bolder">
                      Receipt
                    </div>
                    </span>
                    <table width="100%">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>#</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              $sub_total = 0;
                              $total_vat = 0;
                              $total_discount = 0;
                              $cash_tendered = $data["cash_tendered"];
                              $details_sql = mysqli_query($conn, "SELECT * FROM tbl_sales_order_detail WHERE sales_order_id = '$sales_id'");
                              while($row = mysqli_fetch_array($details_sql)){
                              $p_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tbl_products WHERE product_id = '$row[product_id]'"));
                              $discount = $p_data["is_discountable"] == 1 && $data["is_discounted"] == 1?$p_data["price"]*.20:0;
                              $vat = $p_data["is_vatable"] == 1?$p_data["price"]*.12:0;
                              $price = $p_data["price"];

                              $total_price_sum = $row["quantity"] * $price;
                              $sub_total += $total_price_sum;
                              $total_vat += $vat*$row["quantity"];
                              $total_discount += $discount;
                              $grand_total = $sub_total + $total_vat;
                              $change = $cash_tendered - $grand_total;
                            ?>
                              <tr>
                                  <td class="col-md-9 prod"><?=$p_data["brand_name"].", ".$p_data["generic_name"];?></td>
                                  <td class="col-md-1" style="text-align: center"> <?=$row["quantity"]?> </td>
                                  <td class="col-md-1 text-center"><?=number_format($price,2)?></td>
                                  <td class="col-md-1 text-center"><?=number_format($total_price_sum,2)?></td>
                              </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3" class="text-right">
                                  <p>
                                      <strong>Subtotal: </strong>
                                  </p>
                                  <p>
                                      <strong>VAT: </strong>
                                  </p>
                                  <p>
                                      <strong>Discount: </strong>
                                  </p>
                                </td>
                                <td class="text-center">
                                  <p>
                                    <?=number_format($sub_total,2)?>
                                  </p>
                                  <p>
                                    <?=number_format($total_vat,2)?>
                                  </p>
                                  <p>
                                    <?=number_format($total_discount,2)?>
                                  </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total: </strong></td>
                                <td class="text-center text-danger"><strong><u><?=number_format($grand_total,2)?></u></strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">
                                    <p>
                                        <strong>Cash Tendered: </strong>
                                    </p>
                                    <p>
                                        <strong>Change: </strong>
                                    </p>
                                </td>
                                <td class="text-center">
                                  <p>
                                    <?=number_format($cash_tendered,2)?>
                                  </p>
                                  <p>
                                    <?=number_format($change,2)?>
                                  </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>

</div>

<!-- PAGE SCRIPT -->
<script type="text/javascript">
  $(document).ready( function(){
    
  });
  function print_receipt(){
    var mywindow = window.open('', 'PRINT');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"><link rel="stylesheet" href="../assets/icons/css/all.min.css"><style type="text/css">@media print { body, #receipt_container, table, h5, h1 { margin: 0; font-size: xxx-large; } address, em, .prod { font-size: xx-large; } }</style></head><body >');
    mywindow.document.write(document.getElementById("receipt_container").innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    setTimeout( function(){
      mywindow.print();
      mywindow.close();
    },200);

    return true;
  }

</script>