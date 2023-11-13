<?php
 return array(
    'enabled' => array(
      'title' => 'Activado/Desactivado',
      'type' => 'checkbox',
      'label' => 'Activar Módulo.',
      'default' => 'no'
    ),
    'title' => array(
      'title' => 'Título:',
      'type' => 'text',
      'default' => 'Niubiz'
    ),
    'description' => array(
      'title' => 'Descripción:',
      'type' => 'textarea',
      'default' => 'Paga con tarjeta de crédito/débito'
    ),
    'multicomercio' => array(
      'title' => 'Modo Multicomercio',
      'type' => 'checkbox',
      'label' => 'Activar modo Multicomercio.',
      'default' => 'no'
    ),
    'registerLog' => array(
      'title' => 'Log',
      'type' => 'checkbox',
      'label' => 'Activar registro de log.',
      'default' => 'no'
    ),
    'marcas' => array(
      'title' => 'Marcas',
      'type' => 'multiselect',
      'label' => 'Activar marcas.',
      'options' => array(
        'visa' => 'Visa',
        'mc' => 'MasterCard',
        'amex' => 'Amex',
        'diners' => 'Diners',
        'pe' => 'PagoEfectivo',
        'bbva' => 'Puntos/Millas'
      )
    ),
    'countable' => array(
      'title' => 'Liquidación automática',
      'type' => 'checkbox',
      'label' => 'Activar liquidación automática.',
      'default' => 'yes'
    ),
    'discountForBins' => array(
      'title' => 'Descuento por Bines',
      'type' => 'checkbox',
      'label' => 'Activar descuento por Bines.',
      'default' => 'no'
    ),
    'customButton' => array(
      'title' => 'Botón personalizado',
      'type' => 'checkbox',
      'label' => 'Activar botón personalizado.',
      'default' => 'no'
    ),
    'buttonSize' => array(
      'title' => 'Tamaño del botón',
      'type' => 'select',
      'options' => array(
        "DEFAULT" => "Defecto",
        "SMALL" => "Pequeño",
        "MEDIUM" => "Mediano",
        "LARGE" => "Grande"
      )
    ),
    'buttonColor' => array(
      'title' => 'Color del botón',
      'type' => 'select',
      'options' => array(
        "NAVY" => "Azul",
        "GRAY" => "Gris"
      )
    ),
    'payButtonColor' => array(
      'title' => 'Color del botón pagar',
      'type' => 'text',
      'default' => '#FF0000'
    ),
    'showAmount' => array(
      'title' => 'Mostrar importe',
      'type' => 'checkbox',
      'label' => 'Mostrar el importe a pagar.',
      'default' => 'yes'
    ),
    'status' => array(
      'title' => 'Estado',
      'type' => 'select',
      'options' => array("processing" => "Procesando", "completed" => "Completado"),
    ),
    'environment' => array(
      'title' => 'Ambiente',
      'type' => 'select',
      'options' => array( "S" => "Sandbox", "dev" => "Desarrollo", "prd" => "Produccion"),
    ),
    'merchantIdPEN' => array(
      'title' => 'Merchant ID Soles',
      'type' => 'text',
    ),
    'merchantIdUSD' => array(
      'title' => 'Merchant ID Dólares',
      'type' => 'text'
    ),
    'user' => array(
      'title' => 'Usuario',
      'type' => 'text',
    ),
    'password' => array(
      'title' => 'Contraseña',
      'type' => 'text',
    ),
    'ruc' => array(
      'title' => 'R.U.C.',
      'type' => 'text',
      'custom_attributes' => array('required'=> 'required'),
    ),
    'urlLogo' => array(
      'title' => 'URL de Logo',
      'type' => 'text'
    ),
    'urlTyC' => array(
      'title' => 'URL de Terminos y Condiciones',
      'type' => 'text',
      'custom_attributes' => array('required'=> 'required'),
    ),
    'urlTo' => array(
      'title' => 'URL de TimeOut',
      'type' => 'text',
      'custom_attributes' => array('required'=> 'required'),
    ),
    // PagoEfectivo
    'estadoPagadoPE' => array(
      'title' => 'Estado PagoEfectivo - CIP Pagado',
      'type' => 'select',
      'options' => array("processing" => "Procesando", "completed" => "Completado"),
    ),
    'urlPE' => array(
      'title' => 'URL Callback de PagoEfectivo',
      'type' => 'text',
      'custom_attributes' => array('readonly'=> 'readonly'),
      'default' => plugin_dir_url(dirname(__FILE__)).'pagoefectivo.php'
    ),
  );