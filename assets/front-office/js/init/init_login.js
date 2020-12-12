/* Show login modal */
function launchLogin(type){
    $('#regLoginForm').html(
        '<h4 class="m-text26 p-b-36 text-center">'+
            'LOGIN TO YOUR ACCOUNT'+
        '</h4>'+
        '<div class="error-msg"></div>'+
        '<div class="bo4 of-hidden size15 m-t-20 m-b-20">'+
            '<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="login_email" placeholder="Email or Username">'+
        '</div>'+
        '<div class="bo4 of-hidden size15 m-b-20">'+
            '<input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="login_password" placeholder="Password">'+
        '</div>'+
        '<div class="size15 trans-0-4">'+
            '<button onclick="login(this)" type="button" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">'+
                'LOGIN'+
            '</button>'+
        '</div>'
    );
    $('#footer-login').html('Don\'t waste time <a onclick="launchRegister()" href="javascript:;"> Create an account</a>');
    if(type==1){ $('#loginModal').modal('show'); }
}

/* Show registration modal */
function launchRegister(type){
    H5_loading.show({color:"rgb(230, 85, 64)",background:"rgba(0, 0, 0, 0.55)",timeout:0.5,scale:0.8});
    $.ajax({
        url: base_url+'auth/registration',
        success: (res)=>{
            H5_loading.hide();
            $('#regLoginForm').html(res);
            $('#footer-login').html('Having an account? <a onclick="launchLogin(2)" href="javascript:;"> Login here</a>');
            if(type==1){ $('#loginModal').modal('show'); }
        }
    });
}

/* Login user using ajax */
function login(e){
    loadBtn(e, '', 'start');
    $('.error-msg').html('');
    $.ajax({
        url: base_url+'auth/login_user',
        type: 'POST',
        data: $('#regLoginForm').serialize(),
        success: (res)=>{
            if(res==1){
                location.reload();
            }else{
                loadBtn(e, '', 'stop', 'LOGIN');
                $('.error-msg').html(errMsg('.error-msg', 'Incorrect email or password.'));
            }
        }
    });
}

/* Register user using ajax */
function register(e){
    $('.error-msg').html('');
    var reg_fname        = $('#reg_email').val();
    var reg_lname        = $('#reg_lname').val();
    var reg_address      = $('#reg_address').val();
    var reg_address_unit = $('#reg_address_unit').val();
    var reg_zipcode      = $('#reg_zipcode').val();
    var reg_country      = $('#reg_country').val();
    var reg_state        = $('#reg_state').val();
    var reg_city         = $('#reg_city').val();
    var reg_email        = $('#reg_email').val();
    var reg_password     = $('#reg_password').val();
    var reg_cpassword    = $('#reg_cpassword').val();
    if(reg_fname&&reg_lname&&reg_address&&reg_zipcode&&reg_country&&reg_state&&reg_city&&reg_email&&reg_password&&reg_cpassword){
        if(isEmail(reg_email)){
            loadBtn(e, '', 'start');
            if(!isEmailExist(reg_email)){
                if(reg_password==reg_cpassword){
                    loadBtn(e, '', 'start');
                    $.ajax({
                        url: base_url+'auth/register_user',
                        type: 'POST',
                        data: $('#regLoginForm').serialize(),
                        success: (res)=>{
                            if(res==1){
                                location.reload();
                            }else{
                                loadBtn(e, '', 'stop', 'REGISTER');
                                $('.error-msg').html(errMsg('.error-msg', 'A problem occured. Please try again.'));
                            }
                        }
                    });
                }else{
                    $('.error-msg').html(errMsg('.error-msg', 'Password must be equal to Confirm Password.'));
                }
            }else{
                loadBtn(e, '', 'stop', 'REGISTER');
                $('.error-msg').html(errMsg('.error-msg', 'Email already exists or invalid. Please try another email.'));
            }
        }else{
            $('.error-msg').html(errMsg('.error-msg', 'Invalid email address. Please try another email.'));
        }
    }else{
        $('.error-msg').html(errMsg('.error-msg', 'Please fill all empty fields.'));
    }
}
