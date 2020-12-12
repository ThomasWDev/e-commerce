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

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12">
								<h4 class="page-title">Dashboard</h4>
								<p class="text-muted page-title-alt">E-commerce Admin Panel</p>
							</div>
						</div>
						<div class="row">
                        <div class="col-lg-4 col-sm-4">
                                <div class="widget-panel widget-style-2 bg-white">
                                    <i class="md md-store-mall-directory text-info"></i>
                                    <h2 class="m-0 text-dark counter font-600"><?=$total_products;?></h2>
                                    <div class="text-muted m-t-5">Products</div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="widget-panel widget-style-2 bg-white">
                                    <i class="md md-store-mall-directory text-info"></i>
                                    <h2 class="m-0 text-dark counter font-600"><?=$total_category;?></h2>
                                    <div class="text-muted m-t-5">Categories</div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="widget-panel widget-style-2 bg-white">
                                    <i class="md md-store-mall-directory text-primary"></i>
                                    <h2 class="m-0 text-dark counter font-600"><?=$total_customers;?></h2>
                                    <div class="text-muted m-t-5">Customers</div>
                                </div>
                            </div>
						</div>
						<div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="widget-panel widget-style-2 bg-white">
                                    <i class="md md-store-mall-directory text-pink"></i>
                                    <h2 class="m-0 text-dark counter font-600"><?=$total_items_in_cart;?></h2>
                                    <div class="text-muted m-t-5">For Sales</div>
                                </div>
							</div>
							<div class="col-lg-6 col-sm-6">
                                <div class="widget-panel widget-style-2 bg-white">
                                    <i class="md md-store-mall-directory text-primary"></i>
                                    <h2 class="m-0 text-dark counter font-600"><?=$total_orders;?></h2>
                                    <div class="text-muted m-t-5">Orders</div>
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
	
	</body>
</html>