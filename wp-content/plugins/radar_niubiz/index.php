<?php
/*
  Plugin Name: Pagos recurrentes Niubiz
  Description: Módulo para suscripciones en línea.
  Version: 1.0
  Author: Radar
  Text Domain: Acepta pagos con Visa, MasterCard, Amex y Diners
  Domain Path: /langs
  WC tested up to: 4.0
  License: GNU General Public License v3.0
  License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

include 'includes/radarNiubizFunction.php';

add_action('plugins_loaded', 'radar_niubiz_init', 0);

function radar_niubiz_init()
{
	if (!class_exists('WC_Payment_Gateway')) {
		return;
	}

	class WC_Radar_Niubiz extends WC_Payment_Gateway
	{
		public function __construct()
		{
			$this->id                 = 'radar_niubiz';
			$this->method_title       = 'Niubiz pagos recurrentes';
			$this->method_description = 'Pagos recurrentes con cargo a tarjeta de crédito';
			$this->has_fields         = false;

			$this->form_fields = include 'includes/initFormFields.php';
			$this->init_settings();

			// $this->urlLogos = $this->validarMarcas($this->settings['marcas']);
			// $this->urlLogos = NiubizFunction::validarMarcas($this->settings['marcas']);
			$niubizFunction = new RadarNiubizFunction();
			$this->urlLogos = $niubizFunction->validarMarcas($this->settings['marcas']);
			$uri            = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

			if ($uri == wc_get_checkout_url() || $_SERVER['QUERY_STRING'] == 'wc-ajax=update_order_review') {
				$this->title = $this->settings['title'] . $this->urlLogos;
			} else {
				$this->title = $this->settings['title'];
			}
			$this->description   = $this->settings['description'];
			$this->merchantIdPEN = $this->settings['merchantIdPEN'];
			$this->merchantIdUSD = $this->settings['merchantIdUSD'];
			$this->user          = $this->settings['user'];
			$this->pwd           = $this->settings['password'];
			$this->ruc           = $this->settings['ruc'];
			$this->registerLog   = $this->settings['registerLog'];
			$this->environment   = $this->settings['environment'];
			$this->urlLogo       = $this->settings['urlLogo'];
			$this->urlTyC        = $this->settings['urlTyC'];

			$this->countable  = $this->settings['countable'];
			$this->showAmount = $this->settings['showAmount'];
			$this->status     = $this->settings['status'];


			$this->msg['message'] = "";
			$this->msg['class']   = "";

			add_action('woocommerce_update_options_payment_gateways_' . $this->id, array(
				$this,
				'process_admin_options'
			));
			add_action('woocommerce_receipt_' . $this->id, array($this, 'receipt_page'));
			add_action('woocommerce_thankyou_' . $this->id, array($this, 'thankyou_page'));
			add_action('woocommerce_api_auth_transaction', array($this, 'authorize_transaction'));
			$this->db_niubiz_payment();
		}

		function db_niubiz_payment()
		{
			global $wpdb, $charset_collate;
			$nombreTabla = $wpdb->prefix . "niubiz_recurrent_payment";
			$sql         = "
        CREATE TABLE IF NOT EXISTS $nombreTabla (
          ID bigint(20) NOT NULL auto_increment,
          actionCode varchar(3) NULL,
          purchaseNumber varchar(15) NULL,
          amount varchar(15) NULL,
          card varchar(16) NULL,
          brand varchar(15) NULL,
          transactionId varchar(50) NULL,
            transactionDate varchar(20) NULL,
            message varchar(100) NULL,
            currency varchar(3) NULL,
            full_response longtext NULL,
          PRIMARY KEY (ID)
        ) $charset_collate;
      ";
			$wpdb->query($sql);
		}


		public function admin_options()
		{
			echo '<h3>Niubiz</h3>';
			echo '<p>Niubiz permite realizar pagos con tarjeta de crédito o débito</p>';
			echo '<table class="form-table">';
			echo $this->generate_settings_html();
			echo '</table>';
		}

		function payment_fields()
		{
			if ($this->description) {
				echo wpautop(wptexturize($this->description));
			}
		}

		function receipt_page($order)
		{
			echo '<p>Haga click en el botón para realizar su pago mediante Niubiz.</p>';
			echo $this->generate_niubiz_form($order);
		}

		public function validateRecurrence($order_items)
		{
			foreach ($order_items as $item) {
				//                echo '<pre>';
				//                print_r($item);
				//                die();
				if (is_a($item['data'], 'WC_Product_Variation')) {
					$config = get_post_meta($item['data']['parent_id'], 'RADAR_RECURRENCE_YES', true);
				} else {
					$config = get_post_meta($item['product_id'], 'RADAR_RECURRENCE_YES', true);
				}
				if ($config == 'yes') {
					return 'TRUE';
				}
			}

			return 'FALSE';
		}

		public function showMessage($message)
		{
			echo "<div class='woocommerce-info'>{$message}</div>";
		}

		public function getMDD($order)
		{
			$mdd   = array(
				'MDD21' => '0'
			);
			$email = $order->get_billing_email();
			if ($email != null) {
				$mdd['MDD4']  = $email;
				$mdd['MDD32'] = $email;
			}

			return $mdd;
		}

		/** GENERAR BOTON DE PAGO **/
		public function generate_niubiz_form($order_id)
		{
			$order      = new WC_Order($order_id);
			$recurrence = $this->validateRecurrence($order->get_items());
			if ($recurrence == 'TRUE') {
				$items   = $order->get_items();
				$product = reset($items);

				$niubizFunction = new RadarNiubizFunction();

				// $amount = $order->order_total;
				$amount = $order->get_total();

				$currency = get_post_meta($order_id, '_order_currency', true);

				$urlLogo = $this->urlLogo;

				$recurrenceAmount = null;
				$recurrenceType   = 'FIXEDINITIAL';
				$frequency        = get_post_meta($product['product_id'], 'RADAR_RECURRENCE_FREQ', true);

				if ($currency == 'PEN' || $currency == 'USD') {
					$merchant = $currency == 'PEN' ? $this->merchantIdPEN : $this->merchantIdUSD;
					$user     = $this->user;
					$pwd      = $this->pwd;
				} else {
					$this->showMessage('Moneda no válida');

					return;
				}

				$save = $this->registerLog == 'yes' ? '1' : '0';

				$token      = $niubizFunction->generateTokenPW($this->environment, $user, $pwd, $save);
				$mdd        = $this->getMDD($order);
				$sessionKey = $niubizFunction->generateSessionPW($this->environment, $amount, $merchant, $mdd, $token, $recurrenceAmount, $save);

				//      $callback = $order->get_checkout_order_received_url();
				$callback   = get_site_url();
				$callback   = add_query_arg(array(
					'wc-api' => 'auth_transaction',
					'oc'     => $order_id,
					'key'    => $order->get_order_key()
				), $callback);
				$urlJS      = $this->environment == "S" ? $niubizFunction->endPointSandboxJs : ($this->environment == "dev" ? $niubizFunction->endPointDevJs : $niubizFunction->endPointProdJs);
				$return_url = wc_get_cart_url();

				return "<form action='{$callback}' method='post'>
            <script src='{$urlJS}'
              data-sessiontoken='{$sessionKey}'
              data-merchantid='{$merchant}'
              data-channel='web'
              data-merchantlogo='{$urlLogo}'
              data-merchantname=\"\"
              data-showamount='{$this->showAmount}'
              data-purchasenumber='{$order_id}'
              data-amount='{$amount}'
              data-recurrence='{$recurrence}'
              data-recurrencefrequency='{$frequency}'
              data-recurrencetype='{$recurrenceType}'
              data-recurrenceamount='{$amount}'
              data-recurrencemaxamount='{$amount}'
              data-timeouturl='{$return_url}'
            /></script>
          </form>
		  <script>jQuery('.start-js-btn').trigger('click');</script>
		";
			} else {
				$this->showMessage('Sólo puede utilizar este método de pago con membresías');

				return;
			}
		}

		/** PROCESAR PAGO **/
		function process_payment($order_id)
		{
			global $woocommerce;
			$order = new WC_Order($order_id);

			return array(
				'result'   => 'success',
				'redirect' => $order->get_checkout_payment_url(true)
			);
		}

		public function authorize_transaction()
		{
			global $wpdb;
			if (isset($_GET['oc']) && isset($_GET['key']) && isset($_POST)) {
				$order = wc_get_order($_GET['oc']);
				//                echo '<pre>'; print_r($order); die();
				if ($_GET['key'] == $order->get_order_key()) {
					$currency = get_post_meta($order->get_id(), '_order_currency', true);
					//                    var_dump($dni); die();
					if ($currency == 'PEN' || $currency == 'USD') {
						$transactionToken = $_POST['transactionToken'];
						$niubizFunction   = new RadarNiubizFunction();
						$token            = $niubizFunction->generateTokenPW($this->environment, $this->user, $this->pwd, false);
						$items            = $order->get_items();
						$product          = reset($items);
						//                        echo '<pre>';
						//                        var_dump($product['product_id']);
						//                        die();
						$productId        = get_post_meta($product['product_id'], 'RADAR_PRODUCT_CODE', true);
						$merchant = $currency == 'PEN' ? $this->merchantIdPEN : $this->merchantIdUSD;
						$countable = $this->countable == 'yes' ? 'true' : 'false';

						$recurrenceType = 'FIXEDINITIAL';
						/*
                         * 0 – DNI
                         * 1 – Carnet de extranjería
                         * 2 – Pasaporte
                         * Estos numeros son para el tipo de documento del cardholder. No viene en los datos.
                         * */
						$documentTypes    = array(
							'dni'       => '0',
							'carnet'    => '1',
							'pasaporte' => '2'
						);
						$selectedDocument = get_user_meta($order->get_customer_id(), 'billing_documento', true);
						//$documentType          = $documentTypes[ $selectedDocument ];
						$documentNumberField      = $selectedDocument == 'carnet' ? 'extranjeria' : $selectedDocument;
						$documentNumber  = get_user_meta($order->get_customer_id(), 'billing_' . $documentNumberField, true);
						$total             = $order->get_total();
						$recurrence = array(
							'type'                 => $recurrenceType,
							'frequency'            => get_post_meta($product['product_id'], 'RADAR_RECURRENCE_FREQ', true),
							'beneficiaryId'        => $documentNumber,
							'beneficiaryFirstName' => get_post_meta($order->get_id(), '_billing_first_name', true),
							'beneficiaryLastName'  => get_post_meta($order->get_id(), '_billing_last_name', true),
							'maxAmount'            => $total,
							'amount'               => $total
						);
						$save       = $this->registerLog == 'yes' ? '1' : '0';
						//$merchant   = $this->merchantIdPEN;
						//                        $isRecurrence = $this->validateRecurrence($order_items);

						$cardHolder = array(
							'documentType'   => '0',
							'documentNumber' => str_pad($order->get_id(), 8, '0', STR_PAD_LEFT)
						);
						$response = $niubizFunction->generateAuthorizationPW($this->environment, $countable, $order->get_total(), $currency, $order->get_id(), $transactionToken, $productId, $merchant, $token, $cardHolder, $recurrence, $save);
						//                        var_dump($response);
						//                        die();
						if ($niubizFunction->responseStatus == 200 && !isset($response->errorCode)) {
							$data = $response->dataMap;
						} elseif (isset($response->data)) {
							$data = $response->data;
						}
						if (isset($data->ACTION_CODE) && !isset($response->errorCode)) {
							$statusOrderMessage = 'Su pedido ha sido procesado.';
							$actionCode         = $data->ACTION_CODE;

							$message         = isset($data->RECURRENCE_SRV_MESSAGE) ? $data->RECURRENCE_SRV_MESSAGE : $data->ACTION_DESCRIPTION;
							$card            = isset($data->CARD) ? $data->CARD : null;
							$brand           = isset($data->BRAND) ? $data->BRAND : null;
							$c               = str_split($data->TRANSACTION_DATE, 2);
							$transactionDate = $c[0] . "-" . $c[1] . "-" . $c[2] . " " . $c[3] . ":" . $c[4] . ":" . $c[5];
							$transactionId   = isset($data->TRANSACTION_ID) ? $data->TRANSACTION_ID : null;
							$order->update_status($this->status);
							if ($data->ACTION_CODE == "000") {
								$order->update_status($this->status);
							} else {
								$order->update_status('failed');
							}
							$order->add_order_note("Pago con tarjeta (Niubiz)\n
                        * Mensaje: {$message}\n
                        * Tarjeta: {$card}\n
                        * Marca: {$brand}\n
                        * Transaction ID: {$transactionId}\n");

							$nombreTabla   = $wpdb->prefix . "niubiz_recurrent_payment";
							$full_response = json_encode($response);
							$ms_queries    = "INSERT INTO $nombreTabla (`actionCode`, `purchaseNumber`, `amount`, `card`, `brand`, `transactionId`, `transactionDate`, `message`, `currency`, `full_response`)
                        VALUES ('{$actionCode}', '{$order->get_id()}', '{$order->get_total()}', '{$card}', '{$brand}', '{$transactionId}', '{$transactionDate}', '{$message}', '{$currency}', '{$full_response}')";
							$wpdb->query($ms_queries);
						} else {
							$message       = isset($response->errorMessage) ? $response->errorMessage : null;
							$transactionId = isset($response->header->ecoreTransactionUUID) ? $response->header->ecoreTransactionUUID : null;
							if (isset($response->header->ecoreTransactionDate)) {
								$c               = str_split($response->header->ecoreTransactionDate, 2);
								$transactionDate = $c[0] . "-" . $c[1] . "-" . $c[2] . " " . $c[3] . ":" . $c[4] . ":" . $c[5];
							} else {
								$transactionDate = null;
							}

							$nombreTabla   = $wpdb->prefix . "niubiz_recurrent_payment";
							$full_response = json_encode($response);
							$ms_queries    = "INSERT INTO $nombreTabla (`purchaseNumber`, `amount`, `transactionId`, `transactionDate`, `message`, `currency`, `full_response`)
                        VALUES ('{$order->get_id()}', '{$order->get_total()}', '{$transactionId}', '{$transactionDate}', '{$message}', '{$currency}', '{$full_response}')";
							$wpdb->query($ms_queries);
							$order->update_status('failed');
						}
					} else {
						$this->showMessage('Moneda no válida');

						return;
					}
				}
			}
			wp_redirect($order->get_checkout_order_received_url());
			die();
		}

		/** PAGINA DE RETORNO **/
		function thankyou_page($order_id)
		{
			global $wpdb;
			$select = "SELECT * FROM {$wpdb->prefix}niubiz_recurrent_payment WHERE purchaseNumber = {$order_id} ORDER BY id DESC LIMIT 1";
			$query  = $wpdb->get_results($select);
			if (count($query) > 0) {
				$result = array_pop($query);
				if (isset($result->actionCode) && $result->actionCode === "000") {
					$select = "SELECT * FROM {$wpdb->prefix}regalos_queue WHERE id_orden = {$order_id} ORDER BY id DESC LIMIT 1";
					//$query  = $wpdb->get_results( $select );
					$gift_result = $wpdb->get_results($select);
					if (!$gift_result) {
						$this->setAffiliationData($order_id, $result);
					}
				}
				$client         = get_post_meta($order_id, '_billing_first_name', true) . " " . get_post_meta($order_id, '_billing_last_name', true);
				$currencySymbol = $result->currency == 'PEN' ? 'S/' : '$';

				$transactionDate = date('d/m/Y H:i:s', strtotime($result->transactionDate));

				$html = "<div class='row'><div class='col-md-6'><div class='row custom_row'>";
				$html .= "<div class='col-md-12'><b>Cliente: </b>{$client}</div>";
				$html .= "<div class='col-md-12'><b>Fecha y Hora: </b>{$transactionDate}</div>";
				//$html .= "<div class='col-md-12'><b>Tarjeta: </b>{$card}</div>";
				if (isset($result->brand)) {
					$html .= "<div class='col-md-12'><b>Marca: </b>{$result->brand}</div>";
				}
				if (isset($result->actionCode)) {
					$html .= "<div class='col-md-12'><b>Mensaje: </b>{$result->message}</div>";
				} else {
					$html .= "<div class='col-md-12'><b>Mensaje: </b>No se pudo finalizar la transacción</div>";
				}
				$html .= "<div class='col-md-12'><b>Monto con tarjeta: </b>{$currencySymbol}{$result->amount}</div>";
				$html .= "<div class='col-md-12'><b>Moneda: </b>{$result->currency}</div>";
				if (isset($result->actionCode)) {
					$html .= "<div class='col-md-12'><b>ID Transacción: </b>{$result->transactionId}</div>";
					// $html .= "<div class='col-md-12'><a href='{$this->urlTyC}' target='_blank'>Términos y condiciones</a></div>";
					
				}
				$html .= "</div></div></div><br>'";
				echo $html;
			}
		}

		public function unsuscribe($subscriptionId, $beneficiaryId)
		{
			$niubizFunction = new RadarNiubizFunction();
			$env            = $this->environment;
			$terminalId     = '00000001';
			$merchantId     = $this->merchantIdPEN;
			$merchantName   = "Isilgo";
			$datetime       = date('ymdHis');
			$currencyId     = 604;
			$channelId      = 6;
			$amount         = 0;
			$dataMap        = array(
				'merchantId'    => $this->merchantIdPEN,
				'productCode'   => $subscriptionId,
				'channelId'     => $channelId,
				'beneficiaryId' => $beneficiaryId
			);
			$save       = $this->registerLog == 'yes' ? '1' : '0';
			$token = $niubizFunction->generateTokenPW($this->environment, $this->user, $this->pwd, false);
			$response       = $niubizFunction->generateDisaffiliation($env, $terminalId, $merchantId, $merchantName, $datetime, $currencyId, $channelId, $amount, $dataMap, $token, $save);
			return $response;
		}

		private function setAffiliationData($order_id, $transactionResult)
		{
			$order = wc_get_order($order_id);
			$selectedDocument = get_user_meta($order->get_customer_id(), 'billing_documento', true);
			$documentNumberField = $selectedDocument == 'carnet' ? 'extranjeria' : $selectedDocument;
			$documentNumber  = get_user_meta($order->get_customer_id(), 'billing_' . $documentNumberField, true);
			$items = $order->get_items();
			$product = reset($items);

			$meses = get_membership_frequency($product['product_id']);
            $dias = $meses == 12 ? 365 : $meses * 30;

			update_field('fecha_suscripcion', date('Y-m-d', strtotime($transactionResult->transactionDate)), 'user_' . $order->get_user_id());
			update_field('fecha_expiracion', date('Y-m-d', strtotime($transactionResult->transactionDate . '+' . $dias . ' days')), 'user_' . $order->get_user_id());
			update_field('id_membresia', $product['product_id'], 'user_' . $order->get_user_id());
			update_field('orden_de_compra', $order->get_id(), 'user_' . $order->get_user_id());
			update_field('membresia', true, 'user_' . $order->get_user_id());
			update_field('nro_documento', $documentNumber, 'user_' . $order->get_user_id());

			try {
				$affiliationId = $this->getCurrentSubscriptionId($transactionResult->transactionDate, $documentNumber);
				if ($affiliationId) {
					update_field('id_afiliacion', $affiliationId, 'user_' . $order->get_user_id());
				}
			} catch (Exception $e) {
				$logger = wc_get_logger();
				$context = array('source' => 'radar_niubiz');
				$logger->info('Error al conseguir id de afiliación: ' . $e->getMessage(), $context);
			}
		}

		public function getCurrentSubscriptionId($transactionDate, $documentNumber)
		{
			$niubizFunction = new RadarNiubizFunction();
			$env = $this->environment;
			$terminalId = "00000001";
			$merchantId = $this->merchantIdPEN;
			$merchantName = "Isilgo";
			$dateTime = date('ymdHis');
			$dataMap = array(
				'channelAffiliation' => null,
				'affiliationDateFrom' => date('Y-m-d', strtotime($transactionDate)),
				'affiliationDateTo' => date('Y-m-d', strtotime($transactionDate)),
				'merchantId' => $this->merchantIdPEN,
				'channelId' => 6
			);
			$save       = $this->registerLog == 'yes' ? '1' : '0';
			$token = $niubizFunction->generateTokenPW($this->environment, $this->user, $this->pwd, false);
			$list = $niubizFunction->getAffiliationList($env, $terminalId, $merchantId, $merchantName, $dateTime, $dataMap, $token, $save);
			if (isset($list->dataMap->messageResponse->body->comercioListadoAfiliacionResponse)) {
				$affiliations = $list->dataMap->messageResponse->body->comercioListadoAfiliacionResponse;
				foreach ($affiliations as $affiliation) {
					if ($documentNumber == $affiliation->idBeneficiario  && 0 == $affiliation->estadoAfiliacion) {
						return $affiliation->idAfiliacion;
					}
				}
			}
			return false;
		}

		public function isAffiliationActive($beneficiaryId, $affiliationId, $transactionDate, $productId)
		{
			$niubizFunction = new RadarNiubizFunction();
			$env = $this->environment;
			$terminalId = "00000001";
			$merchantId = $this->merchantIdPEN;
			$merchantName = "Isilgo";
			$dateTime = date('ymdHis');
			$dataMap = array(
				'channelAffiliation' => null,
				'affiliationDateFrom' => $transactionDate,
				'affiliationDateTo' => $transactionDate,
				'merchantId' => $this->merchantIdPEN,
				'beneficiaryId' => $beneficiaryId,
				'channelId' => 6
			);
			$save = $this->registerLog == 'yes' ? '1' : '0';
			$token = $niubizFunction->generateTokenPW($this->environment, $this->user, $this->pwd, false);
			$list = $niubizFunction->getAffiliationList($env, $terminalId, $merchantId, $merchantName, $dateTime, $dataMap, $token, $save);
			if (isset($list->dataMap->messageResponse->body->comercioListadoAfiliacionResponse)) {
				$affiliations = $list->dataMap->messageResponse->body->comercioListadoAfiliacionResponse;
				foreach ($affiliations as $affiliation) {
					if (0 == $affiliation->estadoAfiliacion && $productId == $affiliation->codProducto && $affiliationId == $affiliation->idAfiliacion) {
						return true;
					}
				}
			}
			return false;
		}

		public function hasValidCharge($from, $to, $beneficiaryId, $niubizProductId)
		{
			$niubizFunction = new RadarNiubizFunction();
			$env = $this->environment;
			$terminalId = "00000001";
			$merchantId = $this->merchantIdPEN;
			$merchantName = "Isilgo";
			$dateTime = date('ymdHis');
			$dataMap = array(
				'channelAffiliation' => 6,
				'requestDateFrom' => $from,
				'requestDateTo' => $to,
				'merchantId' => $this->merchantIdPEN,
				'channelId' => 6,
				'beneficiaryId' => $beneficiaryId
			);
			$save = $this->registerLog == 'yes' ? '1' : '0';
			$token = $niubizFunction->generateTokenPW($this->environment, $this->user, $this->pwd, false);
			$chargesRequest = $niubizFunction->getAffiliatedCharges($env, $terminalId, $merchantId, $merchantName, $dateTime, $dataMap, $token, $save);

			if ($chargesRequest->status === '000') {
				$charges = $chargesRequest->dataMap->messageResponse->body;
				foreach ($charges->comercioListadoCargoResponse as $charge) {
					if ($charge->codProducto == $niubizProductId && $charge->estadoCargo == 5) {
						return true;
					}
				}
			}
			return false;
		}
	}

	/**
	 * AGREGAMOS EL MÉTODO DE PAGO NIUBIZ
	 **/
	add_filter('woocommerce_payment_gateways', 'woocommerce_add_radar_niubiz');

	function woocommerce_add_radar_niubiz($methods)
	{
		$methods[] = 'WC_Radar_Niubiz';

		return $methods;
	}

	add_filter('woocommerce_available_payment_gateways', 'set_recurrent_gateway', 1, 1000);

	function set_recurrent_gateway($gateways)
	{
		global $wp;
		global $woocommerce;
		if (is_checkout() || !empty($wp->query_vars['order-pay'])) {
			if (isset($gateways['radar_niubiz'])) {
				if ((isset($woocommerce->session) && $woocommerce->session->get('es_regalo_form') == true) || (isset($_SESSION['es_regalo_form']) && $_SESSION['es_regalo_form'] == true)) {
					unset($gateways['radar_niubiz']);
				} else {
					$recurrent_category = get_term_by('slug', 'suscripciones', 'product_cat');
					$is_recurrent       = false;
					if (!empty($wp->query_vars['order-pay'])) {
						$order = wc_get_order($wp->query_vars['order-pay']);
						$items = $order->get_items();
					} else {
						$items = $woocommerce->cart->get_cart();
					}
					foreach ($items as $item) {
						if (!empty($wp->query_vars['order-pay'])) {
							$product      = wc_get_product($item->get_product_id());
							$category_ids = $product->get_category_ids();
							$product_id   = $product->get_id();
						} else {
							if (is_a($item['data'], 'WC_Product_Variation')) {
								$product_id   = $item['data']->get_parent_id();
								$category_ids = wc_get_product_cat_ids($product_id);
							} else {
								$category_ids = $item['data']->get_category_ids();
								$product_id   = $item['data']->get_id();
							}
						}
						if (in_array($recurrent_category->term_id, $category_ids) || get_post_meta($product_id, 'RADAR_RECURRENCE_YES', true) == 'yes') {
							$is_recurrent = true;


							if (!empty(get_post_meta($product_id, 'RADAR_RECURRENCE_FREQ', true)) && !empty(get_post_meta($product_id, 'RADAR_PRODUCT_CODE', true))) {
								return array('radar_niubiz' => $gateways['radar_niubiz']);
							}
						}
					}

					if (!$is_recurrent) {
						unset($gateways['radar_niubiz']);
					}
				}
			}
		}
		return $gateways;
	}
}

