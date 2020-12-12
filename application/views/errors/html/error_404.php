<!DOCTYPE html>
<?php $base_url = load_class('Config')->config['base_url'];  ?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="E-commerce Web Design, Admin Page">
		<meta name="author" content="Coderthemes">

		<link rel="icon" type="image/png" href="<?=$base_url;?>assets/front-office/images/icons/favicon.png"/>

		<title>Admin - E-commerce</title>

		<link href="<?=$base_url;?>assets/back-office/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=$base_url;?>assets/back-office/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=$base_url;?>assets/back-office/css/core.css" rel="stylesheet" type="text/css" />
		<link href="<?=$base_url;?>assets/back-office/css/components.css" rel="stylesheet" type="text/css" />
		<link href="<?=$base_url;?>assets/back-office/css/icons.css" rel="stylesheet" type="text/css" />
		<link href="<?=$base_url;?>assets/back-office/css/pages.css" rel="stylesheet" type="text/css" />
		<link href="<?=$base_url;?>assets/back-office/css/responsive.css" rel="stylesheet" type="text/css" />
		<link href="<?=$base_url;?>assets/back-office/css/style.css" rel="stylesheet" type="text/css" />
		<link href="<?=$base_url;?>assets/back-office/plugins/sweetalert/sweetalert.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=$base_url;?>assets/back-office/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
		<link href="<?=$base_url;?>assets/back-office/plugins/bootstrapvalidator/src/css/bootstrapValidator.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?=$base_url;?>assets/back-office/plugins/magnific-popup/dist/magnific-popup.css"/>
		<script src="<?=$base_url;?>assets/back-office/js/modernizr.min.js"></script>
		<input type="hidden" id="base_url" value="<?=$base_url;?>">
	</head>
    <body>
    	
    	<div class="account-pages"></div>
		<div class="clearfix"></div>
		
        <div class="wrapper-page">
            <div class="ex-page-content text-center">
                <div class="text-error"><span class="text-primary">4</span><i class="ti-face-sad text-pink"></i><span class="text-info">4</span></div>
                <h2>Whoops! <?php echo $heading; ?> </h2><br>
                <p class="text-muted"><?php echo $message; ?></p>
                <p class="text-muted">Use the navigation above or the button below to get back and track.</p>
                <br>
                <a class="btn btn-default waves-effect waves-light" href="javascript:;" onclick="history.back()"><i class="fa fa-arrow-left"></i> Go Back</a>
            </div>
        </div>
    	<script>
            var resizefunc = [];
        </script>	
	</body>
</html>