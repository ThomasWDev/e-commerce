<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/* Display login dashboard or login page */
	public function index(){
		// if logged in, display the dashboard
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			redirect('admin/dashboard');
		}else{ // if not logged in, display the login page
			$data['is_page'] = 'login';
			$this->load->view('admin/login', $data);
		}
	}

	/* Display admin dashboard */
	public function dashboard(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] 			 = 'dashboard'; // is in dashboard page
			// Count all data in according the its type
			$data['total_products'] 	 = count($this->product_model->get_all_products());
			$data['total_orders'] 	 	 = count($this->product_model->get_all_orders());
			$data['total_customers'] 	 = count($this->customer_model->get_all_customers(1));
			$data['total_category'] 	 = count($this->catalog_model->get_all_categories());
			$data['total_items_in_cart'] = count($this->product_model->get_all_cartItems());
			$this->load->view('admin/dashboard', $data);
		}else{
			redirect(base_url());
		}
	}

	/* Display orders page */
	public function orders(){
        if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] = 'orders';
			$data['orders']  = $this->product_model->all_orders();
			$this->load->view('admin/products/order_view', $data);
		}else{
			redirect(base_url());
		}
	}

	/* Display specific order */
	public function view_order($orderID){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] = 'view_order';
			$data['orders'] = $this->product_model->get_single_order($orderID);
			$data['user'] = $this->customer_model->get_single_customer($data['orders']['customer_id']);
			// if($data['orders']['tracking_number'] != ""){
			// 	$data['trackShipment'] = $this->track_shipping($data['orders']['tracking_number']);
			// }
			$this->load->view('admin/products/order_details', $data);
		}else{
			redirect(base_url());
		}
	}

	/* Track Shipping */
	public function track_shipping($trackingNumber){
        $this->load->library('UpsTrack');
        $this->upstrack->addField('trackNumber', $trackingNumber);
		list($response, $status) = $this->upstrack->processTrack();
		$ups_response = json_decode($response);
        if(isset($ups_response->Fault)){
            return $ups_response->Fault->detail->Errors->ErrorDetail->PrimaryErrorCode->Description;    
        }else{
			return;
		}
    }

	/* Display payment settings */
	public function payment_settings(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] = 'payment_settings';
			$data['payment_settings'] = $this->admin_model->get_payment_settings();
			$this->load->view('admin/payment_settings', $data);
		}else{
			redirect(base_url());
		}
	}

	/* Diplay Sendgrid Settings */
	public function sendgrid_settings(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] = 'sendgrid_settings';
			$data['sendgrid_settings'] = $this->admin_model->get_payment_settings();
			$this->load->view('admin/sendgrid_settings', $data);
		}else{
			redirect(base_url());
		}
	}

	/* Diplay Sendgrid Settings */
	public function taxjar_settings(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] = 'taxjar_settings';
			$data['taxjar_settings'] = $this->admin_model->get_payment_settings();
			$this->load->view('admin/taxjar_settings', $data);
		}else{
			redirect(base_url());
		}
	}

	/* Diplay UPS Settings */
	public function ups_settings(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] = 'ups_settings';
			$data['ups_settings'] = $this->admin_model->get_payment_settings();
			$this->load->view('admin/ups_settings', $data);
		}else{
			redirect(base_url());
		}
	}

	/* Display tax and shipping rates */
	// public function tax_shipping_rates(){
	// 	if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
	// 		$data['is_page'] = 'tax_shipping_rates';
	// 		$data['payment_settings'] = $this->admin_model->get_payment_settings();
	// 		$this->load->view('admin/tax_shipping_rates', $data);
	// 	}else{
	// 		redirect(base_url());
	// 	}
	// }

	/* Save payment settings using ajax */
	public function save_settings(){
		if($this->session->userdata('user_id')&&($this->session->userdata('role')==1 || $this->session->userdata('role')==3)){
			echo $this->admin_model->save_settings()?1:0;
		}else{ echo 0; }
	}



	/* Save payment settings using ajax */
	public function save_rate_settings(){
		if($this->session->userdata('user_id')&&($this->session->userdata('role')==1 || $this->session->userdata('role')==3)){
			echo $this->admin_model->save_rate_settings()?1:0;
		}else{ echo 0; }
	}

	/* Display customers view */
	public function customers(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] = 'customers';
			$data['get_all_customers'] = $this->customer_model->get_all_customers(1);
			$this->load->view('admin/customers/view_customers', $data);
		}else{
			redirect(base_url());
		}
	}

	/* Display profile view */
	public function profile($userID){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data = $this->customer_model->get_single_customer($userID);
			echo ($data)?json_encode($data):0;
		
		}
	}

	/* Save profile using ajax */
	public function save_profile(){
		if ($this->session->userdata('user_id')&&$this->input->post()) {
			echo ($this->customer_model->save_profile()) ? 1 : 0;
		}
	}

	/* Check email on database using ajax */
	public function checkEmail(){ //
		if($this->input->post('email')){
			$email = $this->input->post('email');
			$res = $this->admin_model->checkEmail($email);
			echo ($res) ? 1 : 0;
		}
	}

	/* Check cusotmer email using ajax  */
	public function check_customer_email(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			if($this->input->post()){
				$customer_id = $this->customer_model->get_customer_id($this->input->post('email'));
				echo ($customer_id) ? $customer_id['user_id'] : 0;
			}else{ echo 0; }
		}else{ echo 0; }
	}

	/* Customers view */
	public function view_customer($uid){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] = 'view_customer';
			$data['user'] = $this->customer_model->get_single_customer($uid);
			$data['orders'] = $this->product_model->get_my_transactionsHistory($uid);
			$this->load->view('admin/customers/customer_detail', $data);
		}else{
			redirect(base_url());
		}
	}

	/* Products view */
	public function products(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] = 'products';
			$data['get_all_products'] = $this->product_model->get_all_products();
			$this->load->view('admin/products/view_products', $data);
		}else{
			redirect(base_url());
		}
	}

	/* Categories view */
	public function categories(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] = '';
			
		}else{
			redirect(base_url());
		}
	}

	/* Attributes Vuew */
	public function attributes(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] = '';
			
		}else{
			redirect(base_url());
		}
	}

	/* Update order status using ajax */
	public function updateOrderStatus(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$orderStatus = $this->input->post('order_status');
			if($orderStatus == 5){
				$this->bookShipping($this->input->post('order_id'));
			}else{
				if($orderStatus == 9){
					$send_email = $this->sendTrackingNumEmail($this->input->post('order_id'));
					echo $this->product_model->updateOrderStatus() ? 1 : 0;
				}else{
					echo $this->product_model->updateOrderStatus() ? 1 : 0;
				}
				
			}
		}
	}

	public function sendTrackingNumEmail($orderID){
		$data['is_page'] 		= 'Email Template';
		$orderData 				= $this->product_model->get_single_order($orderID);
		$customerData 			= $this->customer_model->get_single_customer($orderData['customer_id']);
		$data['trackingNumber'] = $orderData['tracking_number'];
		$data['customerName'] 	= $customerData['firstname'];
		$body = $this->load->view('admin/email_template/send_tracking_email_template',$data,TRUE); // Separated template to view the codes easily
        $this->email->from('noreply@elisautosale.com', 'E-commerce Site');
        $this->email->to($customerData['email']);
        $this->email->subject('Order has been shipped out');
        $this->email->message($body);
        return ($this->email->send())? true : false;
	}

	/* Book shipping */
	public function bookShipping($orderID){
        $this->load->library('UpsShipping');
        $orderData = $this->product_model->get_single_order($orderID);
        $this->upsshipping->addField('ShipTo_Name', $orderData['shipping_firstname'] .' '.$orderData['shipping_lastname']);
        $this->upsshipping->addField('ShipTo_AddressLine', array($orderData['shipping_address']));
        $this->upsshipping->addField('ShipTo_City', $orderData['shipping_city']);
        $this->upsshipping->addField('ShipTo_StateProvinceCode', $orderData['shipping_state']);
        $this->upsshipping->addField('ShipTo_PostalCode', $orderData['shipping_zip_code']);
        $this->upsshipping->addField('ShipTo_CountryCode', $orderData['shipping_country']);
        $this->upsshipping->addField('ShipTo_Number', $orderData['shipping_phone']);
        $this->upsshipping->addField('Service_Code', $orderData['service_type']);
        /* Package Dimension and Weight */
        $dimensions = array();
		$index = 0;
		$qty = json_decode($orderData['quantity']);
        foreach( json_decode($orderData['product_id']) as $key => $product_id ) {
            $product = $this->product_model->get_specific_product($product_id);

            $dimensions[$index]['Length']   = $product['length'];
            $dimensions[$index]['Width']    = $product['width'];
            $dimensions[$index]['Height']   = $product['height'];
            $dimensions[$index]['Weight']   = $product['weight'];
            $dimensions[$index]['Qty']      = $qty[$key];
            $index++;
        }
      
        $this->upsshipping->addField('dimensions', $dimensions);
        list($response, $status) = $this->upsshipping->processShipAccept();
		$ups_response = json_decode( $response );
		if(isset($ups_response->ShipmentResponse)){
			// Response:
			$track_number = $ups_response->ShipmentResponse->ShipmentResults->ShipmentIdentificationNumber;
			$total_charges = $ups_response->ShipmentResponse->ShipmentResults->ShipmentCharges->TotalCharges->MonetaryValue;
			$graphic_image = $ups_response->ShipmentResponse->ShipmentResults->PackageResults->ShippingLabel->GraphicImage;
			$html_image = $ups_response->ShipmentResponse->ShipmentResults->PackageResults->ShippingLabel->HTMLImage; 
			$target_path = "./assets/back-office/images/graphic/";
			$imgNameGraphic = 'graphic_'.uniqid().".gif";

			$file=fopen($target_path.$imgNameGraphic,"w");
			fwrite($file,base64_decode($graphic_image));
			$this->product_model->updateOrderShippingDtls($orderID, array('tracking_number' => $track_number, 'graphic_img' => $imgNameGraphic));
			echo $this->product_model->updateOrderStatus() ? 1 : 0;
		}
		else{
			echo $ups_response->response->errors[0]->message;
		}
    }
}
