<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog_model extends CI_Model {

    /* >>>>>>>> Categories Functions <<<<<<<<< */
    /* Get all Categories */
	public function get_all_categories(){
        $this->db->select('*')->from('categories');
        return $this->db->get()->result_array();
    }

    /* Get all nested caregories from parent to each child */
    public function get_nested_categories(){
        $this->db->select('*')->from('categories')->where('parent_cat_id', 0);
        $parent = $this->db->get();
        
        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){
            $categories[$i]->sub = $this->sub_categories($p_cat->cat_id);
            $i++;
        }
        return $categories;
    }

    /* Get all Sub Categories */
    public function sub_categories($id){
        $this->db->select('*')->from('categories')->where('parent_cat_id', $id);
        $child = $this->db->get();

        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){
            $categories[$i]->sub = $this->sub_categories($p_cat->cat_id);
            $i++;
        }
        return $categories;       
    }

    /* Check if the product has categories exists. This code is called in the view page. */
    function fetch_menu($data, $ctg_list){
        foreach($data as $cat){
            $selected = ($ctg_list) ? ((in_array($cat->cat_id, $ctg_list)) ? 'checked' : '') : '';
            echo '<div class="checkbox">'.
                '<input id="cat'.$cat->cat_id.'" type="checkbox" name="cat_id[]" value="'.$cat->cat_id.'" '.$selected.'>'.
                '<label for="cat'.$cat->cat_id.'">'.
                    $cat->cat_name.
                '</label>'.
            '</div>';
            if(!empty($cat->sub)){
                $this->fetch_sub_menu($cat->sub, 20, $ctg_list);
            }
        }
    }
    
    /* Check if the product has sub categories exists. This code is called in the view page. */
    function fetch_sub_menu($sub_menu, $marg, $ctg_list){
        foreach($sub_menu as $cat){
            $selected = ($ctg_list) ? ((in_array($cat->cat_id, $ctg_list)) ? 'checked' : '') : '';
            echo '<div class="checkbox" style="margin-left:'.$marg.'px;">'.
                '<input id="cat'.$cat->cat_id.'" type="checkbox" name="cat_id[]" value="'.$cat->cat_id.'" '.$selected.'>'.
                '<label for="cat'.$cat->cat_id.'">'.
                    $cat->cat_name.
                '</label>'.
            '</div>';
            if(!empty($cat->sub)){
                $this->fetch_sub_menu($cat->sub, ($marg+20), $ctg_list);
            }        
        }
    }

    /* Get specific category */
    public function view_single_category($cat_id){
        $this->db->select('*')->from('categories')->where('cat_id', $cat_id);
        return $this->db->get()->row_array();
    }

    /* Add or update category */
    public function add_update_category($imgName, $cat_id){
        $data = array(
            'cat_name'      => $this->input->post('cat_name'),
            'cat_desc'      => $this->input->post('cat_desc'),
            'cat_img'       => $imgName,
            'parent_cat_id' => $this->input->post('parent_cat_id')
        );
        // If no category ID declared, add the product
        if(!$cat_id){
            return ($this->db->insert('categories', $data)) ? true : false;
        } else{ // else update the category base on the category ID declared
            $this->db->where('cat_id', $cat_id);
            return ($this->db->update('categories', $data)) ? true : false;
        }
    }

    /* Deleting a category */
    public function delete_category($cat_id){
        // Get category image
        $cat = $this->view_single_category($cat_id);
        $filename = './assets/back-office/images/categories/'.$cat['cat_img'];
        // If category image exists, we must delete the image on our server
        if(file_exists($filename)){
            unlink($filename);
        }

        // Now we can delete the category base on its ID
        $this->db->where('cat_id', $cat_id);
        return ($this->db->delete('categories')) ? true : false;
    }

    /* >>>>>>>> Attributes Functions <<<<<<<<< */
    /* Get all attributes */
    public function get_all_attributes($type){ //1 No parent, 2 Has parent
        $this->db->select('*')->from('attributes');
        if($type==1){
            $this->db->where('parent_attr_id', 0);
        }
        return $this->db->get()->result_array();
    }

    /* Get single attributes */
    public function view_single_attribute($attr_id){
        $this->db->select('*')->from('attributes')->where('attr_id', $attr_id);
        return $this->db->get()->row_array();
    }
    
    /* Add or update attributes */
    public function add_update_attribute($attr_id){
        $data = array(
            'attr_name'      => $this->input->post('attr_name'),
            'attr_desc'      => $this->input->post('attr_desc')
        );
        if(!$attr_id){ // If no attributes ID declared, add the product
            return ($this->db->insert('attributes', $data)) ? true : false;
        } else{ // else update the attributes base on the attributes ID declared
            $this->db->where('attr_id', $attr_id);
            return ($this->db->update('attributes', $data)) ? true : false;
        }
    }

    /* Deleting a category */
    public function delete_attribute($attr_id){
        $this->db->where('attr_id', $attr_id);
        $this->db->delete('attributes');

        $this->db->where('parent_attr_id', $attr_id);
        return ($this->db->delete('attributes')) ? true : false;
    }

    /* Getting the parent items  */
    public function get_parent_items($attr_id){ 
        $this->db->select('*')->from('attributes')->where('parent_attr_id', $attr_id);
        return $this->db->get()->result_array();
    }

    /* Add or update attribute items */
    public function add_update_attr_items($parent_attr_id){
        $data = array(
            'attr_name'      => $this->input->post('attr_name'),
            'parent_attr_id' => $this->input->post('parent_attr_id')
        );
        if(!$parent_attr_id){ //If no attribute items ID declared, add the product
            return ($this->db->insert('attributes', $data)) ? true : false;
        } else{ // else update the attribute items base on the attribute items ID declared
            $this->db->where('attr_id', $parent_attr_id);
            return ($this->db->update('attributes', $data)) ? true : false;
        }
    }
}
