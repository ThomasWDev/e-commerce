// Set Base URL
var base_url = $('#base_url').val();
// Set loader button plugin
const loadBtn=(btn,icon,type,text)=>{
    if(type=="start"){
        $(btn).attr('disabled', '');
        $(btn).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
    }else{
        $(btn).removeAttr('disabled');
        var hasIcon = (icon)?'<i class="'+icon+'"></i> ':'';
        $(btn).html(hasIcon+text);
    }
}
// Set error message UI dynamic
const errMsg = (mn, msg)=>{ 
    $(mn).attr("tabindex",-1).focus();
    return '<div class="custom-cart-alert c-alert-danger"><strong><i class="fa fa-times"></i> Oops!</strong> '+msg+'<span class="alert-close" aria-hidden="true" onclick="removeParent(this)">&times;</span></div>';
}
// Set success message UI dynamic
const succMsg = (mn, msg)=>{ 
    $(mn).attr("tabindex",-1).focus();
    return '<div class="custom-cart-alert c-alert-info"><strong><i class="fa fa-check"></i> Success!</strong> '+msg+' <span class="close" onclick="removeParent(this)">&times;</span></div>';
}
// Set error message UI dynamic
const isEmail = (email)=>{
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
// Accept numbers only in fields
$(".numOnly").keypress(function(event) {
    return /\d/.test(String.fromCharCode(event.keyCode));
});
// Remove parent div
const removeParent=(e)=>{
    e.parentElement.style.display="none"
}
// Checking if email exist on database using ajax
const isEmailExist = (email)=>{
    var result;
    $.ajax({
        url: base_url+'auth/check_email',
        async: false,
        type: 'POST',
        data: {email: email},
        success: (res)=>{
            result = res;
        }
    });

    return (result==1) ? true : false;
}
// Accept numbers only in fields
var validNumber = new RegExp(/^\d*\.?\d*$/);
var lastValid = "";
function validateNumber(elem) {
    if (validNumber.test(elem.value)) {
        lastValid = elem.value;
    } else {
        elem.value = lastValid;
    }
}
// Contact page send messages
function send_message(e){
    loadBtn(e, 'check', 'start');
    var name    = $('#firstname').val() +' '+ $('#lastname').val();
    var email   = $('#email').val();
    var subject = $('#subject').val();
    var message = $('#message').val();
    if(name&&email&&subject&&message){
        if(!isEmail(email)) {
            $('.err-msg').html(errMsg('.err-msg', 'Invalid email address. Please enter different email.'));
            $('#email').focus();
            loadBtn(e, '', 'stop', 'Submit');
        }else{
            $.ajax({
                url: base_url+'auth/send_message',
                type: 'POST',
                data: $('#contactForm').serialize(),
                success:(res)=>{
                    if(res==1){
                        $('.err-msg').html(succMsg('.err-msg', 'Message sent. We will get in touch on you as soon as we can.'));
                        $('#contactForm')[0].reset()
                        loadBtn(e, '', 'stop', 'Submit');
                    }else{
                        $('.err-msg').html(errMsg('.err-msg', 'A problem occured. Please try again.'));
                        loadBtn(e, '', 'stop', 'Submit');
                    }
                }
            });
        }
    } else{
        $('.err-msg').html(errMsg('.err-msg', 'Please fill up all required fields.'));
        loadBtn(e, '', 'stop', 'Submit');
    }
}
