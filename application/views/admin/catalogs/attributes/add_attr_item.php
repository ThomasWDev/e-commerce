<!-- Modals Here -->
<div id="addAttributeItems" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> Attribute Item Form</h4> 
            </div> 
            <form action="" data-parsley-validate novalidate method="POST" enctype="multipart/form-data" id="attribute_form">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Item Name *</label> 
                                <input type="text" class="form-control" name="attr_name" id="attr_name" placeholder="Item Name" required> 
                                <input type="hidden" name="parent_attr_id" id="parent_attr_id" value="<?=$this->uri->segment(3);?>"> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
                <div class="modal-footer"> 
                    <button type="submit" class="btn btn-success waves-effect waves-light saveBtn"><i class="fa fa-save"></i> Save Item</button> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                </div> 
            </form>
        </div> 
    </div>
</div><!-- /.modal -->
<!-- Modals Here -->