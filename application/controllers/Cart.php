<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    /* Add product to cart */
	public function add_to_cart(){
        // Store product into $data variable
        $pid  = $this->input->post('pid');
        $prod = $this->product_model->get_single_product($pid);
        $cart = array();
        $price = $prod['sale_price'] > 0 ? $prod['sale_price'] : $prod['reg_price'];
		$data[$prod['product_id']] = array(
			'item_id'    => $prod['product_id'],
			'item_image' => $prod['product_primary_pic'],
			'item_title' => $prod['product_name'],
            'item_price' => $price,
            'qty'        => 1,
            'weight'     => $prod['weight'],
            'length'     => $prod['length'],
            'width'      => $prod['width'],
            'height'     => $prod['height'],
            'qty_left'   => $prod['quantity']    
        );
        
        if($this->session->userdata('user_id')){ // If user is logged in, save cart into database
            $res = $this->product_model->insert_my_cart($prod);
            if($res){
                $my_items = $this->product_model->get_my_product();
                echo $my_items?json_encode($my_items):0;
            }else{echo 0;}
        }else{ // if not logged in, save cart in a session
            $my_items = (isset($_SESSION['cart']))?$_SESSION['cart']:[];
            if($my_items){
                if (array_search($pid, array_column($my_items, 'item_id')) !== FALSE){
                    if($this->input->post('type') == 'add' || $this->input->post('type') == 'single_add'){
                        if( $_SESSION['cart'][$prod['product_id']]['qty'] != $_SESSION['cart'][$prod['product_id']]['qty_left']){
                            $_SESSION['cart'][$prod['product_id']]['qty'] += 1;
                        }
                    }
                    else{
                        $_SESSION['cart'][$prod['product_id']]['qty'] -= 1;
                    }
                     
                }
                else{
                    $_SESSION['cart'] = $my_items + $data;
                    // echo "Not Exists";
                }

                // $_SESSION['cart'] = $my_items + $data;
            }else{
                $_SESSION['cart'] = $my_items + $data;
            }
            echo $_SESSION['cart']?json_encode($_SESSION['cart']):0;
        }
    }
    
    // Removing cart items
    public function remove_to_cart(){
        if($this->session->userdata('user_id')){ // if logged in, remove cart item from database
            $this->product_model->remove_to_cart($this->input->post('pid'), 1);
            $my_items = $this->product_model->get_my_product();
            echo $my_items?json_encode($my_items):0;
        }else{ //if not logged in, remove cart item from session
            unset($_SESSION['cart'][$this->input->post('pid')]);
            echo $_SESSION['cart']?json_encode($_SESSION['cart']):0;
        }
    }

    /* Empty cart items */
    public function clear_cart(){
        if($this->session->userdata('user_id')){ // if logged in, empty cart items in database
            $this->product_model->remove_to_cart($this->input->post('pid'), 2);
        }else{ // if not logged in, empty cart items in session
            unset($_SESSION['cart']);
        }
        echo 1;
    }

    /* Start buying/purchasing the items */
    public function purchase_orders($payment_type){
        $res = $this->frontpage_model->purchase_orders($payment_type);
        if($res){
            $this->product_model->remove_to_cart(0, 2);
        }
        echo $res ? 1 : 0;
    }
}
