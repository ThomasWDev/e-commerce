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
                if($this->session->userdata('user_id')){
                    
                }else{
                    $orders = (isset($_SESSION['orders']))?$_SESSION['orders']:[];
                }
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
                                            <?php if ($orders) { foreach($orders as $o){?>	
                                                <ul class="list-group m-b-20">
                                                    <li class="list-group-item active">
                                                        <i class="fa fa-shopping-cart"></i> Order ID: <?=$o['order_id'];?> <br>
                                                        <small>Ordered Date: <?=date('Y-m-d, h:i A', strtotime($o['date_ordered']));?></small> <br>
                                                        <small>Status: 
                                                            <?=($o['order_status'] == 1) ? '<span class="label label-danger">Awaiting Check Payment</span>' : '';?>
                                                            <?=($o['order_status'] == 2) ? '<span class="label label-danger">Awaiting COD validation</span>' : '';?>
                                                            <?=($o['order_status'] == 3) ? '<span class="label label-danger">Cancelled</span>':'';?>
                                                            <?=($o['order_status'] == 4) ? '<span class="label label-danger">Delivered</span>' : '';?>
                                                            <?=($o['order_status'] == 5) ? '<span class="label label-danger">Payment Accepted</span>' : '';?>
                                                            <?=($o['order_status'] == 6) ? '<span class="label label-danger">Payment Error</span>':'';?>
                                                            <?=($o['order_status'] == 7) ? '<span class="label label-danger">Processing in progress</span>' : '';?>
                                                            <?=($o['order_status'] == 8) ? '<span class="label label-danger">Refunded</span>' : '';?>
                                                            <?=($o['order_status'] == 9) ? '<span class="label label-danger">Shipped</span>' : '';?>  	
                                                        </small><br />
                                                        <?php if($o['graphic_img']): ?>
                                                        <!-- <small> Shipment Status: <span class="label label-danger"><?= $this->Admin_model->track_shipping($o['tracking_number']); ?></span> </small> -->
                                                        <?php endif ?>
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
                                                    <?php $pid = json_decode($o['product_id']);$qty = json_decode($o['quantity']); ?>
                                                    <?php $sub_total=0; foreach($pid as $key => $j){ $i = $this->product_model->get_specific_product($j);
                                                        $sub_total += $qty[$key] * $i['item_price'];?>
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
                                                    <?php } ?>
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
                                                            <?php $overall = $o['sales_tax']*$sub_total; ?>
                                                            <div class="col-md-3 col-sm-3 col-xs-3"><b>Sales Tax (<?=number_format($o['sales_tax'], 3, '.', '')*100;?>%)</b></div>
                                                            <div class="col-md-4 col-sm-4 col-xs-4"></div>
                                                            <div class="col-md-3 col-sm-3 col-xs-3">$<?=number_format($overall, 2, '.', '');?></div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-2 col-sm-2 col-xs-2"></div>
                                                            <div class="col-md-3 col-sm-3 col-xs-3"><b>Shipping rate (<?=isset($o['service_type']) && $o['service_type'] != "" ? $this->config->item('ups')['services'][$o['service_type']] : '' ?>)</b></div>
                                                            <div class="col-md-4 col-sm-4 col-xs-4"></div>
                                                            <div class="col-md-3 col-sm-3 col-xs-3">$<?=number_format($o['shipping_rate'], 2, '.', '');?></div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-2 col-sm-2 col-xs-2"></div>
                                                            <div class="col-md-3 col-sm-3 col-xs-3"><b>Total</b></div>
                                                            <div class="col-md-4 col-sm-4 col-xs-4"></div>
                                                            <div class="col-md-3 col-sm-3 col-xs-3">$<?=number_format($o['total_paid'], 2, '.', '');?></div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            <?php } }else{ ?>
                                                <div class="alert alert-info">You don't have transactions.</div>
                                            <?php }  ?>
                                        </div>
                                    </div>
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