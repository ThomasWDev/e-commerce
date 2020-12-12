<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('frontpage/common/css');?>

<body class="animsition">

	<!-- header and header fixed -->
	<?php $this->load->view('frontpage/common/header/header');?>
		<!-- breadcrumb -->
        <div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?=base_url();?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17">
			Profile Settings
		</span>
	</div>

	<section class="bgwhite p-t-20 p-b-20">
		<div class="container">
			<div class="card-box" style="box-shadow: 2px 2px 6px lightgrey">
				<form id="customerProfileForm" method="POST" action="javascript:;">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 p-b-20"><div class="err-msg"></div></div>
							<div class="col-md-3 col-sm-12">
								<div class="form-group text-center">
									<div class="acc-img">
										<?php $img_link = ($user['user_img']) ? 'c'.$user['user_id'].'/'.$user['user_img'] : 'default.png';?>
										<img id="img-profile" src="<?=base_url();?>assets/back-office/images/customer/<?=$img_link;?>" alt="Profile Image">
										<input type="file" name="input_img" class="input-img" id="input-img" accept="image/x-png,image/gif,image/jpeg" style="opacity: 0;display: none;">
										<input type="hidden" name="img_data" id="img_data">
										<input type="hidden" name="img_name" id="img_name" value="<?=($user['user_img'])?$user['user_img']:'';?>">
										<input type="hidden" name="userID" id="userID" value="<?=$user['user_id']?>">
									</div>
									<span class="CprofileImgDiv"></span>
								</div>
							</div>
							<div id="customerDivForm" class="col-md-9 col-sm-12">
								<div class="row">
									<div class="col-lg-12">
										<h6 class="m-text26 p-b-20 p-t-15">Personal Information</h6>
										<div class="row">
											<div class="col-md-6">
												<div class="bo4 of-hidden size15 m-b-20">
													<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="firstname" name="firstname" placeholder="First Name *" value="<?=$user['firstname']?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="bo4 of-hidden size15 m-b-20">
													<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="lastname" name="lastname" placeholder="Last Name *" value="<?=$user['lastname']?>">
												</div>
											</div>
										</div>
										<div class="bo4 of-hidden size15 m-b-20">
											<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="address" name="address" placeholder="Address *" value="<?=$user['address']?>">
										</div>
										<div class="bo4 of-hidden size15 m-b-20">
											<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="address_unit" name="address_unit" placeholder="Apartment, suite, unit, street, etc. (Optional)" value="<?=$user['address_unit']?>">
										</div>
										<div class="row">
											<div class="col-md-8">
												<div class="of-hidden size15 m-b-20">
													<select name="country" id="country" class="bo4 sizefull s-text7 p-l-22 p-r-22">
														<option value="">Select Country</option>
														<option value="US" <?=($user['country']=='US')?'selected':'';?>>United States</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="bo4 of-hidden size15 m-b-20">
													<input onchange="hidePaymentBtn()" class="sizefull s-text7 p-l-22 p-r-22" type="text" placeholder="Phone *" value="<?=$user['phone']?>" id="phone" name="phone">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="bo4 of-hidden size15 m-b-20 zipcode-wrap">
													<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="zipcode" name="zipcode" placeholder="Postal/Zip Code *" value="<?=$user['zip_code']?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="bo4 of-hidden size15 m-b-20">
													<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="city" name="city" placeholder="Town/City *" value="<?=$user['city']?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="bo4 of-hidden size15 m-b-20">
													<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="state" name="state" placeholder="State *" value="<?=$user['state']?>">
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<h6 class="m-text26 p-b-20 p-t-15">Account Setting</h6>
										<div class="bo4 of-hidden size15 m-b-20" id="emaildiv">
											<input class="sizefull s-text7 p-l-22 p-r-22" type="email" id="email" name="email" placeholder="Email Address" value="<?=$user['email']?>">
											<input type="hidden" id="old_email" name="old_email" value="<?=$user['email']?>">
										</div>
										<div class="bo4 of-hidden size15 m-b-20 pass-wrap">
											<input class="sizefull s-text7 p-l-22 p-r-22" type="password" id="password" name="password" placeholder="New Password" value="">
										</div>
										<div class="bo4 of-hidden size15 m-b-20">
											<input class="sizefull s-text7 p-l-22 p-r-22" type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" value="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col text-right p-b-15">
										<div class="header-cart-buttons col-md-6">
											<div class="header-cart-wrapbtn">
												<a onclick="enableEditCustomerProfile()" href="javascript:;" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">Cancel</a>
											</div>
											<div class="header-cart-wrapbtn">
												<a onclick="validateProfile(this)" href="javascript:;" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">Save Changes</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="customerDivInformation" class="col-md-9 col-sm-12">
								<div class="row text-left">
									<div class="col-lg-6 col-md-6 col-sm-12">
										<p class="card-title">Personal Information</p>
										<div class="text-left text-muted">
											<p class="card-title m-b-0"><b>Full Name</b></p>
											<p class="card-title m-t-0"><?=ucfirst(strtolower($user['firstname'])).' '.ucfirst(strtolower($user['lastname']));?></p>
											<p class="card-title m-b-0"><b>Address</b></p>
											<p class="card-title m-t-0"><?=$user['address'].', '.$user['address_unit'].', '.$user['city'].', '.$user['state'].', '.$user['country'].', '.$user['zip_code']?></p>
											<p class="card-title m-b-0"><b>Phone</b></p>
											<p class="card-title m-t-0"><?=$user['phone'];?></p>
											</p>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">
										<p class="card-title">Account Details</p>
										<div class="text-left text-muted">
											<p class="card-title m-b-0"><b>Email Address</b></p>
											<p class="card-title m-t-0"><?=$user['email']?></p>
											<p class="card-title m-b-0"><b>Date Registered</b></p>
											<p class="card-title m-t-0"><?=date('M d, Y',strtotime($user['data_created']))?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<?php $this->load->view('frontpage/common/footer');?>

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- JS Files -->
	<?php $this->load->view('frontpage/common/js');?>
	<script src="<?=base_url();?>assets/front-office/js/init/init_profile.js"></script>
</body>
</html>
