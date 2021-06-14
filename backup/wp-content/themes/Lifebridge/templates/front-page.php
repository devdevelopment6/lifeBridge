<?php 
/* Template Name: Home 
*/ 
?>
<?php get_header(); ?>

 <!--================================================== banner start ========================================= -->
 <section class="banner homeBanner">
 <img src="<?php the_field('banner_image');?>" width="100%" class="banner-img">
 <div class="ContBox"><div class="container">
<div class="bannerText"> 
<?php the_field('banner_content');?>
<?php if(get_field('banner_button_visibility')) { ?>

<ul>
 <?php  
if (get_field('banner_buttons')) {
  $i=1;  
while (has_sub_field('banner_buttons')) {
?>  

<?php if(get_sub_field('button_link') == 'Page Link') { ?>
<li><a href="<?php the_sub_field('banner_button_page_link');?>" class="blueBtn btn-<?php echo $i;?>"><?php the_sub_field('button_text');?></a></li>
                        
<?php } if(get_sub_field('button_link') == 'External Page Link') { ?>
<li><a target="_blank" href="<?php the_sub_field('banner_button_external_link');?>" class="blueBtn btn-<?php echo $i;?>"><?php the_sub_field('button_text');?></a></li>
          
<?php  } ?>



<?php $i++;} } ?>

</ul> 
<?php } ?>
      </div>
       </div></div>
     
 </section>
 <!--==================================================banner ends========================================== -->
 <!--==================================================Find Sim Section starts========================================== -->
 <!-- <section class="findSim">
  <div class="container">
  <div class="row">
  <div class="col-lg-5">
 <?php //the_field('findsim_content');?>
  </div>
  <div class="col-lg-7 align-self-center">
  <form>
  <ul>
  <li><input type="search"></li>
  <li><a href="#" class="searchBtn">search</a></li>
  </ul>
  </form>
  </div>
  </div>
  </div>
</section> -->
<!--==================================================Find Sim Section ends========================================== -->
<!-- --------------------------------------------simshare project starts----------------------------------------- -->
<section class="simshareProjct">
<div class="simshareInner">
  <div class="row">
    <div class="col-xl-6 leftRow">
      <div class="row">
        <div class="col-sm-4 col-xl-8">
        <img src="<?php the_field('simshare_image');?>" alt="" width="100%">
        </div>
          <div class="col-sm-8 col-xl-4">
          <div class="simshare">
           <?php the_field('simshare_content');?>

  <?php if(get_field('simshare_button_visibility')) { ?>
<a href="<?php the_field('simshare_button_link');?>"><?php the_field('simshare_button_text');?></a>
<?php } ?>
           </div>
          </div>
      </div>
    </div>
      <div class="col-xl-6 rightRow">
        <div class="row">
        
          <div class="col-sm-8 col-xl-4 ">
            <div class="Simulations">
             <?php the_field('simulations_content');?>
               <?php if(get_field('simulations_button_visibility')) { ?>
<a href="<?php the_field('simulations_button_link');?>"><?php the_field('simulations_button_text');?></a>
<?php } ?>
             </div>
          </div>
            <div class="col-sm-4 col-xl-8"><img src="<?php the_field('simulation_image');?>" alt="" width="100%"></div>
        </div>
      </div>
</div>
</div>

</section>
<!-- --------------------------------------------simshare project ends----------------------------------------- -->
<?php /*
<section class="partnerFaq">
<div class="container">
<div class="row">
<div class="col-md-6">
<div class="partner">
<?php the_field('partner_content');?>
<ul>
   <?php  
if (get_field('partner_logo')) {
while (has_sub_field('partner_logo')) {
?>  
<li><img src="<?php the_sub_field('partner_logo');?>"></li>
<?php } } ?>
</ul>
</div>
</div>
<div class="col-md-6">
<div class="Faqs">
<h2><?php the_field('faq_title');?></h2>
     <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">


 <?php

$testimoniallist = new WP_Query('posts_per_page=5&post_type=faqs&orderby=date&order=DESC');
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

        
      </div> 
<?php if(get_field('faq_button_visibility')) { ?>
<div class="action"><a href="<?php the_field('faq_button_link');?>"><?php the_field('faq_button_text');?></a>
</div>
      <?php } ?>
</div>
</div>
</div>
</div>
</section>
<?php */ ?>
 <?php get_footer(); ?>