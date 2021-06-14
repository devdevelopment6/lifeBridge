<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/css/style.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->


<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,700;0,900;1,300;1,1,400;1,700;1,900&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" >
			
<link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/bootstrap.min.js" ></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/css/style.css">
<script src="<?php bloginfo('template_url');?>/js/owl.carousel.min.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/owl.theme.default.min.css">
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/java.js"></script>


	<?php wp_head(); ?>

  
  

  
</head>

<body >
<?php //wp_body_open(); ?>
<!-- <div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'twentytwentyone' ); ?></a>
	<div class="content-area" style="text-align: right; padding: 20px;">
	<?php if(!is_user_logged_in()) { ?>		
		<a href="<?php echo site_url();?>/login/">Login</a>
	<?php } ?>
	</div>
 -->
	<?php get_template_part( 'template-parts/header/site-header' ); ?>

	
