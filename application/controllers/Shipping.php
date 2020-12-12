<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends CI_Controller {

    // public function trackShipping(){
    //     $this->load->library('UpsTrack');
    //     $this->upstrack->addField('trackNumber', '1Z940F710305563246');
    //     list($response, $status) = $this->upstrack->processTrack();
    // }

    public function shippingRate(){
        $fullname   =   $this->input->post('fullname');
        $address    =   $this->input->post('address');
        $city       =   $this->input->post('city');
        $state      =   $this->input->post('state');
        $zipcode    =   $this->input->post('zipcode');
        $country    =   $this->input->post('country');
        $this->load->library('UpsRating'); // Call the UpsRating library
        $this->upsrating->addField('ShipTo_Name', $fullname);
        $this->upsrating->addField('ShipTo_AddressLine', array($address));
        $this->upsrating->addField('ShipTo_City', $city);
        $this->upsrating->addField('ShipTo_StateProvinceCode', $state);
        $this->upsrating->addField('ShipTo_PostalCode', $zipcode);
        $this->upsrating->addField('ShipTo_CountryCode', $country);
        /* Package Dimension and Weight */
        // $cart = $this->cart->contents();
        $dimensions = array();
        $index = 0;
        if($this->session->userdata('user_id')){// if logged in, get its product from database
            $cart = $this->product_model->get_my_product();
        }else{ // if not logged in, get products on cart inside session
            $cart = (isset($_SESSION['cart']))?$_SESSION['cart']:[];
        }
        foreach( $cart as $rowid => $cart_data ) {
            $dimensions[$index]['Length']   = $cart_data['length'];
            $dimensions[$index]['Width']    = $cart_data['width'];
            $dimensions[$index]['Height']   = $cart_data['height'];
            $dimensions[$index]['Weight']   = $cart_data['weight'];
            $dimensions[$index]['Qty']      = $cart_data['qty'];
            $index++;
        }
        $this->upsrating->addField('dimensions', $dimensions);
        $ratings = $this->upsrating->processRate();
        list($response, $status) = $ratings;

        $response_dcd = json_decode($response);
        // var_dump($response_dcd->RateResponse);
        if(isset($response_dcd->RateResponse)){
            $rates = $response_dcd->RateResponse->RatedShipment;
            $rates_dtls = array();
            // foreach($rates as $rate){
            //     echo ">>>>>>".json_encode($rate);
            $rates_dtls[] = array('rates_amount' => $rates->RatedPackage->TotalCharges->MonetaryValue,'rates_code' => $rates->Service->Code);
            // }
            $shipping_rates['shipping_rates'] = $rates_dtls;
            $this->session->set_userdata($shipping_rates);
        }
        echo json_encode($ratings);
    }
}