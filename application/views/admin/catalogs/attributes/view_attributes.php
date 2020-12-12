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
                                    <a href="javascript:;" class="btn btn-success waves-effect waves-light btn-sm pull-right" onclick="addAttribute()"><i class="fa fa-plus"></i> Add New Attribute</a>
                                    <h4 class="m-t-0 header-title"><b>Attributes</b></h4>
                                    <p class="text-muted m-b-30 font-13">
                                        List of all your attributes below.
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
                                                    <th>Attribute Name</th>
                                                    <th>Description</th>
                                                    <th>Items</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($get_all_attributes as $atrb){ extract($atrb); 
                                                    $parent_items = $this->catalog_model->get_parent_items($attr_id);
                                                ?>
                                                <tr>  
                                                    <td><?=$attr_name;?></td>
                                                    <td><span class="ttl">Description:</span> <?=$attr_desc;?></td>
                                                    <td><span class="ttl">Items:</span> 
                                                        <?php foreach($parent_items as $p){ echo $p['attr_name'].',     '; }?>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light btn-sm" data-toggle="dropdown" aria-expanded="false">Options <span class="caret"></span></button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a href="<?=base_url();?>catalog/view_attribute_items/<?=$attr_id;?>">Configure Items</a></li>
                                                                <li><a href="javascript:;" onclick="viewAttribute(<?=$attr_id;?>)">Edit Attribute</a></li>
                                                                <li><a onclick="delAttr(<?=$attr_id.',0';?>)" href="javascript:;">Delete Attribute</a></li>
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
                <?php $this->load->view('admin/catalogs/attributes/add_attribute');?>
                <?php $this->load->view('admin/common/footer');?>

            </div>
            <!-- End Right content here -->
        </div>
        <!-- END wrapper -->

        <?php $this->load->view('admin/common/js');?>
	</body>
</html>