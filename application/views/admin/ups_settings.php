<!DOCTYPE html>
<html>
    <?php $this->load->view('admin/common/css');?>
	<body class="fixed-left">

		<!-- Begin page -->
		<div id="wrapper">

            <!-- Top Bar Start -->
            <?php $this->load->view('admin/common/topbar');?>
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php $this->load->view('admin/common/leftnav');?>
			<!-- Left Sidebar End -->

			<!-- Start right Content here -->
			<div class="content-page">
				<!-- Start content -->
				<div class="content">
					<div class="container">
						<?php $this->load->view('admin/common/breadcrumbs');?>
                        <div class="row">
                            <div class="col-sm-12">
                                <form id="settingsForm" data-parsley-validate novalidate method="POST">
                                    <input type="hidden" name="action" value="ups_settings">
                                    <div class="card-box">
                                        <!-- UPS Shipping -->
                                        <h4 class="m-t-20 header-title m-b-20"><b>UPS Settings </b></h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="ups_mode">UPS Mode *</label>
                                                    <select class="form-control" name="ups_mode" id="ups_mode">
                                                        <option value="" hidden>Select UPS Mode</option>
                                                        <option value="0" <?= $ups_settings['ups_mode'] == 0 ? 'selected' : '' ?>>Test</option>
                                                        <option value="1" <?= $ups_settings['ups_mode'] == 1 ? 'selected' : '' ?>>Production</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="ups_access_key">Access Key *</label>
                                                    <input type="text" class="form-control" name="ups_access_key" id="ups_access_key" placeholder="UPS Access Key" value="<?=$ups_settings['ups_access_key']?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="ups_shipper_number">Shipper Number *</label>
                                                    <input type="text" class="form-control" name="ups_shipper_number" id="ups_shipper_number" placeholder="UPS Shipper Number" value="<?=$ups_settings['ups_shipper_number']?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="ups_user_id">User ID *</label>
                                                    <input type="text" class="form-control" name="ups_user_id" id="ups_user_id" placeholder="UPS User ID" value="<?=$ups_settings['ups_user_id']?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="ups_password">Password *</label>
                                                    <input type="text" class="form-control" name="ups_password" id="ups_password" placeholder="UPS Password" value="<?=$ups_settings['ups_password']?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-toolbar form-group m-b-0">
                                            <div class="pull-right">
                                                <button onclick="saveSettings(this)" type="button" class="btn btn-danger waves-effect waves-light"><i class="ti-check"></i> Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div> <!-- container -->
                               
                </div> <!-- content -->
                <?php $this->load->view('admin/common/footer');?>

            </div>
            <!-- End Right content here -->
        </div>
        <!-- END wrapper -->

        <?php $this->load->view('admin/common/js');?>
	</body>
</html>