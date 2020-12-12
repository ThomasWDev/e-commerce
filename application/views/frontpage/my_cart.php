<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('frontpage/common/css');?>

<body class="animsition">

	<!-- header and header fixed -->
	<?php $this->load->view('frontpage/common/header/header');?>

	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?=base_url();?>assets/front-office/images/master-slide-06.jpg);">
		<h2 class="l-text2 t-center">
			Cart
		</h2>
	</section>

	<!-- Cart -->
	<?php 
		$total=0;
		$subtotal=0;
		if($this->session->userdata('user_id')){
			$my_items = $this->product_model->get_my_product();
		}else{
			$my_items = (isset($_SESSION['cart']))?$_SESSION['cart']:[];
		}
	?>
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<?php if($my_items){ ?>
						<table class="table-shopping-cart">
							<tr class="table-head">
								<th class="column-1"></th>
								<th class="column-2">Product</th>
								<th class="column-3">Price</th>
								<th class="column-4 text-center">Quantity</th>
								<th class="column-5">Total</th>
								<th class="column-5">Action</th> 
							</tr>

							<?php 
							foreach($my_items as $i){ 
							$subtotal = $i['item_price'] * $i['qty'];
							$total += $subtotal;
							?>
								<tr class="table-row " id="my-cart-row-<?=$i['item_id']?>">
									<td class="column-1">
										<div onclick="remove_to_cart(<?=$i['item_id'];?>, 3)" class="cart-img-product b-rad-4 o-f-hidden">
											<img src="<?=base_url();?>assets/back-office/images/products/<?=$i['item_image'] ? $i['item_image'] : 'default.png';?>" alt="Product Image">
										</div>
									</td>
									<td class="column-2"><a href="<?=base_url();?>product_detail/<?=$i['item_id'];?>" class="header-cart-item-name"><?=$i['item_title'];?></a></td>
									<td class="column-3 " >$<span class="price-tbl-<?=$i['item_id']?>"><?=$i['item_price'];?></span></td>
									<td class="column-4 text-center" p-qty="<?=$i['qty_left']?>"><span class="qtyItem qty-<?=$i['item_id']?>"> <?=$i['qty'];?> </span>  <a class="btn btn-success btn-xs text-white ml-3 qty-btn-plus-<?=$i['item_id']?>  <?=$i['qty'] == $i['qty_left'] ? 'hidden' : '' ?>"  onclick="modifyQty(this,'add',<?=$i['item_id'];?>)"> <i class="fa fa-plus"> </i></a><a class="btn btn-danger btn-xs text-white qty-btn-minus-<?=$i['item_id']?> ml-1 <?=$i['qty'] > 1 ? '' : 'hidden' ?>" onclick="modifyQty(this,'minus',<?=$i['item_id'];?>)"> <i class="fa fa-minus"> </i></a></td>
									<td class="column-5" >$<span class="subtotal-tbl-<?=$i['item_id']?>"><?=number_format($subtotal, 2, '.', '')?></span></td>
									<td class="column-5"><button type="button" class="btn btn-danger" onclick="remove_to_cart(<?=$i['item_id'];?>, 3)"> <i class=" fa fa-times"> </i></button></td>
								</tr>
							<?php } ?>
						</table>
					<?php } else{ ?>
						<div class="custom-cart-alert c-alert-danger">
							<strong><i class="fa fa-check"></i> Empty!</strong> Your cart is empty. <a href="<?=base_url();?>shop">Click here</a> to go to shop.
						</div>
					<?php } ?>
				</div>
			</div>

			<!-- Total -->
			<?php if($my_items){ ?>
				<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
					<h5 class="m-text20 p-b-24">
						Cart Totals
					</h5>
					<!--  -->
					<div class="flex-w flex-sb-m p-t-26 p-b-30">
						<span class="m-text22 w-size19 w-full-sm">Total: </span>
						<span class="m-text21 w-size20 w-full-sm " id="totalCart">$<?=number_format($total, 2, '.', '');?></span>
					</div>
					<div class="size15 trans-0-4">
						<a href="<?=base_url();?>checkout" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Proceed to Checkout
						</a>
					</div>
				</div>
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
