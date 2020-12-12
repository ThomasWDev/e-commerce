/* Update cusomter profile UI view */
enableEditCustomerProfile();
function enableEditCustomerProfile(){
    if ($('#customerDivForm').is(':visible')) {
        $('#customerDivForm').hide();
        $('#customerDivInformation').show('fadeIn');
        $('span.CprofileImgDiv').html('<p class="card-title p-t-20"><a href="javascript:;" onclick="enableEditCustomerProfile()" class="p-t-20"><i class="ti ti-pencil"></i> Edit Profile</a></p>');
    }else{
        $('#customerDivForm').show('fadeIn');
        $('#customerDivInformation').hide();
        $('span.CprofileImgDiv').html('<div class="bgwhite p-t-5 p-b-5"><a href="javascript:;" onclick="selectCustomerPhoto()"><i class="fa fa-camera fa-2x p-t-5 upload-icon float-center"></i></a><p>Click to upload photo</p></div>');
    }
}
/* Save Customer profile image */
function selectCustomerPhoto(){
    $('#input-img').click();
}
/* Read image file */
$("#input-img").change(function() {
    readURL(this);
});
function readURL(input) {
    var fileInput = document.getElementById('input-img');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        swal("Failed", "Please select a valid image with .jpeg/.jpg/.png/.gif extensions.","warning");
        fileInput.value = '';
        return false;
    } else{
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img-profile').attr('src', e.target.result);
                $('#img-profile').hide();
                $('#img-profile').fadeIn(650);
                $('#img_data').val(e.target.result);
                $('img.user-top-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }   
}
/* Validate Profile */
function validateProfile(e){
    var fname        = $('#firstname').val();
    var lname        = $('#lastname').val();
    var address      = $('#address').val();
    var city         = $('#city').val();
    var country      = $('#country').val();
    var zipcode      = $('#zipcode').val();
    var state        = $('#state').val();
    var phone        = $('#phone').val();
    var email        = $('#email').val();
    var old_email    = $('#old_email').val();
    var password     = $('#password').val();
    var cpassword    = $('#cpassword').val();

    if(fname&&lname&&address&&city&&country&&zipcode&&state&&phone&&email){
        if(email!=old_email){
            if(isEmail(email)){
                if(isEmailExist(email)){
                    $('.err-msg').html(errMsg('.err-msg', 'Email already exist. Please enter different email.'));
                    $('#emaildiv').css('border','1px solid red');
                    $('#emaildiv').focus();
                }else{
                    if(password){
                        if(password==cpassword){
                            saveProfile(e);
                        }else{
                            $('.pass-wrap').css('border','1px solid red');
                            $('.err-msg').html(errMsg('.err-msg', 'Confirm Password must be equal to Password field. '));
                            $('#cpassword').focus();
                        }
                    }else{
                        saveProfile(e);
                    }
                }
            }else{
                $('.err-msg').html(errMsg('.err-msg', 'Invalid email address.'));
                $('#emaildiv').css('border','1px solid red');
                $('#emaildiv').focus();
            }
        }else{
            saveProfile(e);
        }
    }else{
        $('.err-msg').html(errMsg('.err-msg', 'Please fill up all required fields.'));
    }
}
/* Save profile information using ajax */
function saveProfile(e){
    loadBtn(e, '', 'start');
    $.ajax({
        url: base_url+'frontpage/save_profile',
        type: 'POST',
        data: $('#customerProfileForm').serialize(),
        success:(res)=>{
            loadBtn(e, '', 'stop', 'SAVE CHANGES');
            if (res==1) {
                swal({
                    title: "Success!", 
                    text: 'Profile updated successfully', 
                    type: "success"
                },function(){
                    window.location.reload();
                });
            }else{
                swal('Oops!','Unable to update your profile information.','warning');
            }
        },
        error:function(error){
            swal('Oops!','Unable to update your profile information.','warning');
        }
    });
}