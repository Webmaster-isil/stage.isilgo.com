<?php

class RadarNiubizFunction {

    private $baseUrlSandbox = "https://apisandbox.vnforappstest.com/";
    private $baseUrlDev = "https://apitestenv.vnforapps.com/";
    private $baseUrlProd = "https://apiprod.vnforapps.com/";

    private $endPointSecurity = "api.security/v1/security";
    private $endPointSession = "api.ecommerce/v2/ecommerce/token/session/";
    private $endPointAuthorization = "api.authorization/v3/authorization/ecommerce/";
    private $endPointConfirmation = "api.confirmation/v1/confirmation/ecommerce/";
    private $endPointRefund = "api.refund/v1/refund/";

	private $endPointAffiliationList = "api.posservices/api/v1/service/recurrence.getAffiliation";
    private $endPointDeaffiliate = "api.posservices/api/v1/service/recurrence.deaffiliateProduct/";
    private $endPointAffiliationStatus = "api.posservices/api/v1/service/recurrence.getAffiliationById";

	private $endPointAffiliationCharges = "api.posservices/api/v1/service/recurrence.getCharges";

    public $endPointSandboxJs = "https://static-content-qas.vnforapps.com/v2/js/checkout.js?qa=true";
    public $endPointDevJs = "https://static-content-qas.vnforapps.com/v2/js/checkout.js?qa=true";
    public $endPointProdJs = "https://static-content.vnforapps.com/v2/js/checkout.js";

    public $responseStatus;

    function __construct(){
    }

    public function validarMarcas($marcas) {
        $logos = "";
        $urlVisa = plugin_dir_url(dirname(__FILE__)).'images/visa.png';
        $urlMc = plugin_dir_url(dirname(__FILE__)).'images/mc.png';
        $urlAmex = plugin_dir_url(dirname(__FILE__)).'images/amex.png';
        $urlDiners = plugin_dir_url(dirname(__FILE__)).'images/dc.png';
        $urlPE = plugin_dir_url(dirname(__FILE__)).'images/pe.png';
        $urlBBVA = plugin_dir_url(dirname(__FILE__)).'images/millas-bbva.png';
        if (is_array($marcas) || is_object($marcas)) {
            foreach ($marcas as $m) {
                if ($m == "visa") {
                    $logos .= " <img src='$urlVisa'>";
                }
                if ($m == "mc") {
                    $logos .= " <img src='$urlMc'>";
                }
                if ($m == "amex") {
                    $logos .= " <img src='$urlAmex'>";
                }
                if ($m == "diners") {
                    $logos .= " <img src='$urlDiners'>";
                }
                if ($m == "pe") {
                    $logos .= " <img src='$urlPE'>";
                }
                if ($m == "bbva") {
                    $logos .= " <img src='$urlBBVA'>";
                }
            }
        }
        return $logos;
    }

    public function getEnvironment($env) {
        switch ($env) {
            case 'S':
                return $this->baseUrlSandbox;
            case 'dev':
                return $this->baseUrlDev;
            case 'prd':
                return $this->baseUrlProd;
        }
    }

