<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E - Commerce | Order Update</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        .m-b-20{margin-bottom:20px}li,ul{margin:0;list-style-type:none}.list-group{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;padding-left:0;margin-bottom:0}.list-group-item{position:relative;display:block;padding:.75rem 1.25rem;margin-bottom:-1px;background-color:#fff;border:1px solid rgba(0,0,0,.125)}.list-group-item:first-child{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.list-group-item.active{z-index:2;color:#fff;background-color:#007bff;border-color:#007bff}.small,small{font-size:80%;font-weight:400}.list-group-item{position:relative;display:block;padding:.75rem 1.25rem;margin-bottom:-1px;background-color:#fff;border:1px solid rgba(0,0,0,.125)}.row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.text-center{text-align:center!important}.list-group-item.cart-items{background-color:#eee}.text-info{color:#17a2b8!important}a{font-weight:400;font-size:15px;line-height:1.7;color:#666;margin:0;transition:all .4s;-webkit-transition:all .4s;-o-transition:all .4s;-moz-transition:all .4s;text-decoration:none;background-color:transparent}h2{margin-bottom:5px;color:#ff4700}@media (min-width:576px){.col-sm-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-sm-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}}@media (min-width:768px){.col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-md-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}}@media only screen and (max-width:575px){li.list-group-item.p-grp-title{display:none}li.list-group-item.cart-items{text-align:center}li.list-group-item.cart-items a{float:none!important}.col-md-2,.col-md-5,.col-sm-2,.col-sm-5{position:relative;width:100%;min-height:1px;padding-right:15px;padding-left:15px}}.label{background: #000;padding: 2px 10px;border-radius: 10px;}
    </style>
</head>
<body style="font-family: sans-serif;background: #fff;color: #546067;font-size:15px;">
    <div class="inner">
        <h2>Hi, <?=$_SESSION['customer_name']?></h2>
        <?php $o = $this->product_model->get_my_last_order($_SESSION['order_id']); $payment_settings = $this->admin_model->get_payment_settings();?>
        <ul class="list-group m-b-20">
            <li class="list-group-item active">
                Order ID: <?=$o['order_id'];?> <br>
                <small>Ordered Date: <?=date('Y-m-d, h:i A', strtotime($o['date_ordered']));?></small> <br>
                <small>Status: 
                    <?=($o['order_status'] == 1) ? '<span class="label">Awaiting Check Payment</span>' : '';?>
                    <?=($o['order_status'] == 2) ? '<span class="label">Awaiting COD validation</span>' : '';?>
                    <?=($o['order_status'] == 3) ? '<span class="label">Cancelled</span>':'';?>
                    <?=($o['order_status'] == 4) ? '<span class="label">Delivered</span>' : '';?>
                    <?=($o['order_status'] == 5) ? '<span class="label">Payment Accepted</span>' : '';?>
                    <?=($o['order_status'] == 6) ? '<span class="label">Payment Error</span>':'';?>
                    <?=($o['order_status'] == 7) ? '<span class="label">Processing in progress</span>' : '';?>
                    <?=($o['order_status'] == 8) ? '<span class="label">Refunded</span>' : '';?>
                    <?=($o['order_status'] == 9) ? '<span class="label">Shipped</span>' : '';?>  	
                </small>
            </li>
            <!-- Item Headings -->
            <li class="list-group-item p-grp-title" style="border-bottom: 3px solid #444;">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-2 text-center"><b>ID</b></div>
                    <div class="col-md-5 col-sm-5 col-xs-5"><b>PRODUCT</b></div>
                    <div class="col-md-5 col-sm-5 col-xs-5"><b>PRICE TOTAL</b></div>
                </div>
            </li>
            <!-- Display cart items -->
            <?php $pid = json_decode($o['product_id']); ?>
            <?php $sub_total=0; foreach($pid as $j){ $i = $this->product_model->get_specific_product($j);?>
                <li class="list-group-item cart-items">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-2 text-center"><?=$i['item_id'];?></div>
                        <div class="col-md-5 col-sm-5 col-xs-5">
                            <a href="<?=base_url();?>product_detail/<?=$i['item_id'];?>" class="text-info"><?=$i['item_title'];?> x 1</a>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-5">$<?=$i['item_price'];?></div>
                    </div>
                </li>
            <?php $sub_total+=$i['item_price']; } ?>
            <li class="list-group-item" style="border-top: 2px solid #444;">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-2"></div>
                    <div class="col-md-5 col-sm-5 col-xs-5"><b>Subtotal</b></div>
                    <div class="col-md-5 col-sm-5 col-xs-5">$<?=number_format($sub_total, 2, '.', '');?></div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-2"></div>
                    <?php $overall = $o['sales_tax']*$sub_total; ?>
					<div class="col-md-5 col-sm-5 col-xs-5"><b>Sales Tax (<?=(number_format($o['sales_tax'], 3, '.', '')*100);?>%)</b></div>
                    <div class="col-md-5 col-sm-5 col-xs-5">$<?=number_format($overall, 2, '.', '');?></div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-2"></div>
                    <div class="col-md-5 col-sm-5 col-xs-5"><b>Shipping rate (<?=isset($o['service_type']) && $o['service_type'] != "" ? $this->config->item('ups')['services'][$o['service_type']] : '' ?>)</b></div>
                    <div class="col-md-5 col-sm-5 col-xs-5">$<?=number_format($o['shipping_rate'], 2, '.', '');?></div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-2"></div>
                    <div class="col-md-5 col-sm-5 col-xs-5"><b>Total</b></div>
                    <div class="col-md-5 col-sm-5 col-xs-5">$<?=number_format($o['total_paid'], 2, '.', '');?></div>
                </div>
            </li>
        </ul>
        <p>Thanks, <br> Fashe *: E - Commerce</p>
    </div>
</body>
</html>