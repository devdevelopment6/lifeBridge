<?php 
/* Template Name: Edit Profile Template
*/ 
global $current_user, $wp_roles;
?>
<?php get_header(); 
  if (isset( $_POST["edit_profile_button"] ) ) {
   // echo $_POST['publish']; exit;

   
// Update the post into the database
   
    if ( !empty( $_POST['user_first_prof'] ) ){
       update_user_meta( $current_user->ID, 'first_name',  $_POST['user_first_prof']  );
            }

    if ( !empty( $_POST['user_last_prof'] ) ){
        update_user_meta( $current_user->ID, 'last_name',  $_POST['user_last_prof']  );
    }

    if ( !empty( $_POST['prof-loc'] ) ){
         update_user_meta( $current_user->ID, 'location',  $_POST['prof-loc']  );
    }

     $user_id = (int) $current_user->ID; // correct ID
    wp_update_user( array(
        'ID' => $user_id,
        'user_email' => $_POST[ 'user_edit_email' ]
   ) ); 
    if ( !empty( $_POST['occupation'] ) ){
         update_user_meta( $current_user->ID, 'occupation',  $_POST['occupation']  );
    }

    if ( !empty( $_POST['institutions'] ) ){
         update_user_meta( $current_user->ID, 'institutions',  $_POST['institutions']  );
    }

     if ( !empty( $_POST['contactp'] ) ){
         update_user_meta( $current_user->ID, 'contactp',  $_POST['contactp']  );
    }

    if ( !empty( $_POST['aboutme'] ) ){
         update_user_meta( $current_user->ID, 'aboutme',  $_POST['aboutme']  );
    }


    if ( !empty( $_POST['urlsadd'] ) ){
         update_user_meta( $current_user->ID, 'urlsadd',  $_POST['urlsadd']  );
    }
    
     if(!empty( $_FILES['profile_pic']['name'] )){ 
    if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}

$uploadedfile = $_FILES['profile_pic'];
$upload_overrides = array( 'test_form' => false );
/* You can use wp_check_filetype() function to check the
 file type and go on wit the upload or stop it.*/

 $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
    $imageurl = "";
    $maxsize    = 10485760;
    if(($_FILES['profile_pic']['size'] >= $maxsize) || ($_FILES["profile_pic"]["size"] == 0)) {
       
          $errors[] = 'File too large. File must be less than 10 megabytes.';
      } else{
    if ( $movefile && ! isset( $movefile['error'] ) ) {
       $imageurl = $movefile['url'];
      // echo $imageurl;
        update_user_meta( $current_user->ID, 'profile_pic',  $imageurl  );
        ?>
           <script type="text/javascript">
      window.location.replace("/dashboard/");
    </script>
    <?php
    } else {
       echo $movefile['error'];
    }
  }
  }
    ?>
   
    <?php 
    wp_redirect(home_url().'/dashboard/');
    //echo "string";
   

    //$user_first     = $_POST["isigma_partner_first"];  
}
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
          <?php
           if(count($errors) === 0) {
        
    } else {
        foreach($errors as $error) {
            echo '<script>alert("'.$error.'");</script>';
        }

         //Ensure no more processing is done
    }
    ?>

<form id="profile_edit_creation" class="profile_edit_creation" action="" method="POST" enctype="multipart/form-data">
      <p>
        
          <label style="width: 25%">First Name : </label> <input placeholder="First Name*" required="required" name="user_first_prof" id="user_first_prof" style="max-width: 400px; display: inline-block; min-width: 400px;" type="text" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" class="form-control" />

        </p>
        <p>
           <label style="width: 25%">Last Name : </label> <input placeholder="Last Name*" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" style="max-width: 400px; display: inline-block; min-width: 400px;" required="required" name="user_last_prof" id="user_last_prof" type="text" class="form-control" />
         
        </p>

        <p>
           <label style="width: 25%">Email : </label> <input placeholder="Email*" value="<?php echo $current_user->user_email; ?>" style="max-width: 400px; display: inline-block; min-width: 400px;" required="required" name="user_edit_email" id="user_edit_email" type="email" class="form-control" />
         
        </p>
      
        <p>
        
          <label style="width: 25%">Location : </label><input id="prof-loc" value="<?php the_author_meta( 'location', $current_user->ID ); ?>"  name="prof-loc" style="max-width: 400px; display: inline-block;  min-width: 400px;" class="required form-control" type="text"/>

        </p>

        <p>
        
          <label style="width: 25%">Occupation : </label><input id="occup" value="<?php the_author_meta( 'occupation', $current_user->ID ); ?>"  name="occupation" style="max-width: 400px; display: inline-block; min-width: 400px;" class="required form-control" type="text"/>

        </p>

        

        
         
          <p>
          
           <label style="width: 25%">Contact : </label><input placeholder="Phone Number*" type="tel" id="contactp"  name="contactp" value="<?php the_author_meta( 'contactp', $current_user->ID ); ?>"  style="max-width: 400px; display: inline-block; min-width: 400px;" class="required form-control"/>
          
        </p>
 
           <p>
        
          <label style="width: 25%">About Me : </label><textarea id="aboutme"  name="aboutme"  style="max-width: 400px; display: inline-block; min-width: 400px;" class="required form-control" ><?php the_author_meta( 'aboutme', $current_user->ID ); ?></textarea>

        </p>

         
         <p>
        
          <label style="width: 25%; vertical-align: top">Profile Pic : </label><input type="file" name="profile_pic" class="files" size="50" />
          
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
         
          <input type="submit" id="submit-button" name="edit_profile_button" value="<?php _e('Save'); ?>"/>
        
        </p>
      </form>
      <script src="<?php echo get_template_directory_uri()?>/js/caret.js"></script>
<script src="<?php echo get_template_directory_uri()?>/js/phone.js"></script>

 <script>
jQuery(function($){
var input = $('[type=tel]')
input.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'}); // U.S.
input.bind('country.mobilePhoneNumber', function(e, country) {
$('.country').text(country || '')
})
});
</script>
</div>
     <?php

}  else{
  echo "Please <a href='/login?redir=sharesim'>login</a> to continue";
}
    ?>

      </div>
    </div>
  </div>
  </div>


<?php get_footer(); ?>