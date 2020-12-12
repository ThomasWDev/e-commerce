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
                                    <h4 class="m-t-0 header-title"><b>Customers</b></h4>
                                    <p class="text-muted m-b-30 font-13">
                                        List of all customers below.
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
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Email</th>
                                                    <th>Date Registered</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($get_all_customers as $user){ extract($user); ?>
                                                    <tr>
                                                        <td>
                                                            <?php $img_link = ($user['user_img']) ? 'c'.$user['user_id'].'/'.$user['user_img'] : 'default.png';?>
                                                            <a href="<?=base_url();?>assets/back-office/images/customer/<?=$img_link;?>" class="image-popup" title="<?=ucfirst(strtolower($user['firstname'])).' '.ucfirst(strtolower($user['lastname']));?>">
                                                                <div class="tbl-img">
                                                                    <img src="<?=base_url();?>assets/back-office/images/customer/<?=$img_link;?>" class="header-icon1  user-top-img rounded-circle" alt="customer avatar">
                                                                </div>
                                                            </a>
                                                        </td>   
                                                        <td><span class="ttl">Name:</span> <a onclick="viewCustomer('<?=$email;?>')" href="javascript:;"> <?=ucfirst($firstname).' '.ucfirst($lastname);?></a></td>
                                                        <td><span class="ttl">Address:</span> <?=$address;?></td>
                                                        <td><span class="ttl">Email:</span> 
                                                            <a href="mailto:<?=$email;?>"><?=$email;?></a>
                                                        </td>
                                                        <td><span class="ttl">Date Registered:</span> 
                                                            <?=date('Y-m-d',strtotime($data_created));?>
                                                        </td>
                                                        <td class="text-center">
                                                            <button onclick="viewCustomer('<?=$email;?>', this)" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> View</button>
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