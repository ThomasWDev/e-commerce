<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');
class UpsRating {
	private $CI;
	private $fields = array();
	public function __construct() {
        $this->CI =& get_instance();
    }
	public function addField($field, $value) {
		$this->fields[$field] = $value;
	}
	public function processRate() {

		try {
			$rateData = $this->getProcessRate();
			$rateData = json_encode( $rateData );
			$settings = $this->CI->db->get_where('payment_settings', array('ps_id' => 1))->row();
			$url = 'https://wwwcie.ups.com/ship/v1/rating/Rate';
			if($settings->ups_mode == 1){
				// FOR PRODUCTION
				$url = 'https://onlinetools.ups.com/ship/v1/rating/Rate';
			}
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $rateData);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json","AccessLicenseNumber:$settings->ups_access_key", "Username:$settings->ups_user_id", "Password:$settings->ups_password", "transId:trans123", "transactionSrc:Firefox" ));
			if ( !($res = curl_exec($ch)) ) {
				die(date('[Y-m-d H:i e] '). "Got " . curl_error($ch) . " when processing data");
				curl_close($ch);
				exit;
			}
			curl_close($ch);
			/* Curl End */
			
			if( is_string( $res ) ) {
				$resObject = json_decode( $res );
			}
			
			if( isset( $resObject->Fault ) && !empty( $resObject->Fault ) ) {
				return array( $res, 403 );
			} else if( isset( $resObject->RateResponse ) && !empty( $resObject->RateResponse ) ) {
				return array( $res, 200 );
			}else{
				return array( $res, 203 );
			}
		}
		catch(Exception $ex) {
			return array( $ex, 403 );
		}
	}
	private function getProcessRate() {
		// GET THE UPS CREADENTIALS
		$settings = $this->CI->db->get_where('payment_settings', array('ps_id' => 1))->row();
		
		$option['RequestOption'] = 'Shop';
		$request['RateRequest']['Request'] = $option;

		$pickuptype['Code'] = '01'; // 01 - Daily Pickup (Default - used when an invalid pickup type code is provided) , 03 - Customer Counter, 06 - One Time Pickup, 19 - Letter Center, 20 - Air Service Center
		$pickuptype['Description'] = 'Daily Pickup';
		$request['PickupType'] = $pickuptype;

		$customerclassification['Code'] = '01'; //  00 - Rates Associated with Shipper Number, 01 - Daily Rates, 04 - Retail Rates, 05 - Regional Rates, 06 - General List Rates, 53 - Standard List Rates
		$customerclassification['Description'] = 'Classfication';
		$request['CustomerClassification'] = $customerclassification;
		
		$row = $this->CI->db->get_where('users', array('user_id' => 2))->row();
		$shipper['Name'] = $row->firstname .' '.$row->lastname;
		$shipper['ShipperNumber'] = $settings->ups_shipper_number;
		$address['AddressLine'] = $row->address;
		$address['City'] = $row->city;
		$address['StateProvinceCode'] = $row->state;
		$address['PostalCode'] = $row->zip_code;
		$address['CountryCode'] = $row->country;
		$shipper['Address'] = $address;
		$shipment['Shipper'] = $shipper;

		$shipto['Name'] = $this->fields['ShipTo_Name'];
		$addressTo['AddressLine'] = $this->fields['ShipTo_AddressLine'];
		$addressTo['City'] = $this->fields['ShipTo_City'];
		$addressTo['StateProvinceCode'] = $this->fields['ShipTo_StateProvinceCode'];
		$addressTo['PostalCode'] = $this->fields['ShipTo_PostalCode'];
		$addressTo['CountryCode'] = $this->fields['ShipTo_CountryCode'];
		$shipto['Address'] = $addressTo;
		$shipment['ShipTo'] = $shipto;

		$service['Code'] = '03'; // 01 = Next Day Air 02 = 2nd Day Air 03 = Ground 12 = 3 Day Select 13 = Next Day Air Saver 14 = UPS Next Day Air Early 59 = 2nd Day Air A.M. Valid international values: 07 = Worldwide Express 08 = Worldwide Expedited 11= Standard 54 = Worldwide Express Plus 65 = Saver 96 = UPS Worldwide Express Freight 71 = UPS Worldwide Express Freight
		$service['Description'] = 'Service Code';
		$shipment['Service'] = $service;
		$package = array();
		$packaging['Code'] = '02'; // 00 = UNKNOWN 01 = UPS Letter 02 = Package 03 = Tube 04 = Pak 21 = Express Box 24 = 25KG Box 25 = 10KG Box 30 = Pallet 2a = Small Express Box 2b = Medium Express Box 2c = Large Express Box. For FRS rating requests the only valid value is customer supplied packaging “02”.
		$packaging['Description'] = 'Rate';
		$package['PackagingType'] = $packaging;
		$weight = 0;
		foreach( $this->fields['dimensions'] as $dimension ) {
			$weight = $weight + ($dimension['Weight']*$dimension['Qty']);
		}
		$punit['Code'] = 'LBS';
		$punit['Description'] = 'Pounds';
		$packageweight['Weight'] = "$weight";
		$packageweight['UnitOfMeasurement'] = $punit;
		$package['PackageWeight'] = $packageweight;

		$shipment['Package'] = array( $package );
		$request['RateRequest']['Shipment'] = $shipment;
		return $request;
	}
}