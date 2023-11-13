<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', '¡Has recibido un regalo!', null ); ?>

<?php /* translators: %s: Customer first name */ ?>
	<p><?php printf( ( '¡Hola <b>%s</b>!,'), esc_html( $args['nombre_destinatario'] ) ); ?></p>

	<p><?php echo $args['parrafo_regalo'] ?></p>
    <p><?php printf('Si no tienes una cuenta en ISIL Go, por favor regístrate en nuestro sitio web <a href="%s">aquí.</a>', $args['register']) ?></p>
    <p><b>Mensaje personalizado enviado por el comprador:</b></p>
    <p style="padding: 5px 15px; background-color: #eeeeee">"<em><?php echo nl2br($args['mensaje']) ?>"</em></p>

<?php
do_action( 'woocommerce_email_footer',  null );
