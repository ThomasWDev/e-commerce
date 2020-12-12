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
                                    <a href="<?=base_url();?>product/add_product" class="btn btn-success waves-effect waves-light btn-sm pull-right"><i class="fa fa-plus"></i> Add New Product</a>
                                    <h4 class="m-t-0 header-title"><b>Product</b></h4>
                                    <p class="text-muted m-b-30 font-13">
                                        List of all your products below.
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
                                                    <th>SKU</th>
                                                    <th>Product Name</th>
                                                    <th>Price</th>
                                                    <th>Categories</th>
                                                    <th>Featured</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($get_all_products as $prod){ extract($prod); ?>
                                                <tr>
                                                    <td>
                                                        <?php $img_link = ($product_primary_pic) ? 'assets/back-office/images/products/'.$product_primary_pic : 'assets/back-office/images/products/default.png'; ?>
                                                        <a href="<?=base_url().$img_link;?>" class="image-popup" title="<?=$product_name;?>">
                                                            <div class="tbl-img">
                                                                <img src="<?=base_url().$img_link;?>" class="header-icon1  user-top-img rounded-circle" alt="customer avatar">
                                                            </div>
                                                        </a>
                                                    </td>   
                                                    <td><span class="ttl">SKU:</span> <?=$product_sku;?></td>
                                                    <td><span class="ttl">Product Name:</span> <?=$product_name;?></td>
                                                    <td><span class="ttl">Price:</span> 
                                                        <?=($sale_price!='0.00') ? $sale_price.' <span class="pSale">'.$reg_price.'</span>' : $reg_price;?>
                                                    </td>
                                                    <td><span class="ttl">Categories:</span> 
                                                        <?php 
                                                            if($categories){ 
                                                                $cat = json_decode($categories); 
                                                                foreach($cat as $cat_id){
                                                                    $ctg = $this->catalog_model->view_single_category($cat_id);
                                                                    echo $ctg['cat_name'].', ';
                                                                }
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="text-center"><span class="ttl">Featured:</span> 
                                                        <input type="checkbox" id="is_featured<?=$product_id;?>" onchange="makeFeatured(<?=$product_id;?>,<?=($is_featured) ? 0 : 1; ?>)" data-plugin="switchery" data-color="#81c868" data-size="small" <?=($is_featured) ? 'checked' : ''; ?> />
                                                    </td>
                                                    <td class="text-center"><span class="ttl">Status:</span> <?=($quantity > 0) ? '<span class="label label-primary">In stock ('.$quantity.')</span>' : '<span class="label label-danger">Out of stock</span>';?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light btn-sm" data-toggle="dropdown" aria-expanded="false">Options <span class="caret"></span></button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a href="<?=base_url();?>product_detail/<?=$product_id;?>" target="_blank">View Product</a></li>
                                                                <li><a href="<?=base_url();?>product/edit_product/<?=$product_id;?>">Edit Product</a></li>
                                                                <li class="divider"></li>
                                                                <li><a onclick="delProduct(<?=$product_id;?>)" href="javascript:;">Delete Product</a></li>
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