/* JS email validation */
const isEmail = (email)=>{
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

/* Get user info using ajax */
function get_this_user(user_id){
    $.ajax({
        url:base_url+'admin/profile/'+user_id,
        type:'POST',
        dataType:'json',
        success: (res)=>{
            if(res!=0){
                var imgUrl = (res['user_img']) ? 'c'+res['user_id']+'/'+res['user_img'] : 'default.png';
                $('#img-profile').attr('src', base_url+'assets/back-office/images/customer/'+imgUrl);
                $('#img_data').val('');
                $('#img_name').val(res['user_img']);
                $('#firstname').val(res['firstname']);
                $('#lastname').val(res['lastname']);
                $('#address').val(res['address']);
                $('#address_unit').val(res['address_unit']);
                $("#country option[value='"+res['country']+"']").prop('selected','selected');
                $('#phone').val(res['phone']);
                $('#city').val(res['city']);
                $('#state').val(res['state']);
                $('#email').val(res['email']);
                $('#old_email').val(res['email']);
                $('#zipcode').val(res['zip_code']);
                $('.saveBtn').removeAttr('disabled');
                $('#addMemberModal').modal('show');
            }else{
                alert('A problem occured.');
            }
        }
    });
}

/* Check if email exist */
const checkEmail = ()=>{
    var email = $('#email').val();
    var old_email = $('#old_email').val();
    if(isEmail(email)){
        if(email!=old_email){
            $.ajax({
                url: base_url+'admin/checkEmail',
                type: 'POST',
                data: { email:email },
                success: (res)=>{
                    if(res==0){
                        $('#check_email_msg').html('<span class="text-success"><i class="fa fa-check"></i> Email Available</span>');
                        $('.saveBtn').removeAttr('disabled');
                    } else{
                        $('#check_email_msg').html('<span class="text-danger"><i class="fa fa-times"></i> Email already exist</span>');
                        $('#email').focus();
                        $('.saveBtn').attr('disabled', '');
                    }
                }
            });
        } else{
            $('#check_email_msg').html('');
            $('.saveBtn').removeAttr('disabled');
        }
    } else{
        $('#check_email_msg').html('');
        $('.saveBtn').attr('disabled', '');
    }
}

/* Validate profile before saving */
function validateBeforeSaveProfile(e){
    $('#adminProfileForm').parsley().validate();
    if($('#adminProfileForm').parsley().isValid()){
        var newpass = $('#password').val();
        var cpass = $('#cpassword').val();
        if (newpass) {
            if (newpass==cpass) {
                if (newpass.length>=8) {
                    saveCustomerProfile(e);
                }else{
                    $.Notification.notify('error','top right','Oops!', 'Password must contain 8 characters and above');
                }
            }else{
                $.Notification.notify('error','top right','Oops!', 'Password did not match!');
            }
        }else{
            saveCustomerProfile(e);
        }
    }
}

/* Save profile using ajax */
function saveCustomerProfile(e){
    loadBtn(e, 'check', 'start');
    $.ajax({
        method:'POST',
        url: base_url+'admin/save_profile',
        data:$('#adminProfileForm').serialize(),
        dataType:'JSON',
        success:function(res){
            loadBtn(e, '', 'stop', 'Save Changes');
            if (res==1) {
                $('#addMemberModal').modal('hide');
                swal({
                    title: "Success!", 
                    text: 'Profile updated successfully', 
                    type: "success"
                },function(){
                    window.location.reload();
                });
            }else{
                $.Notification.notify('error','top right','Oops!', 'Unable to update your profile information.');
            }
        }
    });
}

