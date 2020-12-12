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
                                    <input type="hidden" name="action" value="sendgrid_settings">
                                    <div class="card-box">
                                       
                                        <!-- Sendgrid Settings -->
                                        <h4 class="m-t-20 header-title m-b-20"><b>Sendgrid Settings </b></h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="sendgrid_key">Sendgrid API Key *</label>
                                                    <input type="text" class="form-control" name="sendgrid_key" id="sendgrid_key" placeholder="Sendgrid API Key" value="<?=$sendgrid_settings['sendgrid_key']?>" required>
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