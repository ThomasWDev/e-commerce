/* Categories functions */

/* Show add category modal */
const addCategory = ()=>{
    $('#img-profile').attr('src', base_url+'assets/back-office/images/products/default.png');
    $('#category_form').attr('action', base_url+'catalog/add_update_category/0');
    $('#cat_name').val('');
    $('#cat_desc').val('');
    $('#old_img').val('');
    $('#parent_cat_id option').removeAttr('selected');
    $('#addCategory').modal('show');
}

/* View catefiry using ajax */
const viewCategory = (cat_id)=>{
    $.ajax({
        url: base_url+'catalog/view_single_category/'+cat_id,
        dataType: 'JSON',
        success: (res)=>{
            if(res!=0){
                var imgUrl = (res['cat_img']) ? base_url+'assets/back-office/images/categories/'+res['cat_img'] : base_url+'assets/back-office/images/products/default.png'
                $('#img-profile').attr('src', imgUrl);
                $('#category_form').attr('action', base_url+'catalog/add_update_category/'+res['cat_id']);
                $('#cat_name').val(res['cat_name']);
                $('#cat_desc').val(res['cat_desc']);
                $('#old_img').val(res['cat_img']);
                $('#parent_cat_id option[value="'+res['parent_cat_id']+'"]').attr('selected', 'selected');
                $('#addCategory').modal('show');
            } else{
                swal('Oops!', 'A problem occured while fetching data.', 'error');
            }
        }
    });
}

/* Delete category using a controller */
const delCat = (cat_id)=>{
    swal({
        title: "Delete Category?",
        text: "This will not be recovered.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641",
        showLoaderOnConfirm: true
    },
    function(){
        window.location.href = base_url+"catalog/delete_category/"+cat_id;
    });
}

/* Attributes functions */

/* Show add attribute modal */
const addAttribute = ()=>{
    $('#attribute_form').attr('action', base_url+'catalog/add_update_attribute/0');
    $('#attr_name').val('');
    $('#attr_desc').val('');
    $('#addAttribute').modal('show');
}

/* View attribute using ajax */
const viewAttribute = (attr_id)=>{
    $.ajax({
        url: base_url+'catalog/view_single_attribute/'+attr_id,
        dataType: 'JSON',
        success: (res)=>{
            if(res!=0){
                $('#attribute_form').attr('action', base_url+'catalog/add_update_attribute/'+res['attr_id']);
                $('#attr_name').val(res['attr_name']);
                $('#attr_desc').val(res['attr_desc']);
                $('#addAttribute').modal('show');
            } else{
                swal('Oops!', 'A problem occured while fetching data.', 'error');
            }
        }
    });
}

/* Delete attribute using controller */
const delAttr = (attr_id, parent_attr_id)=>{
    swal({
        title: "Delete Attribute?",
        text: "This will not be recovered.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641",
        showLoaderOnConfirm: true
    },
    function(){
        window.location.href = base_url+"catalog/delete_attribute/"+attr_id+'/'+parent_attr_id;
    });
}

/* Show add attributes item */
const addAttributeItems = ()=>{
    $('#attribute_form').attr('action', base_url+'catalog/add_update_attr_items/0');
    $('#attr_name').val('');
    $('#addAttributeItems').modal('show');
}

/* View attributs item using ajax */
const viewAttributeItems = (attr_id)=>{
    $.ajax({
        url: base_url+'catalog/view_single_attribute/'+attr_id,
        dataType: 'JSON',
        success: (res)=>{
            if(res!=0){
                $('#attribute_form').attr('action', base_url+'catalog/add_update_attr_items/'+res['attr_id']);
                $('#attr_name').val(res['attr_name']);
                $('#addAttributeItems').modal('show');
            } else{
                swal('Oops!', 'A problem occured while fetching data.', 'error');
            }
        }
    });
}