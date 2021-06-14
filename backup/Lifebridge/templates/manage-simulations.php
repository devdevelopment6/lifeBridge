<?php 
/* Template Name: Manage Simulations Template
*/ 
?>
<?php get_header(); 

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
    <style type="text/css">
  td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

th {
  background-color: #dddddd;
}
</style>
      
<div class="inner-page faq-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 wow fadeInUp simdetail" data-wow-offset="10" data-wow-duration="1.5s">
        <?php if(!is_user_logged_in() ){
          echo 'You must be <a href="/login">logged<a> in view this';
        } else {
        ?>
        <div class="left-column">
          <?php include 'page-sidebar.php'; ?>
        </div>
        <div class="right-column">
          <div class="rightspo">

         
          <?php 
 $cuid = get_current_user_id();
  
  $posta = array();
             $args = array(
                   'post_type'   => 'sims',
                   'orderby' => 'publish_date',
                    'post_status' => 'publish',
                   'author' => $cuid,
                    'order' => 'DESC',
                     'posts_per_page' => -1
                  );
            $latest_books = get_posts( $args );
            if($latest_books){
?>
          
 <h3 style="color: #072452; padding-bottom: 10px">My Sims</h3>
<table class="my-sim">
   <thead>
 <tr>
    <th>Title</th>
    <th>Uploaded</th>
   <th>Files</th>
    <th>Level</th>
    <th>Views</th>
    <th>Edit</th>
     <th>Delete</th>
  </tr>
</thead>
<tbody>
  <?php
  
            foreach($latest_books as $post) {

              $stra = get_post_meta( get_the_ID(), 'files', true );
              $posta = explode(",",$stra);
              $result = array_filter($posta); 
             $carr = sizeof($result);
             $count = 0;
             $postauth = $post->post_author;

              $views = get_post_meta( get_the_ID(), 'views', true );
              $viewsa = explode(",",$views);
              $viewsa = array_filter($viewsa); 
             $viewc = count($viewsa);
             //$statd = array_filter($statd);
 foreach ($result as $key) {
   # code...
  //$name = wp_basename( $key );
  $tit = get_the_title($key);
  if($tit !== ''){
    $count = $count + 1;
  }
}
             //echo "$postauth";
             //$postauthname = get_the_author_meta()
             //print_r($posta);
             //print_r(get_post_meta( get_the_ID(), 'subject_classifications', true ));
              ?>
  <tr>
    <td><a href="/sim-details/?simid=<?php echo get_the_ID(); ?>"><?php echo get_the_title() ?></a></td>
    <td><?php echo get_the_date() ?></td>
         <td><?php echo $count; ?></td>
            <td style="text-transform: capitalize;"><?php echo get_post_meta( get_the_ID(), 'security', true ); ?></td>
            <td><?php echo $viewc; ?></td>
             <td><a href='/edit-sim?simid=<?php echo get_the_ID(); ?>'><i class="fas fa-edit"></i></a></td>
              <td class="delpost" data-del='<?php echo get_the_ID() ?>'><i class="fas fa-trash-alt"></i></td>
  </tr>
  <?php } ?>

</tbody>
  
</table>

<?php } else {
  echo "<p>No Published Sims Yet!</p>";
} ?>

  
          <?php 
 $cuid = get_current_user_id();
  
  $posta = array();
             $args = array(
                   'post_type'   => 'sims',
                   'orderby' => 'draft',
                   'author' => $cuid,
                    'post_status' => 'draft',
                    'order' => 'DESC',
                     'posts_per_page' => -1
                  );
            $latest_books = get_posts( $args );
            if($latest_books){
?>
<p style="padding-bottom: 10px; margin-top: 25px;">This is a summary page of draft posts on Simshare. </p>
          <h1 >My Drafts</h1>
         
 
<table class="my-sim">
   <thead>
  <tr>
    <th>Title</th>
    <th>Uploaded</th>
   <th>Files</th>
    <th>Level</th>
    <th>Views</th>
    <th>Edit</th>
     <th>Delete</th>
  </tr>
</thead>
<tbody>
  <?php
  
            foreach($latest_books as $post) {

              $stra = get_post_meta( get_the_ID(), 'files', true );
              $posta = explode(",",$stra);
              $result = array_filter($posta); 
             $carr = sizeof($result);
             $count = 0;
             $postauth = $post->post_author;

              $views = get_post_meta( get_the_ID(), 'views', true );
              $viewsa = explode(",",$views);
              $viewsa = array_filter($viewsa); 
             $viewc = count($viewsa);
             //$statd = array_filter($statd);
 foreach ($result as $key) {
   # code...
  //$name = wp_basename( $key );
  $tit = get_the_title($key);
  if($tit !== ''){
    $count = $count + 1;
  }
}
             //echo "$postauth";
             //$postauthname = get_the_author_meta()
             //print_r($posta);
             //print_r(get_post_meta( get_the_ID(), 'subject_classifications', true ));
              ?>
   <tr>
    <td><a href="/sim-details/?simid=<?php echo get_the_ID(); ?>"><?php echo get_the_title() ?></a></td>
    <td><?php echo get_the_date() ?></td>
         <td><?php echo $count; ?></td>
            <td style="text-transform: capitalize;"><?php echo get_post_meta( get_the_ID(), 'security', true ); ?></td>
            <td><?php echo $viewc; ?></td>
             <td><a href='/edit-sim?simid=<?php echo get_the_ID(); ?>'><i class="fas fa-edit"></i></a></td>
              <td class="delpost" data-del='<?php echo get_the_ID() ?>'><i class="fas fa-trash-alt"></i></td>
  </tr>
  <?php } ?>

</tbody>
  
</table>

<?php } ?>
</div>


        </div>
      <?php } ?>
      </div>
    </div>
  </div>
  </div>
  
<script type="text/javascript">
       jQuery('body').on('click', '.delpost', function() {
      var simid = jQuery(this).attr('data-del');
      var r = confirm("Are you Sure ?");
  if (r == true) {
   
 
       //jQuery('#searchval').val("");
      //jQuery('#pagination').hide();
      //var role = '<?php echo $getrole ?>';
      if(simid != ''){
      jQuery.ajax({
    url: "<?php echo get_template_directory_uri() ?>/user-request.php",
        type: "post",
        data: {"simid" : simid , "utype":'delete' },

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
 } else {
   console.log('ok');
  }

    });
       </script>
<?php get_footer(); ?>