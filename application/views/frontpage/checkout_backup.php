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
	<?php $this->load->view('frontpage/common/header/header');?>

	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?=base_url();?>assets/front-office/images/master-slide-06.jpg);">
		<h2 class="l-text2 t-center"> Checkout </h2>
	</section>
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="pos-relative">
				<div class="bgwhite">
                    <form id="paymentForm" class="leave-comment">
					    <div class="row">
                            <?php if($my_items){ ?>
                                <div class="col-lg-7 col-md-12">
                                    <h4 class="m-text26 p-b-20">Billing Details</h4>
                                    <?php if(!$this->session->userdata('user_id')){ ?>
                                        <p>Returning Customer? <a onclick="launchLogin(1)" href="javascript:;" class="text-info">Click here to login</a>.</p>
                                    <?php } ?>
                                    <p>Please fill-up all the fields below to proceed.</p>
                                    <div class="row">
                                        <div class="col-md-12 p-b-20"><div class="err-msg"></div></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div onkeypress="hidePaymentBtn()" onblur="hidePaymentBtn()" class="bo4 of-hidden size15 m-b-20">
                                                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="firstname" name="firstname" placeholder="First Name *" value="<?=($this->session->userdata('user_id'))?$my_info['firstname']:'';?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div onkeypress="hidePaymentBtn()" onblur="hidePaymentBtn()" class="bo4 of-hidden size15 m-b-20">
                                                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="lastname" name="lastname" placeholder="Last Name *" value="<?=($this->session->userdata('user_id'))?$my_info['lastname']:'';?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bo4 of-hidden size15 m-b-20">
                                        <input onkeypress="hidePaymentBtn()" onblur="hidePaymentBtn()" class="sizefull s-text7 p-l-22 p-r-22" type="text" id="address" name="address" placeholder="Address *" value="<?=($this->session->userdata('user_id'))?$my_info['address']:'';?>">
                                    </div>
                                    <div class="bo4 of-hidden size15 m-b-20">
                                        <input onkeypress="hidePaymentBtn()" onblur="hidePaymentBtn()" class="sizefull s-text7 p-l-22 p-r-22" type="text" id="address_unit" name="address_unit" placeholder="Apartment, suite, unit, street, etc. (Optional)" value="<?=($this->session->userdata('user_id'))?$my_info['address_unit']:'';?>">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="bo4 of-hidden size15 m-b-20 zipcode-wrap">
                                                <input onkeypress="hidePaymentBtn()" onblur="hidePaymentBtn()" class="sizefull s-text7 p-l-22 p-r-22 numOnly" type="text" id="zipcode" name="zip_code" placeholder="Postal/Zip Code *" value="<?=($this->session->userdata('user_id'))?$my_info['zip_code']:'';?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="bo4 of-hidden size15 m-b-20 zipcode-wrap">
                                                <input onkeypress="hidePaymentBtn()" onblur="hidePaymentBtn()" class="sizefull s-text7 p-l-22 p-r-22" type="text" id="city" name="city" placeholder="Town/City *" value="<?=($this->session->userdata('user_id'))?$my_info['city']:'';?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="bo4 of-hidden size15 m-b-20 zipcode-wrap">
                                                <input onkeypress="hidePaymentBtn()" onblur="hidePaymentBtn()"  class="sizefull s-text7 p-l-22 p-r-22" type="text" id="state" name="state" placeholder="State *" value="<?=($this->session->userdata('user_id'))?$my_info['state']:'';?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bo4 of-hidden size15 m-b-20">
                                        <select onkeypress="hidePaymentBtn()" onblur="hidePaymentBtn()" name="country" id="country" class="bo4 sizefull s-text7 p-l-22 p-r-22">
                                            <option value="">Select Country</option>
                                            <option value="US" <?=($this->session->userdata('user_id'))?((($my_info['country']=='US'))?'selected':''):'';?>>United States</option>
                                        </select>
                                    </div>
                                    <div class="bo4 of-hidden size15 m-b-20">
                                        <input onkeypress="hidePaymentBtn()" onblur="hidePaymentBtn()" class="sizefull s-text7 p-l-22 p-r-22" type="text" placeholder="Phone *" value="<?=($this->session->userdata('user_id'))?$my_info['phone']:'';?>" id="phone" name="phone">
                                    </div>
                                    <div class="bo4 of-hidden size15 m-b-20" id="emaildiv">
                                        <input onkeypress="hidePaymentBtn()" onblur="hidePaymentBtn()" class="sizefull s-text7 p-l-22 p-r-22" type="text" placeholder="Email *" value="<?=($this->session->userdata('user_id'))?$my_info['email']:'';?>" id="email" name="email" <?=($this->session->userdata('user_id'))?'readonly':'';?>>
                                    </div>
                                    <?php if(!$this->session->userdata('user_id')){ ?>
                                        <h4 class="m-text26">Create Your Account</h4>
                                        <p>If you want to become a member on our site, you can create your account to checkout fast on your next transactions. If you have already an account, you can <a onclick="launchLogin(1)" href="javascript:;" class="text-info">login here</a>.</p>
                                        <div class="bo4 of-hidden size15 m-b-20">
                                            <input class="sizefull s-text7 p-l-22 p-r-22" type="password" placeholder="Password *" value="" id="password" name="password">
                                        </div>
                                        <div class="bo4 of-hidden size15 m-b-20 pass-wrap">
                                            <input class="sizefull s-text7 p-l-22 p-r-22" type="password" placeholder="Confirm Password *" value="" id="cpassword">
                                        </div>
                                    <?php } ?>
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
                data: $('#paymentForm').serialize(),
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
                        }else{
                            $('.paypal-btn-grp').hide();
                        }
                        
                    }else{
                        // $('#my-orders').html(res.data);
                        $('#val-data').html('');
                        $("#agree").prop('checked', false); 
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
