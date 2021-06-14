<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$wrapper_classes  = 'site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= ( true === get_theme_mod( 'display_title_and_tagline', true ) ) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu( 'primary' ) ? ' has-menu' : '';
?>
<!-- 
<header id="masthead" class="<?php echo esc_attr( $wrapper_classes ); ?>" role="banner">

	<?php //get_template_part( 'template-parts/header/site-branding' ); ?>
	<?php //get_template_part( 'template-parts/header/site-nav' ); ?>

</header> --><!-- #masthead -->

<header class="">
<div class="BlueStrip"></div>
<div class="container">
	<div class="row">
	<div class="col-sm-8">
	<ul class="logos">
	<a href="<?php echo site_url();?>">	
		<li><img src="<?php bloginfo('template_url');?>/img/logo.png"></li>
		<li><img src="<?php bloginfo('template_url');?>/img/logo2.png"></li>
	</a>
	</ul>
	</div>

	<div class="col-sm-4 align-self-center">
		<?php if(!is_user_logged_in()){?>
			<a href="<?php echo site_url();?>/login/" class="LoginBtn">Login</a>
		<?php }else{ ?>
			<a href="<?php echo wp_logout_url( ) ?>" class="LoginBtn">Logout</a>
		<?php } ?>

	</div>
	</div>
</header>