<!-- Modals Here -->
<?php $countries = $this->admin_model->get_countries(); ?>
<div id="addMemberModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title" id="form-title"> Update Profile</h4> 
            </div> 
            <form action="javascript:;" data-parsley-validate novalidate method="POST" id="adminProfileForm">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="acc-img">
                                    <img id="img-profile" src="<?=base_url();?>assets/front-office/images/icons/icon-header-01.png" alt="Profile Image">
                                    <span class="cust-mod-edit-prof" title="Choose image"><i class="fa fa-pencil text-white"></i></span>
                                    <input type="file" name="user_img" class="input-img" id="input-img">
                                    <input type="hidden" name="img_data" id="img_data">
                                    <input type="hidden" name="img_name" id="img_name">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"><label class="f-15">Personal Information</label></div>
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">First Name *</label> 
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name *" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Last Name *</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name *" required>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Address * </label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address *" required>
                            </div> 
                        </div>
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Apartment, suite, unit, street, etc. (Optional) </label>
                                <input type="text" class="form-control" id="address_unit" name="address_unit" placeholder="Apartment, suite, unit, street, etc. (Optional) ">
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Country * </label>
                                <select name="country" id="country" class="form-control" required>
                                    <option value="">Select Country</option>
                                    <option value="US">United States</option>
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Phone * </label>
                                <input type="text" class="form-control numOnly" id="phone" name="phone" placeholder="Phone *" required> 
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Postal/Zipcode * </label>
                                <input type="text" class="form-control numOnly" id="zipcode" name="zipcode" placeholder="Postal/Zipcode *" required> 
                            </div> 
                        </div>
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Town/City * </label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Town/City *" required> 
                            </div> 
                        </div>
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">State * </label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="State *" required> 
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><label class="f-15">Account</label></div>
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-1" class="control-label">Email * </label> <span id="check_email_msg"></span>
                                <input onkeyup="checkEmail()" type="email" class="form-control email" id="email" name="email" placeholder="Email" parsley-trigger="email" required> 
                                <input type="hidden" id="old_email"> 
                            </div> 
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="field-2" class="control-label">New Password</label> 
                                <input type="password" class="form-control" id="password" name="newpass" placeholder="New Password"> 
                            </div> 
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="field-2" class="control-label">Confirm Password</label> 
                                <input type="password" data-parsley-equalto="#password" id="cpassword" class="form-control" name="cpass" placeholder="Confirm Password"> 
                            </div> 
                        </div> 
                    </div>  
                </div>
                <div class="modal-footer"> 
                    <button type="button" onclick="validateBeforeSaveProfile(this)" class="btn btn-success waves-effect waves-light saveBtn" disabled>Save Changes</button> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                </div> 
            </form>
        </div> 
    </div>
</div><!-- /.modal -->
<!-- Modals Here -->