/** AGREGAMOS LAS OPCIONES ADICIONALES PARA LOS PRODUCTOS **/
add_action('woocommerce_product_write_panel_tabs', 'tabRecurrence');

function tabRecurrence()
{ ?>
	<style>
		#woocommerce-coupon-data ul.wc-tabs li.custom_tab a::before,
		#woocommerce-product-data ul.wc-tabs li.custom_tab a::before,
		.woocommerce ul.wc-tabs li.custom_tab a::before {
			font-family: WooCommerce;
			content: "\e01e";

		}
	</style>
	<li class="custom_tab">
		<a href="#tabRecurrence"><span>Suscripcion recurrente</span></a>
	</li>
<?php
}

function tabRecurrence_product_tab_content()
{
?>
	<div id='tabRecurrence' class='panel woocommerce_options_panel'>
		<div class='options_group'>
			<h2><b>Configuración de cargos recurrentes</b></h2>
			<?php

			woocommerce_wp_checkbox(array(
				'id'      => 'RADAR_RECURRENCE_YES',
				'label'   => 'Es una suscripción recurrente',
				'default' => 'no'
			));

			woocommerce_wp_select(array(
				'id'      => 'RADAR_RECURRENCE_FREQ',
				'label'   => 'Frecuencia',
				'options' => array(
					""          => "SELECCIONE FRECUENCIA",
					"MONTHLY"   => "MENSUAL",
					"QUARTERLY" => "TRIMESTRAL",
					"BIANNUAL"  => "SEMESTRAL",
					"ANNUAL"    => "ANUAL"
				)
			));

			woocommerce_wp_text_input(array(
				'id'          => 'RADAR_PRODUCT_CODE',
				'label'       => 'Código de producto',
				'type'        => 'text',
				'desc_tip'    => 'true',
				'description' => 'Código registrado en el portal Niubiz',
			));
			?>
		</div>
	</div>
<?php
}

