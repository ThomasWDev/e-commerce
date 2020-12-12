<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    // Check if user exists and login
	public function check_user($email, $password, $role){
        $this->db->select('*')->from('users');
        $this->db->where("email", $email);
        $this->db->where("password", $password);
        $this->db->where("role", $role);
		$res = $this->db->get()->row_array();
        if($res){
            // Set user data in session and logged in
            $userdata = array(
                'user_id'   => $res['user_id'],
                'role' 		=> $res['role']
            );
            $this->session->set_userdata($userdata);
            return $res;
        }
        return false;
    }

    /* Check email if exist in database */
    public function check_email($email){
        $this->db->where("email", $email);
        $res = $this->db->get("users")->row_array();
        return $res ? true : false;
    }

    /* Register a new user */
    public function register_user(){
        /* Storing all POST data into 1 array */
        $data = array(
            'firstname'    => $this->input->post('firstname'),
            'lastname'     => $this->input->post('lastname'),
            'address'      => $this->input->post('address'),
            'address_unit' => $this->input->post('address_unit'),
            'zip_code'     => $this->input->post('zipcode'),
            'city'         => $this->input->post('city'),
            'country'      => $this->input->post('country'),
            'state'        => $this->input->post('state'),
            'phone'        => $this->input->post('phone'),
            'email'        => $this->input->post('email'),
            'password'     => md5($this->input->post('password')),
            'role'         => 2,
        );
        /* Check if this user is a guest and has purchased history on the site */
        $has_email = $this->frontpage_model->check_email($this->input->post('email'));
        if($has_email){
            $this->db->where('user_id', $has_email['user_id']);
            $res = $this->db->update('users', $data);
            // Set user data in session and logged in
            $userdata = array(
                'user_id' => $has_email['user_id'],
                'role' 	  => 2
            );
            $this->session->set_userdata($userdata);
            return true;
        }else{ /* If not guest, so register as a new user */
            $this->db->insert('users', $data);
            $uid = $this->db->insert_id();
            // Set user data in session and logged in
            $userdata = array(
                'user_id' => $uid,
                'role' 	  => 2
            );
            $this->session->set_userdata($userdata);
            return true;
        }
    }

    /* Save my cart into the database */
    public function save_my_cart($items){
        $data = array('user_id'=>$this->session->userdata('user_id'), 'item_id'=>$items['item_id'], 'qty' => $items['qty']);
        $this->db->select('*')->from('cart')->where($data);
        $res = $this->db->get()->row_array();
        // If the item doesn't exists, save the item to the cart.
        if(!$res){
            $this->db->insert('cart', $data);
        }
        return true;
    }

    /* Get user profile information */
    public function get_my_info(){
        $uid = $this->session->userdata('user_id');
        $this->db->select('*')->from('users')->where('user_id',$uid);
        return $this->db->get()->row_array();
    }

    /* Get admin profile information */
    public function get_admin_info(){
        $this->db->select('*')->from('users')->where('user_id',2);
        return $this->db->get()->row_array();
    }
}
