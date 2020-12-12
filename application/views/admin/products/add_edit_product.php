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
                        <form action="<?=base_url();?>product/add_update_product/<?=($is_page=='add_product') ? 0 : $prod['product_id'];?>" data-parsley-validate novalidate method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if(isset($_SESSION['error'])){ ?>
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <strong><i class="fa fa-times"></i> Error!</strong> <?=$_SESSION['error'];?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-8 col-md-12">
                                    <div class="card-box">
                                        <h4 class="m-t-0 header-title"><b><?=($is_page=='add_product') ? 'Add New Product' : 'Edit Product';?></b></h4>
                                        <p class="text-muted m-b-30 font-13">
                                            Please fill up all informations below.
                                        </p>
                                        <div class="row">
                                            <div class="col-md-12"> 
                                                <div class="form-group"> 
                                                    <label class="control-label">Product Name *</label> 
                                                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Name.." required value="<?=($prod) ? $prod['product_name'] : '';?>"> 
                                                </div> 
                                            </div> 
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-12">
                                                <div class="form-group"> 
                                                    <label class="control-label">Product Description </label> <textarea class="form-control" placeholder="Enter product description.." name="description" id="" cols="30" rows="3"><?=($prod) ? $prod['description'] : '';?></textarea>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"> 
                                                <ul class="nav nav-tabs tabs">
                                                    <li class="active tab">
                                                        <a href="#general" data-toggle="tab" aria-expanded="false"> 
                                                            <span class="visible-xs"><i class="fa fa-cog"></i></span> 
                                                            <span class="hidden-xs"><i class="fa fa-cog"></i> General</span> 
                                                        </a> 
                                                    </li> 
                                                    <li class="tab"> 
                                                        <a href="#inventory" data-toggle="tab" aria-expanded="false"> 
                                                            <span class="visible-xs"><i class="fa fa-tag"></i></span> 
                                                            <span class="hidden-xs"><i class="fa fa-tag"></i> Inventory</span> 
                                                        </a> 
                                                    </li>
                                                </ul> 
                                                <div class="tab-content"> 
                                                    <div class="tab-pane active" id="general"> 
                                                        <div class="row">
                                                            <div class="col-md-3 form-group">
                                                                <label class="control-label">Length(inch)*</label> 
                                                                <input type="text" class="form-control" id="length" name="length" placeholder="Enter Length" required value="<?=($prod) ? $prod['length'] : '';?>" onblur="getWeight()" onkeyup="checkDecimal(this,'#length')"> 
                                                            </div> 
                                                            <div class="col-md-3 form-group">  
                                                                <label class="control-label">Width(inch)*</label> 
                                                                <input type="text" class="form-control" id="width" name="width" placeholder="Enter Width" required value="<?=($prod) ? $prod['width'] : '';?>" onblur="getWeight()" onkeyup="checkDecimal(this,'#width')"> 
                                                            </div> 
                                                            <div class="col-md-3 form-group"> 
                                                                <label class="control-label">Height(inch)*</label> 
                                                                <input type="text" class="form-control" id="height" name="height" placeholder="Enter Height" required value="<?=($prod) ? $prod['height'] : '';?>" onblur="getWeight()" onkeyup="checkDecimal(this,'#height')"> 
                                                            </div> 
                                                            <div class="col-md-3 form-group"> 
                                                                <label class="control-label">Weight <small>(pounds)*</small></label> 
                                                                <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter Weight" value="<?=($prod) ? $prod['weight'] : '';?>" readonly> 
                                                            </div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <label class="control-label" for="reg_price">Regular Price</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                                    <input oninput="validateNumber(this);"  onkeyup="checkSale()" type="text" id="reg_price" name="reg_price" class="form-control decimalOnly" placeholder="0.00" required value="<?=($prod) ? $prod['reg_price'] : '';?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" for="sale_price">Sale Price</label> <span id="chkSale"></span>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                                    <input oninput="validateNumber(this);"  onkeyup="checkSale()" type="text" id="sale_price" class="form-control decimalOnly" name="sale_price" placeholder="0.00" value="<?=($prod) ? $prod['sale_price'] : '';?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group"> 
                                                                <label class="control-label">Featured</label> 
                                                                <select class="form-control" id="is_featured" name="is_featured">
                                                                    <option value="0" <?=($prod && $prod['is_featured']==0) ? 'selected' : '';?>>No</option>
                                                                    <option value="1" <?=($prod && $prod['is_featured']==1) ? 'selected' : '';?>>Yes</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="tab-pane" id="inventory">
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <label class="control-label" for="product_sku">SKU</label> <span id="check_sku"></span>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                                                    <input onchange="checkSKU()" type="text" id="product_sku" name="product_sku" class="form-control" placeholder="SKU" value="<?=($prod) ? $prod['product_sku'] : '';?>">
                                                                    <input type="hidden" id="old_product_sku" value="<?=($prod) ? $prod['product_sku'] : '';?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" for="quantity">Quantity</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                                                    <input type="text" id="quantity" name="quantity" class="form-control numOnly" placeholder="Quantity" required value="<?=($prod) ? $prod['quantity'] : '';?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div> 
                                        </div>
                                        <div class="row m-t-20"> 
                                            <div class="col-md-12"> 
                                                <div class="form-group text-center"> 
                                                    <button type="submit" class="btn btn-success waves-effect saveBtn waves-light"><i class="fa fa-save"></i> Save Product</button>  
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="row">
                                        <!-- Product Image -->
                                        <div class="col-md-12">
                                            <div class="card-box">
                                                <h4 class="m-t-0 header-title"><b>Product Image</b></h4>
                                                <p class="text-muted font-13">
                                                    Set product primary image.
                                                </p>
                                                <div class="row">
                                                    <div class="col-md-12"> 
                                                        <div class="prod-pri-img">
                                                            <?php $img_name = ($prod && $prod['product_primary_pic']) ? $prod['product_primary_pic'] : 'default.png'; ?>
                                                            <img id="img-profile" src="<?=base_url();?>assets/back-office/images/products/<?=$img_name;?>" alt="Primary Product Image">
                                                            <span class="cust-mod-edit-prof" title="Choose image"><i class="fa fa-pencil text-white"></i></span>
                                                            <i class="fa fa-upload upload-icon"></i>
                                                            <input type="file" name="prod_pri_img" class="input-img" id="input-img">
                                                            <input type="hidden" name="old_prod_img" value="<?=($prod && $prod['product_primary_pic']) ? $prod['product_primary_pic'] : '';?>">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-12 text-center m-t-10">
                                                        <a href="javascript:;" onclick="remPrimaryImg()" class="btn btn-warning btn-xs"> Remove Image</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <!-- Product $ctgegories -->
                                         <div class="col-md-12">
                                            <div class="card-box">
                                                <h4 class="m-t-0 header-title"><b>Product Categories</b></h4>
                                                <p class="text-muted font-13">
                                                    Select Product category.
                                                </p>
                                                <div class="row">
                                                    <div class="col-md-12"> 
                                                        <?php
                                                        $ctg = ($prod) ? json_decode($prod['categories']) : array();
                                                        $this->catalog_model->fetch_menu($get_nested_categories, $ctg); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Gallery -->
                                        <div class="col-md-12">
                                            <div class="card-box">
                                                <h4 class="m-t-0 header-title"><b>Product Gallery</b></h4>
                                                <p class="text-muted font-13">
                                                    Add product images as your product gallery.
                                                </p>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-body drop-images text-center">
                                                                <p><i class="fa fa-cloud-download fa-3x text-orange"></i></p>
                                                                <p class="text-black">Drag and Drop Images here or <br>Click to Upload</p>
                                                                <input type="file" class="drag-files" id="uploadFiles" multiple="multiple" name="product_gallery[]" accept=".gif, .png, .jpg, .jpeg">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 m-t-20 my-upload-pets text-center">
                                                        <label for="">Product Images</label>
                                                        <div class="card">
                                                            <div class="card-body uploaded-images">
                                                                <?php if($prod){ ?>
                                                                    <?php $imgs = $this->product_model->get_product_images($prod['product_id']);?>
                                                                    <?php if($imgs){ ?>
                                                                    <!-- Update Product -->
                                                                        <div class="row uploaded-files">
                                                                            <div class="col-md-12" id="emptyImg">
                                                                            </div>
                                                                            <?php foreach($imgs as $m){ extract($m);?>
                                                                                <div class="col-md-4 img_uploaded">
                                                                                    <div class="product-imgs">
                                                                                        <img class="w-100" alt="property Images" src="<?=base_url();?>assets/back-office/images/products/<?=$img_name;?>"/>
                                                                                    </div>
                                                                                    <span class="cust-mod-close rmImg" title="Remove Image" onclick="delProdImg(<?=$img_id;?>,'<?=$img_name;?>', this)"><i class="fa fa-times text-white"></i></span>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } else{ ?>
                                                                        <!-- Add Product -->
                                                                        <div class="row uploaded-files">
                                                                            <div class="col-md-12" id="emptyImg">
                                                                                <div class="alert alert-danger f-15" role="alert">
                                                                                    <strong><i class="fa fa-check"></i> Empty!</strong> Please upload image less than 3 mb of size.
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                <?php } else{ ?>
                                                                    <!-- Add Product -->
                                                                    <div class="row uploaded-files">
                                                                        <div class="col-md-12" id="emptyImg">
                                                                            <div class="alert alert-danger f-15" role="alert">
                                                                                <strong><i class="fa fa-check"></i> Empty!</strong> Please upload image less than 3 mb of size.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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