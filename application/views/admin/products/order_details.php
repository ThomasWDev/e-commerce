<!DOCTYPE html>
<html>
    <?php $this->load->view('admin/common/css');?>
	<body class="fixed-left">

		<!-- Begin page -->
		<div id="wrapper">

            <!-- Top Bar Start -->
            <?php $this->load->view('admin/common/topbar');?>
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php $this->load->view('admin/common/leftnav');?>
			<!-- Left Sidebar End -->
            <?php 
                $payment_settings = $this->admin_model->get_payment_settings();
            ?>
			<!-- Start right Content here -->
			<div class="content-page">
				<!-- Start content -->
				<div class="content">
					<div class="wraper container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="bg-picture text-center">
                                    <div class="bg-picture-overlay"></div>
                                    <div class="profile-info-name">
                                        <?php $img_link = ($user['user_img']) ? 'c'.$user['user_id'].'/'.$user['user_img'] : 'default.png';?>
                                        <div class="prof-img">
                                            <a href="<?=base_url();?>assets/back-office/images/customer/<?=$img_link;?>" class="image-popup" title="<?=ucfirst(strtolower($user['firstname'])).' '.ucfirst(strtolower($user['lastname']));?>">
                                                <img src="<?=base_url();?>assets/back-office/images/customer/<?=$img_link;?>" class="header-icon1  user-top-img rounded-circle" alt="customer avatar">
                                            </a>
                                        </div>
                                        <h4 class="m-b-5"><b><?=ucfirst(strtolower($user['firstname'])).' '.ucfirst(strtolower($user['lastname']));?></b></h4>
                                        <p class="text-muted"><i class="fa fa-map-marker"></i> <?=$user['address'].', '.$user['address_unit'].', '.$user['city'].', '.$user['state'].', '.$user['country'].', '.$user['zip_code']?></p>
                                        <p class="text-muted"><?=$user['email'];?></p>
                                        <label class="label label-danger"><?=($user['role']==2)?'Customer':'Guest'?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box m-t-20">
									<h4 class=" m-t-0 header-title"><b>Transaction History </b></h4>
									<p class="text-muted m-b-30 font-13">Below are the list of transactions for this client.</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="list-group m-b-20">
                                                <li class="list-group-item active">
                                                    <i class="fa fa-shopping-cart"></i> Order ID: <?=$orders['order_id'];?><br>
                                                    <?php if($orders['graphic_img']): ?>
                                                        <i class="fa fa-send"></i> Shipping Tracking No.: <?= ($orders['tracking_number']) ? ''.$orders['tracking_number'].'' : 'No shipment tracking available'; ?> <br>
                                                    <?php endif ?>
                                                    <small>Ordered Date: <?=date('Y-m-d, h:i A', strtotime($orders['date_ordered']));?></small> <br>
                                                    <small>Status: 
                                                        <?=($orders['order_status'] == 1) ? '<span class="label label-danger">Awaiting Check Payment</span>' : '';?>
                                                        <?=($orders['order_status'] == 2) ? '<span class="label label-danger">Awaiting COD validation</span>' : '';?>
                                                        <?=($orders['order_status'] == 3) ? '<span class="label label-danger">Cancelled</span>':'';?>
                                                        <?=($orders['order_status'] == 4) ? '<span class="label label-danger">Delivered</span>' : '';?>
                                                        <?=($orders['order_status'] == 5) ? '<span class="label label-danger">Payment Accepted</span>' : '';?>
                                                        <?=($orders['order_status'] == 6) ? '<span class="label label-danger">Payment Error</span>':'';?>
                                                        <?=($orders['order_status'] == 7) ? '<span class="label label-danger">Processing in progress</span>' : '';?>
                                                        <?=($orders['order_status'] == 8) ? '<span class="label label-danger">Refunded</span>' : '';?>
                                                        <?=($orders['order_status'] == 9) ? '<span class="label label-danger">Shipped</span>' : '';?>  	
                                                    </small>
                                                </li>
                                                <!-- Item Headings -->
                                                <li class="list-group-item p-grp-title" style="border-bottom: 3px solid #444;">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 col-xs-2 text-center"><b>ID</b></div>
                                                    <div class="col-md-3 col-sm-3 col-xs-3"><b>PRODUCT</b></div>
                                                    <div class="col-md-3 col-sm-3 col-xs-3"><b>PRICE TOTAL</b></div>
                                                    <div class="col-md-1 col-sm-1 col-xs-1"><b>QTY</b></div>
                                                    <div class="col-md-3 col-sm-3 col-xs-3"><b>SUBTOTAL</b></div>
                                                </div>
                                                </li>
                                                <!-- Display cart items -->
                                                <?php $pid = json_decode($orders['product_id']); $qty = json_decode($orders['quantity']); ?>
                                                <?php $sub_total=0; $subtotal = 0; foreach($pid as $key => $j){ $i = $this->product_model->get_specific_product($j);
                                                     $subtotal += $qty[$key] * $i['item_price']; ?>
                                                    <li class="list-group-item cart-items">
                                                        <div class="row">
                                                        <div class="col-md-2 col-sm-2 col-xs-2 text-center"><?=$i['item_id'];?></div>
                                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                                <div class="img-product">
                                                                    <img src="<?=base_url();?>assets/back-office/images/products/<?=$i['item_image'] ? $i['item_image'] :  'default.png';?>" alt="Product Image">
                                                                </div>
                                                                <a href="<?=base_url();?>product_detail/<?=$i['item_id'];?>" class="text-info" style="    margin-top: 15px;float:left;"><?=$i['item_title'];?></a>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 col-xs-3">$<?=$i['item_price'];?></div>
                                                            <div class="col-md-1 col-sm-1 col-xs-1"><?=$qty[$key];?></div>
                                                            <div class="col-md-3 col-sm-3 col-xs-3">$<?=number_format($qty[$key] * $i['item_price'], 2, '.', '');?></div>
                                                        </div>
                                                    </li>
                                                <?php $sub_total = $subtotal; } ?>
                                                <li class="list-group-item" style="border-top: 2px solid #444;">
                                                    <div class="row">
                                                        <div class="col-md-2 col-sm-2 col-xs-2"></div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3"><b>Subtotal</b></div>
                                                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3">$<?=number_format($sub_total, 2, '.', '');?></div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-2 col-sm-2 col-xs-2"></div>
                                                        <?php $overall = $orders['sales_tax']*$sub_total; ?>
                                                        <div class="col-md-3 col-sm-3 col-xs-3"><b>Sales Tax (<?=number_format($orders['sales_tax'], 3, '.', '')*100;?>%)</b></div>
                                                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3">$<?=number_format($overall, 2, '.', '');?></div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-2 col-sm-2 col-xs-2"></div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3"><b>Shipping rate (<?=$orders['service_type'] != "" ? $this->config->item('ups')['services'][$orders['service_type']] : '' ?>)</b></div>
                                                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3">$<?=number_format($orders['shipping_rate'], 2, '.', '');?></div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-2 col-sm-2 col-xs-2"></div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3"><b>Total</b></div>
                                                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3">$<?=number_format($orders['total_paid'], 2, '.', '');?></div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php if($orders['graphic_img']): ?>
                                        <h4 class=" m-t-20 header-title"><b>Shipping Information </b></h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="shipping-img ship-img">
                                                    <img src="<?=base_url()?>assets/back-office/images/graphic/<?=$orders['graphic_img'];?>" alt="Shipping Information"> 
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div> <!-- container -->
                               
                </div> <!-- content -->

                <?php $this->load->view('admin/common/footer');?>

            </div>
            <!-- End Right content here -->
        </div>
        <!-- END wrapper -->

        <?php $this->load->view('admin/common/js');?>
        <script>
            $(document).ready(function() {
                $('.image-popup').magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    mainClass: 'mfp-fade',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    }
                });
            });
        </script>
	</body>
</html>