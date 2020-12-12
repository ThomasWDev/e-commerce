<!-- Modals Here -->
<?php $all_attr = $this->catalog_model->get_all_attributes(2); ?>
<div id="addAttribute" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> Attribute Form</h4> 
            </div> 
            <form action="<?=base_url();?>catalog/add_attribute" data-parsley-validate novalidate method="POST" enctype="multipart/form-data" id="attribute_form">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Attribute Name *</label> 
                                <input type="text" class="form-control" name="attr_name" id="attr_name" placeholder="Attribute Name" required> 
                            </div> 
                        </div> 
                    </div>
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Description *</label> 
                                <textarea class="form-control" name="attr_desc" id="attr_desc" cols="5" rows="2" placeholder="Write description ..."></textarea>
                            </div> 
                        </div>
                    </div>
                </div> 
                <div class="modal-footer"> 
                    <button type="submit" class="btn btn-success waves-effect waves-light saveBtn"><i class="fa fa-save"></i> Save Attribute</button> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                </div> 
            </form>
        </div> 
    </div>
</div><!-- /.modal -->
<!-- Modals Here -->