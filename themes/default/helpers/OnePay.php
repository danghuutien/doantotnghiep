<?php
namespace Sudo\Theme\helpers;
use DB;
use GuzzleHttp\Client;
use Sudo\Ecommerce\Models\Order;

class OnePay
{
	private $domain;
	private $vpcURL;
	
	private $vpc_Merchant;
	private $vpc_AccessCode;
	private $SECURE_SECRET;
	
	private $vpc_Merchant_TG;
	private $vpc_AccessCode_TG;
	private $SECURE_SECRET_TG;

    function __construct() {
        $this->domain = config('onepay')['ONEPAY_DOMAIN'] ?? '';
        $this->vpcURL = config('onepay')['ONEPAY_VPCURL'] ?? '';

        $this->vpc_Merchant = config('onepay')['ONEPAY_VPC_MERCHANT'] ?? '';
        $this->vpc_AccessCode = config('onepay')['ONEPAY_VPC_ACCESSCODE'] ?? '';
        $this->SECURE_SECRET = config('onepay')['ONEPAY_SECURE_SECRET'] ?? '';

        $this->vpc_Merchant_TG = config('onepay')['ONEPAY_VPC_MERCHANT_TG'] ?? '';
        $this->vpc_AccessCode_TG = config('onepay')['ONEPAY_VPC_ACCESSCODE_TG'] ?? '';
        $this->SECURE_SECRET_TG = config('onepay')['ONEPAY_SECURE_SECRET_TG'] ?? '';
    }

