
/* Modefiy the quantity */ 
function modifyQty(element,type = 'add',itemId){
    var currentQty = parseInt($(element).siblings('span').text());
    var priceTable = parseFloat($('.price-tbl-'+itemId).text());
    var qty_left = $(element).parent().attr('p-qty');
    /* When the user add quantity */ 
    if(type == 'add'){
        var add_Qty = currentQty + 1;
        $('.qty-'+itemId).html(add_Qty);
        modifyQtyAjax(itemId,'add');
        $('.subtotal-tbl-'+itemId).html((priceTable * add_Qty).toFixed(2)); /* Generate new subtotal in my cart page on specific product */
        $('.qty-btn-minus-'+itemId).removeClass('hidden'); /* Show the minus button if the user add quantity */
        if(add_Qty == qty_left){
            $('.qty-btn-plus-'+itemId).addClass('hidden'); /* Show the minus button if the user add quantity */
        }
    }else{ /* When the user reduce the quantity */
        var minus_Qty = currentQty - 1;
        $('.qty-'+itemId).html(minus_Qty);
        $('.subtotal-tbl-'+itemId).html((priceTable * minus_Qty).toFixed(2)); /* Generate new subtotal in my cart page on specific product */
        $('.qty-btn-plus-'+itemId).removeClass('hidden');
        if(minus_Qty <= 1){
            $('.qty-btn-minus-'+itemId).addClass('hidden'); /* Hide the minus button if the quantity is one */
        }
        modifyQtyAjax(itemId,'minus');
    }
    getTotal();
    
}
/* Get the total in cart */ 
function getTotal(){
    var totalDesktop = 0;
    var subtotalDesktop = 0;
    var totalMobile = 0;
    var subtotalMobile = 0;
    var totalFixHeader = 0;
    var subtotalFixHeader = 0;
    $('.container-menu-header-v2').find('.cartItem').each(function(e){
        var price = $(this).find('span.header-cart-item-info').attr('priceAttr');
        var qty = $(this).find('.qtyItem').text();
        subtotalDesktop = price * qty;
        totalDesktop += subtotalDesktop;
    })
    $('.wrap_header_mobile').find('.cartItem').each(function(e){
        var price = $(this).find('span.header-cart-item-info').attr('priceAttr');
        var qty = $(this).find('.qtyItem').text();
        subtotalMobile = price * qty;
        totalMobile += subtotalMobile;
    })
    $('.fixed-header2').find('.cartItem').each(function(e){
        var price = $(this).find('span.header-cart-item-info').attr('priceAttr');
        var qty = $(this).find('.qtyItem').text();
        subtotalFixHeader = price * qty;
        totalFixHeader += subtotalFixHeader;

    })
  
    $('.container-menu-header-v2').find('.totalCart').html(totalDesktop.toFixed(2)); /* Get product total if the display is default header */
    $('.wrap_header_mobile').find('.totalCart').html(totalMobile.toFixed(2)); /* Get product total if the display is mobile header */
    $('.fixed-header2').find('.totalCart').html(totalFixHeader.toFixed(2)); /* Get product total if the display is fixed header */
    $('#totalCart').text('$'+totalFixHeader.toFixed(2));

}

