<?php
/**
 * Email Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-addresses.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 5.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$text_align = is_rtl() ? 'right' : 'left';
$address    = $order->get_formatted_billing_address();
$shipping   = $order->get_formatted_shipping_address();

?><table id="addresses" cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top; margin-bottom: 20px; padding:0;" border="0">
	<tr>
		<td style="text-align:<?php echo esc_attr( $text_align ); ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; border:0; padding:0;" valign="top" width="50%">
			<!-- <h2><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></h2> -->
			<h2 style="margin-top: 20px;">INFORMACIÓN DE CLIENTE</h2>

			<address class="address">
				<?php
					$first_name = $order->get_billing_first_name();
					$last_name = $order->get_billing_last_name();
					$email = $order->get_billing_email();
					$phone = $order->get_billing_phone();
					$order_date = $order->get_date_created();
					setlocale(LC_TIME, 'es_ES.utf8');
				?>
				<p>
					<strong>Nombre:</strong> <?php echo esc_html($first_name . ' ' . $last_name); ?>
				</p>
				<p>
					<strong>Email:</strong> <a href="mailto:<?php echo esc_html($email); ?>" target="_blank"><?php echo esc_html($email); ?></a>
				</p>
				<p>
					<strong>Teléfono de contacto:</strong> <?php echo wc_make_phone_clickable($phone); ?>
				</p>
				<p style="margin: 0 0 16px;	border-top: none;	text-align: left; padding-top: 0;">
					<strong>Fecha de orden:</strong> <?php echo strftime('%B %d de %Y', strtotime($order_date->format('Y-m-d H:i:s'))); ?>
				</p>
			</address>
		</td>
		<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && $shipping ) : ?>
			<td style="text-align:<?php echo esc_attr( $text_align ); ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; padding:0;" valign="top" width="50%">
				<h2><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></h2>

				<address class="address">
					<?php echo wp_kses_post( $shipping ); ?>
					<?php if ( $order->get_shipping_phone() ) : ?>
						<br /><?php echo wc_make_phone_clickable( $order->get_shipping_phone() ); ?>
					<?php endif; ?>
				</address>
			</td>
		<?php endif; ?>
	</tr>
</table>
