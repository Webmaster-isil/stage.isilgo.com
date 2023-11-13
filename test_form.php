<?php
function postRequest($url, $postData, $token){
    $curl = curl_init();
    // var_dump($postData);
    // var_dump($token);
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
    // print_r($info);
    curl_close($curl);
    return $response;
}

function generateSessionPW($amount, $mdd, $token, $recurrenceAmount) {
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
    // echo '<pre>va el session</br>';
    // var_dump($json);
    // echo '</pre>';
    $url = 'https://apitestenv.vnforapps.com/api.ecommerce/v2/ecommerce/token/session/522591303';
    $response = json_decode(postRequest($url, $json, $token));
    return $response->sessionKey;
}

function generateTokenPW() {
    $user = 'integraciones@niubiz.com.pe';
    $pwd = '_7z3@8fF';
    $url = 'https://apitestenv.vnforapps.com/api.security/v1/security';
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
    return $token;
}


$orden = 1600;
$monto = '86.00';
// echo 'voy a pedir el token seguridad</br>';
$tokenSeguridad = generateTokenPW();

?>


<?php

if($_POST){

    // echo '<pre>';
    // print_r($_POST);
    // die();

    $data = array(
        'antifraud' => null,
        'captureType' => 'manual',
        'channel' => 'web',
        'countable' => 'true',
        'order' => array(
            'amount' => $monto,
            'currency' => 'PEN',
            'purchaseNumber' => $orden,
            'tokenId' => $_POST['transactionToken'],
            'productId' => 105
        ),
        'cardHolder' => array(
            'documentType'   => '0',
            'documentNumber' => str_pad( $orden, 8, '0', STR_PAD_LEFT )
        ),
        'recurrence' => array(
            'type'                 => 'FIXEDINITIAL',
            'frequency'            => 'QUARTERLY',
            'beneficiaryId'        => '7988562',
            'beneficiaryFirstName' => 'Manuel',
            'beneficiaryLastName'  => 'Romero',
            'maxAmount'            => $monto,
            'amount'               => $monto
        )
    );
    $json = json_encode($data);
    $url = 'https://apitestenv.vnforapps.com/api.authorization/v3/authorization/ecommerce/522591303';
    $response = json_decode(postRequest($url, $json, $tokenSeguridad));
    echo '<pre>';
    print_r($response);

} else {
    
			$mdd   = array(
				'MDD21' => '0'
			);



    $session = generateSessionPW($monto, $mdd, $tokenSeguridad, $monto);

    // var_dump($session) . '<br>';
    
?>


<form action='https://isilgo.dev.radar.cl/test_form.php' method='post'>
<script src="https://static-content-qas.vnforapps.com/v2/js/checkout.js?qa=true"
data-sessiontoken="<?php echo $session ?>"
data-merchantid="522591303"
data-channel="web"
data-merchantlogo="https://isilgo.dev.radar.cl/wp-content/uploads/2023/05/logo_isilgo-1.svg"
data-merchantname=""
data-showamount="yes"
data-purchasenumber="<?php echo $orden ?>"
data-amount="<?php echo $monto ?>"
data-recurrence="TRUE"
data-recurrencefrequency="QUARTERLY"
data-recurrencetype="FIXEDINITIAL"
data-recurrenceamount="<?php echo $monto ?>"
data-recurrencemaxamount="<?php echo $monto ?>"
data-timeouturl="https://isilgo.dev.radar.cl/carrito-compras/">
</script>
</form>
<script>jQuery('.start-js-btn').trigger('click');
</script>


<?php

}