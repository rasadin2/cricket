<?php 
/**
 * Notout WooCommerce Class
 * 
 * @package Notout
 * @author Notout
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) : exit; endif;

if( !class_exists( 'Notout_WooCommerce' ) ) :

    /**
     * The Notout WooCommerce Integration Class
     */
    class Notout_WooCommerce {

        /**
         * Setup Class
         * 
         * @since 1.0.0
         */
        public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'woocommerce_scripts' ), 20 );
            add_filter( 'loop_shop_per_page', array( $this, 'products_per_page' ), 20 );
            add_filter( 'loop_shop_columns', array( $this, 'shop_columns' ), 20 );
			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
			// add_filter( 'woocommerce_product_thumbnails_columns', array( $this, 'thumbnail_columns' ) );
            add_filter( 'woocommerce_breadcrumb_defaults', array( $this,'change_breadcrumb_delimiter' ) );
            add_action( 'woocommerce_before_shop_loop_item_title',  array( $this, 'product_secondary_thumbnail' ), 11 );
            add_filter( 'post_class', array( $this, 'product_has_gallery' ) );
            if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.5', '<' ) ) {
				add_action( 'wp_footer', array( $this, 'star_rating_script' ) );
			}
			if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '<' ) ) {
				add_filter( 'loop_shop_per_page', array( $this, 'products_per_page' ) );
            }

        }

        /**
         * Notout WooCommerce Scripts
         * 
         * @since 1.0.0
         */
        public function woocommerce_scripts() {
		    wp_enqueue_style( 'notout-woo-style', get_template_directory_uri() . '/woocommerce.css' );  
        }

        /**
         * Products Per Page
         * 
         * @since 1.0.0
         */
        public function products_per_page( $cols ) {
            return $cols = 12;
        }

        /**
         * Shop Columns Per Row
         * 
         * @since 1.0.0
         */
        public function shop_columns( $cols ) {
            return $cols = 3;
        }

        /**
		 * Related Products Args
         * 
         * @since 1.0.0
		 */
		public function related_products_args( $args ) {
			$args = apply_filters( 'notout_related_products_args', array(
				'posts_per_page' => 3,
				'columns'        => 3,
			) );

			return $args;
		}


        /**
         * Change Breadcrumb Delimiter
         * 
         * @since 1.0.0
         */
        public function change_breadcrumb_delimiter( $defaults ) {
            $defaults['delimiter'] = '<i class="icofont icofont-thin-right"></i>';

            return $defaults;
        }

        /**
         * Flip Image on Hover
         * 
         * @since 1.0.0
         */
        public function product_has_gallery( $classes ) {
			global $product;

			$post_type = get_post_type( get_the_ID() );

			if ( ! is_admin() ) {

				if ( $post_type == 'product' ) {

					$attachment_ids = $this->get_gallery_image_ids( $product );

					if ( $attachment_ids ) {
						$classes[] = 'product-has-gallery';
					}
				}
			}

			return $classes;
        }
        
        /**
		 * Frontend functions
		 */
		public function product_secondary_thumbnail() {
			global $product, $woocommerce;

			$attachment_ids = $this->get_gallery_image_ids( $product );

			if ( $attachment_ids ) {
				$attachment_ids     = array_values( $attachment_ids );
				$secondary_image_id = $attachment_ids['0'];

				$secondary_image_alt = get_post_meta( $secondary_image_id, '_wp_attachment_image_alt', true );
				$secondary_image_title = get_the_title($secondary_image_id);

				echo wp_get_attachment_image(
					$secondary_image_id,
					'shop_catalog',
					'',
					array(
						'class' => 'secondary-image attachment-shop-catalog wp-post-image wp-post-image--secondary',
						'alt' => $secondary_image_alt,
						'title' => $secondary_image_title
					)
				);
			}
		}


		/**
		 * WooCommerce Compatibility Functions
		 */
		public function get_gallery_image_ids( $product ) {
			if ( ! is_a( $product, 'WC_Product' ) ) {
				return;
			}

			if ( is_callable( 'WC_Product::get_gallery_image_ids' ) ) {
				return $product->get_gallery_image_ids();
			} else {
				return $product->get_gallery_attachment_ids();
			}
		}
    }

endif;

return new Notout_WooCommerce();