/* Add products/items to cart using ajax*/
function add_to_cart(e, pid, type){
    loadBtn(e, 'check', 'start');
    $('.cart-items').html('');
    $.ajax({
        url: base_url+'cart/add_to_cart',
        type: 'POST',
        data: { pid:pid },
        dataType:'JSON',
        success:(res)=>{
            if(type=='single_add'){
                loadBtn(e, '', 'stop', 'Add to cart');
                $('#success-msg').html('<i class="fa fa-check"></i> PRODUCT ADDED TO CART');
            }else{
                loadBtn(e, '', 'stop', 'Added to cart');
            }
            if(res!=0){
                var total=0, numCart=0;
                $.each(res, function(i, item){
                    $('.cart-items').append(
                        '<li class="header-cart-item">'+
                            '<div onclick="remove_to_cart('+item.item_id+',1)" class="header-cart-item-img">'+
                                '<img src="'+base_url+'assets/back-office/images/products/'+item.item_image+'" alt="Product Image">'+
                            '</div>'+
                            '<div class="header-cart-item-txt">'+
                                '<a href="'+base_url+'product_detail/'+item.item_id+'" class="header-cart-item-name">'+item.item_title+
                                '</a>'+
                                '<span class="header-cart-item-info">'+
                                    'Price: $'+item.item_price+
                                '</span>'+
                            '</div>'+
                        '</li>'
                    );
                    total+=parseInt(item.item_price);
                    numCart+=1;
                });
                $('.cart-btn-details').html(
                    '<div class="header-cart-total cart-total">'+
                        'Total: $'+total.toFixed(2)+' <a onclick="clear_cart()" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Clear Cart</a>'+
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
        data: { pid:pid },
        dataType:'JSON',
        success:(res)=>{
            console.log(res)
            if(type==1){
                if(res!=0){
                    var total=0, numCart=0;
                    $.each(res, function(i, item){
                        $('.cart-items').append(
                            '<li class="header-cart-item">'+
                                '<div onclick="remove_to_cart('+item.item_id+',1)" class="header-cart-item-img">'+
                                    '<img src="'+base_url+'assets/back-office/images/products/'+item.item_image+'" alt="Product Image">'+
                                '</div>'+
                                '<div class="header-cart-item-txt">'+
                                    '<a href="'+base_url+'product_detail/'+item.item_id+'" class="header-cart-item-name">'+item.item_title+
                                    '</a>'+
                                    '<span class="header-cart-item-info">'+
                                        'Price: $'+item.item_price+
                                    '</span>'+
                                '</div>'+
                            '</li>'
                        );
                        total+=parseInt(item.item_price);
                        numCart+=1;
                    });
                    $('.cart-btn-details').html(
                        '<div class="header-cart-total cart-total">'+
                            'Total: $'+total.toFixed(2)+' <a onclick="clear_cart()" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Clear Cart</a>'+
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

/* Check if user has agreed the terms, and then vaidate this inputted information */
function checkInput(){
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
                    }
                }else{
                    $('.pass-wrap').css('border','1px solid red');
                    $('.err-msg').html(errMsg('.err-msg', 'Confirm Password must be equal to Password field. You can remove the password if you want to checkout as Guest.'));
                    $('.paypal-btn-grp').hide();
                    $('#cpassword').focus();
                    $("#agree").prop('checked', false); 
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
        }
    }else{
        $('.err-msg').html(errMsg('.err-msg', 'Please fill up all required fields.'));
        $('.paypal-btn-grp').hide();
        $("#agree").prop('checked', false); 
    }
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
                var shippingRateObj = responseObj.RateResponse.RatedShipment;
                var option = '<option value="" hidden>.....</option>';
                $.each(shippingRateObj, function(x,y){
                    $.each(services_desc, function(a,b){
                        if(y.Service.Code == a){
                            option += `<option value="${a}|${y.TotalCharges.MonetaryValue}"> $${y.TotalCharges.MonetaryValue} ${b}</option>`;
                        }
                    })
                    
                })
                $('#hasTax').show();
                calculate_orders(2);
                $('.paypal-btn-grp').hide();
                setTimeout(function(){
                    $('#select_shipping_method').html(option);
                    $('.select-shipping-text').show();
                },3000);
            }else{
                $("#agree").prop('checked', false); 
                $('#val-data').html('');
                $('.err-msg').html(errMsg('.err-msg', responseObj.Fault.detail.Errors.ErrorDetail.PrimaryErrorCode.Description));

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