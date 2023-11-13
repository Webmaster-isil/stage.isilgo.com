<?php

/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form'); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?>>

	<?php do_action('woocommerce_edit_account_form_start'); ?>

	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
		<label for="account_first_name"><?php esc_html_e('First name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text form-control input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr($user->first_name); ?>" />
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
		<label for="account_last_name"><?php esc_html_e('Last name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text form-control input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr($user->last_name); ?>" />
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-first">
		<label for="account_display_name"><?php esc_html_e('Display name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text form-control input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr($user->display_name) ?>" /></span>
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-last">
		<label for="account_phone"><?php esc_html_e('Teléfono', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
		<input type="tel" class="woocommerce-Input woocommerce-Input--text form-control input-text" name="account_phone" id="account_phone" value="<?php echo get_field('telefono', 'user_' . $user->id); ?>" />
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-first">
		<label for="account_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
		<input type="hidden" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr($user->user_email); ?>" />
		<span><?php echo esc_attr($user->user_email); ?></span>
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-last">
		<label for="account_bithday"><?php esc_html_e('Fecha de Nacimiento', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
		<input type="date" class="woocommerce-Input woocommerce-Input--email form-control input-text" name="account_bithday" id="account_bithday" value="<?php echo get_field('fecha_de_nacimiento_isil', 'user_' . $user->id); ?>" />
	</p>

	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-first">
		<label for="account_dni">
			<?php $tipo = get_user_meta($user->id, 'billing_documento', true);
			if ($tipo == 'dni') {
				echo 'DNI';
			}
			?>
		</label>
		<span><?php echo get_user_meta($user->id, 'billing_' . $tipo, true); ?></span>

	</p>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-last">
		<label for="account_grado"><?php esc_html_e('Grado de Instrucción', 'woocommerce'); ?> &nbsp;<span class="required">*</span></label>
		<?php $grado = get_field('grado_isil', 'user_' . $user->id); ?>
		<select required class="woocommerce-Input woocommerce-Input--email form-control input-text" name="account_grado" id="account_grado">
			<option value="">...</option>
			<option <?php if ($grado == 'Secundaria') {
						echo 'selected';
					} ?> value="Secundaria">Secundaria</option>
			<option <?php if ($grado == 'Técnico completo') {
						echo 'selected';
					} ?> value="Técnico completo">Técnico completo</option>
			<option <?php if ($grado == 'Técnico incompleto') {
						echo 'selected';
					} ?> value="Técnico incompleto">Técnico incompleto</option>
			<option <?php if ($grado == 'Universitario completo') {
						echo 'selected';
					} ?> value="Universitario completo">Universitario completo</option>
			<option <?php if ($grado == 'Universitario incompleto') {
						echo 'selected';
					} ?> value="Universitario incompleto">Universitario incompleto</option>
			<option <?php if ($grado == 'Maestría') {
						echo 'selected';
					} ?> value="Maestría">Maestría</option>
			<option <?php if ($grado == 'Doctorado') {
						echo 'selected';
					} ?> value="Doctorado">Doctorado</option>
		</select>
	</p>

	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-first">
		<label for="account_situacion"><?php esc_html_e('Situación Laboral', 'woocommerce'); ?> &nbsp;<span class="required">*</span></label>
		<?php $situacion = get_field('situacion_isil', 'user_' . $user->id); ?>
		<select required class="woocommerce-Input woocommerce-Input--email form-control input-text" name="account_situacion" id="account_situacion">
			<option value="">...</option>
			<option <?php if ($situacion == 'Trabajo dependiente') {
						echo 'selected';
					} ?> value="Trabajo dependiente">Trabajo dependiente</option>
			<option <?php if ($situacion == 'Trabajo independiente') {
						echo 'selected';
					} ?> value="Trabajo independiente">Trabajo independiente</option>
			<option <?php if ($situacion == 'Desempleado(a)') {
						echo 'selected';
					} ?> value="Desempleado(a)">Desempleado(a)</option>
			<option <?php if ($situacion == 'Jubilado(a)') {
						echo 'selected';
					} ?> value="Jubilado(a)">Jubilado(a)</option>
			<option <?php if ($situacion == 'Amo(a) de casa') {
						echo 'selected';
					} ?> value="Amo(a) de casa">Amo(a) de casa</option>
		</select>
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-last">
		<input type="hidden" readonly class="woocommerce-Input woocommerce-Input--email form-control input-text" name="account_company" id="account_company" value="<?php echo esc_attr($user->first_name) . ' ' . esc_attr($user->last_name); ?>" />
	</p>
	<div class="clear"></div>
	<?php $cates = get_categories(array('taxonomy' => 'product_cat'));
	if ($cates) { ?>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-first">
			<label for="account_interes_1"><?php esc_html_e('Interés 1', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
			<select required class="woocommerce-Input woocommerce-Input--email form-control input-text" name="account_interes_1" id="account_interes_1">
				<option value="">...</option>
				<?php foreach ($cates as $key => $cat) { ?>
					<option <?php if ($cat->name == get_field('interes_1_isil', 'user_' . $user->id)) {
								echo 'selected';
							} ?> value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
				<?php } ?>
			</select>
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-last">
			<label for="account_interes_2"><?php esc_html_e('Interés 2', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
			<select required class="woocommerce-Input woocommerce-Input--email form-control input-text" name="account_interes_2" id="account_interes_2">
				<option value="">...</option>
				<?php foreach ($cates as $key => $cat) { ?>
					<option <?php if ($cat->name == get_field('interes_2_isil', 'user_' . $user->id)) {
								echo 'selected';
							} ?> value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
				<?php } ?>
			</select>
		</p>
		<div class="clear"></div>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-first">
			<label for="account_interes_3"><?php esc_html_e('Interés 3', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
			<select required class="woocommerce-Input woocommerce-Input--email form-control input-text" name="account_interes_3" id="account_interes_3">
				<option value="">...</option>
				<?php foreach ($cates as $key => $cat) { ?>
					<option <?php if ($cat->name == get_field('interes_3_isil', 'user_' . $user->id)) {
								echo 'selected';
							} ?> value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
				<?php } ?>
			</select>
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-last">
			<label for="account_interes_4"><?php esc_html_e('Interés 4', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
			<select required class="woocommerce-Input woocommerce-Input--email form-control input-text" name="account_interes_4" id="account_interes_4">
				<option value="">...</option>
				<?php foreach ($cates as $key => $cat) { ?>
					<option <?php if ($cat->name == get_field('interes_4_isil', 'user_' . $user->id)) {
								echo 'selected';
							} ?> value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
				<?php } ?>
			</select>
		</p>

		<div class="clear"></div>
	<?php } ?>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_linkedIn"><?php esc_html_e('LinkedIn URL', 'woocommerce'); ?></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--email form-control input-text" name="account_linkedIn" id="account_linkedIn" value="<?php echo get_field('linkedin', 'user_' . $user->id); ?>" />
	</p>

	<?php do_action('woocommerce_edit_account_form'); ?>

	<p>
		<br>
		<?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
		<button type="submit" class="woocommerce-Button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="save_account_details" value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>"><?php esc_html_e('Save changes', 'woocommerce'); ?></button>
		<input type="hidden" name="action" value="save_account_details" />
	</p>




	<?php do_action('woocommerce_edit_account_form_end'); ?>
</form>

<?php do_action('woocommerce_after_edit_account_form'); ?>