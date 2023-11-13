<?php


 class whmcCouponmedia {

        private $screens = array('shop_coupon');

        private $fields = array(
          array(
            'label' => 'Upload Image',
            'id' => 'whmcouponimage',
            'type' => 'media',
            'returnvalue' => 'url',
          )  
        );

        public function __construct() {
          add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
          add_action( 'save_post', array( $this, 'save_fields' ) );
        }

        public function add_meta_boxes() {
          foreach ( $this->screens as $s ) {
            add_meta_box(
              'UploadImage',
              __( 'Coupon Banner Scetion', 'textdomain' ),
              array( $this, 'meta_box_callback' ),
              $s,
              'normal',
              'default'
            );
          }
        }

        public function meta_box_callback( $post ) {
          wp_nonce_field( 'UploadImage_data', 'UploadImage_nonce' ); 
          $this->field_generator( $post );
        }

        public function field_generator( $post ) {
          $output = '';
          foreach ( $this->fields as $field ) {
            $label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
            $meta_value = get_post_meta( $post->ID, $field['id'], true );
            if ( empty( $meta_value ) ) {
              if ( isset( $field['default'] ) ) {
                $meta_value = $field['default'];
              }
            }
            switch ( $field['type'] ) {
              case 'media':
                $meta_url = '';
                if ($meta_value) {
                  if ($field['returnvalue'] == 'url') {
                    $meta_url = $meta_value;
                  } else {
                    $meta_url = wp_get_attachment_url($meta_value);
                  }
                }
                $input = sprintf(
                  '<input style="display:none;" id="%s" name="%s" type="text" value="%s" data-return="%s"><div id="whmcpreview%s" style="background-color:#fafafa;margin-right:12px;border:1px solid #eee;max-width: 150px;height:150px;background-image:url(%s);background-size:cover;background-repeat:no-repeat;background-position:center;"></div><input style="width: 15%%;margin-right:5px;" class="button whmc-new-media" id="%s_button" name="%s_button" type="button" value="Select" /><button class="button whmc-remove-media" id="%s_buttonremove" name="%s_buttonremove" type="button"><span class="dashicons dashicons-trash"></span></button>',
                  $field['id'],
                  $field['id'],
                  $meta_value,
                  $field['returnvalue'],
                  $field['id'],
                  $meta_url,
                  $field['id'],
                  $field['id'],
                  $field['id'],
                  $field['id']
                );
                break;
        
              default:
                $input = sprintf(
                '<input %s id="%s" name="%s" type="%s" value="%s">',
                $field['type'] !== 'color' ? 'style="width: 100%"' : '',
                $field['id'],
                $field['id'],
                $field['type'],
                $meta_value
              );
            }
            $output .= $this->format_rows( $label, $input );
          }
          echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
        }

        public function format_rows( $label, $input ) {
          return '<div style="margin-top: 10px;"><strong>'.$label.'</strong></div><div>'.$input.'</div>';
        }

        public function save_fields( $post_id ) {
          if ( !isset( $_POST['UploadImage_nonce'] ) ) {
            return $post_id;
          }
          $nonce = $_POST['UploadImage_nonce'];
          if ( !wp_verify_nonce( $nonce, 'UploadImage_data' ) ) {
            return $post_id;
          }
          if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
          }
          foreach ( $this->fields as $field ) {
            if ( isset( $_POST[ $field['id'] ] ) ) {
              switch ( $field['type'] ) {
                case 'email':
                  $_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
                  break;
                case 'text':
                  $_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
                  break;
              }
              update_post_meta( $post_id, $field['id'], $_POST[ $field['id'] ] );
            } else if ( $field['type'] === 'checkbox' ) {
              update_post_meta( $post_id, $field['id'], '0' );
            }
          }
        }

      }

      if (class_exists('whmcCouponmedia')) {
        new whmcCouponmedia;
      };
