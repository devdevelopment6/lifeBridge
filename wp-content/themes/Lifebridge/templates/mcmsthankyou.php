<?php 
/* Template Name: MCMS Member Thank You Appointment
*/ 
get_header(); 

$getId= base64_decode($_REQUEST['id']);


 global $wpdb;   

 $appointment = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "appointment where id='".$getId."'");
  
?>

<!------ Include the above in your HEAD tag ---------->



<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/intlTelInput.css">

<section class="innerSec">  
  
        
            
<div class="container">
  

<!-- -----------------------------------------------   ----------------------------------------------- -->
    <div class="feildBoxBgcover">
    <h1> Thank You</h1>
    <p>Please call Waco Psychological Associates at (254) 751-1550.<br>  Ask for Joanne and let her know you are an MCMS member requesting a LifeBridge appointment!</p>
    
  </div>
</div>
  </section>
  



<?php get_footer(); ?>