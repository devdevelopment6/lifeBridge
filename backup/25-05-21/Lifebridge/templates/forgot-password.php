<?php
/**
 * Template Name: Forgot Password
 *
 * Allow users to update their profiles from Frontend.
 *
 */
get_header();

$errors = array();
$outpss = array();
 global $current_user, $wp_roles;


if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
  $user_email = $_POST['user_email'];
   /* Update user password. */
    if(username_exists($user_email)) {
      // Username already registered
      $my_array['activation_key'] = md5( $user_email );
      $headers = array('Content-Type: text/html; charset=UTF-8');
      $valkey =  $my_array['activation_key'];
      $user = get_user_by( 'login', $user_email );
      $user_email = $user->user_email;
      $USERID = $user->ID;

      $message = "Hi, we have received a request to reset your password <br><br><a href='".home_url()."/change-password/?id=$USERID&u=$user_email&k=$valkey&reset=true'>Click Here to Reset</a><br><br> ";
      if(wp_mail($user_email, 'Account Password Reset', $message,  $headers )){
         isigma_errors()->add('password_mismatch', __('A link to reset password has been sent to you!.'));
      }
      else{
         isigma_errors()->add('password_mismatch', __('There was a error sending the email!.'));
      }
     
    } elseif (email_exists( $user_email ) ) {
         $my_array['activation_key'] = md5( $user_email );
      $headers = array('Content-Type: text/html; charset=UTF-8');
      $valkey =  $my_array['activation_key'];
      $user = get_user_by( 'email', $user_email );
      $user_email = $user->user_email;
      $USERID = $user->ID;

      $message = "Hi, we have received a request to reset your password <br><br><a href='".home_url()."/change-password/?id=$USERID&u=$user_email&k=$valkey&reset=true'>Click Here to Reset</a><br><br> ";
      if(wp_mail($user_email, 'Account Password Reset', $message,  $headers )){
         isigma_errors()->add('password_mismatch', __('A link to reset password has been sent to you!.'));
      }
      else{
         isigma_errors()->add('password_mismatch', __('There was a error sending the email!.'));
      }
    }
        else{
            isigma_errors()->add('password_mismatch', __('Username does not exist.')); 
           // $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
        }
    
   $errors2 = isigma_errors()->get_error_messages();
   if(empty($errors2)) {
  //print_r($outpss);exit();
   
    do_action('edit_user_profile_update', $current_user->ID);
    //echo 'Added Succesfully';
    //echo $current_user->ID ; 
     //the_author_meta( 'userstatus', $current_user->ID ); die(); exit;
  wp_redirect(home_url().'/login'); exit;
       
    }
  
}


// displays error messages from form submissions 
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
      <div class="col-lg-12 col-md-12 wow fadeInUp login-form" data-wow-offset="10" data-wow-duration="1.5s">

               <?php 
                 isigma_show_error_messages();
        // show any error messages after form submission
                  

    ?>
           <form method="post" id="adduser"  action="<?php the_permalink(); ?>" enctype="multipart/form-data">
                    <fieldset>
                  
                    <p class="form-password">
                        <label for="user_name"><?php _e('Please Enter Username/Email Id *', 'profile'); ?> </label>
                        <input class="text-input form-control" name="user_email" type="text" required="required" id="user_name" />
                    </p><!-- .form-password -->
                  
                     
                   
                    <p class="form-submit">
                       
                        <input name="updateuser" type="submit" id="updateuser" class="submit forgot-pass button" value="<?php _e('Send Reset Email', 'profile'); ?>" />
                        <?php wp_nonce_field( 'update-user' ) ?>
                        <input name="action" type="hidden" id="action" value="update-user" />
                    </p><!-- .form-submit -->
                    </fieldset>
                </form><!-- #adduser -->


        </div><!-- .entry-content -->
    
</div>
       
   </div>
</div>
<?php get_footer();?>

                 
               
