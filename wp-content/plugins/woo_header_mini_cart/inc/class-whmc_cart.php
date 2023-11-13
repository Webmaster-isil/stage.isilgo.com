<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that inc attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      4.0.1
 *
 * @package    WHMC
 * @subpackage WHMC/inc
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      4.0.1
 * @package    WHMC
 * @subpackage WHMC/inc
 */
class WHMC_Cart extends WhmcfileGenerator {
	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    4.0.1
	 */

	 function __construct(){

	 	$notifications = get_option('whmc_notification');
	 	$notification_enabes_whmc = isset($notifications['notification_enabes_whmc']) ? $notifications['notification_enabes_whmc'] : 'no';
	 	add_action('wp_ajax_nopriv_item_added', array( $this , 'addedtocart_sweet_message'));
	 	
	 	add_action('wp_ajax_item_added', array( $this ,'addedtocart_sweet_message'));

	 	add_action( 'wc_ajax_ace_add_to_cart', array( $this ,'ace_ajax_add_to_cart_handler' ));

	 	add_action( 'wc_ajax_nopriv_ace_add_to_cart', array( $this ,'ace_ajax_add_to_cart_handler' ));


	 	add_filter('wc_add_to_cart_message_html', '__return_null');	 

	 	add_filter( "woocommerce_loop_add_to_cart_args", array( $this ,'filter_wc_loop_add_to_cart_args'), 20, 2 );

	 	if($notification_enabes_whmc == 'no'){

		add_action('wp_footer', array( $this ,'item_count_check'));

		add_action( 'wp_footer', array( $this ,'ace_product_page_ajax_add_to_cart_js' ));

		add_action( 'wp_head', array( $this ,'ace_product_page_head' ));
 
		}elseif($notification_enabes_whmc == 'yes'){

			add_action( 'wp_footer', array( $this ,'item_count_check2' ));
			add_action( 'wp_footer', array( $this ,'ace_product_page_ajax_add_to_cart_js2' ));

		}
	parent::__construct();
	}

	function filter_wc_loop_add_to_cart_args( $args, $product ) {
	    if ( $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ) 
	    {
	        $args['attributes']['data-product_name'] = $product->get_name();
	        $args['attributes']['data-product_image'] = wp_get_attachment_image_url( $product->get_image_id(), 'thumbnail');   
	    }
	    return $args;
	}


	// Wordpress Ajax PHP

	function addedtocart_sweet_message() {
	    echo isset($_POST['id']) && $_POST['id'] > 0 ? (int) esc_attr($_POST['id']) : false;
	    die();
	}


	function item_count_check() {
        $this->options;
        $opuiosngshgd = $this->options_value;

        if($opuiosngshgd == $this->vausropiokss){

		if (class_exists( 'WooCommerce' ) ){

			if (is_checkout())
			    return;

	    wp_enqueue_script('SweetAlert', WHMC_URL.'assets/public/js/SweetAlert.js' , array('jquery'), '3.23' , true);


	    $notifications = get_option('whmc_notification');
	    $notifications_rang_value = isset($notifications['wmhc_notification_added_text']) ? $notifications['wmhc_notification_added_text'] : 'added successfully';
	    	if(empty($notifications_rang_value)){
	    	$notifications_rang_value = 'Adeed Succeesfully';
	    	}

	    	$notification_position = isset($notifications['notification_position']) ? $notifications['notification_position'] : 'top-end';

	    	$notification_timing = isset($notifications['notification_timing']) ? $notifications['notification_timing'] : '3000';
	 	$sidepanels    = get_option('whmc_sidepanel');

        $wmhc_cart_side_autup = (isset($sidepanels['wmhc_cart_side_autup']) && $sidepanels['wmhc_cart_side_autup'] === 'wmhc_cart_side_autup') ? 'checked' : '';

				if($wmhc_cart_side_autup){
					$whmcpmopen = '';
					$whmcpmshoe = '';	
					$whmcpmhide = '';
				}else{
					$whmcpmopen = 'pm_open';
					$whmcpmshoe = 'pm_show';
					$whmcpmhide = 'pm_hide';
				}
	    ?>

	    <script type="text/javascript">
	    jQuery( function($) {
	    	var productText = "<?php echo $notifications_rang_value; ?>";
	    	 NotificationPosition = "<?php echo $notification_position; ?>";
	    	 Timing = <?php echo $notification_timing;?>;

	        if ( typeof wc_add_to_cart_params === 'undefined' )
	            return false;

	        $(document.body).on( 'added_to_cart', function( a, b, c, d  ) {
	 
	           var prod_id   = d.data('product_id'), // Get the product name
	                      prod_qty  = d.data('quantity'), // Get the quantity
	                      prod_name = d.data('product_name'); // Get the product name
	                      prod_img = d.data('product_image');
	            $.ajax({
	                type: 'POST',
	                url: wc_add_to_cart_params.ajax_url,
	                data: {
	                    'action': 'item_added',
	                    'id'    : prod_id
	                },
	                success: function (response) {
	                    if(response == prod_id){
	                    	const Toast = Swal.mixin({
	                    	  toast: true,
	                    	  position: NotificationPosition,
	                    	  showConfirmButton: false,
	                    	  timer: Timing,
	                    	  timerProgressBar: true,

	                    	})

	                    	Toast.fire({
	                    	imageUrl: prod_img,
	                    	  icon: 'success',
	                    	  title: prod_name + ' '+ productText
	                    	})
							$(".shopping-cart").wiggle({speed: 20});
	                    	$('#pm_menu').addClass('<?php echo $whmcpmopen; ?>');
	                    	$('.pm_overlay').addClass('<?php echo $whmcpmshoe; ?>');
	                    	$('.pm_overlay').removeClass('<?php echo $whmcpmhide; ?>');
	                    	
	                    }
	                }
	            });
	        });
	    });
	    </script>
	    <?php
	}
	}
	}

