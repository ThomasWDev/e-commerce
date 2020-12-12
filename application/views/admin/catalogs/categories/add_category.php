<!-- Modals Here -->
<?php $all_cat = $this->catalog_model->get_all_categories(); ?>
<div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> Category Form</h4> 
            </div> 
            <form action="<?=base_url();?>catalog/add_category" data-parsley-validate novalidate method="POST" enctype="multipart/form-data" id="category_form">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="acc-img">
                                <img id="img-profile" src="<?=base_url();?>assets/back-office/images/products/default.png" alt="Profile Image">
                                <span class="cust-mod-edit-prof" title="Choose image"><i class="fa fa-pencil text-white"></i></span>
                                <i class="fa fa-upload upload-icon"></i>
                                <input type="file" name="user_img" class="input-img" id="input-img">
                                <input type="hidden" name="img_data" id="img_data">
                                <input type="hidden" name="old_img" id="old_img">
                            </div>
                        </div>
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Category Name *</label> 
                                <input type="text" class="form-control" name="cat_name" id="cat_name" placeholder="Category Name" required> 
                            </div> 
                        </div> 
                    </div>
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Description *</label> 
                                <textarea class="form-control" name="cat_desc" id="cat_desc" cols="5" rows="2" placeholder="Write description ..."></textarea>
                            </div> 
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Parent Category</label> 
                                <select class="form-control" name="parent_cat_id" id="parent_cat_id">
                                    <option value="0">No Parent Category</option>
                                    <?php foreach($all_cat as $cat){ extract($cat); ?>
                                        <option value="<?=$cat_id;?>"><?=$cat_name;?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                        </div>
                    </div> 
                </div> 
                <div class="modal-footer"> 
                    <button type="submit" class="btn btn-success waves-effect waves-light saveBtn"><i class="fa fa-save"></i> Save Category</button> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                </div> 
            </form>
        </div> 
    </div>
</div><!-- /.modal -->
<!-- Modals Here -->