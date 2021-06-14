<?php
/**
 * Template Name: My Connections
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

            
         
          <?php 
 $cuid = get_current_user_id();
  
  $posta = array();
             $args = array(
                   'post_type'   => 'sims',
                   'orderby' => 'publish_date',
                   'author' => $cuid,
                    'post_status' => 'any',
                    'order' => 'DESC',
                     'posts_per_page' => -1
                  );
            $latest_books = get_posts( $args );
            if($latest_books){
  
 
?>

        <h3>Download Requests</h3>
         

  <?php

                foreach($latest_books as $post) {
                    $postsec = get_post_meta( get_the_ID(), 'security', true );
  if($postsec == 'private'){
              $stra = get_post_meta( get_the_ID(), 'files', true );
              $posta = explode(",",$stra);
              $result = array_filter($posta); 
               $carr = sizeof($result);
               $count = 0;
               $postauth = $post->post_author;
               //$statd = array_filter($statd);
                $ureq =  get_post_meta( get_the_ID(), 'ureq', true );
                $ureq = explode(",",$ureq);
               $ureq = array_filter($ureq);
                 if(empty($ureq)) { ?>
                  
                  <div class="posttit" style="font-weight: bold; color:blue;padding-bottom: 20px">
                    <?php echo get_the_title() ?>
                  </div>
                <?php
                echo "<p>There are no Requests yet for this sim</p>";
               } else{ ?>
                <div class="posttit" style="font-weight: bold; color:blue;padding-bottom: 20px">
                    <?php echo get_the_title() ?>
                  </div>
                  <!-- Different tables for different sims -->
               <table class="my-connections">
   <thead>
  <tr>
    <th>Sim Title</th>
    <th>User Name</th>
    <th>Institution</th>
    <th>Location</th>
    <th></th>
  </tr>
</thead>
<tbody>
             <?php    foreach($ureq as $req) { ?>

               <tr>
    <td><?php echo get_the_title() ?></td>
    <td><?php echo get_the_author_meta( 'first_name', $req )." ".get_the_author_meta( 'last_name', $req ); ?></td>
    
     <td><?php echo get_the_author_meta(  'institutions', $req ); ?></td>
       <td><?php echo get_the_author_meta(  'location',  $req  ); ?></td>
<td><button data-sub='<?php echo $req ?>' class='rowbutt' data-all='<?php echo get_the_ID() ?>'>Allow Access</button></td>
         
  </tr>
            
             
               <?php }?> 
</tbody>
  
</table><?php  } } } ?>


            <?php } else {
                    echo "<p>You haven't published any sims yet!</p>";
                  } ?>
                  </div>
                <?php } ?>
                </div>
                </div>
                <script type="text/javascript">
       jQuery('body').on('click', '.rowbutt', function() {
      var simid = jQuery(this).attr('data-all');
      var uid = jQuery(this).attr('data-sub');
       //jQuery('#searchval').val("");
      //jQuery('#pagination').hide();
      //var role = '<?php echo $getrole ?>';
      if(uid != ''){
      jQuery.ajax({
    url: "<?php echo get_template_directory_uri() ?>/user-request.php",
        type: "post",
        data: {"simid" : simid , "uid": uid , "utype":'sub' },

         beforeSend: function() { 
                jQuery('body').addClass("loading");  
                jQuery('body').append('<div class="modalgif">wait...</div>');
                
              },
              complete: function() { 
          jQuery('body').removeClass("loading"); 
          jQuery('.modalgif').remove();
           
        },
      success: function(result){
        console.log('hi');
        location.reload();
      }
  });
}

    });
       </script>
              </div>
              </div>
<?php get_footer();?>

                 
               
