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
                                    <a href="javascript:;" class="btn btn-success waves-effect waves-light btn-sm pull-right" onclick="addAttributeItems()"><i class="fa fa-plus"></i> Add New <?=$attr['attr_name']?></a>
                                    <h4 class="m-t-0 header-title"><b><?=$attr['attr_name']?></b></h4>
                                    <p class="text-muted m-b-30 font-13">
                                        List of all <?=$attr['attr_name']?> below.
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
                                                    <th>ID</th>
                                                    <th>Item Name</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($get_parent_items as $atrb){ extract($atrb); ?>
                                                <tr>  
                                                    <td><?=$attr_id;?></td>
                                                    <td><span class="ttl">Item Name:</span> <?=$attr_name;?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light btn-sm" data-toggle="dropdown" aria-expanded="false">Options <span class="caret"></span></button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a href="javascript:;" onclick="viewAttributeItems(<?=$attr_id;?>)">Edit Item</a></li>
                                                                <li><a onclick="delAttr(<?=$attr_id.','.$this->uri->segment(3);?>)" href="javascript:;">Delete Item</a></li>
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
                <?php $this->load->view('admin/catalogs/attributes/add_attr_item');?>
                <?php $this->load->view('admin/common/footer');?>

            </div>
            <!-- End Right content here -->
        </div>
        <!-- END wrapper -->

        <?php $this->load->view('admin/common/js');?>
	</body>
</html>