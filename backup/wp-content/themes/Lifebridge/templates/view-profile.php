<?php 
/* Template Name: View Profile Template
*/ 
global $current_user, $wp_roles;
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

      
<div class="inner-page faq-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-offset="10" data-wow-duration="1.5s">
       

    <?php 

    if(is_user_logged_in()) { 
      $umeta = get_the_author_meta( 'profile_pic', $current_user->ID );
     // echo "$umeta";
    // show any error messages after form submission
   ?>
   <div class="left-column">
          <?php include 'page-sidebar.php'; ?>
        </div>
        <div class="right-column">
<img style="max-width: 300px" src="<?php echo $umeta; ?>">
<form id="profile_edit_creation" class="profile_edit_creation" action="" method="POST" enctype="multipart/form-data">
      <p>
        
          <label style="width: 25%">First Name : </label> <input placeholder="First Name*" required="required" disabled="disabled" name="user_first_prof" id="user_first_prof" style="max-width: 400px; display: inline-block; min-width: 400px;" type="text" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" class="form-control" />

        </p>
        <p>
           <label style="width: 25%">Last Name : </label> <input placeholder="Last Name*" disabled="disabled" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" style="max-width: 400px; display: inline-block; min-width: 400px;" required="required" name="user_last_prof" id="user_last_prof" type="text" class="form-control" />
         
        </p>
      
        <p>
        
          <label style="width: 25%">Location : </label><input id="prof-loc" disabled="disabled" value="<?php the_author_meta( 'location', $current_user->ID ); ?>"  name="prof-loc" style="max-width: 400px; display: inline-block;  min-width: 400px;" class="required form-control" type="text"/>

        </p>

        <p>
        
          <label style="width: 25%">Occupation : </label><input id="occup" disabled="disabled" value="<?php the_author_meta( 'occupation', $current_user->ID ); ?>"  name="occupation" style="max-width: 400px; display: inline-block; min-width: 400px;" class="required form-control" type="text"/>

        </p>

        

       

          <p>
        
          <label style="width: 25%">Contact : </label><input id="contactp" disabled="disabled" name="contactp" value="<?php the_author_meta( 'contactp', $current_user->ID ); ?>"  style="max-width: 400px; display: inline-block; min-width: 400px;" class="required form-control" type="text"/>

        </p>

        
           <p>
        
          <label style="width: 25%">About Me : </label><textarea id="aboutme" disabled="disabled"  name="aboutme"  style="max-width: 400px; display: inline-block; min-width: 400px;" class="required form-control" ><?php the_author_meta( 'aboutme', $current_user->ID ); ?></textarea>

        </p>

         
         <p>
        
         
          
          <div class="form-group">

          </div>
                        <!--div class="progress" style="margin-left: 25%; width: 35%">
                            <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
                        </div>
                        <div style="margin-left: 25%" class="msg"></div>
                      </div-->
          <?php wp_nonce_field( 'upload_attachment', 'my_image_upload_nonce' ); ?>

        </p>
        
         <!--p>
        
          <label style="width: 25%; vertical-align: top">Simulation Files : </label><input type="file" id="files" name="files" multiple>

        </p-->
          <p>
         
        </p>
      </form>
</div>
 <?php   }  else{
  echo "Please <a href='/login?redir=sharesim'>login</a> to continue";
}
    ?>

      </div>
    </div>
  </div>
  </div>


<?php get_footer(); ?>