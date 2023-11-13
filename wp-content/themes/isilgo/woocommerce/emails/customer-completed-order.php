<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
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
?>




<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
	</head>
	<body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
		
		<table width="100%" id="outer_wrapper" class="header-mail-isilgo">
			<tr>
				<td><!-- Deliberately empty to support consistent sizing and layout across multiple email clients. --></td>
				<td width="600">
					<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
						<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
							<tr>
								<td align="center" valign="top">
									<div id="template_header_image">
										<?php
										$img = get_option( 'woocommerce_email_header_image' );

										if ( $img ) {
											echo '<p style="margin-top:0;"><img src="' . esc_url( $img ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" /></p>';
										}
										?>
									</div>
									<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_container">
										<tr>
											<td align="center" valign="top">
												<!-- Header -->
												<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_header">
													<tr>														
														<!--VERIFICAR LA CATEGORIA DE PRODUCTO-->
														<?php
															$items = $order->get_items();
															$contador = 0;
															foreach ($items as $item_id => $item_data) {
																$producto = $item_data->get_product();
																$product_name = $item_data->get_name();
																$contador = $contador + 1;
																if($contador == 1){
																	$product_categories = wc_get_product_category_list($producto->get_id());
																}
															}
															$category_name = strip_tags($product_categories); 
															$product_categories = trim($category_name);
															$variable = 0;
															
															if (!empty($product_categories)) {
																if ($product_categories === "Membresías") {
																	$membresia = "Suscripción a Membresía";
																	$variable = 1;
																}
															}
															if($variable == 1){
																?>
																<td id="header_wrapper">
																	<h1><?php echo $membresia;?></h1>
																</td>
																<?php
															}
															else{
																?>
																<td id="header_wrapper">
																	<h1>Compra de curso</h1>
																</td>
																<?php
															}
														?>
														<!--VERIFICAR LA CATEGORIA DE PRODUCTO-->
													</tr>
												</table>
												<!-- End Header -->
											</td>
										</tr>
										<tr>
											<td align="center" valign="top">
												<!-- Body -->
												<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_body">
													<tr>
														<td valign="top" id="body_content">
															<!-- Content -->
															<table border="0" cellpadding="20" cellspacing="0" width="100%">
																<tr>
																	<td valign="top">
																		<div id="body_content_inner">


<?php /* translators: %s: Customer first name */ ?>
<p><?php printf( esc_html__( 'Estimado %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></p>
<p><?php esc_html_e( 'We have finished processing your order.', 'woocommerce' ); ?></p>
<?php
$order_date = $order->get_date_created();
$meses = array(
    'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
    'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
);
if($variable==1){
	if (isset($order->user_id)) {
		$fecha_expiracion 	= get_user_meta($order->user_id, 'fecha_expiracion', true);
		$fecha_suscripcion 	= get_user_meta($order->user_id, 'fecha_suscripcion', true);

		$timestamp = strtotime($fecha_suscripcion);
		$dia = date('d', $timestamp);
		$mes = $meses[intval(date('m', $timestamp)) - 1];
		$año = date('Y', $timestamp);
		$fecha_suscripcion = "$dia de $mes de $año";


		$timestamp = strtotime($fecha_expiracion);
		$dia = date('d', $timestamp);
		$mes = $meses[intval(date('m', $timestamp)) - 1];
		$año = date('Y', $timestamp);
		$fecha_expiracion = "$dia de $mes de $año"; 
	}
	?>
	<p>¡Bienvenido a ISIL Go y gracias por unirte a nuestra membresía! Estamos emocionados de tenerte como 
		parte de nuestra comunidad exclusiva.
		Tu membresía ha sido activada exitosamente y a partir de ahora, tendrás acceso completo a todos 
		nuestros cursos, materiales de aprendizaje y recursos exclusivos. Te garantizamos una experiencia 
		de aprendizaje de alta calidad que te ayudará a alcanzar tus metas educativas y profesionales.
		<br>
		Aquí hay algunos detalles clave sobre tu membresía: 
		<br><br>
		Fecha de inicio de la membresía: <?php echo $fecha_suscripcion; ?><br>
		Fecha de Fin de la membresía: <?php echo $fecha_expiracion; ?>
		<br><br>
	</p>
	<?php
}
else{
	?>
	<p>Es un placer darle la bienvenida a ISIL Go, su destino de aprendizaje en línea. Nos complace mucho que 
		haya decidido invertir en su crecimiento personal y profesional al adquirir nuestro curso en línea: <br>
		<?php 	$product_name = $item_data->get_name();
				echo '"'.$product_name.'"';
		?>. <br>
		Una de las características más destacadas de nuestro curso es que su acceso es ilimitado. 
		Esto significa que no tiene que preocuparse por plazos o fechas de vencimiento. 
		Puede tomar el curso a su propio ritmo, revisar las lecciones tantas veces como desee y acceder 
		a los recursos siempre que lo necesite. 
	</p>
	<?php
}
/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
 do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );
 
/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if($variable == 1){
	?>

	<p>Queremos recordarte que tu membresía se renovará automáticamente al finalizar el período de suscripción 
		actual; sin embargo, si en algún momento deseas cancelar tu membresía, puedes hacerlo en cualquier 
		momento a través de tu cuenta en nuestro sitio web.
		Mantente al tanto de las actualizaciones, nuevos cursos y eventos especiales que tenemos preparados 
		para ti. Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos a través de nuestro 
		servicio de atención al cliente en comunidad@isilgo.pe o visitando nuestra sección de preguntas 
		frecuentes en: <br> <a href="https://isilgo.dev.radar.cl/preguntas-frecuentes/" style="color:blue">
		Preguntas Frecuentes</a>
	</p>
	<?php
}
else{
	?>
	<p>Nuevamente, le agradecemos por elegir ISIL Go como su fuente de educación en línea. 
		Estamos seguros de que este curso enriquecerá sus conocimientos y habilidades, y estamos emocionados 
		de ser parte de su éxito.
		Si tiene alguna pregunta o necesita asistencia en cualquier momento, no dude en ponerse en 
		contacto con nosotros a comunidad@isilgo.pe  estamos aquí para ayudarlo en su viaje de aprendizaje.

	</p>
	<?php
}
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}
/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );


