<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');
require_once  FCPATH . 'vendor/autoload.php';

class Auth extends CI_Controller {

	/* Login as admin */
	public function login(){
		if($this->input->post()){
			$email 	  = $this->input->post('email');
			$password = md5($this->input->post('password'));
            $res      = $this->auth_model->check_user($email, $password, 1); // 1 Admin
            if($res){
                $this->session->set_flashdata('success', 'Welcome back '.$res['firstname']);
                redirect('admin/dashboard');
            }else{
                $this->session->set_flashdata('error', 'Invalid Username or Password');
			    redirect('admin');
            }
		}else{
			redirect('frontpage');
		}
	}

	/* Login as user using ajax */
	public function login_user(){
		if($this->input->post()){
			// Login user
			$email 	  = $this->input->post('login_email');
			$password = md5($this->input->post('login_password'));
			$res      = $this->auth_model->check_user($email, $password, 2); // 1 User
			if($res){ // If logged in, need to check if user has existing carts in the session, if has, then add them to database
				$my_items = (isset($_SESSION['cart']))?$_SESSION['cart']:[];
				if($my_items){
					foreach($my_items as $items){
						$res = $this->auth_model->save_my_cart($items);
					}
				}
				echo $res ? 1 : 0;
			}else{ echo 0; }
		}else{ echo 0; }
	}

	/* Register as a new user */
	public function register_user(){
		if($this->input->post()){
			// Register user and set session for login
			$res = $this->auth_model->register_user();
			if($res){ // If inserted, need to check if user has existing carts in the session, if has, then add them to database
				$my_items = (isset($_SESSION['cart']))?$_SESSION['cart']:[];
				if($my_items){
					foreach($my_items as $items){
						$res = $this->auth_model->save_my_cart($items);
					}
				}
				echo $res ? 1 : 0;
			}else{ echo 0; }
		}else{ echo 0; }
	}

	/* Registration get registration view */
	public function registration(){
		$data['countries'] = $this->frontpage_model->get_countries();
		echo $this->load->view('frontpage/common/header/register', $data, true);
	}

	/* Check email using ajax */
	public function check_email(){
		if($this->input->post()){
			$email = $this->input->post('email');
			$res   = $this->auth_model->check_email($email);
			echo $res ? 1 : 0;
		}else{ echo 0; }
	}

	/* Send message using ajax */
	public function send_message(){
        if($this->input->post()){ 
            $this->email->from($this->input->post('email'), $this->input->post('firstname').' '.$this->input->post('lastname')); 
			$emails = array('artvekinc@gmail.com', 'artvekinc@yahoo.com');
            $this->email->to($emails); 
            $this->email->subject($this->input->post('subject'));
            $this->email->message($this->input->post('message'));
            echo ($this->email->send()) ? 1 : 0;
        } else { echo 0; }
    }

	// Logout and end the session
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	/* For testing taxjar API */
	public function testApi(){
		$admin  = $this->auth_model->get_admin_info();
		$client = TaxJar\Client::withApiKey('464bfbbade313bdcb03d8f613d719f75');
		try {
			$tax = $client->taxForOrder([
				'from_country'  => 'US',
				'from_zip' 		=> '07001',
				'from_state' 	=> 'NJ',
				'from_city' 	=> 'Avenel',
				'from_street'	=> '305 W Village Dr',
				'to_country' 	=> 'US',
				'to_zip' 		=> '07446',
				'to_state' 		=> 'NJ',
				'to_city' 		=> 'Ramsey',
				'to_street' 	=> '63 W Main St',
				'amount'		=> 16.50,
				'shipping' 		=> 0,
			]);
			echo $tax->amount_to_collect; // 1.09
			echo $tax->rate; // 0.06625
		  } catch (TaxJar\Exception $e) {
			// 406 Not Acceptable – transaction_id is missing
			echo $e->getMessage();
		}
	}
}
