<?php 
/* Template Name: Faqs Template
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

      
<div class="inner-page faq-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-offset="10" data-wow-duration="1.5s">

<?php 
while ( have_posts() ) : the_post();
the_content();
endwhile;
?>
        
        <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

 <?php

$testimoniallist = new WP_Query('posts_per_page=-1&post_type=faqs&orderby=date&order=DESC');
if($testimoniallist->have_posts()) : while($testimoniallist->have_posts()): $testimoniallist->the_post();

?>


 <div class="card">
    <!-- Card header -->
    <div class="card-header" role="tab" id="heading-<?php the_ID(); ?>">
      <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapse-<?php the_ID(); ?>"
        aria-expanded="false" aria-controls="collapse-<?php the_ID(); ?>">
        <h5 class="mb-0"><?php the_title();?> <i class="fa fa-angle-down rotate-icon"></i>
        </h5>
      </a>
    </div>
    <!-- Card body -->
    <div id="collapse-<?php the_ID(); ?>" class="collapse" role="tabpanel" aria-labelledby="heading-<?php the_ID(); ?>" data-parent="#accordionEx">
      <div class="card-body">
         <?php the_content();?>
      </div>
    </div>

  </div>
<?php endwhile; endif; wp_reset_query(); ?>


        
      </div> </div>
    </div>
  </div>
  </div>






<?php get_footer(); ?>