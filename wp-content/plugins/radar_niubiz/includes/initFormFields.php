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
      'default' => 'Pagos recurrentes Niubiz'
    ),
    'description' => array(
      'title' => 'Descripción:',
      'type' => 'textarea',
      'default' => 'Suscribe tu membresía con tarjetas de crédito'
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
    /*'urlTo' => array(
      'title' => 'URL de TimeOut',
      'type' => 'text',
      'custom_attributes' => array('required'=> 'required'),
    )*/
  );