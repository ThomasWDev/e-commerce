<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends CI_Controller {

    /* Categories Functions */
    /* Categories view */
	public function view_categories(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
            $data['is_page'] = 'categories';
            $data['get_all_categories'] = $this->catalog_model->get_all_categories();
			$this->load->view('admin/catalogs/categories/view_categories', $data);
		}else{
			redirect(base_url());
		}
    }
    
    /* Add or update category base on its ID */
    public function add_update_category($cat_id){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			if($this->input->post()){
                // Checking and inserting image
                if($this->input->post('img_data')){
                    $target_path = './assets/back-office/images/categories/';
                    $imgName     = 'p'.'_'.uniqid().".jpg"; 
                    $data        = explode(',', $this->input->post('img_data'));
                    $decoded     = base64_decode($data[1]);
                    $status      = file_put_contents($target_path.$imgName,$decoded); 
                } else{
                    $old_img = $this->input->post('old_img');
                    $imgName = ($old_img) ? $old_img : "";
                    $status  = true;
                }
                
                if($status){
                    $res = $this->catalog_model->add_update_category($imgName, $cat_id);
                    if($res){
                        $succ_msg = (!$cat_id) ? 'New category was successfully added.' : 'Category was successfully updated.';
                        $this->session->set_flashdata('success', $succ_msg);
                        redirect('catalog/view_categories');
                    } else{
                        $this->session->set_flashdata('error', 'A problem occured. Please try again.');
                        redirect('catalog/view_categories');
                    }
                }else{
                    $this->session->set_flashdata('error', 'A problem occured. Please try again.');
                    redirect('catalog/view_categories');
                }    
            } else{
                $this->session->set_flashdata('error', 'A problem occured. Please try again.');
                redirect('catalog/view_categories');
            }
		}else{
			redirect(base_url());
		}
    }

    /* Deleting a category */
    public function delete_category($cat_id){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
            $res = $this->catalog_model->delete_category($cat_id);
            if($res){
                $this->session->set_flashdata('success', 'Category deleted successfully.');
            }else{
                $this->session->set_flashdata('error', 'A problem occured. Please try again.');
            }
            redirect('catalog/view_categories');
		}else{
			$this->session->set_flashdata('error', 'A problem occured. Please try again.');
            redirect(base_url());
		}
    }

    /* Viewing single category */
    public function view_single_category($cat_id){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
            $data = $this->catalog_model->view_single_category($cat_id);
			echo ($data) ? json_encode($data) : 0;
		}else{
			echo 0;
		}
    }
    
    /* Attributes Functions */
    /* Attributes view */
    public function view_attributes(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
            $data['is_page'] = 'attributes';
            $data['get_all_attributes'] = $this->catalog_model->get_all_attributes(1);
			$this->load->view('admin/catalogs/attributes/view_attributes', $data);
		}else{
			redirect(base_url());
		}
    }
    
    /* Add or udpate attributes */
    public function add_update_attribute($attr_id){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			if($this->input->post()){
                $res = $this->catalog_model->add_update_attribute($attr_id);
                if($res){
                    $succ_msg = (!$attr_id) ? 'New attribute was successfully added.' : 'Attribute was successfully updated.';
                    $this->session->set_flashdata('success', $succ_msg);
                    redirect('catalog/view_attributes');
                } else{
                    $this->session->set_flashdata('error', 'A problem occured. Please try again.');
                    redirect('catalog/view_attributes');
                }   
            } else{
                $this->session->set_flashdata('error', 'A problem occured. Please try again.');
                redirect('catalog/view_attributes');
            }
		}else{
			redirect(base_url());
		}
    }
    
    /* View single attribute */
    public function view_single_attribute($attr_id){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
            $data = $this->catalog_model->view_single_attribute($attr_id);
			echo ($data) ? json_encode($data) : 0;
		}else{
			echo 0;
		}
    }

    /* Delete attribute and its sub attrbutes */
    public function delete_attribute($attr_id, $parent_attr_id){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
            $res = $this->catalog_model->delete_attribute($attr_id);
            if($res){
                $this->session->set_flashdata('success', 'Attribute deleted successfully.');
            }else{
                $this->session->set_flashdata('error', 'A problem occured. Please try again.');
            }
            if($parent_attr_id){
                redirect('catalog/view_attribute_items/'.$parent_attr_id);
            } else{
                redirect('catalog/view_attributes');
            }
            
		}else{
			$this->session->set_flashdata('error', 'A problem occured. Please try again.');
            redirect(base_url());
		}
    }

    /* Configure Attributes Items */
    /* Attribute items view */
    public function view_attribute_items($attr_id){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
            $data['is_page']            = 'attribute_items';
            $data['attr']               = $this->catalog_model->view_single_attribute($attr_id);
            $data['get_parent_items']   = $this->catalog_model->get_parent_items($attr_id);
			$this->load->view('admin/catalogs/attributes/view_attr_items', $data);
		}else{
			redirect(base_url());
		}
    }

    /* Add and update attribute items */
    public function add_update_attr_items($attr_id){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			if($this->input->post()){
                $parent_attr_id = $this->input->post('parent_attr_id');
                $res = $this->catalog_model->add_update_attr_items($attr_id);
                if($res){
                    $succ_msg = (!$attr_id) ? 'New attribute item was successfully added.' : 'Attribute item was successfully updated.';
                    $this->session->set_flashdata('success', $succ_msg);
                    redirect('catalog/view_attribute_items/'.$parent_attr_id);
                } else{
                    $this->session->set_flashdata('error', 'A problem occured. Please try again.');
                    redirect('catalog/view_attribute_items/'.$parent_attr_id);
                }   
            } else{
                $this->session->set_flashdata('error', 'A problem occured. Please try again.');
                redirect('catalog/view_attribute_items/'.$parent_attr_id);
            }
		}else{
			redirect(base_url());
		}
    }
}
