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
                                    <input type="hidden" name="action" value="payment_settings">
                                    <div class="card-box">
                                        <!-- PayPal Settings -->
                                        <h4 class="m-t-0 header-title m-b-20"><b>PayPal Settings </b></h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="paypal_sandbox">PayPal Sandbox/Live *</label>
                                                    <select class="form-control" name="paypal_sandbox" id="paypal_sandbox">
                                                        <option value="1" <?=($payment_settings['paypal_sandbox']==1)?'selected':'';?>>Sandbox</option>
                                                        <option value="0" <?=($payment_settings['paypal_sandbox']==0)?'selected':'';?>>Live</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="paypal_email">PayPal Receiver Email *</label>
                                                    <input type="text" class="form-control" name="paypal_email" id="paypal_email" placeholder="PayPal Receiver Email" value="<?=$payment_settings['paypal_email']?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="paypal_client_id">PayPal Client ID *</label>
                                                    <input type="text" class="form-control" name="paypal_client_id" id="paypal_client_id" placeholder="PayPal Client ID" value="<?=$payment_settings['paypal_client_id']?>" required>
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