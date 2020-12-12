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
                            <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Tax and Shipping Rates Settings </b></h4>
                                    <p class="text-muted m-b-30 font-13">
                                        Please update some of the fields below carefully.
                                    </p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form id="paymentForm" data-parsley-validate novalidate method="POST">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="ship_rate">Tax rate % *</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><b>%</b></span>
                                                                <input type="text" class="form-control decimalOnly" name="tax_rate" id="tax_rate" placeholder="PayPal Receiver Email" value="<?=$payment_settings['tax_rate']?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="ship_rate">Shipping Rate *</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><b>$</b></span>
                                                                <input type="text" class="form-control decimalOnly" name="ship_rate" id="ship_rate" placeholder="PayPal Client ID" value="<?=$payment_settings['ship_rate']?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="btn-toolbar form-group m-b-0">
                                                            <div class="pull-right">
                                                                <button onclick="saveRateSettings(this)" type="button" class="btn btn-danger waves-effect waves-light"><i class="ti-check"></i> Save Changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
        <script>
            const saveRateSettings=(e)=>{
                loadBtn(e, 'ti-check', 'start');
                $.ajax({
                    url: base_url+'admin/save_rate_settings',
                    type: 'POST',
                    data: $('#paymentForm').serialize(),
                    success: (res)=>{
                        loadBtn(e, 'ti-check', 'stop', 'Save Changes');
                        if(res==1){
                            $.Notification.notify('success','top right','Save!', 'Settings saved.');
                        }else{
                            $.Notification.notify('error','top right','Failed!', 'A problem occurred. Please try again.');
                        }
                    }
                });
            } 
        </script>
	</body>
</html>