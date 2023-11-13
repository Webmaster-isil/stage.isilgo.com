<?php 

    require_once( '../../../wp-load.php' );

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $cip = $data->cip;
    $nroPedido = $data->operationNumber;
    $status = $data->status;

    global $wpdb, $woocommerce;
    $nombreTabla = $wpdb->prefix."niubiz_pagoefectivo";
    $sql = "SELECT * from $nombreTabla where cip = $cip";
    $result = $wpdb->get_results($sql);
    $config = get_option("woocommerce_niubiz_settings");
    if ($config['registerLog'] == 'yes') {
      $niubizFunction = new NiubizFunction();
      $niubizFunction->saveLog('PagoEfectivo', $json);
    }
    // Validamos status
    if ($result[0]->status == '') {
      $order = new WC_Order($result[0]->wcOrderId);
      // Actualizar orden
      $order->update_status($status=='Paid' ? $config['estadoPagadoPE'] : 'failed');
      $order->add_order_note("PagoEfectivo\noperationNumber: {$nroPedido}\nstatus: {$status}");
      if ($status == 'Paid') {$order->reduce_order_stock();}
      // Actualizar BD
      $wpdb->update($nombreTabla,array('nroPedido' => $nroPedido,'status' => $status),array( 'ID' => $result[0]->ID ));
    } else {
      echo "La orden ya fue procesada";
    }

?>