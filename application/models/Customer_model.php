<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

    /* Getting all customers */
    public function get_all_customers($role=null){
        $this->db->query("SET sql_mode = ''");
        $this->db->select('*')->from('users');
        if ($role) {
        	$this->db->where('role !=',$role);
        }
        $this->db->group_by('email');
        return $this->db->get()->result_array();
    }

    /* Get specific customer */
    public function get_single_customer($cid){
        $this->db->select('*')->from('users')->where('user_id', $cid);
        return $this->db->get()->row_array();
    }

    /* Get customer ID base on email given */
    public function get_customer_id($email){
        $this->db->select('*')->from('users')->where('email', $email);
        return $this->db->get()->row_array();
    }

    // Uploading image to the server. This function is reusable
    public function upload_image($uid){
        // Check if has POST request name "img_data"
        if($this->input->post('img_data')){
            // Creating a directory
            $tp = 'assets/back-office/images/customer/c'.$uid."/";
            if (!is_dir($tp)) {
                mkdir($tp);
                $target_path = $tp;
            } else{
                $target_path = $tp;
            }

            $imgName = 'p'.'_'.uniqid().".png"; // Create Image name
            $data    = explode(',', $this->input->post('img_data')); // Explode post data and get the 2nd array to convert the file to image
            $decoded = base64_decode($data[1]); // convert the image using base64_decode
            $status  = file_put_contents($target_path.$imgName,$decoded); // place the file and put it on the directory we have created.
            // If the user has existing image, we need to remove it from our server
            if($this->input->post('img_name')){
                if(file_exists($target_path.$this->input->post('img_name'))){
                    unlink($target_path.$this->input->post('img_name'));
                }
            }
        } else{
            // if no POST request name "img_data", just get the image name only
            $imgName = $this->input->post('img_name');
        }

        return $imgName;
    }

    // Saving customer profile information
    public function save_profile(){
        $uid        = $this->session->userdata('user_id');
        $password   = $this->input->post('password');
        $cpassword  = $this->input->post('cpassword');
        $email      = $this->input->post('email');
        $image      = $this->upload_image($uid);

        // If has password, then check the password if equal.
        if($password){
            if($password==$cpassword) {
                $data['password'] = md5($password); // Then add the password to the $data variable
            }else{
                return false;
            }
        }else{ // update data with no password
            $data = array(
                'firstname'     => ucwords(strtolower($this->input->post('firstname'))),
                'lastname'      => ucwords(strtolower($this->input->post('lastname'))),
                'address'       => ucwords(strtolower($this->input->post('address'))),
                'address_unit'  => ucwords(strtolower($this->input->post('address_unit'))),
                'city'          => $this->input->post('city'),
                'state'         => $this->input->post('state'),
                'country'       => $this->input->post('country'),
                'phone'         => $this->input->post('phone'),
                'zip_code'      => $this->input->post('zipcode'),
                'email'         => $email,
                'user_img'      => $image
            );
        }
        $this->db->where('user_id',$uid);
        return ($this->db->update('users',$data))?true:false;
        
    }
}