    public function generateTokenPW($env, $user, $pwd, $save) {
        $baseUrl = $this->getEnvironment($env);
        $url = $baseUrl.$this->endPointSecurity;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                'Authorization: '.'Basic '.base64_encode($user.":".$pwd)
            ),
        ));
        $token = curl_exec($curl);
        curl_close($curl);
        if($save == '1') {
			$this->saveLog('URL', $url);
			$this->saveLog('Base64: ', base64_encode($user.":".$pwd));
		}
        return $token;
    }

    public function postRequest($url, $postData, $token, $save) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.$token,
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => $postData
        ));
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        $this->responseStatus = $info['http_code'];
        curl_close($curl);
        if($save == '1') { $this->saveLog('URL', $url); $this->saveLog('Request', $postData); $this->saveLog('Response', $response); }
        return $response;
    }

    public function generateSessionPW($env, $amount, $merchant, $mdd, $token, $recurrenceAmount, $save) {
        $baseUrl = $this->getEnvironment($env);
        $session = array(
            'amount' => $amount,
            'antifraud' => array(
                'clientIp' => $_SERVER['REMOTE_ADDR'],
                'merchantDefineData' => $mdd
            ),
            'channel' => 'web',
            'recurrenceMaxAmount' => $recurrenceAmount,
        );
        $json = json_encode($session);
        $url = $baseUrl.$this->endPointSession.$merchant;
        $response = json_decode($this->postRequest($url, $json, $token, $save));
        return $response->sessionKey;
    }

    public function generateAuthorizationPW($env, $countable, $amount, $currency, $purchaseNumber, $transactionToken, $productId, $merchant, $token, $cardHolder, $recurrence, $save) {
        $baseUrl = $this->getEnvironment($env);
        $data = array(
            'antifraud' => null,
            'captureType' => 'manual',
            'channel' => 'web',
            'countable' => $countable,
            'order' => array(
                'amount' => $amount,
                'currency' => $currency,
                'purchaseNumber' => $purchaseNumber,
                'tokenId' => $transactionToken,
                'productId' => $productId
            ),
            'cardHolder' => $cardHolder,
            'recurrence' => $recurrence
        );
        $json = json_encode($data);
        $url = $baseUrl.$this->endPointAuthorization.$merchant;
        $response = json_decode($this->postRequest($url, $json, $token, $save));
        return $response;
    }

    public function generateConfirmationtionPW($env, $purchaseNumber, $amount, $authorizedAmount, $currency, $transactionId, $merchant, $token, $save) {
        $baseUrl = $this->getEnvironment($env);
        $data = array(
            'channel' => 'web',
            'captureType' => 'manual',
            'order' => array(
                'purchaseNumber' => $purchaseNumber,
                'amount' => $amount,
                'authorizedAmount' => $authorizedAmount,
                'currency' => $currency,
                'transactionId' => $transactionId
            )
        );
        $json = json_encode($data);
        $url = $baseUrl.$this->endPointConfirmation.$merchant;
        $response = json_decode($this->postRequest($url, $json, $token, $save));
        return $response;
    }

    public function generateDisaffiliation($env, $terminalId, $merchantId, $merchantName, $datetime, $currencyId, $channelId=6, $amount=0, $dataMap, $token, $save) {
        $baseUrl = $this->getEnvironment($env);
        $data = array(
            'terminalId' => $terminalId,
            'merchantId' => $merchantId,
            'merchantName' => $merchantName,
            'dateTime' => $datetime,
	        'currencyId' => $currencyId,
	        'channelId' => $channelId,
	        'amount' => $amount,
	        'dataMap' => $dataMap

        );
        $json = json_encode($data);
        $url = $baseUrl.$this->endPointDeaffiliate;
        $response = json_decode($this->postRequest($url, $json, $token, $save));
        return $response;
    }

	public function getAffiliationList($env, $terminalId, $merchantId, $merchantName, $datetime, $dataMap, $token, $save){
		$baseUrl = $this->getEnvironment($env);
		$data = array(
			'terminalId' => $terminalId,
			'merchantId' => $merchantId,
			'merchantName' => $merchantName,
			'dateTime' => $datetime,
			'dataMap' => $dataMap
		);
		$json = json_encode($data);
		$url = $baseUrl.$this->endPointAffiliationList;
		$response = json_decode($this->postRequest($url, $json, $token, $save));
		return $response;
	}

	public function getAffiliationStatus($env, $terminalId, $merchantId, $merchantName, $datetime, $dataMap, $token, $save){
		$baseUrl = $this->getEnvironment($env);
		$data = array(
			'terminalId' => $terminalId,
			'merchantId' => $merchantId,
			'merchantName' => $merchantName,
			'dateTime' => $datetime,
			'dataMap' => $dataMap
		);
		$json = json_encode($data);
		$url = $baseUrl.$this->endPointAffiliationStatus;
		$response = json_decode($this->postRequest($url, $json, $token, $save));
		return $response;
	}

	public function getAffiliatedCharges($env, $terminalId, $merchantId, $merchantName, $datetime, $dataMap, $token, $save){
		$baseUrl = $this->getEnvironment($env);
		$data = array(
			'terminalId' => $terminalId,
			'merchantId' => $merchantId,
			'merchantName' => $merchantName,
			'dateTime' => $datetime,
			'dataMap' => $dataMap
		);
		$json = json_encode($data);
		$url = $baseUrl.$this->endPointAffiliationCharges;
		$response = json_decode($this->postRequest($url, $json, $token, $save));
		return $response;
	}

    public function saveLog($title, $message) {
        $logger = wc_get_logger();
        $context = array( 'source' => 'radar_niubiz' );
        $logger->info($title.': '.$message, $context);
    }

}
