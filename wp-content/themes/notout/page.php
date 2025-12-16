<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package notout
 */

get_header();
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div id="primary" class="notout-content-area">
				<main id="main" class="notout-site-main">

					<?php

					/**
					 * notout_before_main_content hook
					 */
					do_action( 'notout_before_main_content' );

					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/page/content', 'page' );
					
					endwhile; // End of the loop.

					/**
					 * notout_after_main_content hook
					 */
					do_action( 'notout_after_main_content' );
					?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
	</div>
</div>

<?php
get_footer();
