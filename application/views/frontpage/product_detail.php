<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('frontpage/common/css');?>

<body class="animsition">

	<!-- header and header fixed -->
	<?php $this->load->view('frontpage/common/header/header');?>
	
		<!-- breadcrumb -->
        <div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?=base_url();?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="<?=base_url();?>shop" class="s-text16">
			Shop
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			<?=$prod['product_name'];?>
		</span>
	</div>

	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>

					<div class="slick3">
						<div class="item-slick3" data-thumb="<?=base_url();?>assets/back-office/images/products/<?=$prod['product_primary_pic'] ? $prod['product_primary_pic'] : 'default.png'?>">
							<div class="wrap-pic-w">
								<img src="<?=base_url();?>assets/back-office/images/products/<?=$prod['product_primary_pic'] ? $prod['product_primary_pic'] : 'default.png'?>" alt="<?=$prod['product_name'];?>">
							</div>
						</div>
                        <?php $imgs = $this->product_model->get_product_images($prod['product_id']);?>
                        <?php if($imgs){ foreach($imgs as $m){ extract($m);?>
                            <div class="item-slick3" data-thumb="<?=base_url();?>assets/back-office/images/products/<?=$img_name;?>">
                                <div class="wrap-pic-w">
                                    <img src="<?=base_url();?>assets/back-office/images/products/<?=$img_name;?>" alt="<?=$prod['product_name'];?>">
                                </div>
                            </div>
                        <?php } } ?>
					</div>
				</div>
			</div>

			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
                <?=$prod['product_name'];?>
				</h4>

                <?php if($prod['sale_price']!=0){ ?>
                    <span class="text-danger m-text17 p-r-5">
                        $ <?=$prod['sale_price'];?>
                    </span>
                    <span class="oldprice m-text17 p-r-5">
                        $ <?=$prod['reg_price'];?>
                    </span>
                <?php } else { ?>
                    <span class="block2-price m-text17 p-r-5">
                        $ <?=$prod['reg_price'];?>
                    </span>
                <?php } ?>

				<p class="s-text8 p-t-10">
					<?=$prod['description'];?>
				</p>
				<p class="s-text8 p-t-10">
					<span class="s-text8 m-r-35">Remaining Quantity: <?=$prod['quantity'];?></span>
				</p>
				
				<!--  -->
				<div class="p-t-33 p-b-60 text-left">
					<div class="p-t-10">
						<small class="text-success" id="success-msg"></small>
						<div class="w-size16 flex-m flex-w">
							<div class="btn-addcart-product-detail size12 trans-0-4 m-b-10">
								<!-- Button -->
								<?php if($prod['quantity']){ ?>
									<button onclick="add_to_cart(this, <?=$prod['product_id'];?>,'single_add')" class="sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
										Add to Cart
									</button>
								<?php }else{ ?>
									<span class="out-of-stock">Out of stock</span>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>

				<div class="p-b-45">
					<span class="s-text8 m-r-35">SKU: <?=($prod['product_sku'])?$prod['product_sku']:'No SKU';?></span>
					<span class="s-text8">Categories: 
                        <?php 
                            if($prod['categories']){ 
                                $cat = json_decode($prod['categories']); 
                                foreach($cat as $cat_id){
                                    $ctg = $this->catalog_model->view_single_category($cat_id);
                                    echo $ctg['cat_name'].', ';
                                }
                            }else{ echo 'No Category'; }
                        ?>
					</span>
					<br/>
					<span class="s-text8 m-r-35">Dimension: <?= $prod['length'] .' x '. $prod['width'] .' x '. $prod['height'].' cm'?></span>
					<span class="s-text8">Weight: <?= $prod['weight'] .' lbs'; ?></span>

					
				</div>

				<!--  -->
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Description
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							<?=($prod['description'])?$prod['description']:'No Description';?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Our product -->
	<section class="bgwhite p-t-45 p-b-58">
		<div class="container">
			<div class="row">
				<!-- All Products List -->
				<div class="col-lg-12 p-b-50">
					<h4 class="m-text14 p-b-20">
						All Products
					</h4>

					<div class="row">
						<?php if($get_new_products){ foreach($get_new_products as $new){ extract($new); ?>
							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
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
													<button onclick="add_to_cart(this, <?=$product_id;?>,'add')" type="button" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
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

</body>
</html>
