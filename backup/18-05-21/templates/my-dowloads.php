<?php
/**
 * Template Name: My Downloads
 *
 * Allow users to update their profiles from Frontend.
 *
 */
get_header();

?>
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
 
        <?php if(!is_user_logged_in() ){
          echo 'You must be <a href="/login">logged<a> in view this';
        } else {
        ?>
  <div class="left-column">
          <?php include 'page-sidebar.php'; ?>
        </div>
        <div class="right-column">
<h3 style="color: #072452; padding-bottom: 10px">My Downloads</h3>
              
          <?php 
 $cuid = get_current_user_id();
   $dtrack =  get_the_author_meta(  'dtrack', $cuid );
   //echo $dtrack;
     $dtrack = explode(",",$dtrack);
    //echo $dtrack;
       $dtrack = array_filter($dtrack);
               if(empty($dtrack)) { 
                echo '<p>No downloads Yet !</p>';
              } else {
             ?>
             <table class="my-downloads">
   <thead>
  <tr>
    <th>Simulation</th>
    <th>File</th>
    <th>Downloaded</th>
    
  </tr>
</thead>
<tbody>

             <?php
 foreach($dtrack as $post) {
             $dtracks = explode(":",$post);
                   ?>
               <tr>
    <td><?php echo get_the_title($dtracks[0]) ?></td>
    <td><?php echo get_the_title($dtracks[1]); ?></td>
    
     <td><?php echo $dtracks[2] ?></td>
     
  </tr>
            
             
               <?php }?> 
</tbody>
  
</table><?php  }   ?>
                  </div>
                <?php } ?>
                </div>
                </div>
               
              </div>  </div>
<?php get_footer();?>

                 
               
