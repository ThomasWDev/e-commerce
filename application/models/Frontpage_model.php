<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontpage_model extends CI_Model {
    
    /* Get all Categories */
	public function categories(){
        $this->db->select('*')->from('categories');
        $this->db->order_by('cat_name', 'asc');
        return $this->db->get()->result_array();
    }

    /* Get all new products */
    public function get_new_products($limit){
        $this->db->select('*')->from('products');
        if($limit){ $this->db->limit($limit); } // if limit is set, we need to add limit (means how many products needs to display)
        $this->db->order_by('product_id', 'desc');
        return $this->db->get()->result_array();
    }

    /* Get all featured products */
    public function get_featured_products($limit){
        $this->db->select('*')->from('products')->where('is_featured', 1);
        if($limit){ $this->db->limit($limit); } // if limit is set, we need to add limit (means how many products needs to display)
        $this->db->order_by('product_id', 'desc');
        return $this->db->get()->result_array();
    }

    /* Get all sales products */
    public function get_sale_products($limit){
        $this->db->select('*')->from('products')->where('sale_price !=', 0);
        if($limit){ $this->db->limit($limit); } // if limit is set, we need to add limit (means how many products needs to display)
        $this->db->order_by('product_id', 'desc');
        return $this->db->get()->result_array();
    }

    /* Get all products, this function has limit, start and type that is used in pagination */
    public function get_all_products($limit, $start, $type){
        if($type==1){
            return $this->db->get('products')->num_rows();
        } else{
            $this->db->select('*')->from('products');
            if (isset($_GET['sort_price'])) {
                $sort = ($_GET['sort_price']==1)?'ASC':'DESC';
                $this->db->order_by('reg_price',$sort);
            }else{
                $this->db->order_by('product_id', 'desc');
            }
            
            $this->db->limit($limit, $start);
            return $this->db->get()->result_array() ;
        }
    }

    /* Get all sales products, this function has limit, start and type that is used in pagination */
    public function get_all_sale($limit, $start, $type){
        if($type==1){
            return $this->db->select('*')->from('products')->where('sale_price !=', 0)->get()->num_rows();
        } else{
            $this->db->select('*')->from('products')->where('sale_price !=', 0);
            $this->db->order_by('product_id', 'desc');
            $this->db->limit($limit, $start);
            return $this->db->get()->result_array() ;
        }
    }

    /* Get all featured products, this function has limit, start and type that is used in pagination */
    public function get_all_features($limit, $start, $type){
        if($type==1){
            return $this->db->select('*')->from('products')->where('is_featured', 1)->get()->num_rows();
        } else{
            $this->db->select('*')->from('products')->where('is_featured', 1);
            $this->db->order_by('product_id', 'desc');
            $this->db->limit($limit, $start);
            return $this->db->get()->result_array() ;
        }
    }

    /* Get all single product */
    public function get_single_product($product_id){
        $this->db->select('*')->from('products')->where('product_id', $product_id);
        return $this->db->get()->row_array();
    }

    /* Buy or purchased the product */
    public function purchase_orders($payment_type){
        if($this->session->userdata('user_id')){ // if user is logged in
            $my_items = $this->product_model->get_my_product();
        }else{ // if not logged in
            $my_items = (isset($_SESSION['cart']))?$_SESSION['cart']:[];
        }
        // Update product stocks/quantity
        $product_id =   array();
        $qty        =   array();
        foreach($my_items as $i){
            $this->update_stock($i['item_id'],$i['qty']);
            $product_id[]   =   $i['item_id'];
            $qty[]          =   $i['qty'];
        }

        // if user is logged in, insert orders to database
        if ($this->session->userdata('user_id')) {
            $user = $this->customer_model->get_single_customer($this->session->userdata('user_id'));
            
            $data = array(
                'customer_id'   => $this->session->userdata('user_id'),
                'product_id'    => json_encode($product_id),
                'quantity'      => 1,
                'payment_type'  => $payment_type,
                'order_status'  => 1,
                'sales_tax'     => $this->input->post('tax_rate'),
                'shipping_rate' => $this->input->post('ship_rate'),
                'total_paid'    => $this->input->post('total_amount'),
                'quantity'      => json_encode($qty),
                'shipping_rate' => $this->input->post('ship_rate'),
                'service_type'  => $this->input->post('service_code'),

            );
            if($this->input->post('billing-address') == 1){
                $data['billing_address'] = json_encode($this->session->userdata('receiver_details'));
            }else{
                $data['billing_address'] = json_encode(
                    array(
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
                )
            );
            }

            foreach($this->session->userdata('receiver_details') as $key => $val){
                if($key != 'email'){
                    $data['shipping_'.$key] = $val;
                }
            }
            $this->db->insert('orders', $data);
            $_SESSION['order_id']        = $this->db->insert_id();
            $_SESSION['customer_name']   = $user['firstname'].' '.$user['lastname'];
            $_SESSION['customer_email']  = $user['email'];
            // $this->register_user($this->session->userdata('role'), $this->session->userdata('user_id'));
        }else{ // if not logged in, insert orders as guest
            $user_id = ($this->input->post('password')) ? $this->register_user(2) : $this->register_user(3);
            $data = array(
                'customer_id'   => $user_id,
                'product_id'    => json_encode($product_id),
                'quantity'      => json_encode($qty),
                'payment_type'  => $payment_type,
                'order_status'  => 1,
                'sales_tax'     => $this->input->post('tax_rate'),
                'shipping_rate' => $this->input->post('ship_rate'),
                'total_paid'    => $this->input->post('total_amount'),
                'shipping_rate' => $this->input->post('ship_rate'),
                'service_type'  => $this->input->post('service_code')
            );
            if($this->input->post('billing-address') == 1){
                $data['billing_address'] = json_encode($this->session->userdata('receiver_details'));
            }else{
                $data['billing_address'] = json_encode(
                    array(
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
                )
            );
            }
            foreach($this->session->userdata('receiver_details') as $key => $val){
                if($key != 'email'){
                    $data['shipping_'.$key] = $val;
                }
            }
            $this->db->insert('orders', $data);
            $_SESSION['order_id']        = $this->db->insert_id();
            $_SESSION['customer_name']   = ucfirst($this->input->post('firstname')).' '.ucfirst($this->input->post('lastname'));
            $_SESSION['customer_email']  = $this->input->post('email');
        }
        // Send receipt to client via email
        $sent = $this->send_client_email();
        return $sent ? true : false;
    }

    // Update product stocks/quantity
    public function update_stock($pid,$qty){
        $this->db->set('quantity', 'quantity - '.$qty, FALSE);
        $this->db->where('product_id',$pid);
        $this->db->update('products');
        if ($this->db->trans_status() === TRUE){
            return true;
        }
        else
        {
            return false;
        }
    }

    // Send receipt to client via email
    public function send_client_email(){
        $data['is_page'] = 'Email Template';
        $body = $this->load->view('admin/email_template/order_email_template.php',$data,TRUE); // Separated template to view the codes easily
        $this->email->from('noreply@elisautosale.com', 'E-commerce Site');
        $this->email->to($_SESSION['customer_email']);
        $this->email->subject('Order Receipt');
        $this->email->message($body);
        if($this->email->send()){
            $this->session->unset_userdata('receiver_details');
            $this->session->unset_userdata('shipping_rates');
            $this->session->unset_userdata('tax_dtls');	
            $this->session->unset_userdata('shipping_details');
            if($this->session->userdata('new_customer_password')){
                $this->session->unset_userdata('new_customer_password');
            }
            return true;
        }else{
            echo $this->email->print_debugger();
            return false;
        }
    }

    // Register or update user
    public function register_user($role, $uid=''){
        $data = array(
            'firstname'    => $this->input->post('firstname'),
            'lastname'     => $this->input->post('lastname'),
            'address'      => $this->input->post('address'),
            'address_unit' => $this->input->post('address_unit'),
            'zip_code'     => $this->input->post('zip_code'),
            'city'         => $this->input->post('city'),
            'country'      => $this->input->post('country'),
            'state'        => $this->input->post('state'),
            'phone'        => $this->input->post('phone'),
            'email'        => $this->input->post('email'),
            'role'         => $role,
        );

        if($uid){ // If ID is declared, update user information
            $this->db->where('user_id', $uid);
            return $this->db->update('users', $data) ? true : false;
        }else{
            /* Check if this user is a guest and has purchased history on the site */
            $has_email = $this->check_email($this->input->post('email'));
            if($has_email){
                if($role==2){ $data['password'] = md5($this->input->post('password')); }
                $this->db->where('user_id', $has_email['user_id']);
                $res = $this->db->update('users', $data);
                // Set user data in session and logged in
                if($role==2){
                    $userdata = array(
                        'user_id' => $has_email['user_id'],
                        'role' 	  => 2
                    );
                    $this->session->set_userdata($userdata);
                }
                return $has_email['user_id'];
            }else{
                //if role is client, add the password
                if($role==2){ $data['password'] = md5($this->input->post('password')); }
                // Insert to users table
                $this->db->insert('users', $data);
                $uid = $this->db->insert_id();
                // Set user data in session and logged in
                if($role==2){
                    $userdata = array(
                        'user_id' => $uid,
                        'role' 	  => 2
                    );
                    $this->session->set_userdata($userdata);
                }
                return $uid;
            }
        }
    }

    /* Check if this user is a guest and has purchased history on the site */
    public function check_email($email){
        $this->db->where("email", $email);
        $this->db->where("role", 3);
        $res = $this->db->get("users")->row_array();
        return $res ? $res : false;
    }
    
    /* Get all countries from database */
    public function get_countries(){
		$this->db->select('*')->from('countries');
        return $this->db->get()->result_array();
    }
}
