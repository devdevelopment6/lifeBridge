<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
	<?php if ( is_front_page() && is_home() ) {?>
<footer class="footer">
	
<div class="FtrHeading">

	<div class="shape"><img src="<?php bloginfo('template_url');?>/img/triangleShape.png" width="100%"></div>
<p>LifeBridge is about having a safe harbor to empower and equip you with the tools you need <br/>to take care of yourself as well as you take care of your patients.</p></div>
<div class="container"><p>© <?php echo date('Y');?> McLennan County Medical Society </p></div>
</footer>
<?php }else{ ?>

<footer class="footer">
<div class="FtrBlueBg"><div class="container"><p>© 2021 McLennan County Medical Society </p></div></div>
</footer>
<?php } ?>
<?php wp_footer(); ?>



</body>
</html>
