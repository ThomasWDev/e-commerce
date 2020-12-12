<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');
require_once  FCPATH . 'vendor/autoload.php';
class Frontpage extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('frontpage_model');
    }

	/* Frontpage/Main homapage view */
	public function index(){
		$data['is_page'] 			   = 'homepage';
		$data['get_new_products'] 	   = $this->frontpage_model->get_new_products(8);
		$data['get_featured_products'] = $this->frontpage_model->get_featured_products(8);
		$data['get_sale_products'] 	   = $this->frontpage_model->get_sale_products(8);
		$this->load->view('frontpage/homepage', $data);
	}

	/* Shop page view */
	public function shop(){
		$data['is_page'] 		= 'shop';
		$data['base_url']		= base_url().'shop';
		$per_page 			 	= isset($_GET['per_page']) ? $_GET['per_page'] : '';
		$data['total_rows'] 	= $this->frontpage_model->get_all_products(0, 0, 1);
		$data['per_page'] 		= 15;
		$data["uri_segment"] 	= 2;
		$this->pagination->initialize($data);
		$page 					= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["links"] 			= $this->pagination->create_links();
		$data['get_products'] 	= $this->frontpage_model->get_all_products($data["per_page"], $per_page, 2);
		$data['categories'] 	= $this->frontpage_model->categories();
		$this->load->view('frontpage/shop', $data);
    }
	
	/* Product sale page view */
    public function sale(){
		$data['is_page'] 		= 'sale';
		$data['base_url'] 		= base_url().'sale';
		$per_page 			 	= isset($_GET['per_page']) ? $_GET['per_page'] : '';
		$data['total_rows'] 	= $this->frontpage_model->get_all_sale(0, 0, 1);
		$data['per_page'] 		= 15;
		$data["uri_segment"] 	= 2;
		$this->pagination->initialize($data);
		$page 					= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["links"] 			= $this->pagination->create_links();
		$data['get_products'] 	= $this->frontpage_model->get_all_sale($data["per_page"], $per_page, 2);
		$data['categories'] 	= $this->frontpage_model->categories();
		$this->load->view('frontpage/shop', $data);
    }
	
	/* Featured products page view */
    public function features(){
		$data['is_page'] 	 	= 'features';
		$data['base_url'] 	 	= base_url().'features';
		$per_page 			 	= isset($_GET['per_page']) ? $_GET['per_page'] : '';
		$data['total_rows']  	= $this->frontpage_model->get_all_features(0, 0, 1);
		$data['per_page'] 	 	= 15;
		$data["uri_segment"] 	= 2;
		$this->pagination->initialize($data);
		$page 				  	= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["links"] 		  	= $this->pagination->create_links();
		$data['get_products'] 	= $this->frontpage_model->get_all_features($data["per_page"], $per_page, 2);
		$data['categories']   	= $this->frontpage_model->categories();
		$this->load->view('frontpage/shop', $data);
	}

	/* Product detail view */
	public function product_detail($product_id){
		$data['is_page'] 		  = 'product_detail';
		$data['get_new_products'] = $this->frontpage_model->get_new_products(8);
		$data['prod'] 			  = $this->frontpage_model->get_single_product($product_id);
		$this->load->view('frontpage/product_detail', $data);
	}

	/* About page view */
	public function about(){
		$data['is_page'] = 'about';
		$this->load->view('frontpage/about', $data);
	}

	/* Contact page view */
	public function contact(){
		$data['is_page'] = 'contact';
		$this->load->view('frontpage/contact', $data);
	}

	/*  Profile page view */
	public function profile(){
		if ($this->session->userdata('user_id')) {
			$data['is_page'] 	= 'profile';
			$data['countries'] 	= $this->frontpage_model->get_countries();
			$data['user'] 		= $this->customer_model->get_single_customer($this->session->userdata('user_id'));
			$this->load->view('frontpage/profile', $data);
		}else{
			redirect(base_url());
		}
	}

	/* Transaction page view */
	public function transactions(){
		$data['is_page'] = 'transaction_history';
		$this->load->view('frontpage/transaction_history', $data);
	}
	
	/* Cart page view */
	public function my_cart(){
		$data['is_page'] = 'my_cart';
		$this->load->view('frontpage/my_cart', $data);
	}

	/* Checkout page view */
	public function checkout(){
		if($this->session->userdata('user_id')){
			$data['my_info'] = $this->auth_model->get_my_info();
		}
		$data['is_page']  		  = 'checkout';
		$data['countries'] 		  = $this->frontpage_model->get_countries();
		$data['payment_settings'] = $this->admin_model->get_payment_settings();
		if($this->input->post()){
			$receiver_dtls = array(
				'firstname' 	=> $this->input->post('firstname'),
				'lastname'		=> $this->input->post('lastname'),
				'address'		=> $this->input->post('address'),
				'address_unit'	=> $this->input->post('address_unit'),
				'zip_code'		=> $this->input->post('zip_code'),
				'city'			=> $this->input->post('city'),
				'state'			=> $this->input->post('state'),
				'country'		=> $this->input->post('country'),
				'phone'			=> $this->input->post('phone'),
				'email'			=> $this->input->post('email')
			);
			$receiver_details['receiver_details'] = $receiver_dtls;
			$this->session->set_userdata($receiver_details);
			if($this->input->post('password')){
				$new_customer_password['new_customer_password'] = $this->input->post('password');
				$this->session->set_userdata($new_customer_password);
			}
			redirect('shipping');

		}
		if($this->session->userdata('shipping_details')){
			$data['shipping'] = $this->session->userdata('shipping_details');
		}
		if($this->session->userdata('tax_dtls')){
			$data['tax']		= $this->session->userdata('tax_dtls');	
		}
		if($this->session->userdata('receiver_details')){
			$data['receiver_dtls'] = $this->session->userdata('receiver_details');
		}else{
			$data['receiver_dtls'] = array();
		}
		if($this->session->userdata('receiver_details')){
			$data['new_customer_password'] = $this->session->userdata('new_customer_password');
		}else{
			$data['new_customer_password'] = array();
		}
		$this->load->view('frontpage/checkout', $data);
	}

	/* Shipping Page */
	public function shipping(){
		if($this->session->userdata('shipping_rates')){
			$data['is_page']	= 'shipping';
			$data['rates']		= $this->session->userdata('shipping_rates');
			$data['tax']		= $this->session->userdata('tax_dtls');	
			if($this->input->post()){
				list($code, $amount) = explode('|',$this->input->post('shipping_method'));
				$shipping_details['shipping_details'] = array(
					'code' => $code,
					'amount'=> $amount		
				);
				$this->session->set_userdata($shipping_details);
				redirect('payment');
			}		
			if($this->session->userdata('shipping_details')){
				$data['shipping'] = $this->session->userdata('shipping_details');
			}
			$this->load->view('frontpage/shipping', $data);
		}else{
			redirect('checkout');
		}
	}

	/* Shipping Page */
	public function payment(){
		if($this->session->userdata('shipping_details')){
			$data['is_page']  			= 'payment';
			$data['shipping'] 			= $this->session->userdata('shipping_details');
			$data['tax']				= $this->session->userdata('tax_dtls');	
			$data['receiver_details']	= $this->session->userdata('receiver_details');
			if($this->session->userdata('receiver_details')){
				$data['new_customer_password'] = $this->session->userdata('new_customer_password');
			}else{
				$data['new_customer_password'] = array();
			}
			$this->load->view('frontpage/payment', $data);
		}elseif($this->session->userdata('shipping_rates')){
			redirect('shipping');
		}else{
			redirect('checkout');
		}
	}

	/* Calculate orders including tax rate using ajax */
	public function calculate_orders(){
		if($this->input->post('zip_code')){ // if has zipcode, calculate tax
			$total=0;
			$subtotal=0;
			if($this->session->userdata('user_id')){// if logged in, get its product from database
				$my_items = $this->product_model->get_my_product();
			}else{ // if not logged in, get products on cart inside session
				$my_items = (isset($_SESSION['cart']))?$_SESSION['cart']:[];
			}
			foreach($my_items as $i){ 
				$subtotal = $i['item_price'] * $i['qty'];
				$total+=$subtotal; 
			}
			$res = $this->calculate_sales_tax($total, $this->input->post()); // calculate tax 
			if($res['error']){ // if has error
				$data['has_tax'] = false;
				$res = array(
					'code' => 203,
					'msg' => $res['msg'],
					'data' => []
				);
			}else{ // if sucess
				$data['has_tax'] = true;
				$data['tax_rate'] = $res['tax_rate'];
				$data['amount_to_collect'] = $res['amount_to_collect'];
				$tax_dtls['tax_dtls'] = $data;
				$this->session->set_userdata($tax_dtls);
				$res = array(
					'code' => 200,
					'msg' => $res['msg'],
					'data' => $this->load->view('frontpage/my_order', $data, true)
				);
			}
		}else{ //error if no zipcode
			$data['has_tax'] = false;
			$res = array(
				'code' => 203,
				'msg' => 'Error',
				'data' => []
			);
		}
		echo json_encode($res); // display data as json
	}

	/* Get payment settings using ajax */
	public function get_payment_settings(){
        $p_settings = $this->admin_model->get_payment_settings();
        echo $p_settings ? json_encode($p_settings) : 0;
	}

	/* Search product */
    public function search(){
		$data['is_page'] 	 	= 'search';
		$keywords 			 	= isset($_GET['keywords']) ? $_GET['keywords'] : '';
		$per_page 			 	= isset($_GET['per_page']) ? $_GET['per_page'] : '';
		$data['base_url']    	= base_url().'search?keywords='.$keywords;
		$data['total_rows']  	= $this->product_model->search_keywords(null, null, 1, $keywords);
		$data['per_page']    	= 15;
		$this->pagination->initialize($data);
		$data["links"]       	= $this->pagination->create_links();
		$data['get_products'] 	= $this->product_model->search_keywords($data["per_page"], $per_page, 2, $keywords);
        $data['categories'] 	= $this->frontpage_model->categories();
        $this->load->view('frontpage/shop', $data);
	}

	/* Sve prooduct using ajax */
	public function save_profile(){
		if ($this->session->userdata('user_id')&&$this->input->post()) {
			echo ($this->customer_model->save_profile()) ? 1 : 0;
		}
	}

	/* Calculate tax using taxjar API */
	public function calculate_sales_tax($total, $post){
		$admin  	= $this->auth_model->get_admin_info(); // Getting the admin address form the database
		$settings 	= $this->admin_model->get_payment_settings(); // Getting the Admin settings to get the TaxJar key
		$res = array(
			'error' => false,
			'msg' => 'success',
			'tax_rate' => '0.2',
			'amount_to_collect' => '0.2'
		);
		return $res;
		// $client = TaxJar\Client::withApiKey($settings['taxjar_key']);
		// try {
		// 	$tax = $client->taxForOrder([
		// 		'from_country'  => $admin['country'],
		// 		'from_zip' 		=> $admin['zip_code'],
		// 		'from_state' 	=> $admin['state'],
		// 		'from_city' 	=> $admin['city'],
		// 		'from_street'	=> $admin['address'],
		// 		'to_country' 	=> $post['country'],
		// 		'to_zip' 		=> $post['zip_code'],
		// 		'to_state' 		=> $post['state'],
		// 		'to_city' 		=> $post['city'],
		// 		'to_street' 	=> $post['address'],
		// 		'amount'		=> $total,
		// 		'shipping' 		=> 0,
		// 	]);
		// 	$res = array(
		// 		'error' => false,
		// 		'msg' => 'success',
		// 		'tax_rate' => $tax->rate,
		// 		'amount_to_collect' => $tax->amount_to_collect
		// 	);
		// 	return $res;
		// } catch (TaxJar\Exception $e) {
		// 	$res = array(
		// 		'error' => true,
		// 		'msg' => $e->getMessage()
		// 	);
		// 	return $res;
		// }
	}

	/* Email template testing/viewing */
	public function sendEmailTest(){
		$this->load->view('admin/email_template/order_email_template');
	}
}
