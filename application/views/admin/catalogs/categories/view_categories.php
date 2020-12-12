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
                <input type="hidden" value="<?=(isset($_SESSION['prop_msg'])) ? $_SESSION['prop_msg'] : '0';?>" id="getAgentMsg">
				<!-- Start content -->
				<div class="content">
					<div class="container">
						<?php $this->load->view('admin/common/breadcrumbs');?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <a href="javascript:;" class="btn btn-success waves-effect waves-light btn-sm pull-right" onclick="addCategory()"><i class="fa fa-plus"></i> Add New Category</a>
                                    <h4 class="m-t-0 header-title"><b>Categories</b></h4>
                                    <p class="text-muted m-b-30 font-13">
                                        List of all your categories below.
                                    </p>
                                    <?php if(isset($_SESSION['success'])){ ?>
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <strong><i class="fa fa-check"></i> Success!</strong> <?=$_SESSION['success'];?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    
                                    <?php if(isset($_SESSION['error'])){ ?>
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <strong><i class="fa fa-times"></i> Error!</strong> <?=$_SESSION['error'];?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <div class="tbl-resonsive">
                                        <table id="datatable" class="table table-striped table-bordered table-actions-bar m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Category Name</th>
                                                    <th>Description</th>
                                                    <th>Parent Category</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($get_all_categories as $cat){ extract($cat); ?>
                                                <?php $cat = $this->catalog_model->view_single_category($parent_cat_id); ?>
                                                <tr>
                                                    <td>
                                                        <?php $img_link = ($cat_img) ? 'assets/back-office/images/categories/'.$cat_img : 'assets/back-office/images/products/default.png'; ?>
                                                        <a href="<?=base_url().$img_link;?>" class="image-popup" title="<?=($cat) ? '— ' : '';?> <?=$cat_name;?>">
                                                            <div class="tbl-img">
                                                                <img src="<?=base_url().$img_link;?>" class="header-icon1 user-top-img rounded-circle" alt="customer avatar">
                                                            </div>
                                                        </a>
                                                    </td>   
                                                    <td><span class="ttl">Category Name:</span> <?=($cat) ? '— ' : '';?> <?=$cat_name;?></td>
                                                    <td><span class="ttl">Description:</span> <?=$cat_desc;?></td>
                                                    <td><span class="ttl">Parent Category:</span> <?=($cat) ? $cat['cat_name'] : '';?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light btn-sm" data-toggle="dropdown" aria-expanded="false">Options <span class="caret"></span></button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a href="javascript:;" onclick="viewCategory(<?=$cat_id;?>)">Edit Category</a></li>
                                                                <li><a onclick="delCat(<?=$cat_id;?>)" href="javascript:;">Delete Category</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- container -->
                               
                </div> <!-- content -->
                <?php $this->load->view('admin/catalogs/categories/add_category');?>
                <?php $this->load->view('admin/common/footer');?>

            </div>
            <!-- End Right content here -->
        </div>
        <!-- END wrapper -->

        <?php $this->load->view('admin/common/js');?>
        <script>
            $(document).ready(function() {
                $('.image-popup').magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    mainClass: 'mfp-fade',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    }
                });
            });
        </script>
	</body>
</html>