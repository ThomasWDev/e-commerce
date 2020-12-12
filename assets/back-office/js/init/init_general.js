// Set Base URL
var base_url = $('#base_url').val();
// Set datatables plugin
$(document).ready(function() {
    $('#datatable').dataTable();
    $('#datatable-order').dataTable({
        "order": [[ 0, 'desc' ]]
    });
});
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
// Accept decimal only
$(function () {
    $(".decimalOnly").keydown(function (event) {
        if (event.shiftKey == true) {
           event.preventDefault();
        }

        if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

        } else {
            event.preventDefault();
        }
        
        if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
           event.preventDefault();

    });
});
// Logout user with sweet alert
var logout = ()=>{
    swal({
        title: "Logout?",
        text: "Do you want to logout?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Logout!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641"
    },
    ()=>{
        window.location.href = base_url+"auth/logout";
    });
}
// Read file/image
var readURL = (input)=> {
    var fileInput = document.getElementById('input-img');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        swal("Upload Failed", "Please select a valid image with .jpeg/.jpg/.png/.gif extensions.","warning");
        fileInput.value = '';
        return false;
    } else{
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img-profile').attr('src', e.target.result);
                $('#img-profile').hide().fadeIn(650);
                $('#img_data').val(e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }   
}
// Read file/image
var readURL2 = (input)=> {
    var fileInput = document.getElementById('input-img2');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        swal("Upload Failed", "Please select a valid image with .jpeg/.jpg/.png/.gif extensions.","warning");
        fileInput.value = '';
        return false;
    } else{
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img-profile2').attr('src', e.target.result);
                $('#img-profile2').hide().fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }   
}

const saveSettings=(e)=>{
    $('#settingsForm').parsley().validate();
    if($('#settingsForm').parsley().isValid()){
        loadBtn(e, 'ti-check', 'start');
        $.ajax({
            url: base_url+'admin/save_settings',
            type: 'POST',
            data: $('#settingsForm').serialize(),
            success: (res)=>{
                loadBtn(e, 'ti-check', 'stop', 'Save Changes');
                if(res==1){
                    $.Notification.notify('success','top right','Save!', 'Settings saved.');
                }else{
                    $.Notification.notify('error','top right','Failed!', 'A problem occurred. Please try again.');
                }
            }
        });
    }
} 

// If has image imported, execute the function
$("#input-img").change(function() {
    readURL(this);
});
// If has image imported, execute the function
$("#input-img2").change(function() {
    readURL2(this);
});
// Remove primary image of the product
function remPrimaryImg(){
    $('#img-profile').attr('src', base_url+'assets/back-office/images/products/default.png');
}
// Accept numbers only
$(".numOnly").keypress(function(event) {
    return /\d/.test(String.fromCharCode(event.keyCode));
});