add_filter('woocommerce_product_data_panels', 'tabRecurrence_product_tab_content');

function save_recurrence_info($post_id)
{
	$woocommerce_mc_es_recurrente = isset($_POST['RADAR_RECURRENCE_YES']) ? 'yes' : 'no';
	update_post_meta($post_id, 'RADAR_RECURRENCE_YES', $woocommerce_mc_es_recurrente);

	$woocommerce_mc_frecuencia_recurrencia = $_POST['RADAR_RECURRENCE_FREQ'];
	if (!empty($woocommerce_mc_frecuencia_recurrencia)) {
		update_post_meta($post_id, 'RADAR_RECURRENCE_FREQ', esc_attr($woocommerce_mc_frecuencia_recurrencia));
	}

	$woocommerce_mc_codigo_producto = $_POST['RADAR_PRODUCT_CODE'];
	if (!empty($woocommerce_mc_codigo_producto)) {
		update_post_meta($post_id, 'RADAR_PRODUCT_CODE', esc_attr($woocommerce_mc_codigo_producto));
	}
}

add_action('woocommerce_process_product_meta_simple', 'save_recurrence_info');
add_action('woocommerce_process_product_meta_variable', 'save_recurrence_info');

add_action('wp_ajax_desuscribir', 'unsuscribe');

