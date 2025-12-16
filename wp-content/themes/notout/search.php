<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package notout
 */

get_header();
?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<section id="primary" class="notout-content-area">
				<main id="main" class="notout-site-main">

				<?php 
				/**
				 * notout_before_main_content hook
				 */
				do_action( 'notout_before_main_content' );

				if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="page-title">
							<?php
							/* translators: %s: search query. */
							printf( esc_html__( 'Search Results for: %s', 'notout' ), '<span>' . get_search_query() . '</span>' );
							?>
						</h1>
					</header><!-- .page-header -->

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/page/content', 'search' );

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
			</section><!-- #primary -->
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
