<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package notout
 */

get_header();
?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div id="primary" class="notout-content-area">
				<main id="main" class="notout-site-main">

				<?php
				/**
				 * notout_before_main_content hook
				 */
				do_action( 'notout_before_main_content' );

				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) :
						?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
						<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/post/content', get_post_type() );

					endwhile;

					/**
					 * notout_before_post_pagination hook
					 */
					do_action( 'notout_before_post_pagination' );

					// the_posts_navigation();
					echo paginate_links(array(
						'prev_text' => esc_html__('Prev', 'notout'),
						'next_text' => esc_html__('Next', 'notout')
					));

					/**
					 * notout_after_post_pagination hook
					 */
					do_action( 'notout_after_post_pagination' );

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;

				/**
				 * notout_after_main_content hook
				 */
				do_action( 'notout_after_main_content' );
				?>
				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
		<div class="col-md-3">
				
			<?php 
				/**
				 * notout_before_sidebar hook
				 */
				do_action( 'notout_before_sidebar' );

				get_sidebar();
				
				/**
				 * notout_after_sidebar hook
				 */
				do_action( 'notout_after_sidebar' );
			?>
			
		</div>
	</div>
</div>
	
<?php
get_footer();
