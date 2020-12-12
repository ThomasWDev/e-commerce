<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	/* Add new product view */
	public function add_product(){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] = 'add_product';
			$data['prod']     = "";
			$data['get_nested_categories'] = $this->catalog_model->get_nested_categories();
			$this->load->view('admin/products/add_edit_product', $data);
		}else{
			redirect(base_url());
		}
	}

	/* Edit product view */
	public function edit_product($product_id){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$data['is_page'] = 'edit_product';
			$data['get_nested_categories'] = $this->catalog_model->get_nested_categories();
			$data['prod']    			   = $this->product_model->get_single_product($product_id);
			$this->load->view('admin/products/add_edit_product', $data);
		}else{
			redirect(base_url());
		}
	}

	/* Add and update product */
	public function add_update_product($pid){
		if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			if($this->input->post()){
				/* Generate Product Image */
				$old_prod_img = $this->input->post('old_prod_img');
				$product_primary_pic = ($_FILES["prod_pri_img"]["tmp_name"]) ? $this->product_model->gen_product_image($old_prod_img) : (($old_prod_img) ? $old_prod_img : '');
				/* Insert Product Data */
				$product_id = $this->product_model->add_update_product($product_primary_pic, $pid);
				if($product_id) {
					/* Insert Product Gallery */
					if($_FILES["product_gallery"]){
						$gallery_res = $this->product_model->add_product_gallery($product_id);
					}
					$msg = ($pid) ? 'The Product was updated successfully' : 'New Product Inserted successfully';
					$this->session->set_flashdata('success', $msg);
					redirect('admin/products');
				} else{
					$this->session->set_flashdata('error', 'A problem occured. Please try again');
					redirect('product/add_product');
				}
			} else{
				$this->session->set_flashdata('error', 'A problem occured. Please try again');
				redirect('product/add_product');
			}
		}else{
			redirect(base_url());
		}
	}

	/* Deleting a specific product */
	public function delete_product($product_id){
        if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
            $res =$this->product_model->delete_product($product_id); 
            if($res){
                $this->session->set_flashdata('success', 'The product was deleted successfully');
                redirect('admin/products');
            }else{
                $this->session->set_flashdata('error', 'A problem occured. Please try again.');
                redirect('admin/products');
            }
        } else{
            redirect(base_url());
        }
	}
	
	/* Delete product images using ajax*/
	public function del_prod_img($img_id){
        if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
			$img_name = $this->input->post('img_name');
            $res = $this->product_model->del_prod_img($img_id, $img_name); 
            echo ($res) ? 1 : 0;
        } else{
            echo 0;
        }
	}

	/* Make product featured using ajax */
	public function make_featured($product_id, $val){
        if($this->session->userdata('user_id') && $this->session->userdata('role')==1){
            $res =$this->product_model->make_featured($product_id, $val); 
            echo ($res) ? 1 : 0;
        } else{
            echo 0;
        }
	}
	
	/* Check SKU if unique using ajax */
	public function checkSKU(){
        if($this->input->post()){
            $product_sku = $this->input->post('product_sku');
            $res = $this->product_model->checkSKU($product_sku);
            echo ($res) ? 1 : 0;
        }
    }
}
