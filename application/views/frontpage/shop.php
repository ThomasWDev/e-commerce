<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('frontpage/common/css');?>

<body class="animsition">

	<!-- header and header fixed -->
	<?php $this->load->view('frontpage/common/header/header');?>
	
	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?=base_url();?>assets/front-office/images/master-slide-06.jpg);">
		<h2 class="l-text2 t-center">
			Shop
		</h2>
		<p class="m-text13 t-center">
			All products this <?=date('Y'); ?>
		</p>
	</section>

	<!-- Our product -->
	<section class="bgwhite p-t-45 p-b-58">
		<div class="container">
			<div class="row">
				<!-- Sort Left Navigation -->
				<?php $this->load->view('frontpage/common/sort');?>

				<!-- All Products List -->
				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<h4 class="m-text14 p-b-20">
						All Products
					</h4>

					<div class="row" id="product_row_containter">
						<?php if($get_products){ foreach($get_products as $new){ extract($new); ?>
							<div class="col-sm-6 col-md-4 col-lg-4 p-b-50 product_container" data-search-item="<?=$product_name;?>" data-search-price="<?=$reg_price;?>">
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative <?=($sale_price!=0) ? 'block2-labelsale' : 'block2-labelnew';?>">
										<div class="product-img">
											<img src="<?=base_url();?>assets/back-office/images/products/<?=$product_primary_pic ? $product_primary_pic : 'default.png';?>" alt="<?=$product_name;?>">
										</div>

										<div class="block2-overlay trans-0-4">
											<div class="block2-btn-addcart w-size1 trans-0-4">
												<!-- Button -->
												<a href="<?= base_url() ?>product_detail/<?=$product_id?>" class="mb-1 flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 text-white">
													View Product
												</a>
												<?php if($quantity){ ?>
													<button onclick="add_to_cart(this, <?=$product_id;?>,'add')" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														Add to Cart
													</button>
												<?php } ?>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="<?=base_url();?>product_detail/<?=$product_id;?>" class="block2-name dis-block s-text3 p-b-5">
											<?=$product_name;?>
										</a>
										<?php if($sale_price!=0){ ?>
											<span class="block2-oldprice m-text7 p-r-5">
												$ <?=$reg_price;?>
											</span>
											<span class="block2-newprice m-text8 p-r-5">
												$ <?=$sale_price;?>
											</span>
										<?php } else { ?>
											<span class="block2-price m-text6 p-r-5">
												$ <?=$reg_price;?>
											</span>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } ?>
						<?php }else{ ?>
							<div class="col lg-12 p-b-50">
								<div class="alert alert-info">
									<strong>Empty!</strong> There are no new arrival products.
								</div>
							</div>
						<?php } ?>
					</div>
					<?php if($get_products){ ?>
						<div class="row">
							<div class="col-md-12">
								<?=$links;?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
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

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>

	<!-- JS Files -->
	<?php $this->load->view('frontpage/common/js');?>
	<script type="text/javascript">
		$(document).on("change", "#sort_price", function() {
		    var sort = $(this).val();
		    var url = $(this).attr('data-url');
		    window.location.href=base_url+url+'?sort_price='+sort;
		});
	</script>
</body>
</html>