	function item_count_check2() {
        $this->options;
        $opuiosngshgd = $this->options_value;

        if($opuiosngshgd == $this->vausropiokss){
		
		if (class_exists( 'WooCommerce' ) ){

			if (is_checkout())
			    return;
	 	$sidepanels    = get_option('whmc_sidepanel');
        $wmhc_cart_side_autup = (isset($sidepanels['wmhc_cart_side_autup']) && $sidepanels['wmhc_cart_side_autup'] === 'wmhc_cart_side_autup') ? 'checked' : '';
		if($wmhc_cart_side_autup == 'checked'){
			$whmcpmopen = '';
			$whmcpmshoe = '';	
			$whmcpmhide = '';	
		}else{
			$whmcpmopen = 'pm_open';
			$whmcpmshoe = 'pm_show';
			$whmcpmhide = 'pm_hide';
		}

			?>
	    <script type="text/javascript">
	    jQuery( function($) {

	        if ( typeof wc_add_to_cart_params === 'undefined' )
	            return false;

	        $(document.body).on( 'added_to_cart', function( a, b, c, d  ) {
	 
	           var prod_id   = d.data('product_id');
	            $.ajax({
	                type: 'POST',
	                url: wc_add_to_cart_params.ajax_url,
	                data: {
	                    'action': 'item_added',
	                    'id'    : prod_id
	                },
	                success: function (response) {
	                    if(response == prod_id){
	     					$(".shopping-cart").wiggle({speed: 20});
	                    	$('#pm_menu').addClass('<?php echo $whmcpmopen; ?>');
	                    	$('.pm_overlay').addClass('<?php echo $whmcpmshoe; ?>');
	                    	$('.pm_overlay').removeClass('<?php echo $whmcpmhide; ?>');
	                    	
	                    }
	                }
	            });
	        });
	    });
	    </script>
	    <?php
	}
	}
	}
	///single product add to cart message ajax message

