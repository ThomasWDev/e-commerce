<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('frontpage/common/css');?>

<body class="animsition">

	<!-- header and header fixed -->
	<?php $this->load->view('frontpage/common/header/header');?>

	<!-- Slide1 -->
	<section class="slide1">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1 item1-slick1" style="background-image: url(assets/front-office/images/master-slide-07.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="fadeInUp">
							Leather Bags
						</h2>

						<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
							New Collection <?=date('Y');?>
						</span>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<!-- Button -->
							<a href="<?=base_url();?>shop" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item2-slick1" style="background-image: url(assets/front-office/images/master-slide-06.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="rollIn">
							Fashion Dresses
						</h2>

						<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="lightSpeedIn">
							New Collection <?=date('Y');?>
						</span>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
							<!-- Button -->
							<a href="<?=base_url();?>shop" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item3-slick1" style="background-image: url(assets/front-office/images/master-slide-02.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="rotateInDownLeft">
							Cool Pants
						</h2>

						<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="rotateInUpRight">
							New Collection <?=date('Y');?>
						</span>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="rotateIn">
							<!-- Button -->
							<a href="<?=base_url();?>shop" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- Our product -->
	<section class="bgwhite p-t-45 p-b-58">
		<div class="container">
			<div class="sec-title p-b-22">
				<h3 class="m-text5 t-center">
					Our Products
				</h3>
			</div>
			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#new-arrival" role="tab">New Arrivals</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#featured" role="tab">Featured</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#sale" role="tab">Sale</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-35">
					<!-- Sale -->
					<div class="tab-pane fade show active" id="new-arrival" role="tabpanel">
						<div class="row">
							<?php if($get_new_products){ foreach($get_new_products as $new){ extract($new); ?>
								<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
									<div class="block2">
										<div class="block2-img wrap-pic-w of-hidden pos-relative <?=($sale_price!='0.00') ? 'block2-labelsale' : 'block2-labelnew';?>">
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
											<?php if($sale_price!='0.00'){ ?>
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
							<?php } }else{ ?>
								<div class="col lg-12 p-b-50">
									<div class="alert alert-info">
										<strong>Empty!</strong> There are no new arrival products.
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
					<!-- Featured -->
					<div class="tab-pane fade" id="featured" role="tabpanel">
						<div class="row">
							<?php if($get_featured_products){ foreach($get_featured_products as $featured){ extract($featured); ?>
								<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
									<div class="block2">
										<div class="block2-img wrap-pic-w of-hidden pos-relative <?=($sale_price!='0.00') ? 'block2-labelsale' : 'block2-labelnew';?>">
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
											<?php if($sale_price!='0.00'){ ?>
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
							<?php } }else{ ?>
								<div class="col lg-12 p-b-50">
									<div class="alert alert-info">
										<strong>Empty!</strong> There are no new arrival products.
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
					<!-- Sale -->
					<div class="tab-pane fade" id="sale" role="tabpanel">
						<div class="row">
							<?php if($get_sale_products){ foreach($get_sale_products as $sale){ extract($sale); ?>
								<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
									<div class="block2">
										<div class="block2-img wrap-pic-w of-hidden pos-relative <?=($sale_price!='0.00') ? 'block2-labelsale' : 'block2-labelnew';?>">
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
											<?php if($sale_price!='0.00'){ ?>
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
							<?php } }else{ ?>
								<div class="col lg-12 p-b-50">
									<div class="alert alert-info">
										<strong>Empty!</strong> There are no new arrival products.
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
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

	<!-- JS Files -->
	<?php $this->load->view('frontpage/common/js');?>

</body>
</html>
