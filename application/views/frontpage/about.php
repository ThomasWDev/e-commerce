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
			About Us
		</span>
	</div>

	<section class="bgwhite p-t-45 p-b-58">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 p-b-50">
					<h4 class="m-text14 p-b-20">
						About Us
					</h4>

					<div class="row">
						<div class="col lg-12 p-b-50">
							Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia delectus voluptate nulla molestias esse id numquam vitae tempore fugiat saepe labore recusandae qui cumque inventore, voluptatum voluptatibus ducimus deserunt dignissimos! <br><br>
							Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia delectus voluptate nulla molestias esse id numquam vitae tempore fugiat saepe labore recusandae qui cumque inventore, voluptatum voluptatibus ducimus deserunt dignissimos! <br><br>
							Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia delectus voluptate nulla molestias esse id numquam vitae tempore fugiat saepe labore recusandae qui cumque inventore, voluptatum voluptatibus ducimus deserunt dignissimos!
                        </div>
					</div>
				</div>
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

</body>
</html>
