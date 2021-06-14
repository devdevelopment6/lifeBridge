<?php 
/* Template Name: Contact
*/ 
?>
<?php get_header(); ?>

<div class="inner-banner">
      <div class="container">
            <div class="row">
              <div class="col-lg-12 wow fadeInUp" data-wow-offset="10" data-wow-duration="1.5s">
                 <h1 class="page-title"><?php the_title();?></h1>
              </div>
            </div>
                        
        </div>
  </div>

      
<div class="inner-page contact-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-offset="10" data-wow-duration="1.5s">
       <div class="sec-heading">
          <?php 
while ( have_posts() ) : the_post();
the_content();
endwhile;
?>
      
        </div>
      </div>


<div class="col-lg-7 col-md-7">
        <div class="contact-form">
               <?php echo do_shortcode( '[contact-form-7 id="8" title="Contact form"]' ); ?>
        </div>
        
      </div>




<!--div class="col-lg-4 col-md-5 offset-lg-1">
        <div class="inner-column">
<?php  if (get_field('contact_info')) {
while (has_sub_field('contact_info')) {
?>
<div class="cont-info-single">
<h5><?php the_sub_field('icon');?> <?php the_sub_field('title');?>:</h5>
<p><?php the_sub_field('cont_info');?></p>
</div>
<?php } } ?>  


        </div>
        
      </div-->

    </div>
  </div>
  </div>



<?php get_footer(); ?>