function unsuscribe()
{
	$customer = wp_get_current_user();

	if (md5($customer->ID) == $_POST['input'] && wp_verify_nonce($_POST['hash'], 'user_unsuscribe')) {
		if (unsuscribe_action($customer)) {
			$message = array('success' => true, 'message' => 'Desafiliación exitosa');
		} else {
			$message = array('success' => false, 'message' => 'no ha sido posible realizar esta operación');
		}
	}
	wp_send_json($message);
	//
	//	update_field('fecha_suscripcion', date('Y-m-d'), 'user_' . $customer->ID);
	//	update_field('fecha_expiracion', '', 'user_' . $customer->ID );
	//	update_field('id_membresia', $product['product_id'], 'user_' . $customer->ID);
	//	update_field('orden_de_compra', $order->get_id(), 'user_' . $order->get_user_id());
	die();
}

function unsuscribe_action($customer)
{
	if (!class_exists('WC_Radar_Niubiz')) {
		radar_niubiz_init();
	}
	$radar_niubiz = new WC_Radar_Niubiz();
	$course_id    = get_field('id_membresia', 'user_' . $customer->ID);
	$purchased    = get_field('mis_cursos', 'user_' . $customer->ID);
	$row          = null;
	foreach ($purchased as $index => $item) {
		if ($item['curso'] == $course_id) {
			$row = $index + 1; //ACF usa indices base 1
			break;
		}
	}
	$product_id_niubiz = get_post_meta($course_id, 'RADAR_PRODUCT_CODE', true);
	$order_id = get_field('orden_de_compra', 'user_' . $customer->ID);
	$beneficiary_id  = get_beneficiary_id($order_id);
    //Validar que afiliacion aun esta activa
    $beneficiary_id = get_beneficiary_id($order_id);
	$affiliationid = get_field('id_afiliacion', 'user_' . $customer->ID);
	$affiliationDate = get_field('fecha_suscripcion', 'user_' . $customer->ID);
	$productId = get_field('id_membresia', 'user_' . $customer->ID);
    $remove_membership = false;
    if($radar_niubiz->isAffiliationActive($beneficiary_id, $affiliationid, $affiliationDate, $productId)){
	    $response = $radar_niubiz->unsuscribe($product_id_niubiz, $beneficiary_id);
	    if ($response && isset($response->dataMap->messageResponse->header->status->busResponseType) && "0" == $response->dataMap->messageResponse->header->status->busResponseType) {
	        $remove_membership = true;
        }
    } else {
	    $remove_membership = true;
    }
    if($remove_membership){
	    update_field('membresia', false, 'user_' . $customer->ID);
	    if ($row) {
		    delete_row('mis_cursos', $row, 'user_' . $customer->ID);
	    }
	    return true;
    }
	return false;
}