function modifyQtyAjax(pid,type){
    $.ajax({
        url: base_url+'cart/add_to_cart',
        type: 'POST',
        data: { pid:pid, type : type },
        dataType:'JSON',
        success:(res)=>{
            if(res!=0){
                return true;
            }else{
                return false;
            }
        }
    }); 
}
/* Add products/items to cart using ajax*/
function add_to_cart(e, pid, type = 'add'){
    loadBtn(e, 'check', 'start');
    $('.cart-items').html('');
    $.ajax({
        url: base_url+'cart/add_to_cart',
        type: 'POST',
        data: { pid:pid, type : type },
        dataType:'JSON',
        success:(res)=>{
            
            if(res!=0){
                if(type=='single_add'){
                    loadBtn(e, '', 'stop', 'Add to cart');
                    $('#success-msg').html('<i class="fa fa-check"></i> PRODUCT ADDED TO CART');
                }else{
                    loadBtn(e, '', 'stop', 'Added to cart');
                }
                var total=0, numCart=0;
                var subTotal = 0;
                $.each(res, function(i, item){
                    subTotal = parseInt(item.item_price) * parseInt(item.qty);
                    var ishidden =  item.qty > 1 ? "" : "hidden";
                    var ishiddenPlus = item.qty == item.qty_left ? 'hidden' : '';
                    var image = item.item_image ? item.item_image : 'default.png';
                    $('.cart-items').append(
                        '<li class="header-cart-item cartItem">'+
                            '<div onclick="remove_to_cart('+item.item_id+',1)" class="header-cart-item-img">'+
                                '<img src="'+base_url+'assets/back-office/images/products/'+image+'" alt="Product Image">'+
                            '</div>'+
                            '<div class="header-cart-item-txt">'+
                                '<a href="'+base_url+'product_detail/'+item.item_id+'" class="header-cart-item-name">'+item.item_title+
                                '</a>'+
                                '<span class="header-cart-item-info" priceAttr="'+item.item_price+'">'+
                                    'Price: $'+item.item_price+
                                '</span>'+
                                '<div class="header-cart-item-info qtyCart" qty="'+item.qty+'" p-qty="'+item.qty_left+'" pid="'+item.item_id+'">'+
                                    'Qty: <span class="qtyItem qty-'+item.item_id+'"> '+item.qty+' </span>'+
                                    '<a class="btn btn-success btn-xs text-white ml-3 qty-btn-plus-'+item.item_id+' '+ishiddenPlus+' " onclick="modifyQty(this,`add`,'+item.item_id+')"> <i class="fa fa-plus"> </i></a><a class="btn btn-danger btn-xs text-white qty-btn-minus-'+item.item_id+' ml-1 '+ishidden+'" onclick="modifyQty(this,1,'+item.item_id+')"> <i class="fa fa-minus"> </i></a>'+
                                '</div>'+
                            '</div>'+
                        '</li>'
                    );
                    total+=subTotal;
                    numCart+=1;
                });
                $('.cart-btn-details').html(
                    '<div class="header-cart-total cart-total">'+
                        'Total: <span class="totalCart">$'+total.toFixed(2)+'</span> <a onclick="clear_cart()" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Clear Cart</a>'+
                    '</div>'+
                    '<div class="header-cart-buttons cart-buttons">'+
                        '<div class="header-cart-wrapbtn">'+
                            '<a href="'+base_url+'cart" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">'+
                                'View Cart'+
                            '</a>'+
                        '</div>'+
                        '<div class="header-cart-wrapbtn">'+
                            '<a href="'+base_url+'checkout" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">'+
                                'Check Out'+
                            '</a>'+
                        '</div>'+
                    '</div>'
                );
                $('.cart-items-count').html(numCart);
            }else{
                $('.cart-items').html(
                    '<li class="header-cart-item">'+
                        '<a href="javascript:;" class="header-cart-item-name">'+
                            '<i class="fa fa-check"></i> You have no products added.'+
                        '</a>'+
                    '</li>'
                );
                $('.cart-btn-details').html('');
                $('.cart-items-count').html(0);
            }
        }
    }); 
}

