<?php
/**
/* Template Name: Simulation Page
*/

get_header(); ?>

<div class="inner-banner">
      <div class="container">
            <div class="row">
              <div class="col-lg-12 wow fadeInUp" data-wow-offset="10" data-wow-duration="1.5s">
            
                <h1 class="page-title"><?php the_title();?></h1>
            </div>
           
          </div>
        </div>
  </div>





<div class="inner-page">
    <div class="container">
     <div class="row">
      <div class="col-lg-12 col-md-12">   
     <?php 
while ( have_posts() ) : the_post();
the_content();
endwhile;
?>


   

  <div class="accordion-section">

<div id="accordion">
 <?php  
if (get_field('accordion')) {
  $i=1;
while (has_sub_field('accordion')) {
?>  
  <div class="card card-<?php echo $i;?>">
    <div class="card-header" id="heading-<?php echo $i;?>">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-<?php echo $i;?>" aria-expanded="false" aria-controls="collapseOne">
            <?php the_sub_field('accordion_title');?>
        </button>
    </div>
    <div id="collapse-<?php echo $i;?>" class="collapse" aria-labelledby="heading-<?php echo $i;?>" data-parent="#accordion">
      <div class="card-body">
        <?php the_sub_field('accordion_content');?>
      </div>
    </div>
  </div>
<?php $i++;} } ?>

<div class="key-aspects pt-5 card-<?php echo $i;?>">
  
<?php the_field('key_aspects_heading');?>

 </div>
</div>   
</div>

 

 </div>
    
 


      </div>
  </div>
</div>
<script>
$(document).ready(function(){
    $("[data-parent='#accordion']").on("click", function(){
        var trigger = $(this);
        $(".panel-collapse.collapse.in").each(function(){
            if( trigger.attr("href") != ("#"+$(this).attr("id")) ){
            $(this).removeClass("in");
            } // condition returns false on iteration on div to be opened
        });   
    });
});

</script>

<?php get_footer();