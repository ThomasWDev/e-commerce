<?php
/**
 * @Dev Thomas William Woodfin
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');
class UpsShipping {
	private $CI;
	private $fields = array();
	public function __construct() {
        $this->CI =& get_instance();
    }
	public function addField($field, $value) {
		$this->fields[$field] = $value;
	}
	public function processShipAccept() {
		try {
			$shipmentData = $this->getProcessShipAccept();
			$shipmentData = json_encode( $shipmentData );
			// FOR TESTING URL
			$url = 'https://wwwcie.ups.com/ship/v1/shipments';
			$settings = $this->CI->db->get_where('payment_settings', array('ps_id' => 1))->row();
			if($settings->ups_mode == 1){
				// FOR PRODUCTION
				$url = 'https://onlinetools.ups.com/ship/v1/shipments';
			}
			/* Curl start to call UPS shipping API */
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $shipmentData);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json","AccessLicenseNumber:$settings->ups_access_key", "Username:$settings->ups_user_id", "Password:$settings->ups_password", "transId:trans123", "transactionSrc:Firefox", "Accept:application/json" ));
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
			} else if( isset( $resObject->ShipmentResponse ) && !empty( $resObject->ShipmentResponse ) ) {
				return array( $res, 200 );
			}else{
				return array( $res, 203 );
			}
		}
		catch(Exception $ex) {
			return array( $ex, 403 );
		}
	}
	public function getProcessShipAccept() {
		// GET THE UPS CREADENTIALS
		$settings = $this->CI->db->get_where('payment_settings', array('ps_id' => 1))->row();
		/* Important */
		$requestoption['RequestOption'] = 'nonvalidate';
		$request['ShipmentRequest']['Request'] = $requestoption;

		/* SHIPPER DETAILS*/
		$row = $this->CI->db->get_where('users', array('user_id' => 2))->row();
		$shipment['Description'] = '';
		$shipper['Name'] = $row->firstname .' '.$row->lastname;
		$shipper['AttentionName'] = '';
		$shipper['ShipperNumber'] = $settings->ups_shipper_number;
		$address['AddressLine'] = $row->address;
		$address['City'] = $row->city;
		$address['StateProvinceCode'] = $row->state;
		$address['PostalCode'] = $row->zip_code;
		$address['CountryCode'] = $row->country;
		$shipper['Address'] = $address;
		$phone['Number'] = $row->phone;
		$shipper['Phone'] = $phone;
		$shipment['Shipper'] = $shipper;

		/* Important */
		/* Shipping to Customer Address */		
		$shipto['Name'] = $this->fields['ShipTo_Name'];
		$shipto['AttentionName'] = $this->fields['ShipTo_Name'];
		$addressTo['AddressLine'] = $this->fields['ShipTo_AddressLine'];
		$addressTo['City'] = $this->fields['ShipTo_City'];
		$addressTo['StateProvinceCode'] = $this->fields['ShipTo_StateProvinceCode'];
		$addressTo['PostalCode'] = $this->fields['ShipTo_PostalCode'];
		$addressTo['CountryCode'] = $this->fields['ShipTo_CountryCode'];
		$shipto['Address'] = $addressTo;
		$phone2['Number'] = $this->fields['ShipTo_Number'];
		$shipto['Phone'] = $phone2;
		$shipment['ShipTo'] = $shipto;

		/* CREDIT CARD DETAILS*/
		$shipmentcharge['Type'] = '01'; // 01 = American Express 03 = Discover 04 = MasterCard 05 = Optima 06 = VISA 07 = Bravo 08 = Diners Club 13=Dankort 14=Hipercard 15=JCB 17=Postepay 18=UnionPay/ExpressPay 19=Visa Electron 20=VPAY 21=Carte Bleue Type
		$creditcard['Type'] = '06';
		$creditcard['Number'] = $this->CI->config->item('ups')['cc']['CC_Number'];
		$creditcard['SecurityCode'] = $this->CI->config->item('ups')['cc']['CC_SecurityCode'];
		$creditcard['ExpirationDate'] = $this->CI->config->item('ups')['cc']['CC_ExpirationDate'];
		$creditCardAddress['AddressLine'] = $this->CI->config->item('ups')['cc']['CC_AddressLine'];
		$creditCardAddress['City'] = $this->CI->config->item('ups')['cc']['CC_City'];
		$creditCardAddress['StateProvinceCode'] = $this->CI->config->item('ups')['cc']['CC_StateProvinceCode'];
		$creditCardAddress['PostalCode'] = $this->CI->config->item('ups')['cc']['CC_PostalCode'];
		$creditCardAddress['CountryCode'] = $this->CI->config->item('ups')['cc']['CC_CountryCode'];
		$creditcard['Address'] = $creditCardAddress;
		$billshipper['CreditCard'] = $creditcard;
		$shipmentcharge['BillShipper'] = $billshipper;
		$paymentinformation['ShipmentCharge'] = $shipmentcharge;
		$shipment['PaymentInformation'] = $paymentinformation;

		/* Important */
		$service['Code'] = $this->fields['Service_Code']; // GET THE METHOD FROM THE CUSTOMER ORDER
		// $service['Description'] = 'Expedited';
		$shipment['Service'] = $service;

		/* Important */
		$packaging['Code'] = '02'; // 01 = UPS Letter 02 = Customer Supplied Package03 = Tube 04 = PAK21 = UPS Express Box24 = UPS 25KG Box25 = UPS 10KG Box30 = Pallet2a = Small Express Box2b = Medium Express Box 2c = Large Express Box 56 = Flats57 = Parcels 58 = BPM59 = First Class 60 = Priority61 = Machineables 62 = Irregulars63 = Parcel Post64 = BPM Parcel65 = Media Mail66 = BPM Flat67 = Standard Flat.
		$package['Packaging'] = $packaging;

		/* Important */
		$package_array = array();
		$weight = 0;
		foreach( $this->fields['dimensions'] as $dimension ) {
			$weight = $weight + $dimension['Weight']*$dimension['Qty'];
		}
		$punit['Code'] = 'LBS';
		$punit['Description'] = 'Pounds';
		$packageweight['Weight'] = "$weight";
		$packageweight['UnitOfMeasurement'] = $punit;
		$package['PackageWeight'] = $packageweight;

		$shipment['Package'] = array( $package );
		
		/* Important */
		$labelimageformat['Code'] = 'GIF';
		$labelimageformat['Description'] = 'GIF';
		$labelspecification['LabelImageFormat'] = $labelimageformat;
		$labelspecification['HTTPUserAgent'] = 'Mozilla/4.5';
		$shipment['LabelSpecification'] = $labelspecification;
		$request['ShipmentRequest']['Shipment'] = $shipment;
		return $request;
	}
}