/* Remove items to cart using ajax */
function remove_to_cart(pid, type){
    $('.cart-items').html('');
    $.ajax({
        url: base_url+'cart/remove_to_cart',
        type: 'POST',
        data: { pid:pid,type:type },
        dataType:'JSON',
        success:(res)=>{
            if(type==1){
                if(res!=0){
                    var total=0, numCart=0;
                    var subTotal = 0;
                    $.each(res, function(i, item){
                        subTotal = parseInt(item.item_price) * parseInt(item.qty);
                        var ishidden =  item.qty > 1 ? "" : "hidden";
                        $('.cart-items').append(
                            '<li class="header-cart-item cartItem">'+
                                '<div onclick="remove_to_cart('+item.item_id+',1)" class="header-cart-item-img">'+
                                    '<img src="'+base_url+'assets/back-office/images/products/'+item.item_image+'" alt="Product Image">'+
                                '</div>'+
                                '<div class="header-cart-item-txt">'+
                                    '<a href="'+base_url+'product_detail/'+item.item_id+'" class="header-cart-item-name">'+item.item_title+
                                    '</a>'+
                                    '<span class="header-cart-item-info" priceAttr="'+item.item_price+'">'+
                                        'Price: $'+item.item_price+
                                    '</span>'+
                                    '<div class="header-cart-item-info qtyCart" qty="'+item.qty+'" pid="'+item.item_id+'">'+
                                        'Qty: <span class="qtyItem qty-'+item.item_id+'"> '+item.qty+' </span>'+
                                        '<a class="btn btn-success btn-xs text-white ml-3" onclick="modifyQty(this,`add`,'+item.item_id+')"> <i class="fa fa-plus"> </i></a><a class="btn btn-danger btn-xs text-white qty-btn-minus-'+item.item_id+' ml-1 '+ishidden+'" onclick="modifyQty(this,1,'+item.item_id+')"> <i class="fa fa-minus"> </i></a>'+
                                    '</div>'+
                                '</div>'+
                            '</li>'
                        );
                        total+=subTotal;
                        numCart+=1;
                    });
                    $('.cart-btn-details').html(
                        '<div class="header-cart-total cart-total">'+
                            'Total: <span class="totalCart">$'+total.toFixed(2)+'</span> <a onclick="clear_cart()" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Clear Cart</a>'+
                        '</div>'+
                        '<div class="header-cart-buttons cart-buttons">'+
                            '<div class="header-cart-wrapbtn">'+
                                '<a href="'+base_url+'cart" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">'+
                                    'View Cart'+
                                '</a>'+
                            '</div>'+
                            '<div class="header-cart-wrapbtn">'+
                                '<a href="'+base_url+'checkout" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">'+
                                    'Check Out'+
                                '</a>'+
                            '</div>'+
                        '</div>'
                    );
                    $('.cart-items-count').html(numCart);
                }else{
                    $('.cart-items').html(
                        '<li class="header-cart-item">'+
                            '<a href="javascript:;" class="header-cart-item-name">'+
                                '<i class="fa fa-check"></i> You have no products added.'+
                            '</a>'+
                        '</li>'
                    );
                    $('.cart-btn-details').html('');
                    $('.cart-items-count').html(0);
                    $('#totalCart').html('$0.00')
                }
                $('#my-cart-row-'+pid).remove();
                $('#totalCart').html('$'+total.toFixed(2));
            }else{
                location.reload();
            }
        }
    }); 
}

/* Clear items from cart using ajax */
function clear_cart(e, pid){
    loadBtn(e, 'check', 'start');
    $.ajax({
        url: base_url+'cart/clear_cart',
        type: 'POST',
        data: { pid:pid },
        success:(res)=>{
            loadBtn(e, 'fa fa-times', 'stop', 'Clear Cart');
            $('.cart-items').html(
                '<li class="header-cart-item">'+
                    '<a href="javascript:;" class="header-cart-item-name">'+
                        '<i class="fa fa-check"></i> You have no products added.'+
                    '</a>'+
                '</li>'
            );
            $('.cart-btn-details').html('');
            $('.cart-items-count').html(0);
        }
    }); 
}

