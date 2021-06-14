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


global $current_user;
 $sname = $current_user->first_name.' '.$current_user->last_name;
 $ids = get_current_user_id();
 $user_meta = get_userdata($ids);
$user_roles = $user_meta->roles;

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

			<a href="<?php echo site_url();?>/dashboard/" class="LoginBtn">My Account</a>


			<!-- <nav role="navigation" class="submenuaccount">
			  <ul>
			   
			    <li><a href="#" aria-haspopup="true">My Account</a>
			      <ul class="dropdown" aria-label="submenu">
			      	<?php if ( in_array( 'usera', $user_roles, true ) ) { ?>
			        <li><a href="<?php echo site_url()?>/inquiry/">Inquiry</a></li>
			   		<?php }else if ( in_array( 'userb', $user_roles, true ) ) { ?>
			   		<li><a href="<?php echo site_url()?>/appointment/">Appointment</a></li>	
			   		<?php } ?>	
			         <li><a href="<?php echo wp_logout_url( ) ?>" >Logout</a></li>	

			      </ul>
			    </li>
			   
			  </ul>
			</nav> -->


		<?php } ?>

	</div>
	</div>
</header>