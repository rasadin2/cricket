<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package notout
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />



	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php  
	/**
	 * notout_before_site_container hook
	 */
	do_action( 'notout_before_site_container' );
?>
<div id="page" class="notout-site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'notout' ); ?></a>
	
	<?php  
		/**
		 * notout_before_header_menu hook
		 */
		do_action( 'notout_before_header_menu' );
	?>

	<?php notout_menu(); ?>

	<?php  
		/**
		 * notout_after_header_menu hook
		 * 
		 * notout_page_header - 10
		 */
		do_action( 'notout_after_header_menu' );
	?>

	<div id="content" class="notout-site-content">	