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
		<h2 class="l-text2 t-center"> Payment </h2>
	</section>
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
        <nav aria-label="breadcrumb">

        <?php $this->load->view('frontpage/common/checkout_breadcrumbs'); ?>
        </nav>
			<!-- Cart item -->
			<div class="pos-relative">
				<div class="bgwhite">
                    <form id="paymentForm" class="leave-comment">
					    <div class="row">
                           
                            <?php if($my_items){ ?>
                                <?php extract($receiver_details); ?>
                                <div class="col-lg-7 col-md-12">
                                    <div class="col-md-12">
                                    <h4 class="m-text26 p-b-10">Payment</h4>
                                    <h6 class="m-b-20">All transactions are secure and encrypted</h6>
                                    <ul class="list-group m-b-20">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" checked name="optradio"> 
                                                    <img alt="PayPal"  src="<?= base_url() ?>assets/front-office/images/paypal.png">
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- <li class="list-group-item" style="background-color:#fafafa">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <img alt="PayPal"  src="<?= base_url() ?>assets/front-office/images/redirected.svg">
                                                <p>After clicking “Complete order”, you will be redirected to PayPal to complete your purchase securely.</p>
                                            </div>
                                        </div>
                                    </li> -->
                                    </ul>
                                    <h4 class="m-text26 p-b-10 m-t-100">Billing address</h4>
                                    <h6 class="m-b-20">Select the address that matches your card or payment method. </h6>
                                    <ul class="list-group m-b-20">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" value="1" checked name="billing-address"> 
                                                        Same as shipping address 
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" value="2" name="billing-address"> 
                                                        Use a different billing address 
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item" id="billing_address" hidden style="background-color:#fafafa">
                                           
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="bo4 of-hidden size15 m-b-20">
                                                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="firstname" name="firstname" placeholder="First Name *" value="<?=$firstname?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="bo4 of-hidden size15 m-b-20">
                                                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="lastname" name="lastname" placeholder="Last Name *" value="<?=$lastname?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bo4 of-hidden size15 m-b-20">
                                                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="address" name="address" placeholder="Address *" value="<?=$address?>">
                                            </div>
                                            <div class="bo4 of-hidden size15 m-b-20">
                                                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="address_unit" name="address_unit" placeholder="Apartment, suite, unit, street, etc. (Optional)" value="<?=$address_unit?>">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="bo4 of-hidden size15 m-b-20 zipcode-wrap">
                                                        <input class="sizefull s-text7 p-l-22 p-r-22 numOnly" type="text" id="zipcode" name="zip_code" placeholder="Postal/Zip Code *" value="<?=$zip_code?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="bo4 of-hidden size15 m-b-20 zipcode-wrap">
                                                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="city" name="city" placeholder="Town/City *" value="<?=$city?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="bo4 of-hidden size15 m-b-20 zipcode-wrap">
                                                        <input  class="sizefull s-text7 p-l-22 p-r-22" type="text" id="state" name="state" placeholder="State *" value="<?=$state?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bo4 of-hidden size15 m-b-20">
                                                <select name="country" id="country" class="bo4 sizefull s-text7 p-l-22 p-r-22">
                                                    <option value="">Select Country</option>
                                                    <option value="US" selected>United States</option>
                                                </select>
                                            </div>
                                            <div class="bo4 of-hidden size15 m-b-20">
                                                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" placeholder="Phone *" value="<?=$phone?>" id="phone" name="phone">
                                            </div> 
                                            <input type="hidden" placeholder="Email *" value="<?=$email?>" id="email" name="email">

                                        </li>
                                    </ul>
                                    </div>

                                    <div class="col-md-12 m-t-10">
                                    Your personal data will be used only to process your order, support your experience throughout this website, and for other purposes described in our <a href="javascript:;" class="text-info f-12">privacy policy</a>.
                                    <p id="val-data"></p>
                                    <div class="row">
                                                <div class="col-md-12 p-b-20"><div class="err-msg"></div></div>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="agree" id="agree" value="1">
                                        <label for="agree">
                                            I have read and agree to the website <a href="javascript:;" class="text-info f-12">terms and conditions</a> *
                                        </label>
                                    </div>
                                    <?php if(!empty($new_customer_password)){ ?>
                                        <input class="sizefull s-text7 p-l-22 p-r-22" type="hidden" placeholder="Password *" value="<?= !empty($new_customer_password) ? $new_customer_password : '' ?>" id="password" name="password">
                                    <?php } ?>
                                    </div>
                                    <div class="row m-b-20">
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-left">
                                            <a href="<?=base_url()?>shipping" class="btn btn-link">< Return to shipping</a>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                                            <button type="button" class="btn btn-primary" id="btn-complete-order">Complete order</button>
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
    <!-- Modals Here -->
<div id="modal-order-dtls" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content">  
        <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div> 
          <div class="modal-body"> 
              <ul class="list-group">
              <div id="display_product_purchased"></div>
              <div id="display_has_tax"></div>
              <li class="list-group-item" style="border-top: 2px solid #444;">
                <div class="row">
                    <div class="col-md-4"><b>Proceed to Pay:</b> </div>
                    <div class="col-md-8">
                        <div id="paypal-button"></div>
                    </div>
                </div>
            </li>
              </ul>
            </div>  
        </div> 
    </div>
</div><!-- /.modal -->
<!-- Modals Here -->
	
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