	function ace_product_page_ajax_add_to_cart_js2() {
        $this->options;
        $opuiosngshgd = $this->options_value;

        if($opuiosngshgd == $this->vausropiokss){
		if (class_exists( 'WooCommerce' ) && is_product()){

			global $product;
			if ($product->is_type("external") ||  $product->is_type( 'grouped' ))
			    return;
	 	$sidepanels    = get_option('whmc_sidepanel');
        $wmhc_cart_side_autup = (isset($sidepanels['wmhc_cart_side_autup']) && $sidepanels['wmhc_cart_side_autup'] === 'wmhc_cart_side_autup') ? 'checked' : '';

		if($wmhc_cart_side_autup == 'checked'){
			$whmcpmopen = '';
			$whmcpmshoe = '';	
			$whmcpmhide = '';
		}else{
			$whmcpmopen = 'pm_open';
			$whmcpmshoe = 'pm_show';
			$whmcpmhide = 'pm_hide';
		}
	    ?><script type="text/javascript" charset="UTF-8">
			jQuery(function($){

			    if ( typeof wc_add_to_cart_params === 'undefined' ) {
					return false;
			    }
			    $(document).on('submit', 'form.cart', function(e){
			        var form = $(this),
			            button = form.find('.single_add_to_cart_button');   
			        var formFields = form.find('input:not([name="product_id"]), select, button, textarea');
			        var formData = [];
			        formFields.each(function(i, field){
			            var fieldName = field.name,
			                fieldValue = field.value;

			            if(fieldName && fieldValue){
			                if(fieldName == 'add-to-cart'){
			                    fieldName = 'product_id';
			                    fieldValue = form.find('input[name=variation_id]').val() || fieldValue;
			                }

			                if((field.type == 'checkbox' || field.type == 'radio') && field.checked == false){
			                    return;
			                }
			                formData.push({
			                    name: fieldName,
			                    value: fieldValue
			                });                
			            }
			        });

			        if(!formData.length){
			            return;
			        } 
			        e.preventDefault();
			        
			        form.block({ 
			            message: null, 
			            overlayCSS: {
			                background: "#ffffff",
			                opacity: 0.6 
			            }
			        });

			        $(document.body).trigger('adding_to_cart', [button, formData]);
			  
			        $.ajax({
			            type: 'POST',
			            url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
			            data: formData,
			            success: function(response){
			                if(!response){

			                    return;
			                }else{
							$(".shopping-cart").wiggle({speed: 20});			                	
		                	$('#pm_menu').addClass('<?php echo $whmcpmopen; ?>');
		                	$('.pm_overlay').addClass('<?php echo $whmcpmshoe; ?>');
		                	$('.pm_overlay').removeClass('<?php echo $whmcpmhide; ?>');
			                }
			                if(response.error & response.product_url){
			                    window.location = response.product_url;
			                    return;
			                } 
			                $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, button]);
			            },
			            complete: function(){
			                form.unblock();
			            }
			        });
			 
			      return false;
			  
			    });
			});
		</script><?php
	}
	}
	}

	/*
	 * JS for AJAX Add to Cart handling
	 */


	function ace_product_page_ajax_add_to_cart_js() {
        $this->options;
        $opuiosngshgd = $this->options_value;

        if($opuiosngshgd == $this->vausropiokss){
		if (class_exists( 'WooCommerce' ) && is_product()){

			global $product;
			if ($product->is_type("external") ||  $product->is_type( 'grouped' ))
			    return;
			$notifications = get_option('whmc_notification');
			$notifications_rang_value = $notifications['wmhc_notification_added_text'];
				if(empty($notifications_rang_value)){
				$notifications_rang_value = 'Adeed Succeesfully';
				}

				$notification_position = isset($notifications['notification_position']) ? $notifications['notification_position'] : 'top-end';

				$notification_timing = isset($notifications['notification_timing']) ? $notifications['notification_timing'] : '3000';

	 	$sidepanels    = get_option('whmc_sidepanel');
        $wmhc_cart_side_autup = (isset($sidepanels['wmhc_cart_side_autup']) && $sidepanels['wmhc_cart_side_autup'] === 'wmhc_cart_side_autup') ? 'checked' : '';
		if($wmhc_cart_side_autup == 'checked'){
			$whmcpmopen = '';
			$whmcpmshoe = '';
			$whmcpmhide = '';				
		}else{
			$whmcpmopen = 'pm_open';
			$whmcpmshoe = 'pm_show';
			$whmcpmhide = 'pm_hide';			
		}
	    ?><script type="text/javascript" charset="UTF-8">

				 	jQuery(function($){

				 	    if ( typeof wc_add_to_cart_params === 'undefined' ) {
				 			return false;
				 	    }
				 	    var productTitle = $('.product_title').text();
				 	    	productimg = $('.woocommerce-product-gallery__image').attr('data-thumb');
				 	    	productText = "<?php echo $notifications_rang_value; ?>";
				 	    	 NotificationPosition = "<?php echo $notification_position; ?>";
				 	    	 Timing = <?php echo $notification_timing; ?>;
			 	    $(document).on('submit', 'form.cart', function(e){
			 	        var form = $(this),
			 	            button = form.find('.single_add_to_cart_button');   
			 	        var formFields = form.find('input:not([name="product_id"]), select, button, textarea');
			 	        var formData = [];
			 	        formFields.each(function(i, field){
			 	            var fieldName = field.name,
			 	                fieldValue = field.value;

			 	            if(fieldName && fieldValue){
			 	                if(fieldName == 'add-to-cart'){
			 	                    fieldName = 'product_id';
			 	                    fieldValue = form.find('input[name=variation_id]').val() || fieldValue;
			 	                }

			 	                if((field.type == 'checkbox' || field.type == 'radio') && field.checked == false){
			 	                    return;
			 	                }
			 	                formData.push({
			 	                    name: fieldName,
			 	                    value: fieldValue
			 	                });                
			 	            }
			 	        });

			 	        if(!formData.length){
			 	            return;
			 	        } 
			 	        e.preventDefault();
			 	        
			 	        form.block({ 
			 	            message: null, 
			 	            overlayCSS: {
			 	                background: "#ffffff",
			 	                opacity: 0.6 
			 	            }
			 	        });

			 	        $(document.body).trigger('adding_to_cart', [button, formData]);
			 	  
			 	        $.ajax({
			 	            type: 'POST',
			 	            url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
			 	            data: formData,
			 	            success: function(response){
			 	                if(!response){

			 	                    return;
			 	                }else{

			 	                	const Toast = Swal.mixin({
			 	                	  toast: true,
			 	                	  position: NotificationPosition,
			 	                	  showConfirmButton: false,
			 	                	  timer: Timing,
			 	                	  timerProgressBar: true,

			 	                	})

			 	                	Toast.fire({
			 	                	
			 	                		title: productTitle + ' '+ productText,
			 	                		  icon: 'success',
			 	                		  imageUrl: productimg,
			 	                		  
			 	                		 
			 	                	})

							$(".shopping-cart").wiggle({speed: 20});			 	                	
			                 	$('#pm_menu').addClass('<?php echo $whmcpmopen; ?>');
			                 	$('.pm_overlay').addClass('<?php echo $whmcpmshoe; ?>');
			                 	$('.pm_overlay').removeClass('<?php echo $whmcpmhide; ?>');
			 	                }
			 	                if(response.error & response.product_url){
			 	                    window.location = response.product_url;
			 	                    return;
			 	                } 
			 	                $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, button]);
			 	            },
			 	            complete: function(){
			 	                form.unblock();
			 	            }
			 	        });
			 	 
			 	      return false;
			 	  
			 	    });
			 	});

		</script><?php
	}
	}
	}


	// Remove WC Core add to cart handler to prevent double-add
	//


	/**
	 * Add to cart handler.
	 */
	function ace_ajax_add_to_cart_handler() {
		
		WC_AJAX::get_refreshed_fragments();
	}

	function ace_product_page_head(){
        $this->options;
        $opuiosngshgd = $this->options_value;

        if($opuiosngshgd == $this->vausropiokss){
		$notifications = get_option('whmc_notification');
		$notifications_title_color = isset($notifications['notification_title_color']) ? $notifications['notification_title_color'] : '#4c4c4c';

		$notifications_bg_color = isset($notifications['notification_background_color']) ? $notifications['notification_background_color'] : '#68d619';
		$notification_boxshadow = isset($notifications['notification_boxshadow']) ? $notifications['notification_boxshadow'] : '#fff';

		$progress_color = isset($notifications['notification_progress_bar_color']) ? $notifications['notification_progress_bar_color'] : '#dd0f0f';


		$notification_round_bar = isset($notifications['notification_round_bar']) ? $notifications['notification_round_bar'] : 'checked';


		$suceess_icon_color = isset($notifications['suceess_icon_color']) ? $notifications['suceess_icon_color'] : '#fff';
	
	 ?>

		<style type="text/css">
		.swal2-popup.swal2-toast.swal2-icon-success.swal2-show {
		    background: <?php echo $notifications_bg_color; ?>;
		}
		h2#swal2-title {
		    color: <?php echo $notifications_title_color; ?>;
		}
		.swal2-timer-progress-bar {
		    background: <?php echo $progress_color; ?> !important;

		}
		.swal2-popup.swal2-toast.swal2-icon-success.swal2-show {
			<?php if($notification_round_bar == 'checked'){ ?>
		    border-radius: 0px;
			<?php } ?>
			box-shadow: 1px 1px 10px <?php echo $notification_boxshadow ?> !important;

		}
		.swal2-icon.swal2-success .swal2-success-ring{
			border: .25em solid <?php echo $suceess_icon_color; ?> !important;
		}
		.swal2-icon.swal2-success [class^=swal2-success-line] {
		    background-color: <?php echo $suceess_icon_color; ?> !important;
		}
		</style>


	<?php

	}
	}

}