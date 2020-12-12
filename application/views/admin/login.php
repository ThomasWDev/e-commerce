<!DOCTYPE html>
<html>
    <?php $this->load->view('admin/common/css');?>
	<body>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class=" card-box">
                <div class="panel-heading"> 
                    <h3 class="text-center"> Sign In to <strong class="text-custom">E-commerce Site</strong> </h3>
                </div> 
                <div class="panel-body">
                    <form action="<?=base_url();?>auth/login" class="form-horizontal m-t-20" data-parsley-validate novalidate method="POST">
                        <?php if(isset($_SESSION['error'])){ ?>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>Oops!</strong> <?=$_SESSION['error'];?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" required="" placeholder="Email" name="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" required="" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group text-center m-t-40">
                            <div class="col-xs-12">
                                <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>

                        <div class="form-group m-t-30 m-b-0">
                            <div class="col-sm-12 text-center">
                                <a href="page-recoverpw.html" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                            </div>
                        </div>
                    </form>
                </div>   
            </div>   
        </div>
        
    	<?php $this->load->view('admin/common/js');?>
	
	</body>
</html>
