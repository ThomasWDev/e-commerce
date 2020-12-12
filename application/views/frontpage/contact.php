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
			Contact Us
		</span>
	</div>

	<section class="bgwhite p-t-45 p-b-58">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 p-b-50">
					<div class="row">
						<div class="col lg-12 p-b-50">
                            <form id="contactForm" class="leave-comment">
								<h4 class="m-text26 p-b-20">Contact Us</h4>
								<p>Please message us below. We can reach you as soon as we can.</p>
								<div class="row">
									<div class="col-md-12 p-b-20"><div class="err-msg"></div></div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="bo4 of-hidden size15 m-b-20">
											<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="firstname" name="firstname" placeholder="First Name *">
										</div>
									</div>
									<div class="col-md-6">
										<div class="bo4 of-hidden size15 m-b-20">
											<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="lastname" name="lastname" placeholder="Last Name *">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="bo4 of-hidden size15 m-b-20">
											<input class="sizefull s-text7 p-l-22 p-r-22" type="text" id="subject" name="subject" placeholder="Subject *">
										</div>
									</div>
									<div class="col-md-6">
										<div class="bo4 of-hidden size15 m-b-20">
											<input class="sizefull s-text7 p-l-22 p-r-22" type="email" id="email" name="email" placeholder="Email *">
										</div>
									</div>
								</div>
								<div class="of-hidden m-b-20">
									<textarea  class="bo4 sizefull s-text7 p-l-22 p-t-20 p-b-20 p-r-22" name="message" id="message" rows="5" placeholder="Your Message *"></textarea>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="size15 trans-0-4">
											<a onclick="send_message(this)" href="javascript:;" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
												Submit
											</a>
										</div>
									</div>
								</div>
							</form>
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
