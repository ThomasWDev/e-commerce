<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    /* Get Payment Settings */
    public function get_payment_settings(){
        $this->db->where('ps_id',1);
        return $this->db->get('payment_settings')->row_array();
    }

    /* Saving Payment Settings */
    public function save_settings(){
        $action =   $this->input->post('action');
        if($action == 'payment_settings'){
            $data['paypal_sandbox']    = $this->input->post('paypal_sandbox');
            $data['paypal_email']      = $this->input->post('paypal_email');
            $data['paypal_client_id']  = $this->input->post('paypal_client_id');
        }
        if($action == 'sendgrid_settings'){
            $data['sendgrid_key']      = $this->input->post('sendgrid_key');
        }
        if($action == 'taxjar_settings'){
            $data['taxjar_key']        = $this->input->post('taxjar_key');
        }
        if($action == 'ups_settings'){
            $data['ups_mode']           = $this->input->post('ups_mode');
            $data['ups_access_key']     = $this->input->post('ups_access_key');
            $data['ups_shipper_number'] = $this->input->post('ups_shipper_number');
            $data['ups_user_id']        = $this->input->post('ups_user_id');
            $data['ups_password']       = $this->input->post('ups_password');
        }
        $this->db->where('ps_id',1);
        $res = $this->db->update('payment_settings',$data);
        return $res ? true : false;
    }

    /* Saving Payment Settings */
    public function save_rate_settings(){
        $data = array(
            'tax_rate'  => $this->input->post('tax_rate'),
            'ship_rate' => $this->input->post('ship_rate'),
        );
        $this->db->where('ps_id',1);
        $res = $this->db->update('payment_settings',$data);
        return $res ? true : false;
    }

    /* Check email if exist in database */
    public function checkEmail($email){
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return ($query->num_rows() > 0) ? true : false;
    }

    /* Get all countries from database */
    public function get_countries(){
		$this->db->select('*')->from('countries');
        return $this->db->get()->result_array();
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
}