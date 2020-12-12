/* Upload multiple products */
if (window.File && window.FileList && window.FileReader) {
    $("#uploadFiles").on("change", function(e) {
        var files = e.target.files,
        filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            var f = files[i];
            var fileReader = new FileReader();
            if(f.size < 3000000){
                fileReader.onload = (function(e) {
                    $("#emptyImg").html('');
                    $(".uploaded-files").append('<div class="col-md-4 img_uploaded">'+
                        '<div class="product-imgs">'+
                            '<img class="w-100" src="'+e.target.result+'" alt="Product Image">'+
                        '</div>'+
                        '<span class="cust-mod-close rmImg" title="Remove Image" onclick="rmimg(this)"><i class="fa fa-times text-white"></i></span>'+
                    '</div>');
                });
                fileReader.readAsDataURL(f);
            } else{
                swal('Failed', "Image should less than 3 MB or 3000kb", 'warning');
            }
        }
    });
} else {
    swal('Failed', "Your browser doesn't support to File API", 'warning');
}

/* Remove parent div/info */
var remInfo = (e)=>{
    $(e).parent().remove();
}

/* Remove image */
var rmimg = (e) => {
    $(e).parent().remove();
    var img_uploaded = $('.img_uploaded').length;
    if(img_uploaded == 0){
        $("#emptyImg").html(''+
            '<div class="alert alert-danger f-15" role="alert">'+
                '<strong><i class="fa fa-check"></i> Empty!</strong> Please upload  image less than 3 mb of size.'+
            '</div>'
        );
    }
}

/* Delete product image using ajax */
var delProdImg = (img_id, img_name, e) => {
    swal({
        title: "Delete Image?",
        text: "This will not be recovered.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
    function(){
        $.ajax({
            url: base_url+'product/del_prod_img/'+img_id,
            data: { img_name: img_name },
            type: 'POST',
            success: (res)=>{
                if(res==1){
                    $(e).parent().remove();
                    var img_uploaded = $('.img_uploaded').length;
                    if(img_uploaded == 0){
                        $("#emptyImg").html(''+
                            '<div class="alert alert-danger f-15" role="alert">'+
                                '<strong><i class="fa fa-check"></i> Empty!</strong> Please upload  image less than 3 mb of size.'+
                            '</div>'
                        );
                    }
                    
                    swal('Success', "Image was successfully deleted.", 'success');
                } else{
                    swal('Failed', "A problem occured while deleting.", 'error');
                }
            }
        })
    });
}

/* Delete product using CI controller */
var delProduct = (product_id) => {
    swal({
        title: "Delete Product?",
        text: "All data and images will be deleted and not be recovered.",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641",
        showLoaderOnConfirm: true
    },
    function(){
        window.location.href = base_url+"product/delete_product/"+product_id;
    });
}

/* Make product featured using ajax */
var makeFeatured = (product_id, val) => {
    $.ajax({
        url: base_url+'product/make_featured/'+product_id+'/'+val,
        success: (res)=>{
            if(res==1){
                if(val==0){
                    $('#is_featured'+product_id).attr('onchange','makeFeatured('+product_id+',1)');
                } else{
                    $('#is_featured'+product_id).attr('onchange','makeFeatured('+product_id+',0)');
                }
                $.Notification.notify('success','top right','Save!', 'Featured settings save.');
            } else{
                $.Notification.notify('error','top right','Failed!', 'Unable to save settings Please try again.');
            }
        }
    });
}

/* Check if product SKU is unique using ajax */
var checkSKU = ()=>{
    var product_sku = $('#product_sku').val();
    var old_product_sku = $('#old_product_sku').val();
    if(product_sku){
        if(product_sku!=old_product_sku){
            $.ajax({
                url: base_url+'product/checkSKU',
                type: 'POST',
                data: { product_sku:product_sku },
                success: (res)=>{
                    if(res==0){
                        $('#check_sku').html('<span class="text-success"> (<i class="fa fa-check"></i> SKU Available)</span>');
                        $('.saveBtn').removeAttr('disabled');
                    } else{
                        $('#check_sku').html('<span class="text-danger">( <i class="fa fa-times"></i> SKU already exist)</span>');
                        $('#product_sku').focus();
                        $('.saveBtn').attr('disabled', '');
                    }
                }
            });
        } else{
            $('#check_sku').html('');
            $('.saveBtn').removeAttr('disabled');
        }
    } else{
        $('#check_sku').html('');
        $('.saveBtn').removeAttr('disabled');
    }
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

/* Vaidate product sale amount */
var checkSale = ()=>{
    var reg_price  = $('#reg_price').val();
    var sale_price = $('#sale_price').val();
    if(sale_price){
        if(parseFloat(sale_price) >= parseFloat(reg_price)){
            $('#chkSale').html('<span class="text-danger">( <i class="fa fa-times"></i> Sale Price must be less than the Regular Price)</span>');
            // $('#sale_price').focus();
            $('.saveBtn').attr('disabled', '');
        } else{
            $('.saveBtn').removeAttr('disabled');
            $('#chkSale').html('');
        }
    } else{
        $('.saveBtn').removeAttr('disabled');
        $('#chkSale').html('');
    }
}



function checkDecimal(el,element){
        var val = el.value;
        var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
        var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
        if (re.test(val)) {
            //do something here
    
        } else {
            val = re1.exec(val);
            if (val) {
                $(element).val(val[0]);
            } else {
                $(element).val("");
            }
        }
}
   
function getWeight(){
    var length  =   $('#length').val();
    var width   =   $('#width').val();
    var height  =   $('#height').val();
    if(length != "" && width != "" && height != ""){
        var volumetric_weight;
        var parcelVolume = Math.round((length * width * height) / 139);
        if(parcelVolume <= 0){
            volumetric_weight = 1;
        }else{
            volumetric_weight = parcelVolume;
        }
        $('#weight').val(volumetric_weight);

    }
}
   