/* Show paypal payment settins using ajax */
function renderPaymentBtn(){
    $('#paypal-button').html("");
    var env = ($('#paypal_sandbox').val()==1) ? 'sandbox' : 'production';
    /* Transactions */
    var sub_total = $('#sub_total').val();
    var ship_rate = $('#ship_rate').val();
    var tax_amount = $('#tax_amount').val();
    var total_amount = $('#total_amount').val();
    /* Payer Information */ 
    var fullname     = $('#firstname').val() + ' ' + $('#lastname').val();
    var address      = $('#address').val();
    var address_unit = $('#address_unit').val();
    var zipcode      = $('#zipcode').val();
    var city         = $('#city').val();
    var state        = $('#state').val();
    var country      = $('#country').val();
    var phone        = $('#phone').val();
    var item_list    = JSON.parse($('#item_list').val());

    /* Render Payment */
    paypal.Button.render({
        // Setting PayPal Button Style
        style: {
            size: 'responsive',
            color: 'black'
        },
        env: env, // Environment (Live or Sanbox)
        // Paypal Client ID
        client: {
            sandbox: $('#paypal_client_id').val(),
            production: $('#paypal_client_id').val()
        },
        locale: 'en_US',
        commit: true, // Show a 'Pay Now' button
        payment: function(data, actions) {
            // Set up the payment here
            return actions.payment.create({
                transactions: [{
                  amount: {
                    total: total_amount,
                    currency: 'USD',
                    details: {
                        subtotal: sub_total,
                        tax: tax_amount,
                        shipping: ship_rate,
                    }
                  },
                  description: 'Shopping cart payment transaction receipt.',
                  payment_options: {
                    allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
                  },
                  item_list: {
                    items: item_list,
                    shipping_address: {
                        recipient_name: fullname,
                        line1: address,
                        line2: address_unit,
                        city: city,
                        country_code: country,
                        postal_code: zipcode,
                        phone: phone,
                        state: state
                    }
                  }
                }],
                note_to_payer: 'Contact us for any questions on your order.'
            });
        },
        onAuthorize: function(data, actions) {
            // Execute the payment here
            return actions.payment.execute().then(function(payment){
                H5_loading.show({color:"rgb(230, 85, 64)",background:"rgba(0, 0, 0, 0.55)",timeout:0.5,scale:0.8});
                $('#modal-order-dtls').modal('hide');
                $.ajax({
                    url: base_url+'cart/purchase_orders/1', // 1 Paypal
                    data: $('#paymentForm').serialize(),
                    type: 'POST',
                    success:(res)=>{
                        H5_loading.hide();
                        if(res==1){
                            swal({ title: "Transaction Complete!", text: 'All items paid successfully. Click "OK" to view your transactions.', type: "success" }, function() { window.location.href=base_url+'transactions'; });
                        }else{
                            swal({ title: "Failed!", text: 'Payment failed.', type: "warning" });
                        }
                    }
                });
            });
        },
        //Error: Error: Request to post https://www.sandbox.paypal.com/v1/payments/payment failed with 400 error. Correlation id:
        onError: function (err) {
            // Simplify the errors and remove unnecessary strings
            var errSimplify = [],   rxp = /{([^}]+)}/g, mat;
            while( mat = rxp.exec( err ) ) {
                errSimplify.push(mat[1]);
            }
            // Place the result on a hidden textfield
            $('#error_text').val(errSimplify);
            // Simplify the error by replacing unused strings
            var errReplace1 = $('#error_text').val().replace('    "name": "VALIDATION_ERROR",    "details": [        {            ', "");
            var errReplace2 = errReplace1.replace(/"field": /g, "<br />");
            var errReplace3 = errReplace2.replace(/"issue"/g, "");
            var errReplace4 = errReplace3.replace(/,/g, "");
            $('.err-msg').html(errMsg('.err-msg', 'Please see the errors below: '+errReplace4));
            hidePaymentBtn();
       }
    }, '#paypal-button');
}

function checkInput(){
    $('#btn-continue-to-shipping').html('<small><i class="fa fa-spinner fa-spin"></i> We are validating your informaton. Please wait...</small>');
    $('#btn-continue-to-shipping').attr('disabled',true);
    $('#paypal-button').html('');
    var fname        = $('#firstname').val();
    var lname        = $('#lastname').val();
    var address      = $('#address').val();
    var city         = $('#city').val();
    var country      = $('#country').val();
    var zipcode      = $('#zipcode').val();
    var phone        = $('#phone').val();
    var state        = $('#state').val();
    var email        = $('#email').val();
    var password     = $('#password').val();
    var cpassword    = $('#cpassword').val();

    if(fname&&lname&&address&&city&&country&&zipcode&&phone&&state&&email){
        if(isEmail(email)){
            if(password){
                if(password==cpassword){
                    if(isEmail(email)){
                        if(isEmailExist(email)){
                            $('.err-msg').html(errMsg('.err-msg', 'Email already exist. Please enter different email.'));
                            $('#emaildiv').css('border','1px solid red');
                            $('.paypal-btn-grp').hide();
                            $('#emaildiv').focus();
                            $("#agree").prop('checked', false); 
                            $('#btn-continue-to-shipping').html('Continue to shipping');
                            $('#btn-continue-to-shipping').attr('disabled',false);
                        }else{
                            getShippingRate(fname+lname, address, city, state, zipcode, country);
                            // calculate_orders(2);
                        }
                    }else{
                        $('.err-msg').html(errMsg('.err-msg', 'Invalid email address. Please try another email.'));
                        $('#emaildiv').css('border','1px solid red');
                        $('.paypal-btn-grp').hide();
                        $('#emaildiv').focus();
                        $("#agree").prop('checked', false);
                        $('#btn-continue-to-shipping').html('Continue to shipping');
                        $('#btn-continue-to-shipping').attr('disabled',false);
                    }
                }else{
                    $('.pass-wrap').css('border','1px solid red');
                    $('.err-msg').html(errMsg('.err-msg', 'Confirm Password must be equal to Password field. You can remove the password if you want to checkout as Guest.'));
                    $('.paypal-btn-grp').hide();
                    $('#cpassword').focus();
                    $("#agree").prop('checked', false); 
                    $('#btn-continue-to-shipping').html('Continue to shipping');
                    $('#btn-continue-to-shipping').attr('disabled',false);
                }
            }else{
                getShippingRate(fname+lname, address, city, state, zipcode, country);
                // calculate_orders(2);
            }
        }else{
            $('#emaildiv').css('border','1px solid red');
            $('#emaildiv').focus();
            $('.err-msg').html(errMsg('.err-msg', 'Invalid email address.'));
            $('.paypal-btn-grp').hide();
            $("#agree").prop('checked', false); 
            $('#btn-continue-to-shipping').html('Continue to shipping');
        $('#btn-continue-to-shipping').attr('disabled',false);
        }
    }else{
        $('.err-msg').html(errMsg('.err-msg', 'Please fill up all required fields.'));
        $('.paypal-btn-grp').hide();
        $("#agree").prop('checked', false); 
        $('#btn-continue-to-shipping').html('Continue to shipping');
        $('#btn-continue-to-shipping').attr('disabled',false);
    }
    
    return false;
}

