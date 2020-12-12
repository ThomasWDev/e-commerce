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
                                    <input type="hidden" name="action" value="taxjar_settings">
                                    <div class="card-box">
                                        
                                        <!-- TaxJar Settings -->
                                        <h4 class="m-t-20 header-title m-b-20"><b>Taxjar Settings </b></h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="taxjar_key">TaxJar API Key *</label>
                                                    <input type="text" class="form-control" name="taxjar_key" id="taxjar_key" placeholder="TaxJar API Key" value="<?=$taxjar_settings['taxjar_key']?>" required>
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