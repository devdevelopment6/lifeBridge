<?php
/**
 * Template Name: Reset Password
 *
 * Allow users to update their profiles from Frontend.
 *
 */
get_header();

if(!is_user_logged_in()){
 echo '<script type="text/javascript">window.location.href = "login/"</script>';
}

$errors = array();
$outpss = array();
 global $current_user, $wp_roles;

$userid = $_GET['_user__role'];
       
 



if ( !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
    $user_pass      = $_POST["pass1"];
        $pass_confirm   = $_POST["pass2"];
    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] ){
           
            
        }
        else{
            isigma_errors()->add('password_mismatch', __('Passwords do not match')); 
           // $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
        }
    }
    else {
          isigma_errors()->add('password_empty', __('Please enter a password'));
    }

   
    /* Update user information. */
   
 


       // echo "ehwkjehjkdhsjkhds".$current_user->ID ; 

   $errors2 = isigma_errors3nr()->get_error_messages();
   if(empty($errors2)) {
    $cid = $_POST['resetpass'];
  //print_r($cid); exit();
    if(!empty($cid)){
       wp_update_user( array( 'ID' => $cid, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
   
   
    do_action('edit_user_profile_update', $cid);
    }
    else{
    wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
   
   
    do_action('edit_user_profile_update', $current_user->ID);
  }
    //echo 'Added Succesfully';
    //echo $current_user->ID ; 
     //the_author_meta( 'userstatus', $current_user->ID ); die(); exit;
  wp_setcookie($current_user->user_login , esc_attr( $_POST['pass1'] ), true);
        wp_set_current_user($current_user->ID, $current_user->user_login);
 // wp_redirect(home_url().'/dashboard/'); 
    }
    /* Redirect so the page will show updated info.*/
  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
    
}




function isigma_errors3nr(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function isigma_show_error_message3nr() {
    if($codes = isigma_errors3nr()->get_error_codes()) {
        echo '<div class="isigma_errors">';
            // Loop error codes and display errors
           foreach($codes as $code){
                $message = isigma_errors3nr()->get_error_message($code);
                echo '<span class="error" style="color:#fff"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
            }
        echo '</div>';
    }   
}
// displays error messages from form submissions 
?>

       
<setion class="innerSec">
<div class="container">
       <div class="feildBoxBgcover1">
        <h1> <?php the_title();?></h1>
        <div class="FeildsSize">

               <?php 
                 isigma_show_error_messages();
                // show any error messages after form submission
                ?>
           <form method="post" id="adduser"  action="<?php the_permalink(); ?>" enctype="multipart/form-data">
                    <fieldset>
                  
                    <p class="form-password">
                        <label for="pass1"><?php _e('Password *', 'profile'); ?> </label>
                         <input class="text-input form-control" value="<?php echo $userid ?>" name="resetpass" type="hidden" id="resetpass" />
                        <input class="text-input form-control" name="pass1" type="password" id="pass1" />
                    </p><!-- .form-password -->
                    <p class="form-password">
                        <label for="pass2"><?php _e('Repeat Password *', 'profile'); ?></label>
                        <input class="text-input form-control" name="pass2" type="password" id="pass2" />
                    </p><!-- .form-password -->
                   
                     
                   
                    <p class="form-submit">
                       
                        <input name="updateuser" type="submit" id="updateuser" class="submtBtn2" value="<?php _e('Update', 'profile'); ?>" />
                        <?php wp_nonce_field( 'update-user' ) ?>
                        <input name="action" type="hidden" id="action" value="update-user" />
                    </p><!-- .form-submit -->
                    </fieldset>
                </form><!-- #adduser -->
</div>
</div>
</div>
</setion>

<?php get_footer();?>

                 
               