function getShippingRate(fullname, address, city, state, zipcode, country){
    $('#val-data').html('<i class="fa fa-spinner fa-spin"></i> We are validating your informaton. Please wait...');
    $.ajax({
        url: base_url+'shipping/shippingRate',
        data:{fullname:fullname, address:address, city:city, state:state, zipcode:zipcode, country:country},
        type:'POST',
        success:function(response){
            var responseArr = JSON.parse(response);
            var responseObj = JSON.parse(responseArr[0]);
            if(typeof responseObj.RateResponse != "undefined"){
                calculate_orders(2);
            }else{
                $("#agree").prop('checked', false); 
                $('#val-data').html('');
                $.each(responseObj.response.errors,function(x,y){
                    $('.err-msg').html(errMsg('.err-msg', y.message));
                })
                $('#btn-continue-to-shipping').html('Continue to shipping');
                $('#btn-continue-to-shipping').attr('disabled',false);
            }
        }
    });
}

function selectShippingrate(_this){
    $('.paypal-btn-grp').hide();
    $('.select-shipping-text').hide();
    var val = _this.value;
    if(val != 'NaN'){
        var total = $('#total_val').val();
        var shipping_rate = val.split('|')[1];
        var total_amount = (parseFloat(total) + parseFloat(shipping_rate)).toFixed(2);
        console.log(val);
        $('#display_total').html('$'+total_amount);
        $('#total_amount').val(total_amount);
        $('#ship_rate').val(shipping_rate);
        $('#service_code').val(val.split('|')[0]);
        setTimeout(function(){
            $('.paypal-btn-grp').show();
            renderPaymentBtn();
        },1000);
    }
    
}

$(document).on('click','input[name=billing-address]',function(){
    var billing_type = $(this).val();
    if(billing_type == 2){
        $('#billing_address').removeAttr('hidden');
    }else{
        $('#billing_address').attr('hidden',true);
    }
})
$(document).on('click','#btn-complete-order',function(){
    if($('#agree').is(':checked')){
        $('.err-msg').html("");
        $('#modal-order-dtls').modal('show');
        var product_purchased = $('#product_purchased').html();
        var has_tax =   $('#hasTax').html();
        $('#display_product_purchased').html(product_purchased);
        $('#display_has_tax').html(has_tax);
        renderPaymentBtn();

    }else{
        $('.err-msg').html(errMsg('.err-msg', 'You must agree to the terms and conditions.'));

    }
    
})
function cancelOrder(orderId, status){
	swal({   
		title: "Are you sure?",   
		text: "Are you sure to cancel this order.",   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, cancel it!",   
		closeOnConfirm: false 
	}, function(){   
		$("#transactionCancelBtn").html('<i class="fa fa-spinner fa-spin"></i> Processing..');
		$.ajax({
			type:'POST',
			url: base_url+'admin/updateOrderStatus',
			data:{order_status:status, order_id:orderId},
			success: (res)=>{
				if (res==1) {
					swal({ title: "Success!", text: "Order successfully cancelled", type: "success" }
						,function(){
							location.reload(); 
						}
					);
				}else{
					swal({ title: "Oops!", text: "Failed to cancelled order", type: "warning" });
				}
			}
		}); 
	});
	
}
