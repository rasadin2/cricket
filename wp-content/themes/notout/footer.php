<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package notout
 */

?>

	</div><!-- #content -->
	<?php 
		/**
		 * notout_before_footer hook
		 */
		do_action( 'notout_before_footer' );
	?>

	<footer class="notout-footer bottom-footer">
		<!-- Widgets -->
		<div class="container first-bottom">
			<div class="row">
			   <div class="col-md-8 col-sm-6 first-colume"><div class="logo-content"><?php dynamic_sidebar( 'footer-widget-6' ); ?></div></div>
			   <div class="col-md-4 col-sm-6 second-colume"><?php dynamic_sidebar( 'footer-widget-7' ); ?></div>
			</div>
		</div>
		<div class="container second-bottom">
			<div class="row">
				<div class="col-md-3 col-sm-6 foo-colume-1">
					<?php dynamic_sidebar( 'footer-widget-1' ); ?>
				</div>
				<div class="col-md-3 col-sm-6 foo-colume-2">
					<?php dynamic_sidebar( 'footer-widget-2' ); ?>
				</div>
				<div class="col-md-3 col-sm-6 foo-colume-3">
					<?php dynamic_sidebar( 'footer-widget-3' ); ?>
				</div>
				<div class="col-md-3 col-sm-6 foo-colume-4">
					<?php dynamic_sidebar( 'footer-widget-4' ); ?>
				</div>
				
			</div>
		</div>
		<!-- Copyright -->
		<div class="container footer-copy-right">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<?php dynamic_sidebar( 'copyright-widget-1' ); ?>
				</div>
				<!--<div class="col-md-6">
					<?php dynamic_sidebar( 'copyright-widget-2' ); ?>
				</div>-->
			</div>
		</div>
	</footer>

	<?php  
		/**
		 * notout_after_footer hook
		 */
		do_action( 'notout_after_footer' );
	?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
