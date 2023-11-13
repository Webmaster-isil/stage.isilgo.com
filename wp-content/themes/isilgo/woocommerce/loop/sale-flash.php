<?php

/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

global $post, $product;

if ($product->featured == 'yes') { ?>
	<div class="destacado">Destacados</div>
<?php }



$terms = get_the_terms($post->ID, 'product_cat'); ?>
<div>
	<?php
	foreach ($terms as $key => $term) {
	?>
		<div class="cat_loop 
		<?php if ($term->slug == 'cyber') {
			echo 'cyber';
		}; ?>" style="
		<?php if ($term->slug == 'cyber') {
			echo 'top:45px;';
		} else {
			echo 'top:10px';
		} ?> "><?php echo $term->name; ?></div>

	<?php }
	?>
</div>
<?php if ($product->is_on_sale()) : ?>

		<?php
		$discount_percentage = apply_filters('advanced_woo_discount_rules_get_product_discount_percentage', 0, $product);
		if ($discount_percentage > 0) {
			echo '<div class="dcto">';
			echo $discount_percentage; // here you can get discount percentage
			echo '% Dscto</div>';
		}

		?>		

<?php
endif;