add_action('wp_login', 'check_membership', 99, 2);

//add_action('wp_ajax_nopriv_test-check', 'check_membership');

function check_membership($user_login, $user)
{
	//user = get_user_by('id', 8);
	$check_membresia = get_field('membresia', 'user_' . $user->ID);
	if ($check_membresia) {
		$charge_date = date('Y-m-d', strtotime(get_field('fecha_expiracion', 'user_' . $user->ID)));
		$today = date('Y-m-d');

		if ($today >= $charge_date && $check_membresia) {
			$from = date('Y-m-d', strtotime($charge_date . ' -2 days'));
			$expiration_date = date('Y-m-d', strtotime($charge_date . ' +7 days'));
			if (!class_exists('WC_Radar_Niubiz')) {
				radar_niubiz_init();
			}
			$orderId = get_field('orden_de_compra', 'user_' . $user->ID);
			$beneficiaryId = get_beneficiary_id($orderId);
			$affiliationid = get_field('id_afiliacion', 'user_' . $user->ID);
			$affiliationDate = get_field('fecha_suscripcion', 'user_' . $user->ID);
			$productId = get_field('id_membresia', 'user_' . $user->ID);
			$niubizProductId = get_post_meta($productId, 'RADAR_PRODUCT_CODE', true);
			$radar_niubiz = new WC_Radar_Niubiz();
			if ($radar_niubiz->isAffiliationActive($beneficiaryId, $affiliationid, $affiliationDate, $niubizProductId)) {
				if ($radar_niubiz->hasValidCharge($from, $today, $beneficiaryId, $niubizProductId)) {
					//                    die('encontré cargo y voy a renovar por la cantidad de meses');
					$months = get_membership_frequency($productId);
					update_field('fecha_expiracion', date('Y-m-d', strtotime($charge_date . '+' . $months . ' months')), 'user_' . $user->ID);
				} elseif ($today > $expiration_date) {
					//                    die('no encontré ningún pago y voy a cancelarle la recurrencia');
					$unsuscribe = unsuscribe_action($user);
					if ($unsuscribe) {
						$course_id    = get_field('id_membresia', 'user_' . $user->ID);
						$purchased    = get_field('mis_cursos', 'user_' . $user->ID);
						$row          = null;
						foreach ($purchased as $index => $item) {
							if ($item['curso'] == $course_id) {
								$row = $index + 1; //ACF usa indices base 1
								break;
							}
						}
						delete_row('mis_cursos', $row, 'user_' . $user->ID);
						update_field('membresia', false, 'user_' . $user->ID);
					}
				} else {
					//                    die('no se encuentra cargo, pero aun esta en fecha de estar activo');
				}
			} else {
				update_field('membresia', false, 'user_' . $user->ID);
			}
		}
	}
}

function get_beneficiary_id($order_id)
{
	$selectedDocument = get_post_meta($order_id, 'billing_documento', true);
	$documentNumberField = $selectedDocument == 'carnet' ? 'extranjeria' : $selectedDocument;
	return get_post_meta($order_id, 'billing_' . $documentNumberField, true);
}

function get_membership_frequency($productId)
{
	$frequency = get_post_meta($productId, 'RADAR_RECURRENCE_FREQ', true);

	switch ($frequency) {
		case "MONTHLY":
			return 1;
		case "QUARTERLY":
			return 3;
		case "BIANNUAL":
			return 6;
		case "ANNUAL":
			return 12;
	}
}
