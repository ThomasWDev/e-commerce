<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('frontpage/common/css');?>

<body class="animsition">
	<div class="loader-bg"><span id="loader"></span></div>
	<!-- header and header fixed -->
	<?php $this->load->view('frontpage/common/header/header');?>
	<?php  $total=0; $subtotal=0; $payment_settings = $this->admin_model->get_payment_settings();?>
		<!-- breadcrumb -->
        <div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?=base_url();?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17">
			Transaction History
		</span>
	</div>
	<section class="cart bgwhite p-t-40 p-b-100">
		<div class="container">
			<h5 class="p-b-10">My Transactions</h5>
			<?php if($this->session->userdata('user_id')){  $orders = $this->product_model->get_my_transactionsHistory(); ?>
			<?php if ($orders) { foreach($orders as $o){
				$qty = json_decode($o['quantity']);?>					
				<ul class="list-group m-b-20">
					<li class="list-group-item active">
						<i class="fa fa-shopping-cart"></i> Order ID: <?=$o['order_id'];?> 
						 <!-- $o['order_status'] != 3 && $o['order_status'] != 4 ? '| <button class="btn btn-danger btn-sm" onclick="cancelOrder('.$o['order_id'].',3)" id="transactionCancelBtn">Cancel</button>' : ''  -->
						  <br>
						<?php if($o['graphic_img']&&$o['order_status']==5): ?>
							<i class="fa fa-send"></i> Shipping Tracking No.: <?= ($o['tracking_number']) ? ''.$o['tracking_number'].'' : 'No shipment tracking available'; ?> <br>
						<?php endif ?>
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
							<div class="col-md-3 col-sm-3 col-xs-3"><b>PRODUCT</b></div>
							<div class="col-md-3 col-sm-3 col-xs-3"><b>PRICE TOTAL</b></div>
							<div class="col-md-1 col-sm-1 col-xs-1"><b>QTY</b></div>
							<div class="col-md-3 col-sm-3 col-xs-3"><b>SUBTOTAL</b></div>

						</div>
					</li>
					<!-- Display cart items -->
					<?php $pid = json_decode($o['product_id']); ?>

					<?php foreach($pid as $key => $j){ 
						$i = $this->product_model->get_specific_product($j); 
						$subtotal = $i['item_price'] * $qty[$key]; $total+=$subtotal;
						?>
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
								<div class="col-md-3 col-sm-3 col-xs-3">$<?=number_format($subtotal, 2, '.', '');?></div>
							</div>
						</li>
					<?php } ?>
					<li class="list-group-item" style="border-top: 2px solid #444;">
						<div class="row">
							<div class="col-md-2 col-sm-2 col-xs-2"></div>
							<div class="col-md-3 col-sm-3 col-xs-3"><b>Subtotal</b></div>
							<div class="col-md-4 col-sm-4 col-xs-4"></div>
							<div class="col-md-3 col-sm-3 col-xs-3">$<?=number_format($total, 2, '.', '');?></div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-2 col-sm-2 col-xs-2"></div>
							<?php $overall = $o['sales_tax']*$total; ?>
							<div class="col-md-3 col-sm-3 col-xs-3"><b>Sales Tax (<?=number_format($o['sales_tax'], 3, '.', '')*100;?>%)</b></div>
							<div class="col-md-4 col-sm-4 col-xs-4"></div>
							<div class="col-md-3 col-sm-3 col-xs-3">$<?=number_format($overall, 2, '.', '');?></div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-2 col-sm-2 col-xs-2"></div>
							<div class="col-md-3 col-sm-3 col-xs-3"><b>Shipping rate (<?=isset($o['service_type'])  && $o['service_type'] != "" ? $this->config->item('ups')['services'][$o['service_type']] : '' ?>)</b></div>
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
				<?php if($o['graphic_img']): ?>
					<h4>Shipping Information</h4>
					<div class="row m-t-10">
						<div class="col-md-12">
							<div class="shipping-img ship-img">
								<img src="<?=base_url()?>assets/back-office/images/graphic/<?=$o['graphic_img'];?>" alt="Shipping Information"> 
							</div>
						</div>
					</div>
				<?php endif ?>
			<?php } } else{ ?>
				<div class="custom-cart-alert c-alert-info">You don't have transactions.</div>
			<?php } } else{ ?>
				<?php $o = (isset($_SESSION['order_id']))?$this->product_model->get_my_last_order($_SESSION['order_id']) : ''; ?>
				<?php if($o){ ?>
					<ul class="list-group m-b-20">
						<li class="list-group-item active">
							<i class="fa fa-shopping-cart"></i> Order ID: <?=$o['order_id'];?> <br>
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
						<?php $total=0; foreach($pid as $j){ $i = $this->product_model->get_specific_product($j);?>
							<li class="list-group-item cart-items">
								<div class="row">
									<div class="col-md-2 col-sm-2 col-xs-2 text-center"><?=$i['item_id'];?></div>
									<div class="col-md-5 col-sm-5 col-xs-5">
										<div class="img-product">
											<img src="<?=base_url();?>assets/back-office/images/products/<?=$i['item_image'];?>" alt="Product Image">
										</div>
										<a href="<?=base_url();?>product_detail/<?=$i['item_id'];?>" class="text-info" style="    margin-top: 15px;float:left;"><?=$i['item_title'];?> x 1</a>
									</div>
									<div class="col-md-5 col-sm-5 col-xs-5">$<?=$i['item_price'];?></div>
								</div>
							</li>
						<?php $total+=$i['item_price']; } ?>
						<li class="list-group-item" style="border-top: 2px solid #444;">
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2"></div>
								<div class="col-md-5 col-sm-5 col-xs-5"><b>Subtotal</b></div>
								<div class="col-md-5 col-sm-5 col-xs-5">$<?=number_format($total, 2, '.', '');?></div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-2"></div>
								<?php $overall = $o['sales_tax']*$total; ?>
								<div class="col-md-5 col-sm-5 col-xs-5"><b>Sales Tax (<?=number_format($o['sales_tax'], 3, '.', '')*100;?>%)</b></div>
								<div class="col-md-5 col-sm-5 col-xs-5">$<?=number_format($overall, 2, '.', '');?></div>
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
				<?php }else{ ?>
					<div class="custom-cart-alert c-alert-info">You don't have transactions.</div>	
				<?php } ?>
			<?php } ?>
		</div>
	</section>

	<!-- Footer -->
	<?php $this->load->view('frontpage/common/footer');?>

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- JS Files -->
	<?php $this->load->view('frontpage/common/js');?>

</body>
</html>
