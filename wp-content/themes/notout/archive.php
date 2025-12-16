<?php
/**
 * The template for displaying archive pages
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

				if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php
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

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/page/content', 'none' );

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
