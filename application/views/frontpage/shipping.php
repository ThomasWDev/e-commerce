<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('frontpage/common/css');?>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<!-- Cart -->
<?php 
    $total=0;
    if($this->session->userdata('user_id')){
        $my_items = $this->product_model->get_my_product();
    }else{
        $my_items = (isset($_SESSION['cart']))?$_SESSION['cart']:[];
    }
?>
<body class="animsition">

	<!-- header and header fixed -->
	<?php 
        if($is_page != 'checkout' && $is_page != 'shipping' && $is_page != 'payment'){
            $this->load->view('frontpage/common/header/header');
        }
    ?>
	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?=base_url();?>assets/front-office/images/master-slide-06.jpg);">
		<h2 class="l-text2 t-center"> Shipping method </h2>
	</section>
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
        <nav aria-label="breadcrumb">
        <?php $this->load->view('frontpage/common/checkout_breadcrumbs'); ?>
        </nav>
			<!-- Cart item -->
			<div class="pos-relative">
				<div class="bgwhite">
                    <form method="post" class="leave-comment">
					    <div class="row">
                            <?php if($my_items){ ?>
                                <div class="col-lg-7 col-md-12">
                                    <h4 class="m-text26 p-b-20">Shipping method</h4>
                                    <ul class="list-group m-b-20">
                                    <?php $x = 0;foreach($rates as $rate){$x++; ?>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label class="form-check-label">
                                                    <input type="radio" value="<?=$rate['rates_code'].'|'.$rate['rates_amount']?>" class="form-check-input" name="shipping_method" <?= isset($shipping) ? ($shipping['code'] == $rate['rates_code'] ? 'checked' : '') :( $x == 1 ? 'checked' : '')?> > 
                                                    <?= $this->config->item('ups')['services'][$rate['rates_code']] ?>
                                                     <!-- <br/> <small>7 to 21 business days</small> -->
                                                </label>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <strong><?=$rate['rates_amount']?></strong>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    </ul>
                                    <div class="row m-b-20">
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-left">
                                            <a href="<?=base_url()?>checkout" class="btn btn-link">< Return to information</a>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                                            <button type="submit" class="btn btn-primary">Continue to payment</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12" id="my-orders">
                                    <?php $this->load->view('frontpage/my_order'); ?>
                                </div>
                            <?php }else{ ?>
                                <div class="col-md-12">
                                    <div class="custom-cart-alert c-alert-info">
                                        <strong><i class="fa fa-shopping-cart"></i> Oops!</strong> Your cart is empty. <a href="<?=base_url();?>shop">Click here</a> to go to shop.
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </form>
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

	<!-- JS Files -->
	<?php $this->load->view('frontpage/common/js');?>
</body>
</html>
