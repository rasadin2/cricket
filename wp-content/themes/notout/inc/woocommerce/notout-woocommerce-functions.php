<?php 
/**
 * WooCommerce Modification
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'notout_woocommerce_wrapper_before' ) ) :
	/**
	 * Before Content.
	 *
	 * @since 1.0.0
	 */
	function notout_woocommerce_wrapper_before() {
		?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="primary" class="notout-content-area">
						<main id="main" class="notout-site-main notout-woocommerce-area">
					
					
		<?php
	}
	add_action( 'woocommerce_before_main_content', 'notout_woocommerce_wrapper_before', 20 );
endif;


if ( ! function_exists( 'notout_woocommerce_wrapper_after' ) ) :
	/**
	 * After Content.
	 * 
	 * @since 1.0.0
	 */
	function notout_woocommerce_wrapper_after() {
		?>
						</main>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	add_action( 'woocommerce_after_main_content', 'notout_woocommerce_wrapper_after', 20 );
endif;

if( ! function_exists( 'notout_add_to_cart_menu' ) ) :
	/**
	 * Add Cart Menu into the Header Menu
	 * 
	 * @since 1.0.0
	 */
	function notout_add_to_cart_menu( $items, $args ) {
		if( 'primary' === $args->theme_location ) {
			$items .= '<li class="menu-item nav-item notout-add-to-cart">';
			$items .= '<a class="cart-contents wc-cart-contents nav-link" href="' . esc_url( wc_get_cart_url() ) . '">';
			$items .= '<span class="notout-header-cart-icon"><i class="icofont icofont-shopping-cart"></i></span>';
			$items .= '<span class="amount"></span> <span class="count"></span>';
			$items .= '</a>';
			$items .= '</li>';
		}
		return $items;
	}
	// if( 'yes' == get_theme_mod( 'cp_show_cart_menu' ) ) {
		add_filter( 'wp_nav_menu_items', 'notout_add_to_cart_menu', 99, 2 );
	// }
	
endif;

if( ! function_exists( 'notout_add_to_cart_fragment' ) ) :
	/**
	 * Add to Cart Fragments
	 * 
	 * @since 1.0.0
	 */
	function notout_add_to_cart_fragment( $fragments ) {
	
		ob_start();
		$count = WC()->cart->get_cart_contents_count()
		?>
			<a class="cart-contents wc-cart-contents nav-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'notout' ); ?>">
				<span class="notout-header-cart-icon"><i class="icofont icofont-shopping-cart"></i></span>
				<?php if ( $count > 0 ) { ?>
				<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'notout' ), WC()->cart->get_cart_contents_count() ) );?></span>
					<?php } ?>
			</a>

			<?php
	
		$fragments['a.wc-cart-contents'] = ob_get_clean();
		
		return $fragments;
	}
	add_filter( 'woocommerce_add_to_cart_fragments', 'notout_add_to_cart_fragment' );

endif;