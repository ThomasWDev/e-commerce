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
		<h2 class="l-text2 t-center"> Information </h2>
	</section>
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
        <nav aria-label="breadcrumb">
        <?php $this->load->view('frontpage/common/checkout_breadcrumbs'); ?>
        </nav>
			<!-- Cart item -->
			<div class="pos-relative">
				<div class="bgwhite">
                    <form id="shippingAddressForm" onsubmit="return checkInput()" class="leave-comment" method="POST">
					    <div class="row">
                            <?php if($my_items){ ?>
                                <div class="col-lg-7 col-md-12">
                                    <h4 class="m-text26 p-b-20">Shipping Address</h4>
                                    <?php if(!$this->session->userdata('user_id')){ ?>
                                        <p>Returning Customer? <a onclick="launchLogin(1)" href="javascript:;" class="text-info">Click here to login</a>.</p>
                                    <?php } ?>
                                    <p>Please fill-up all the fields below to proceed.</p>
                                    <div class="row">
                                        <div class="col-md-12 p-b-20"><div class="err-msg"></div></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="bo4 of-hidden size15 m-b-20">
                                                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="firstname" name="firstname" placeholder="First Name *" value="<?=($this->session->userdata('user_id'))? (!empty($receiver_dtls) ? $receiver_dtls['firstname'] :$my_info['firstname']) : (!empty($receiver_dtls) ? $receiver_dtls['firstname'] :'');?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="bo4 of-hidden size15 m-b-20">
                                                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="lastname" name="lastname" placeholder="Last Name *" value="<?=($this->session->userdata('user_id'))?(!empty($receiver_dtls) ? $receiver_dtls['lastname'] : $my_info['lastname']):(!empty($receiver_dtls) ? $receiver_dtls['lastname'] :'');?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bo4 of-hidden size15 m-b-20">
                                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="address" name="address" placeholder="Address *" value="<?=($this->session->userdata('user_id'))?(!empty($receiver_dtls) ? $receiver_dtls['address'] : $my_info['address']):(!empty($receiver_dtls) ? $receiver_dtls['address'] : '');?>">
                                    </div>
                                    <div class="bo4 of-hidden size15 m-b-20">
                                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="address_unit" name="address_unit" placeholder="Apartment, suite, unit, street, etc. (Optional)" value="<?=($this->session->userdata('user_id'))?(!empty($receiver_dtls) ? $receiver_dtls['address_unit']:$my_info['address_unit']):(!empty($receiver_dtls) ? $receiver_dtls['address_unit']:'');?>">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="bo4 of-hidden size15 m-b-20 zipcode-wrap">
                                                <input class="sizefull s-text7 p-l-22 p-r-22 numOnly" type="text" id="zipcode" name="zip_code" placeholder="Postal/Zip Code *" value="<?=($this->session->userdata('user_id'))?(!empty($receiver_dtls) ? $receiver_dtls['zip_code']:$my_info['zip_code']):(!empty($receiver_dtls) ? $receiver_dtls['zip_code']:'');?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="bo4 of-hidden size15 m-b-20 zipcode-wrap">
                                                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="city" name="city" placeholder="Town/City *" value="<?=($this->session->userdata('user_id'))?(!empty($receiver_dtls) ? $receiver_dtls['city']:$my_info['city']):(!empty($receiver_dtls) ? $receiver_dtls['city']:'');?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="bo4 of-hidden size15 m-b-20 zipcode-wrap">
                                                <input  class="sizefull s-text7 p-l-22 p-r-22" type="text" id="state" name="state" placeholder="State *" value="<?=($this->session->userdata('user_id'))?(!empty($receiver_dtls) ? $receiver_dtls['state']:$my_info['state']):(!empty($receiver_dtls) ? $receiver_dtls['state']:'');?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bo4 of-hidden size15 m-b-20">
                                        <select name="country" id="country" class="bo4 sizefull s-text7 p-l-22 p-r-22">
                                            <option value="">Select Country</option>
                                            <option value="US" <?=($this->session->userdata('user_id'))?((($my_info['country']=='US'))?'selected':''):(!empty($receiver_dtls) ? 'selected' : '');?>>United States</option>
                                        </select>
                                    </div>
                                    <div class="bo4 of-hidden size15 m-b-20">
                                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" placeholder="Phone *" value="<?=($this->session->userdata('user_id'))?(!empty($receiver_dtls) ? $receiver_dtls['phone']:$my_info['phone']):(!empty($receiver_dtls) ? $receiver_dtls['phone']:'');?>" id="phone" name="phone">
                                    </div>
                                    <div class="bo4 of-hidden size15 m-b-20" id="emaildiv">
                                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" placeholder="Email *" value="<?=($this->session->userdata('user_id'))?(!empty($receiver_dtls) ? $receiver_dtls['email']:$my_info['email']):(!empty($receiver_dtls) ? $receiver_dtls['email']:'');?>" id="email" name="email" <?=($this->session->userdata('user_id'))?'readonly':'';?>>
                                    </div>
                                    <?php if(!$this->session->userdata('user_id')){ ?>
                                        <h4 class="m-text26">Create Your Account</h4>
                                        <p>If you want to become a member on our site, you can create your account to checkout fast on your next transactions. If you have already an account, you can <a onclick="launchLogin(1)" href="javascript:;" class="text-info">login here</a>.</p>
                                        <div class="bo4 of-hidden size15 m-b-20">
                                            <input class="sizefull s-text7 p-l-22 p-r-22" type="password" placeholder="Password *" value="<?= !empty($new_customer_password) ? $new_customer_password : '' ?>" id="password" name="password">
                                        </div>
                                        <div class="bo4 of-hidden size15 m-b-20 pass-wrap">
                                            <input class="sizefull s-text7 p-l-22 p-r-22" type="password" placeholder="Confirm Password *" value="<?= !empty($new_customer_password) ? $new_customer_password : '' ?>" value="" id="cpassword">
                                        </div>
                                    <?php } ?>
                                    <div class="row m-b-20">
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-left">
                                            <a href="<?=base_url()?>cart" class="btn btn-link">< Return to cart</a>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                                            <button type="submit" class="btn btn-primary" id="btn-continue-to-shipping">Continue to shipping</button>
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
    <script>
        $('.paypal-btn-grp').hide();
        $('.select-shipping-text').hide();

        function calculate_orders(type){
            // $('#val-data').html('<i class="fa fa-spinner fa-spin"></i> We are validating your informaton. Please wait...');
            $.ajax({
                url: 'frontpage/calculate_orders/',
                type: 'POST',
                dataType: 'JSON',
                data: $('#shippingAddressForm').serialize(),
                success: (res)=>{
                    if(res.code==200){
                        $('#my-orders').html(res.data);

                        if(type==2){
                            
                            // renderPaymentBtn();
                            // $('.paypal-btn-grp').show();
                            $('.zipcode-wrap').removeAttr('style');
                            $('.pass-wrap').removeAttr('style');
                            $('#emaildiv').removeAttr('style');
                            $("#agree").prop('checked', true); 
                            $('.err-msg').html('');
                            $('#shippingAddressForm').removeAttr('onsubmit');
                            $('#shippingAddressForm').submit();
                            

                        }else{
                            // $('.paypal-btn-grp').hide();
                            
                            $('#btn-continue-to-shipping').html('Continue to shipping');
                            $('#btn-continue-to-shipping').attr('disabled',false);
                        }
                        
                    }else{
                        // $('#my-orders').html(res.data);
                        // $('#val-data').html('');
                        // $("#agree").prop('checked', false); 
                        $('.paypal-btn-grp').hide();
                        $('.zipcode-wrap').css('border','1px solid red');
                        $('.err-msg').html(errMsg('.err-msg', res.msg));
                    }
                }
            });
        }

        function hidePaymentBtn(){
            $('.paypal-btn-grp').hide();
            $('#hidePaymentBtn').hide();
            $('#hasTax').hide();
            $("#agree").prop('checked', false); 
        }
    </script>
</body>
</html>
