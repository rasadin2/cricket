<?php
/**
 * This file contians all WooCommerce hooks that this theme uses
 */

if( ! defined( 'ABSPATH' ) ) : exit; endif;

if( ! class_exists( 'Notout_WooCommerce_Hooks' ) ) :

    class Notout_WooCommerce_Hooks {

        public function __construct() {
            add_action( 'after_setup_theme', array( $this, 'woocommerce_theme_support' ), 20 );
            add_action( 'after_setup_theme', array( $this, 'setup_woocommerce_hooks' ), 30 );
        }

        /**
         * notout WooCommerce Theme Support
         */
        public function woocommerce_theme_support() {

            add_theme_support( 'wc-product-gallery-zoom' );
	        add_theme_support( 'wc-product-gallery-lightbox' );
	        add_theme_support( 'wc-product-gallery-slider' );

        }

        /**
         * notout WooCommerce Hooks
         */
        public function setup_woocommerce_hooks() {

            /**
             * Remove default WooCommerce Hooked Functions.
             */
            remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
            remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
            remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
            remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
            
            //  Disabling WooCommerce Default CSS Style
            add_filter('woocommerce_enqueue_styles', '__return_false');
            
            /**
             * Hooks Positioning
             */
            add_action( 'woocommerce_before_shop_loop', 'woocommerce_breadcrumb', 10 );

        }

    }

endif;

return new Notout_WooCommerce_Hooks();