	function createOnePayLink($dataOnePay){	
		try{
			$dataOnePay['vpc_AccessCode'] = $this->vpc_AccessCode;
			$dataOnePay['vpc_Merchant'] = $this->vpc_Merchant;
	        ksort ($dataOnePay);
	        $i = 0;
	        $md5HashData = "";
	        $appendAmp = 0;
	        $vpcURL = $this->vpcURL;
	        $SECURE_SECRET = $this->SECURE_SECRET;
	        foreach($dataOnePay as $key => $value) {
	            // create the md5 input and URL leaving out any fields that have no value
	            if (strlen($value) > 0) {
	                
	                // this ensures the first paramter of the URL is preceded by the '?' char
	                if ($appendAmp == 0) {
	                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
	                    $appendAmp = 1;
	                } else {
	                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
	                }
	                //$md5HashData .= $value; sử dụng cả tên và giá trị tham số để mã hóa
	                if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
	                    $md5HashData .= $key . "=" . $value . "&";
	                }
	            }
	        }
	        //xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa
	        $md5HashData = rtrim($md5HashData, "&");
	        $vpcURL = rtrim($vpcURL, "&");
	        $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',$SECURE_SECRET)));
	        return $vpcURL;
		} catch (\Exception $e) {
			return [
                'status' => 0,
                'message' => 'Có lỗi xảy ra vui lòng thử lại!'
            ];
		}	
	}
	function createOnePayInstallmentLink($dataOnePay){
		try{
			$dataOnePay['vpc_AccessCode'] = $this->vpc_AccessCode_TG;
			$dataOnePay['vpc_Merchant'] = $this->vpc_Merchant_TG;
	        ksort ($dataOnePay);
	        $i = 0;
	        $md5HashData = "";
	        $appendAmp = 0;
	        $vpcURL = $this->vpcURL;
	        $SECURE_SECRET = $this->SECURE_SECRET_TG;
	        foreach($dataOnePay as $key => $value) {
	            // create the md5 input and URL leaving out any fields that have no value
	            if (strlen($value) > 0) {
	                
	                // this ensures the first paramter of the URL is preceded by the '?' char
	                if ($appendAmp == 0) {
	                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
	                    $appendAmp = 1;
	                } else {
	                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
	                }
	                //$md5HashData .= $value; sử dụng cả tên và giá trị tham số để mã hóa
	                if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
	                    $md5HashData .= $key . "=" . $value . "&";
	                }
	            }
	        }
	        //xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa
	        $md5HashData = rtrim($md5HashData, "&");
	        $vpcURL = rtrim($vpcURL, "&");
	        $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',$SECURE_SECRET)));
	        return $vpcURL;
		} catch (\Exception $e) {
			return [
                'status' => 0,
                'message' => 'Có lỗi xảy ra vui lòng thử lại!'
            ];
		}
	}
	function onePayResponse($requests){
		$SECURE_SECRET = $this->SECURE_SECRET;
		if(isset($requests['vpc_Merchant']) && $requests['vpc_Merchant'] == $this->vpc_Merchant_TG){
			$SECURE_SECRET = $this->SECURE_SECRET_TG;;
		}
		$data_response = $requests ?? [];
		$vpc_Txn_Secure_Hash = $data_response["vpc_SecureHash"] ?? '';
		$vpc_MerchTxnRef = $data_response["vpc_MerchTxnRef"] ?? '';
		$vpc_AcqResponseCode = $data_response["vpc_AcqResponseCode"] ?? '';
		$vpc_TxnResponseCode = $data_response["vpc_TxnResponseCode"] ?? '';
		unset($data_response["vpc_SecureHash"]);
		
        if (strlen($SECURE_SECRET) > 0 && $vpc_TxnResponseCode != "7" && $vpc_TxnResponseCode != "No Value Returned") {
		    ksort($data_response);
		    //$md5HashData = $SECURE_SECRET;
		    //khởi tạo chuỗi mã hóa rỗng
		    $md5HashData = "";
		    // sort all the incoming vpc response fields and leave out any with no value
		    foreach ($data_response as $key => $value) {
		//        if ($key != "vpc_SecureHash" or strlen($value) > 0) {
		//            $md5HashData .= $value;
		//        }
		//      chỉ lấy các tham số bắt đầu bằng "vpc_" hoặc "user_" và khác trống và không phải chuỗi hash code trả về
		        if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
				    $md5HashData .= $key . "=" . $value . "&";
				}
		    }
		//  Xóa dấu & thừa cuối chuỗi dữ liệu
		    $md5HashData = rtrim($md5HashData, "&");

		//    if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper ( md5 ( $md5HashData ) )) {
		//    Thay hàm tạo chuỗi mã hóa
			if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',$SECURE_SECRET)))) {
		        // Secure Hash validation succeeded, add a data field to be displayed
		        // later.
		        $hashValidated = "CORRECT";
		    } else {
		        // Secure Hash validation failed, add a data field to be displayed
		        // later.
		        $hashValidated = "INVALID HASH";
		    }
		} else {
		    // Secure Hash was not validated, add a data field to be displayed later.
		    $hashValidated = "INVALID HASH";
		}

		// check trạng thái thanh toán
		$transStatus = "";
		if($hashValidated=="CORRECT" && $vpc_TxnResponseCode=="0"){
			$payment_status = 1;
			$transStatus = "Giao dịch thành công";
		}elseif ($hashValidated=="INVALID HASH" && $vpc_TxnResponseCode=="0"){
			$payment_status = 0;
			$transStatus = "Giao dịch Pendding";
		}else {
			$payment_status = 0;
			$transStatus = "Giao dịch thất bại";
		}

		return [
			'status' => $hashValidated,
			'payment_status' => $payment_status,
			'order_code' => $data_response['vpc_OrderInfo'] ?? '',
			'vpc_MerchTxnRef' => $data_response['vpc_MerchTxnRef'] ?? '',
		];
	}	
	function checkPayment($input){
		$order = Order::where('code',$input['vpc_MerchTxnRef'])->first();
		if($order->payment_method == 2){
			$vpc_Merchant = $this->vpc_Merchant;
			$vpc_AccessCode = $this->vpc_AccessCode;
			$SECURE_SECRET = $this->SECURE_SECRET;
        } else if($order->payment_method == 3){
        	$vpc_Merchant = $this->vpc_Merchant_TG;
			$vpc_AccessCode = $this->vpc_AccessCode_TG;
			$SECURE_SECRET = $this->SECURE_SECRET_TG;
        }

		$vpc_MerchTxnRef = $input['vpc_MerchTxnRef'] ?? '';
		$i = 0;
        $md5HashData = "";
        
        $onepay = [
            'vpc_Command' => 'queryDR',
            'vpc_Version' => '2',
            'vpc_MerchTxnRef' => $vpc_MerchTxnRef,
            'vpc_Merchant' => $vpc_Merchant,
            'vpc_AccessCode' => $vpc_AccessCode,
            'vpc_User' => 'op01',
            'vpc_Password' => 'op123456'
        ];  
        ksort ($onepay);      
        
        $i = 0;
        foreach($onepay as $key => $value) {
            // create the md5 input and URL leaving out any fields that have no value
            $i++;
            if (strlen($value) > 0) {                            
                //$md5HashData .= $value; sử dụng cả tên và giá trị tham số để mã hóa
                if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {                    
                    if($i == count($onepay)){
                        $md5HashData .= $key . "=" . $value;
                    } else{
                        $md5HashData .= $key . "=" . $value . "&";
                    }
                }
            }
        }
        //xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa
        $md5HashData = strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',$SECURE_SECRET)));        
        $onepay['vpc_SecureHash'] = $md5HashData;
        
        $client = new Client();

        $response = $client->request('POST', 'https://'.$this->domain.'/msp/api/v1/vpc/invoices/queries', [
		    'form_params' => $onepay,
	    ]);
        $response_code = $response->getStatusCode();
       	
       	$result = $response->getBody()->getContents();
       	return $result;
	}
	function getFeeInstallment($param = ""){
        $data = array(
            "merchant_id" => $param["merchant_id"],
            "amount" => $param["amount"],
            "bank_code" => $param["bank_code"],
            "cycle" => $param["cycle"],
            "card_type" => $param["card_type"],
        );
        $data = json_encode($data);
        $crypto = new PayonEncrypt($this->_API_APP_SECRET_KEY);
        $data = $crypto->Encrypt($data);
        $checksum = md5($this->_APP_ID . $data . $this->_API_APP_SECRET_KEY);
        $bodyPost = array(
            'app_id' => $this->_APP_ID,
            'data' => $data,
            'checksum' => $checksum,
        );
        $result = $this->call($bodyPost, "getFeeInstallment");
        return $result;
    }
    function loadBank($request){
	    try{
	        $amount = $request->amount ?? '';
	    	if(is_array($request)){
	        	$signature = $request['signature'] ?? '';   
	        	$amount = $request['amount'] ?? '';
	        }
	    	if(!empty($amount)){
	    		$signature = $this->CreateRequestSignature($amount??0);	    	
		        
		        $client = new Client();

		        $response = $client->request('GET', 'https://'.$this->domain.'/msp/api/v1/merchants/'.$this->vpc_Merchant_TG.'/installments?amount='.$amount, [
		            'headers' => [
		                'Accept' => 'application/json',
		                'signature' => $signature
		            ],
		        ]);
		        
		        $result = $response->getBody()->getContents();  
	    	} else{
	    		$result = '';	
	    	}
	        
	        return $result;
	    } catch(\Exception $e){
	    	\Log::info('Lỗi loadbank '.$e->getMessage());

	    	return '';
	    }
    }
	function CreateRequestSignature($amount) {
		
		$keyId = $this->vpc_Merchant_TG;
		$merchan_key = $this->SECURE_SECRET_TG;
		$link = "/msp/api/v1/merchants/".$keyId."/installments?amount=".$amount;
		$signedHeaderNames = ["(request-target)", "(created)", "host", "accept"];

        $created = time();
        $lowercaseHeaders = [];
        $lowercaseHeaders["(request-target)"] = "get " . $link;
        $lowercaseHeaders["(created)"] = $created;
        $lowercaseHeaders["host"] = $this->domain;
        $lowercaseHeaders["accept"] = 'application/json';
        $signingString = "";
        $headerNames = "";
        for ($i = 0; $i < count($signedHeaderNames); $i++) {
            $headerName = $signedHeaderNames[$i];
            if ($signingString !== "") $signingString .= "\n";
            $signingString .= $headerName .": " . $lowercaseHeaders[$headerName];
            if ($headerNames !== "") $headerNames .= " ";
            $headerNames .= $headerName;
        }
        $signature = base64_encode(hash_hmac('SHA512', $signingString, pack('H*',$merchan_key), true));
        $signingAlgorithm = "hs2019";
        return "algorithm=\"" .$signingAlgorithm ."\"" .
            ", keyId=\"" .$keyId ."\"" .
            ", headers=\"" .$headerNames ."\"" .
            ", created=" .$created .
            ", signature=\"" .$signature ."\"";
	}
}
