<?php 
/* Template Name: User Redirected Template
*/ 
?>
<?php //get_header(); 
 wp_head(); 

global $current_user;
 $sname = $current_user->first_name.' '.$current_user->last_name;
 $ids = get_current_user_id();
 $user_meta = get_userdata($ids);
$user_roles = $user_meta->roles;

if(is_user_logged_in() ){
   if ( in_array( 'usera', $user_roles, true ) ) {
      echo '<script type="text/javascript">window.location.href = "'.site_url().'/inquiry/"</script>';
    }else if ( in_array( 'userb', $user_roles, true ) ) {
       echo '<script type="text/javascript">window.location.href = "'.site_url().'/appointment/"</script>';
    }else{
      echo '<script type="text/javascript">window.location.href = "login/"</script>';
    }
}


?>



<?php get_footer(); ?>