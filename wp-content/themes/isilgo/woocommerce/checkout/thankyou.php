<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>

<div class="woocommerce-order">

	<?php
	if ($order) {
		do_action('woocommerce_before_thankyou', $order->get_id());

		if ($order->has_status('failed')) { 
			//fallado 
			?>
			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>
			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
				<?php if (is_user_logged_in()) { ?>
					<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
				<?php }; ?>
			</p>

		<?php  } else {

             //exitoso
			 if (!$order->has_status('failed') && (!$order->has_status('pending'))) {
	            api_isil_complete($order->get_id());
             } 			
			
			global $wpdb;
			$table_name = $wpdb->prefix . 'regalos_queue';

			$sql = $wpdb->prepare("SELECT * FROM {$table_name} WHERE id_orden=%d", $order->get_id());
			$results = $wpdb->get_results($sql, ARRAY_A);

			if (!$results) {
				$items = $order->get_items();
				foreach ($items as $item) {
					$id_product = $item->get_product_id();
					recienComprado($id_product, $order->get_id());
				}
			}





			$producto_gratis = false;
			foreach ($order->get_items() as $item_id => $item) {
				$total = $item->get_total();
				if ($total == 0) {
					$producto_gratis = true;
					break;
				}
			}

			if ($producto_gratis) {
				$order = new WC_Order($order->get_id());
				$order->update_status('completed');
			}

           $order_status = $order->get_status();
		?>
			<div class="col-12 text-center">
				<div class="logo-print"><img class="w-100" src="<?php echo get_field('logo', 'options'); ?>" alt="ISIL GO"></div>				
				<?php  if ($order_status === 'failed') { ?>
					<h3>Su pago <span> No se realizó  <?php echo $order_status;?></span></h3>				    
				<?php  }else{ ?>
					<h3>Su pago se <span>realizó con éxito   <?php echo $order_status;?></span></h3>
				<?php  } ?>
				
				<p>Su número de pedido es: <strong><?php echo $order->get_order_number(); ?></strong></p>
				<div class="linea_horizontal"></div>
			</div>
			<div class="col-12 text-center aling_center_detalle_pay">
				<h3>Detalles del pago</h3>
				<?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
			</div>
			<div class="col-md-8 mx-auto text-center">
				<div class="linea_horizontal"></div>
				<p>Recibirá un mensaje de correo electrónico con los detalles de su pedido y un enlace para hacer un seguimiento de su progreso</p>
				<input  style="display:none;"  type='button' onclick='window.print();' class='btn_imprimir' value='Click Acá para imprimir una copia de su boleta'>
				<p>
					<a href="<?php echo get_bloginfo('url'); ?>" class="volver_inicio">VOLVER AL INICIO</a>
				</p>
			</div>
		<?php }; ?>


	<?php  } else { ?>
		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
			<?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
			?>
		</p>
	<?php }; ?>

</div>

