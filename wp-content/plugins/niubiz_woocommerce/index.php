<?php
  /*
    Plugin Name: WooCommerce pagos con Niubiz
    Plugin URI: https://desarrolladores.niubiz.com.pe/
    Description: Módulo para pagos en línea mediante Visa.
    Version: 3.0
    Author: Integraciones Necomplus
    Author URI: https://desarrolladores.niubiz.com.pe/
    Text Domain: Acepta pagos con Visa, MasterCard, Amex y Diners
    Domain Path: /langs
    Copyright: © 2021 Niubiz.
    WC tested up to: 4.0
    License: GNU General Public License v3.0
    License URI: http://www.gnu.org/licenses/gpl-3.0.html
  */

include 'includes/niubizFunction.php';

add_action('plugins_loaded', 'woocommerce_niubiz_init', 0);

function woocommerce_niubiz_init() {
  if (!class_exists('WC_Payment_Gateway')) return;

  class WC_Niubiz extends WC_Payment_Gateway {
    public function __construct() {
      $this->id = 'niubiz';
      $this->method_title = 'Niubiz';
      $this->method_description = 'Niubiz acepta tarjetas de crédito o débito. ¡Y ahora, también PagoEfectivo!.';
      $this->has_fields = false;

      $this->form_fields = include 'includes/initFormFields.php';
      $this->init_settings();

      // $this->urlLogos = $this->validarMarcas($this->settings['marcas']);
      // $this->urlLogos = NiubizFunction::validarMarcas($this->settings['marcas']);
      $niubizFunction = new NiubizFunction();
      $this->urlLogos = $niubizFunction->validarMarcas($this->settings['marcas']);
      $uri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

      if ($uri == wc_get_checkout_url() || $_SERVER['QUERY_STRING'] == 'wc-ajax=update_order_review') {
        $this->title = $this->settings['title'] . $this->urlLogos;
      } else {
        $this->title = $this->settings['title'];
      }
      $this->description = $this->settings['description'];
      $this->merchantIdPEN = $this->settings['merchantIdPEN'];
      $this->merchantIdUSD = $this->settings['merchantIdUSD'];
      $this->user = $this->settings['user'];
      $this->pwd = $this->settings['password'];
      $this->ruc = $this->settings['ruc'];

      $this->multicomercio = $this->settings['multicomercio'];
      $this->registerLog = $this->settings['registerLog'];
      $this->environment = $this->settings['environment'];
      $this->urlLogo =  $this->settings['urlLogo'];
      $this->urlTyC =  $this->settings['urlTyC'];
      $this->urlTo =  $this->settings['urlTo'];

      $this->countable = $this->settings['countable'];
	  $this->discountForBins = $this->settings['discountForBins'];
	  $this->customButton = $this->settings['customButton'];
      $this->buttonSize = $this->settings['buttonSize'];
      $this->buttonColor = $this->settings['buttonColor'];
      $this->payButtonColor = $this->settings['payButtonColor'];
      $this->showAmount = $this->settings['showAmount'];
      $this->status = $this->settings['status'];

      $this->estadoPagadoPE = $this->settings['estadoPagadoPE'];

      $this->msg['message'] = "";
      $this->msg['class'] = "";

      add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
      add_action('woocommerce_receipt_' . $this->id, array($this, 'receipt_page'));
      add_action('woocommerce_thankyou_' . $this->id, array($this, 'thankyou_page'));
      $this->db_niubiz_payment();
      $this->db_niubiz_pagoefectivo();
    }

    function db_niubiz_payment() {
      global $wpdb, $charset_collate;
      $nombreTabla = $wpdb->prefix."niubiz_payment";
		  $sql = "
        CREATE TABLE IF NOT EXISTS $nombreTabla (
          ID bigint(20) NOT NULL auto_increment,
          actionCode varchar(3) NULL,
          purchaseNumber varchar(15) NULL,
          amount varchar(15) NULL,
          card varchar(16) NULL,
          brand varchar(15) NULL,
          transactionId varchar(50) NULL,
          PRIMARY KEY (ID)
        ) $charset_collate;
      ";
		  $wpdb->query($sql);
    }

    function db_niubiz_pagoefectivo() {
      global $wpdb, $charset_collate;
      $nombreTabla = $wpdb->prefix."niubiz_pagoefectivo";
		  $sql = "
        CREATE TABLE IF NOT EXISTS $nombreTabla (
          ID bigint(20) NOT NULL auto_increment,
          cip varchar(15) NOT NULL,
          url varchar(150) NOT NULL,
          wcOrderId bigint(20) NOT NULL,
          nroPedido varchar(50) NULL,
          status varchar(10) NULL,
          PRIMARY KEY  (ID)
        ) $charset_collate;
      ";
		  $wpdb->query($sql);
    }

    public function admin_options() {
      echo '<h3>Niubiz</h3>';
      echo '<p>Niubiz permite realizar pagos con tarjeta de crédito o débito</p>';
      echo '<table class="form-table">';
      echo $this->generate_settings_html();
      echo '</table>';
    }

    function payment_fields() {
      if ($this->description) echo wpautop(wptexturize($this->description));
    }

    function receipt_page($order) {
      echo '<p>Haga click en el botón para realizar su pago mediante Niubiz.</p>';
      echo $this->generate_niubiz_form($order);
    }

    public function validateRecurrence($order_items) {
      foreach ($order_items as $i) {
        $config = get_post_meta($i['product_id'], 'MC_ES_RECURRENTE', true);
        if ($config == 'yes') {
          return '1';
        }
      }
      return '0';
    }

    public function differentMerchant($order_items, $currency) {
      $first = reset($order_items);
      $merchant = get_post_meta($first['product_id'], $currency == 'PEN' ? 'MC_MERCHANT_ID_PEN' : 'MC_MERCHANT_ID_USD', true);
      foreach ($order_items as $i) {
        $config = get_post_meta($i['product_id'], $currency == 'PEN' ? 'MC_MERCHANT_ID_PEN' : 'MC_MERCHANT_ID_USD', true);
        if ($config != $merchant) {
          return '1';
        }
      }
      return '0';
    }

    public function showMessage($message) {
      echo "<div class='woocommerce-info'>{$message}</div>";
    }

    public function getMDD($order) {
      $mdd = array(
        'MDD21' => '0'
      );
      $email = $order->get_billing_email();
      if ($email != null) {
        $mdd['MDD4'] = $email;
        $mdd['MDD32'] = $email;
      }
      return $mdd;
    }

    /** GENERAR BOTON DE PAGO **/
    public function generate_niubiz_form($order_id) {

      $niubizFunction = new NiubizFunction();

      global $woocommerce, $product;
      $order = new WC_Order($order_id);
      
      // $amount = $order->order_total;
      $amount = $order->get_total();

      $productinfo = "Order $order_id";
      $currency = get_post_meta($order_id, '_order_currency', true);
      $settings = get_option("woocommerce_niubiz_settings");
      $order_items = $order->get_items();
      
      $urlLogo = $this->urlLogo;
      $recurrence = "FALSE";
      $recurrenceAmount = null;
	  $frecuenciaRecurrencia = "";
	  $tipoRecurrencia = "";

      if ($currency == 'PEN' || $currency == 'USD') {
        $merchant = $currency == 'PEN' ? $this->merchantIdPEN : $this->merchantIdUSD;
        $user = $this->user;
        $pwd = $this->pwd;
        if ($this->multicomercio == "yes") {
          $product = reset($order_items);
          $merchant = get_post_meta($product['product_id'], $currency == 'PEN' ? 'MC_MERCHANT_ID_PEN' : 'MC_MERCHANT_ID_USD', true);

          $isRecurrence = $this->validateRecurrence($order_items);
          if($isRecurrence == '1') {
            if (count($order_items) > 1) {
              $this->showMessage('Solo se permite una suscripción');
              return;
            } else {
              $recurrence = "TRUE";
              $frecuenciaRecurrencia = get_post_meta($product['product_id'], 'MC_FRECUENCIA_RECURRENCIA', true);
              $tipoRecurrencia = get_post_meta($product['product_id'], 'MC_TIPO_RECURRENCIA', true);
              $recurrenceAmount = $amount;
              $transactionId = isset($data->dataMap->TRANSACTION_ID) ? $data->dataMap->TRANSACTION_ID : null;
              $urlLogo = get_post_meta($product['product_id'], 'MC_URL_LOGO', true);
              if ($tipoRecurrencia == 'FIXEDINITIAL' || $tipoRecurrencia == 'VARIABLEINITIAL') {
                $pagoInicial = get_post_meta($product['product_id'], 'MC_PAGO_INICIAL', true);
                $amount = $pagoInicial != null ? $pagoInicial : $amount;
              }
            }
          } else {
            $differentMerchant = $this->differentMerchant($order_items, $currency);
            if ($differentMerchant == '1') {
              $this->showMessage('Solo se permite la compra de un comercio');
              return;
            } else {
              $user = get_post_meta($product['product_id'], 'MC_USER', true);
              $pwd = get_post_meta($product['product_id'], 'MC_PWD', true);
              $urlLogo = get_post_meta($product['product_id'], 'MC_URL_LOGO', true);
            }
          }
        }
      } else{
        $this->showMessage('Moneda no válida');
        return;
      }

      $save = $this->registerLog == 'yes' ? '1' : '0';

      $token = $niubizFunction->generateTokenPW($this->environment, $user, $pwd, $save);
      $mdd = $this->getMDD($order);
      $sessionKey = $niubizFunction->generateSessionPW($this->environment, $amount, $merchant, $mdd, $token, $recurrenceAmount, $save);

      $callback = $order->get_checkout_order_received_url();
      $urlJS = $this->environment == "S" ? $niubizFunction->endPointSandboxJs : ($this->environment == "dev" ? $niubizFunction->endPointDevJs : $niubizFunction->endPointProdJs);

      if ($this->customButton == 'yes') {
        return
          "<script src='{$urlJS}'></script>
          <button class='btn btn-primary' onclick='openNiubiz()'>PAGA AQUÍ</button>
          <script> 
            function openNiubiz() {
              VisanetCheckout.configure({
                sessiontoken:'{$sessionKey}',
                merchantid:'{$merchant}',
                channel:'web',
                buttonsize:'{$this->buttonSize}',
                buttoncolor:'{$this->buttonColor}' ,
                merchantlogo:'{$urlLogo}',
                merchantname:\"\",
                formbuttoncolor:'{$this->payButtonColor}',
                showamount:'{$this->showAmount}',
                purchasenumber:'{$order_id}',
                amount:'{$amount}',
                recurrence:'{$recurrence}',
                recurrencefrequency:'{$frecuenciaRecurrencia}',
                recurrencetype:'{$tipoRecurrencia}',
                recurrenceamount:'{$recurrenceAmount}',
                recurrencemaxamount:'{$amount}',
                timeouturl:'{$this->urlTo}',
                action:'{$callback}'
              });
              VisanetCheckout.open();
            }
          </script>";
      } else {
        return
          "<form action='{$callback}' method='post'>
            <script src='{$urlJS}'
              data-sessiontoken='{$sessionKey}'
              data-merchantid='{$merchant}'
              data-channel='web'
              data-buttonsize='{$this->buttonSize}'
              data-buttoncolor='{$this->buttonColor}' 
              data-merchantlogo='{$urlLogo}'
              data-merchantname=\"\"
              data-formbuttoncolor='{$this->payButtonColor}'
              data-showamount='{$this->showAmount}'
              data-purchasenumber='{$order_id}'
              data-amount='{$amount}'
              data-recurrence='{$recurrence}'
              data-recurrencefrequency='{$frecuenciaRecurrencia}'
              data-recurrencetype='{$tipoRecurrencia}'
              data-recurrenceamount='{$recurrenceAmount}'
              data-recurrencemaxamount='{$amount}'
              data-timeouturl='{$this->urlTo}'
            /></script>
          </form>
		  <script>jQuery('.start-js-btn').trigger('click');</script>
		";
      }

    }

    /** PROCESAR PAGO **/
    function process_payment($order_id) {
      global $woocommerce;
      $order = new WC_Order($order_id);
      return array(
        'result'   => 'success',
        'redirect' => $order->get_checkout_payment_url(true)
      );
    }

    /** PAGINA DE RETORNO **/
    function thankyou_page($order_id) {
      global $wpdb;

      if ($_POST) {
        $order = new WC_Order($order_id);
        $transactionToken = $_POST['transactionToken'];
        $channel = $_POST['channel'];
        $customerEmail = $_POST['customerEmail'];
  
        if ($channel == "web") {

          $niubizFunction = new NiubizFunction();

          $amount = $order->get_total();
          $currency = get_post_meta($order_id, '_order_currency', true);
          $settings = get_option("woocommerce_niubiz_settings");
          $order_items = $order->get_items();
          $cardHolder = null;
          $recurrence = null;
          $productId = null;

          if ($currency == 'PEN' || $currency == 'USD') {
            $merchant = $currency == 'PEN' ? $this->merchantIdPEN : $this->merchantIdUSD;
            $user = $this->user;
            $pwd = $this->pwd;
            if ($this->multicomercio == "yes") {
              $product = reset($order_items);
              $merchant = get_post_meta($product['product_id'], $currency == 'PEN' ? 'MC_MERCHANT_ID_PEN' : 'MC_MERCHANT_ID_USD', true);
              $isRecurrence = $this->validateRecurrence($order_items);
              if($isRecurrence == '1') {
                if (count($order_items) > 1) {
                  $this->showMessage('Solo se permite una suscripción');
                  return;
                } else {
                  $cardHolder = array(
                    'documentType' => '0',
                    'documentNumber' => str_pad($order_id, 8, '0', STR_PAD_LEFT)
                  );
                  $recurrenceType = get_post_meta($product['product_id'], 'MC_TIPO_RECURRENCIA', true);
                  $recurrence = array(
                    'type' => $recurrenceType,
                    'frequency' => get_post_meta($product['product_id'], 'MC_FRECUENCIA_RECURRENCIA', true),
                    'beneficiaryId' => $order_id,
                    'beneficiaryFirstName' => get_post_meta($order_id,'_billing_first_name', true),
                    'beneficiaryLastName' => get_post_meta($order_id,'_billing_last_name', true),
                    'maxAmount' => $amount,
                    'amount' => $amount
                  );
                  if ($recurrenceType == 'FIXEDINITIAL' || $recurrenceType == 'VARIABLEINITIAL') {
                    $pagoInicial = get_post_meta($product['product_id'], 'MC_PAGO_INICIAL', true);
                    $amount = $pagoInicial != null ? $pagoInicial : $amount;
                  }
                  $productId = get_post_meta($product['product_id'], 'MC_CODIGO_PRODUCTO', true);
                }
              } else {
                $differentMerchant = $this->differentMerchant($order_items, $currency);
                if ($differentMerchant == '1') {
                  $this->showMessage('Solo se permite la compra de un comercio');
                  return;
                } else {
                  $user = get_post_meta($product['product_id'], 'MC_USER', true);
                  $pwd = get_post_meta($product['product_id'], 'MC_PWD', true);
                }
              }
            }
          } else{
            $this->showMessage('Moneda no válida');
            return;
          }

          $statusOrderMessage = '';

          $save = $this->registerLog == 'yes' ? '1' : '0';
          $token = $niubizFunction->generateTokenPW($this->environment, $user, $pwd, '0');
		  $countable = $this->countable == 'yes' ? 'true' : 'false';
          $data = $niubizFunction->generateAuthorizationPW($this->environment, $countable, $amount, $currency, $order_id, $transactionToken, $productId, $merchant, $token, $cardHolder, $recurrence, $save);

          // Variables puntos BBVA
          $isBBVA = '0';
          $exchangeMerchantID = $redeemedEquivalentAmount = $exchangeTraceID = $redeemedPoints = "";
          $exchangeID = $exchangeProgramName = $exchangeTotalAmount = $exchangeStatus = $exchangeTerminalID = "";

		  // Variable por descuento
		  $hasDiscount = '0';
		  $campaignName = '';
          if (isset($data->dataMap)) {
            if ($data->dataMap->ACTION_CODE == "000") {
              $statusOrderMessage = 'Su pedido ha sido procesado.';
			  if($this->discountForBins == 'yes') {
				  $binNumber = substr($data->dataMap->CARD, 0, 6);
				  $transactionId = $data->dataMap->TRANSACTION_ID;
				  $vexBins = $wpdb->prefix."vex_campaigns_bins";
				  $vexTab = $wpdb->prefix."vex_campaigns_tab";
				  $sql = "SELECT B.id_campaign, B.numbin, B.countrybin, B.banco, B.tipotarjeta, B.redtarjeta, B.status, T.country, T.cupon, T.campaign FROM $vexBins B INNER JOIN $vexTab T ON T.status = B.id_campaign WHERE B.numbin = $binNumber AND B.status = '1' ORDER BY B.id_campaign ASC";
				  $result = $wpdb->get_results($sql);
				  if ($result != null) {
					  $campaignName = $result[0]->campaign;
					  $couponId = $result[0]->cupon;
					  $sqlCoupon = "SELECT p.`ID`, 
					   p.`post_title`   AS coupon_code, 
					   p.`post_excerpt` AS coupon_description, 
					   Max(CASE WHEN pm.meta_key = 'discount_type'      AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS discount_type,          -- Discount type 
					   Max(CASE WHEN pm.meta_key = 'coupon_amount'      AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS coupon_amount,          -- Coupon amount 
					   Max(CASE WHEN pm.meta_key = 'free_shipping'      AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS free_shipping,          -- Allow free shipping 
					   Max(CASE WHEN pm.meta_key = 'date_expires'        AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS date_expires,                -- Coupon expiry date 
					   Max(CASE WHEN pm.meta_key = 'minimum_amount'     AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS minimum_amount,         -- Minimum spend 
					   Max(CASE WHEN pm.meta_key = 'maximum_amount'     AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS maximum_amount,         -- Maximum spend 
					   Max(CASE WHEN pm.meta_key = 'individual_use'     AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS individual_use,         -- Individual use only 
					   Max(CASE WHEN pm.meta_key = 'exclude_sale_items' AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS exclude_sale_items,         -- Exclude sale items 
					   Max(CASE WHEN pm.meta_key = 'product_ids'    AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS product_ids,                -- Products 
					   Max(CASE WHEN pm.meta_key = 'exclude_product_ids'AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS exclude_product_ids,        -- Exclude products 
					   Max(CASE WHEN pm.meta_key = 'product_categories' AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS product_categories,             -- Product categories 
					   Max(CASE WHEN pm.meta_key = 'exclude_product_categories' AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS exclude_product_categories,-- Exclude Product categories 
					   Max(CASE WHEN pm.meta_key = 'customer_email'     AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS customer_email,         -- Email restrictions 
					   Max(CASE WHEN pm.meta_key = 'usage_limit'    AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS usage_limit,                -- Usage limit per coupon 
					   Max(CASE WHEN pm.meta_key = 'usage_limit_per_user'   AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS usage_limit_per_user,   -- Usage limit per user 
					   Max(CASE WHEN pm.meta_key = 'usage_count'    AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS total_used                  -- Usage count 
				FROM   `wp_posts` AS p 
					   INNER JOIN `wp_postmeta` AS pm ON  p.`ID` = pm.`post_id` 
				WHERE  p.`post_type` = 'shop_coupon' 
					   AND p.`post_status` = 'publish'
					   AND p.`ID` = $couponId
				GROUP  BY p.`ID` 
				ORDER  BY p.`ID` ASC";
					  $coupon = $wpdb->get_results($sqlCoupon);
					  if ($coupon != null) {
						  $coupon_code = $coupon[0]->coupon_code;
						  $isValid = $order->apply_coupon($coupon_code);
						  if ($isValid == 'true') {
							  $hasDiscount = '1';
							  $campaignSymbol = $coupon[0]->discount_type == 'percent' ? '%' : '';
							  $campaignName = $campaignName.' ('.$coupon[0]->coupon_amount.$campaignSymbol.')';
							  $authorizedAmount = $coupon[0]->discount_type == 'percent' ? $amount- (($amount * floatval($coupon[0]->coupon_amount)) / 100) : $amount - floatval($coupon[0]->coupon_amount);
							  $discount = $amount - $authorizedAmount;
							  $dataConfirmation = $niubizFunction->generateConfirmationtionPW($this->environment, $order_id, $amount, $authorizedAmount, $currency, $transactionId, $merchant, $token, $save);
							  //print($dataConfirmation);
							  $order->add_order_note("
								Descuento BIN (Niubiz)\n
								 * BIN: {$result[0]->numbin}\n
								 * Banco: {$result[0]->banco}\n
								 * Tipo tarjeta: {$result[0]->tipotarjeta}\n
								 * Red: {$result[0]->redtarjeta}\n
								 * Descuento: {$discount}\n"
							  );
							  $amount = $authorizedAmount;
						  } else 
						  $dataConfirmation = $niubizFunction->generateConfirmationtionPW($this->environment, $order_id, $amount, $amount, $currency, $transactionId, $merchant, $token, $save);
					  } else {
						  $dataConfirmation = $niubizFunction->generateConfirmationtionPW($this->environment, $order_id, $amount, $amount, $currency, $transactionId, $merchant, $token, $save);
					  }
				  } else {
						  $dataConfirmation = $niubizFunction->generateConfirmationtionPW($this->environment, $order_id, $amount, $amount, $currency, $transactionId, $merchant, $token, $save);
				  }
			  }
              $order->update_status($this->status);
              $order->reduce_order_stock();
              $actionCode = $data->dataMap->ACTION_CODE;
              $message = isset($data->dataMap->RECURRENCE_SRV_MESSAGE) ? $data->dataMap->RECURRENCE_SRV_MESSAGE : $data->dataMap->ACTION_DESCRIPTION;
              $card = $data->dataMap->CARD;
              $brand = $data->dataMap->BRAND;
              $c = str_split($data->dataMap->TRANSACTION_DATE, 2);
              $transactionDate = $c[2]."/".$c[1]."/".$c[0]." ".$c[3].":".$c[4].":".$c[5];
              $transactionId = isset($data->dataMap->TRANSACTION_ID) ? $data->dataMap->TRANSACTION_ID : null;
              // Puntos BBVA
              if (isset($data->dataMap->EXCHANGE_ID)) {
                $isBBVA = '1';
                $exchangeMerchantID = $data->dataMap->EXCHANGE_MERCHANT_ID;
                $redeemedEquivalentAmount = $data->dataMap->REDEEMED_EQUIVALENT_AMOUNT;
                $exchangeTraceID = $data->dataMap->EXCHANGE_TRACE_ID;
                $redeemedPoints = $data->dataMap->REDEEMED_POINTS;
                $exchangeID = $data->dataMap->EXCHANGE_ID;
                $exchangeProgramName = $data->dataMap->EXCHANGE_PROGRAM_NAME;
                $exchangeTotalAmount = $data->dataMap->EXCHANGE_TOTAL_AMOUNT;
                $exchangeStatus = $data->dataMap->EXCHANGE_STATUS;
                $exchangeTerminalID = $data->dataMap->EXCHANGE_TERMINAL_ID;
              }
            }
          } else if (isset($data->data)) {
            $statusOrderMessage = 'Desafortunadamente, su pedido no se puede procesar, ya que el banco/comercio ha rechazado su transacción. Por favor, intente su compra de nuevo.';
            $order->update_status('failed');
            $actionCode = $data->data->ACTION_CODE;
            $message = isset($data->data->RECURRENCE_SRV_MESSAGE) ? $data->data->RECURRENCE_SRV_MESSAGE : $data->data->ACTION_DESCRIPTION;
            $card = $data->data->CARD;
            $brand = $data->data->BRAND;
            $c = str_split($data->data->TRANSACTION_DATE, 2);
            $transactionDate = $c[2]."/".$c[1]."/".$c[0]." ".$c[3].":".$c[4].":".$c[5];
            $transactionId = isset($data->data->TRANSACTION_ID) ? $data->data->TRANSACTION_ID : null;
            // Puntos BBVA
            if (isset($data->data->EXCHANGE_ID)) {
              $isBBVA = '1';
              $exchangeID = $data->data->EXCHANGE_ID;
              $exchangeStatus = $data->data->EXCHANGE_STATUS;
            }
          }

          $order->add_order_note("
            Pago con tarjeta (Niubiz)\n
             * Mensaje: {$message}\n
             * Tarjeta: {$card}\n
             * Marca: {$brand}\n
             * Transaction ID: {$transactionId}\n"
          );

          // Registrar en la BD
          $nombreTabla = $wpdb->prefix . "niubiz_payment";
          $ms_queries = "INSERT INTO $nombreTabla (`actionCode`, `purchaseNumber`, `amount`, `card`, `brand`, `transactionId`)
            VALUES ('{$actionCode}', '{$order_id}', '{$amount}', '{$card}', '{$brand}', '{$transactionId}')";
          $wpdb->query( $ms_queries );

          $cliente = get_post_meta($order_id, '_billing_first_name', true) . " " . get_post_meta($order_id, '_billing_last_name', true);

          $this->showMessage($statusOrderMessage);
          $currencySymbol = $currency == 'PEN' ? 'S/' : '$';
          // Custom view
          echo "<div class='row'>";
          echo "
            <div class='col-md-6'>
              <h2 class='woocommerce-column__title'>Detalles de la transacción</h2>
              <div class='row'>";
                  echo "
                    <div class='col-md-12'><b>Cliente: </b>{$cliente}</div>
                    <div class='col-md-12'><b>Fecha y Hora: </b>{$transactionDate}</div>
                  ";
                if ($isBBVA == '0') {
                  echo "
                    <div class='col-md-12'><b>Tarjeta: </b>{$card}</div>
                    <div class='col-md-12'><b>Marca: </b>{$brand}</div>
                    <div class='col-md-12'><b>Mensaje: </b>{$message}</div>
                    <div class='col-md-12'><b>Monto con tarjeta: </b>{$currencySymbol}{$amount}</div>
                    <div class='col-md-12'><b>Moneda: </b>{$currency}</div>
                    <div class='col-md-12'><b>ID Transacción: </b>{$transactionId}</div>
                  ";
					if ($hasDiscount == '1') {
						echo "<div class='col-md-12'><b>Descuento: </b>{$campaignName}</div>";
					}
                } else {
                  if ($exchangeStatus == 'Denied') {
                    $message = "Operación denegada. Transacción no puede ser procesada";
                    echo "<div class='col-md-12'><b>Mensaje: </b>{$message}</div>";
                  } else {
                    echo "<div class='col-md-12'><b>Mensaje: </b>{$message}</div>";
                    if ($data->dataMap->AMOUNT != '0.0') {
                      // TODO: Pago Mixto
                      echo "<div class='col-md-12'><b>Monto con tarjeta: </b>{$currencySymbol}{$data->dataMap->AMOUNT}</div>";
                      echo "<div class='col-md-12'><b>ID Transacción: </b>{$transactionId}</div>";
                    }
                    echo "<div class='col-md-12'><b>Programa: </b>{$exchangeProgramName}</div>";
                    echo "<div class='col-md-12'><b>Puntos canjeados: </b>{$redeemedPoints} (equivalente a {$currencySymbol}{$redeemedEquivalentAmount})</div>";
                    echo "<div class='col-md-12'><b>ID canje: </b>{$exchangeID}</div>";
                  }
                }
                  echo "
                    <div class='col-md-12'><a href='{$this->urlTyC}' target='_blank'>Términos y condiciones</a></div>
                    <div class='col-md-12'><input type='button' onclick='window.print();' class='btn btn-sm btn-primary' value='Imprimir'></div>
                  ";
              echo "</div>"; // Row
            echo "</div>"; // Col
          echo "</div>"; // Row
          echo "<br>";

        } else if ($channel == "pagoefectivo") {
          $url = $_POST["url"];
          $order->add_order_note("PagoEfectivo (Niubiz) => Pendiente de pago\nCIP: {$transactionToken}");
          // Registrar CIP en la BD
          $nombreTabla = $wpdb->prefix . "niubiz_pagoefectivo";
          $ms_queries = "INSERT INTO $nombreTabla (`cip`, `url`, `wcOrderId`) VALUES ('{$transactionToken}', '{$url}', '{$order_id}')";
          $wpdb->query( $ms_queries );
          wp_redirect($url);
        } else {
          die();
        }
        
      } else {
        echo 'No se recibio post.';
        die();
      }
    }
  }

  /**
   * AGREGAMOS EL MÉTODO DE PAGO NIUBIZ
   **/
  add_filter('woocommerce_payment_gateways', 'woocommerce_add_niubiz');

  function woocommerce_add_niubiz($methods) {
    $methods[] = 'WC_Niubiz';
    return $methods;
  }

  /** AGREGAMOS LAS OPCIONES ADICIONALES PARA LOS PRODUCTOS **/
  add_action('woocommerce_product_write_panel_tabs', 'tabNiubiz');

  function tabNiubiz() { ?>
    <style>
          #woocommerce-coupon-data ul.wc-tabs li.custom_tab a::before,
          #woocommerce-product-data ul.wc-tabs li.custom_tab a::before,
          .woocommerce ul.wc-tabs li.custom_tab a::before {
              font-family: Dashicons;
              content: "";
              
          }
      </style>
      <li class="custom_tab">
        <a href="#tabNiubiz" style="padding:0;padding-left: 8px;">
          <img src="<?php echo plugin_dir_url(__FILE__).'images/niubiz.png'?>" width="80">
        </a>
      </li>
    <?php
  }

  function tabNiubiz_product_tab_content() {
    global $post;
    ?>
      <div id='tabNiubiz' class='panel woocommerce_options_panel'>
        <div class='options_group'>
          <h2><b>Configuración general</b></h2>
            <?php
              woocommerce_wp_text_input(array(
                'id'                => 'MC_MERCHANT_ID_PEN',
                'label'             => 'Codigo Comercio PEN',
                'desc_tip'          => 'true',
                'description'       => 'Ingrese su código de comercio de Niubiz para Soles',
                'type'              => 'text',
                'custom_attributes' => array(
                  'placeholder'   => 'Codigo Comercio Soles'
                ),
              ));

              woocommerce_wp_text_input(array(
                'id'                => 'MC_MERCHANT_ID_USD',
                'label'             => 'Codigo Comercio USD',
                'desc_tip'          => 'true',
                'description'       => 'Ingrese su código de comercio de Niubiz para Dólares',
                'type'              => 'text',
                'custom_attributes' => array(
                  'placeholder'   => 'Codigo Comercio Dólares'
                ),
              ));

              woocommerce_wp_text_input(array(
                'id'                => 'MC_USER',
                'label'             => 'Usuario',
                'desc_tip'          => 'true',
                'description'       => 'Ingrese su Usuario de Niubiz',
                'type'              => 'text',
                'custom_attributes' => array(
                  'placeholder'   => 'Usuario'
                ),
              ));

              woocommerce_wp_text_input(array(
                'id'                => 'MC_PWD',
                'label'             => 'Contraseña',
                'desc_tip'          => 'true',
                'description'       => 'Ingrese su Contraseña de Niubiz',
                'type'              => 'text',
                'custom_attributes' => array(
                  'placeholder'   => 'Contraseña'
                ),
              ));

              woocommerce_wp_text_input(array(
                'id'                => 'MC_URL_LOGO',
                'label'             => 'Logo de Producto',
                'desc_tip'          => 'true',
                'description'       => 'URL del logo que será mostrado en el Popup de Visa al momento de comprar este producto.',
                'type'              => 'text',
                'custom_attributes' => array(
                  'placeholder'   => 'URL Logo Producto'
                ),
              ));
            ?>
          <hr>
          <h2><b>Configuración de cargos recurrentes</b></h2>
            <?php
              woocommerce_wp_checkbox(array(
                'id'      => 'MC_ES_RECURRENTE',
                'label'   => 'Aplica recurrencia',
                'default' => 'no'
              ));

              woocommerce_wp_select(array(
                'id'      => 'MC_FRECUENCIA_RECURRENCIA',
                'label'   => 'Frecuencia',
                'options' => array(
                  "MONTHLY" => "MENSUAL",
                  "QUARTERLY" => "TRIMESTRAL",
                  "BIANNUAL" => "SEMESTRAL",
                  "ANNUAL" => "ANUAL"
                )
              ));

              woocommerce_wp_select(array(
                'id'      => 'MC_TIPO_RECURRENCIA',
                'label'   => 'Tipo',
                'options' => array(
                  "FIXED" => "FIJO",
                  "VARIABLE" => "VARIABLE",
                  "FIXEDINITIAL" => "FIJO CON INICIAL",
                  "VARIABLEINITIAL" => "VARIABLE CON INICIAL"
                ),
              ));

              woocommerce_wp_text_input(array(
                'id' => 'MC_PAGO_INICIAL',
                'label' => 'Importe inicial',
                'type' => 'text',
                'desc_tip' => 'true',
                'description' => 'Aplica cuando el Tipo de recurrencia es FIXED y FIXEDINITIAL'
              ));

              woocommerce_wp_text_input(array(
                'id' => 'MC_CODIGO_PRODUCTO',
                'label' => 'Código de producto',
                'type' => 'text',
                'desc_tip' => 'true',
                'description' => 'Código registrado en el Niubiz',
              ));
            ?>
        </div>
      </div>
    <?php
  }

  add_filter('woocommerce_product_data_panels', 'tabNiubiz_product_tab_content');
  
  function save_giftcard_option_fields($post_id) {

    $woocommerce_mc_merchant_id_pen = $_POST['MC_MERCHANT_ID_PEN'];
    if (!empty($woocommerce_mc_merchant_id_pen))
      update_post_meta($post_id, 'MC_MERCHANT_ID_PEN', esc_attr($woocommerce_mc_merchant_id_pen));

    $woocommerce_mc_merchant_id_usd = $_POST['MC_MERCHANT_ID_USD'];
    if (!empty($woocommerce_mc_merchant_id_usd))
      update_post_meta($post_id, 'MC_MERCHANT_ID_USD', esc_attr($woocommerce_mc_merchant_id_usd));

    $woocommerce_mc_user = $_POST['MC_USER'];
    if (!empty($woocommerce_mc_user))
      update_post_meta($post_id, 'MC_USER', esc_attr($woocommerce_mc_user));

    $woocommerce_mc_pwd = $_POST['MC_PWD'];
    if (!empty($woocommerce_mc_pwd))
      update_post_meta($post_id, 'MC_PWD', esc_attr($woocommerce_mc_pwd));

    $woocommerce_mc_url_logo = $_POST['MC_URL_LOGO'];
    if (!empty($woocommerce_mc_url_logo))
      update_post_meta($post_id, 'MC_URL_LOGO', esc_attr($woocommerce_mc_url_logo));

    $woocommerce_mc_es_recurrente = isset( $_POST['MC_ES_RECURRENTE'] ) ? 'yes' : 'no';
	  update_post_meta( $post_id, 'MC_ES_RECURRENTE', $woocommerce_mc_es_recurrente );

    $woocommerce_mc_frecuencia_recurrencia = $_POST['MC_FRECUENCIA_RECURRENCIA'];
    if (!empty($woocommerce_mc_frecuencia_recurrencia))
      update_post_meta($post_id, 'MC_FRECUENCIA_RECURRENCIA', esc_attr($woocommerce_mc_frecuencia_recurrencia));

    $woocommerce_mc_tipo_recurrencia = $_POST['MC_TIPO_RECURRENCIA'];
    if (!empty($woocommerce_mc_tipo_recurrencia))
      update_post_meta($post_id, 'MC_TIPO_RECURRENCIA', esc_attr($woocommerce_mc_tipo_recurrencia));

    $woocommerce_mc_pago_inicial = $_POST['MC_PAGO_INICIAL'];
    if (!empty($woocommerce_mc_pago_inicial))
      update_post_meta($post_id, 'MC_PAGO_INICIAL', esc_attr($woocommerce_mc_pago_inicial));

    $woocommerce_mc_codigo_producto = $_POST['MC_CODIGO_PRODUCTO'];
    if (!empty($woocommerce_mc_codigo_producto))
      update_post_meta($post_id, 'MC_CODIGO_PRODUCTO', esc_attr($woocommerce_mc_codigo_producto));
  }
	
	add_action( 'add_meta_boxes', 'niubiz_add_meta_boxes' );
	if ( ! function_exists( 'niubiz_add_meta_boxes' ) )	{
		function niubiz_add_meta_boxes() 		{
			add_meta_box( 'mb_niubiz', __('Niubiz','woocommerce'), 'niubiz_actions', 'shop_order', 'side', 'core' );
		}
	}
	
	if ( ! function_exists( 'niubiz_actions' ) ) {
		function niubiz_actions() {
			global $post;
			$order = wc_get_order($post);
	        $amount = $order->get_total();
			//echo "<button type='button' class='button'>Devolución</button>";
			echo '<form method="post" action="">
					<div class="row">
						<div class="col-md-12">
							<input type="number" name="refundAmount" value="" max="'.$amount.'" min="1" required style="width: 100%;" placeholder="Importe a devolver"/>
						</div><br><br>
						<div class="col-md-12">
							<input type="text" name="refundComment" value="" maxlength="50" minlength="3" required style="width: 100%;" placeholder="Motivo de la devolución"/>
						</div><br><br>
						<div class="col-md-12">
							<input type="submit" class="button" name="submit_trusted_list" value="Devolución" style="width: 100%;"/>
						</div>
						<input type="hidden" name="trusted_list_nonce" value="' . wp_create_nonce() . '">
					</div>
    			</form>';
		}
	}
	
	add_action( 'save_post', 'niubiz_save_meta_box_data' );
	function niubiz_save_meta_box_data( $post_id ){

		// Only for shop order
		if ( 'shop_order' != $_POST[ 'post_type' ] )
			return $post_id;

		// Check if our nonce is set (and our cutom field)
		if ( ! isset( $_POST[ 'trusted_list_nonce' ] ) && isset( $_POST['submit_trusted_list'] ) )
			return $post_id;

		$nonce = $_POST[ 'trusted_list_nonce' ];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce ) )
			return $post_id;

		// Checking that is not an autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		// Check the user’s permissions (for 'shop_manager' and 'administrator' user roles)
		if ( ! current_user_can( 'edit_shop_order', $post_id ) && ! current_user_can( 'edit_shop_orders', $post_id ) )
			return $post_id;

		// Action to make or (saving data)
		if( isset( $_POST['submit_trusted_list'] ) ) {
			global $wpdb;
			$niubizFunction = new NiubizFunction();
			$refundAmount = $_POST['refundAmount'];
			$refundComment = $_POST['refundComment'];
			$settings = get_option("woocommerce_niubiz_settings");
			$order = wc_get_order($post_id);
	        $amount = $order->get_total();
      		$currency = get_post_meta($post_id, '_order_currency', true);
        	$merchant = $currency == 'PEN' ? $settings['merchantIdPEN'] : $settings['merchantIdUSD'];
			$save = $settings['registerLog'] == 'yes' ? '1' : '0';
			$nombreTabla = $wpdb->prefix."niubiz_payment";
			$sql = "SELECT * from $nombreTabla where purchaseNumber = $post_id AND actionCode = '000'";
			$result = $wpdb->get_results($sql);
			if ($result != null) {
				$token = $niubizFunction->generateTokenPW($settings['environment'], $settings['user'], $settings['pwd'], '0');
				$data = $niubizFunction->generateRefund($settings['environment'], $settings['ruc'], $post_id, $refundAmount, $refundComment, $result[0]->transactionId, $merchant, $token, $save);
				if (isset($data->errorCode)) {
					if ($data->errorCode == 400) {
						$order->add_order_note($data->errorMessage);
					} else {
						$order->add_order_note("
							Devolución (Niubiz)\n
							 * Comercio: {$data->data->CODIGOCOMERCIO}\n
							 * Codigo devolución: {$data->data->CODIGODEVOLUCION}\n
							 * Código: {$data->data->CODERROR}\n
							 * Mensaje: {$data->data->DSCERROR}\n
							 * ID transacción: {$data->data->IDTRANSACCION}\n
							 * Fecha y hora: {$data->data->DATETIMERESPONSE}\n"
						  );
						$order->update_status('refunded');
					}	
				} else $order->add_order_note("No se completó la devolución, por favor, revisa el log.");
			} else {
				$order->add_order_note("No se encontró la orden para iniciar la devolución.");
			}
		}
	}
  
  add_action('woocommerce_process_product_meta_simple', 'save_giftcard_option_fields');
  add_action('woocommerce_process_product_meta_variable', 'save_giftcard_option_fields');
 
}