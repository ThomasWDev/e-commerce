<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    /* Get all products */
	public function get_all_products(){
        $this->db->select('*')->from('products');
        return $this->db->get()->result_array();
    }

    /* Get all orders where status is not equal to 3(Cancelled)*/
    public function get_all_orders(){
        $this->db->where('order_status !=', 3); 
        $this->db->select('*')->from('orders');
        return $this->db->get()->result_array();
    }

    /* Get all orders, with join the users */
    public function all_orders(){
        $this->db->select('*')->from('orders a');
        $this->db->join('users b','a.customer_id=b.user_id');
        return $this->db->get()->result_array();
    }
    
    /* Get all new orders, status 1 is a new order */
    public function all_new_orders(){
        $this->db->select('*')->from('orders a');
        $this->db->where('order_status', 1);
        $this->db->join('users b','a.customer_id=b.user_id');
        $this->db->order_by('a.order_id','DESC');
        return $this->db->get()->result_array();
    }

    /* Get single order */
    public function get_single_order($orderID){
        $this->db->select('*')->from('orders a');
        $this->db->where('a.order_id',$orderID);
        return $this->db->get()->row_array();
    }

    /* Get all cart items */
    public function get_all_cartItems(){
        $this->db->select('*')->from('cart');
        return $this->db->get()->result_array();
    }

    /* Get single product */
    public function get_single_product($product_id){
        $this->db->select('*')->from('products')->where('product_id', $product_id);
        return $this->db->get()->row_array();
    }

    /* Add or update product */
    public function add_update_product($product_primary_pic, $pid){
        // Check and loop categories
        if($this->input->post('cat_id')){
            foreach ($this->input->post('cat_id') as $k => $v) { $cat_id[] = $v; }
            $categories = json_encode($cat_id);
        } else{ $categories = ""; }

        // Mapping all data including the categories
        $data = array(
            'product_name'        => $this->input->post('product_name'),
            'description'         => $this->input->post('description'),
            'reg_price'           => $this->input->post('reg_price'),
            'sale_price'          => $this->input->post('sale_price'),
            'is_featured'         => $this->input->post('is_featured'),
            'product_sku'         => $this->input->post('product_sku'),
            'quantity'            => $this->input->post('quantity'),
            'product_primary_pic' => $product_primary_pic,
            'categories'          => $categories,
            'length'              => $this->input->post('length'),
            'width'               => $this->input->post('width'),
            'height'              => $this->input->post('height'),
            'weight'              => $this->input->post('weight')
        );
        
        if($pid){ // If has ID, then update the product
            $this->db->where('product_id', $pid);
            $res = $this->db->update('products', $data);
            return ($res) ? $pid : false;
        } else{ // if no ID, insert the product
            $this->db->insert('products', $data);
            $product_id = $this->db->insert_id();
            return ($product_id) ? $product_id : false;
        }
    }

    /* Search product with keywords and limits */
    public function search_keywords($limit, $start, $type, $keyword){
        $this->db->select('*')->from('products');
        $this->db->or_like(array('product_name' => $keyword));
        if (isset($_GET['sort_price'])) { // if has sort by price, include this query
            $sort = ($_GET['sort_price']==1)?'ASC':'DESC';
            $this->db->order_by('reg_price',$sort);
        }else{
            $this->db->order_by("date_added", "desc");
        }
        
        if($type == 1) { // if 1, then count only how many products
            return $this->db->get()->num_rows();
        }else{ // get all products data
            $this->db->limit($limit, $start);
            return $this->db->get()->result_array();
        }
    }

    /* Make the product featured/not featured */
    public function make_featured($product_id, $val){
        $data = array('is_featured' => $val);
        $this->db->set($data);
        $this->db->where('product_id', $product_id);
        $res = $this->db->update('products');
        return ($res) ? true : false;
    }

    /* Generate product image name */
    public function gen_product_image($old_prod_img){
        $target_path = './assets/back-office/images/products/';
        $tmp_file = $_FILES['prod_pri_img']["tmp_name"];
        $img_name = 'prod'.'_'.uniqid().".jpg"; 
        $res = move_uploaded_file($tmp_file, $target_path.$img_name);
        if($old_prod_img){
            if(file_exists($target_path.$old_prod_img)){
                unlink($target_path.$old_prod_img);
            }
        }
        return ($res) ? $img_name : false;
    }

    /* Add product images gallery */
    public function add_product_gallery($product_id){
        $target_path = './assets/back-office/images/products/';
        foreach($_FILES['product_gallery']["tmp_name"] as $v){
            $img_name = 'prod'.'_'.uniqid().".jpg"; 
            $res = move_uploaded_file($v, $target_path.$img_name);
            if($res){
                $data = array('product_id'=>$product_id, 'img_name'=>$img_name);
                $inserted = $this->db->insert('product_images', $data);
                return ($inserted) ? true : false;
            }return false;
        }
        
    }

    /* Check if SKU exists */
    public function checkSKU($product_sku){
        $this->db->where('product_sku', $product_sku);
        $query = $this->db->get('products');
        return ($query->num_rows() > 0) ? true : false;
    }

    /* Delete specific product */
    public function delete_product($product_id){
        // Delete product images gallery from the server
        $file_location = './assets/back-office/images/products/';
        $img = $this->get_product_images($product_id);
        foreach($img as $m){ extract($m); 
            $filename = $file_location.$img_name;
            if(file_exists($filename)){
                unlink($filename);
            }
            $this->db->where('img_id', $img_id);
            $this->db->delete('product_images');
        }

        // Delete primary image from the server
        $prod = $this->get_single_product($product_id);
        $img_file = $file_location.$prod['product_primary_pic'];
        if(file_exists($img_file)){
            unlink($img_file);
        }

        // Execute the delete query
        $this->db->where('product_id', $product_id);
        $res = $this->db->delete('products');
        return ($res) ? true : false;
    }

    /* Delete the product image from the server */
    public function del_prod_img($img_id, $img_name){
        $img_link = './assets/back-office/images/products/'.$img_name;
        $this->db->where('img_id', $img_id);
        $res = $this->db->delete('product_images');
        if(file_exists($img_link)){
            unlink($img_link);
        }
        return ($res) ? true : false;
    }

    /* Get producy images gallery */
    public function get_product_images($product_id){
		$this->db->select('img_id, img_name')->from('product_images');
        $this->db->where('product_id', $product_id);
        return $this->db->get()->result_array();
    }
    
    /* Get products according to the owner */
    public function get_my_product(){
        $uid = $this->session->userdata('user_id');
        $this->db->select('a.*, b.weight, b.length, b.width, b.height,b.product_sku, b.product_name AS `item_title`, b.product_primary_pic AS `item_image`, b.reg_price AS `item_price`, b.sale_price, b.quantity AS `qty_left`')->from('cart a');
        $this->db->join('products b', 'b.product_id = a.item_id', 'left');
        $this->db->where('a.user_id', $uid);
        $products = $this->db->get()->result_array();
        $data = array();
        foreach($products as $product){
            $price = $product['sale_price'] > 0 ? $product['sale_price'] : $product['item_price'];
            $data[] = array(
                'item_id'   =>  $product['item_id'],
                'item_image'=>  $product['item_image'],
                'item_title'=>  $product['item_title'],
                'item_price'=>  $price,
                'weight'    =>  $product['weight'],
                'length'    =>  $product['length'],
                'width'     =>  $product['width'],
                'height'    =>  $product['height'],
                'qty'       =>  $product['qty'],
                'cart_id'   =>  $product['cart_id'],
                'qty_left'  =>  $product['qty_left']
            );
        }
        return $data;
    }

    /* Get transation history */
    public function get_my_transactionsHistory($cid=null){
        $this->db->select('*')->from('orders a');
        if ($cid) {
            $this->db->where('a.customer_id', $cid);
        }else{
            $this->db->where('a.customer_id', $this->session->userdata('user_id'));
        }
        $this->db->order_by('order_id', 'DESC');
        return $this->db->get()->result_array();
    }

    /* Get user last order */
    public function get_my_last_order($order_id){
        $this->db->select('*')->from('orders a');
        $this->db->where('a.order_id', $order_id);
        $this->db->order_by('order_id', 'DESC');
        return $this->db->get()->row_array();
    }

    /* Get specific product */
    public function get_specific_product($pid){
        $uid = $this->session->userdata('user_id');
        $this->db->select('b.product_name AS `item_title`,b.sale_price, b.product_primary_pic AS `item_image`, b.reg_price AS `item_price`,b.product_id AS `item_id`, b.length, b.weight, b.width, b.height,b.quantity as qty_left')->from('products b');
        $this->db->where('b.product_id', $pid);
        $product = $this->db->get()->row_array();
        $price = $product['sale_price'] > 0 ? $product['sale_price'] : $product['item_price'];
        return array(
            'item_id'   =>  $product['item_id'],
            'item_image'=>  $product['item_image'],
            'item_title'=>  $product['item_title'],
            'item_price'=>  $price,
            'weight'    =>  $product['weight'],
            'length'    =>  $product['length'],
            'width'     =>  $product['width'],
            'height'    =>  $product['height'],
            'qty_left'  =>  $product['qty_left'],

        );
    }

    /* Insert cart items to database */
    public function insert_my_cart($items){
        $data = array('user_id'=>$this->session->userdata('user_id'), 'item_id'=>$items['product_id']);
        $this->db->select('cart.qty,cart.cart_id,products.quantity')->from('cart')->join('products', 'products.product_id = cart.item_id', 'left')->where($data);
        $res = $this->db->get()->row_array();
        if(!$res){
            $data['qty'] = 1;
            $this->db->insert('cart', $data);
        }else{
            if($res['qty'] != $res['quantity']){
                $type = $this->input->post('type');
                $this->updateQuantity($res['cart_id'],$type);
            }
            
            
        }
        return true;
    }

    public function updateQuantity($cartId, $type = 'add'){
        $this->db->where('cart_id', $cartId);
        if($type == 'add' || $type == 'single_add'){
            $this->db->set('qty', 'qty + 1', FALSE);
        }else{
            $this->db->set('qty', 'qty - 1', FALSE);
        }
        $this->db->update('cart');
        if ($this->db->trans_status() === TRUE){
            return true;
        }
        else
        {
            return false;
        }

    }

    /* Remove cart to databse or session */
    public function remove_to_cart($pid, $type){
        $uid = $this->session->userdata('user_id');
        if ($uid) { // if logged in, delete cart to database
            $this->db->where('user_id', $uid);
            if($type==1 || $type==3){
                $this->db->where('item_id', $pid);
            }
            return $this->db->delete('cart');
        }else{ // if not logged in, delete item from session cart
            $_SESSION['orders'] = $_SESSION['cart'];
            unset($_SESSION['cart']);
            return true;
        }
    }

    /* Update order status */
    public function updateOrderStatus(){
        if ($this->input->post()) {
            $status = $this->input->post('order_status');
            $orderId = $this->input->post('order_id');
            $setstatus = array('order_status' => $status);

            // Update Status
            $this->db->where('order_id', $orderId);
            $res = $this->db->update('orders', $setstatus);
            
            if($res){
                $products = $this->get_single_order($orderId);
                if($status == 3){
                    $qty = json_decode($products['quantity']);
                    foreach(json_decode($products['product_id']) as $key => $pid){
                        $update_qty = $this->update_stock($pid, $qty[$key]);
                    }
                    return $update_qty ? true : false;
                }
                return true;
            } return false;
        }
    }
    
   /* Update stock quantity */ 
    public function update_stock($pid, $qty){
        $this->db->set('quantity', 'quantity+'.$qty, FALSE); 
        $this->db->where('product_id', $pid);
        return $this->db->update('products') ? true : false;
    }

    /* Update tracking number graphic image*/
    public function updateOrderShippingDtls($order_id,$set = array()){
        $this->db->where('order_id', $order_id);
        $res = $this->db->update('orders', $set);
        return $res;
    }
}
