<?php 
/* Template Name: Thank You Appointment
*/ 
get_header(); 

$getId= base64_decode($_REQUEST['id']);


 global $wpdb;   

 $appointment = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "appointment where id='".$getId."'");
  
?>

<!------ Include the above in your HEAD tag ---------->



<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/intlTelInput.css">


<?php //if(is_user_logged_in()){ ?>
<section class="innerSec">  
    <div class="container">
      <div class="feildBoxBgcover">           
               <h1 class="page-title"><?php the_title();?></h1>
               <p style="color: #000; font-size: 18px;">New Appointment has been booked successfully  against the  Patient ID <strong><span style="color: #ef081d;"><?php echo $appointment->patientId ;?></span>. Please see the booking details <a href="<?php echo site_url();?>/list-of-appointment">Click here</a></strong></p> 
       </div>
    </div>
 </section>
<?php //} ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<script type="text/javascript">
  $('#inquiryTabel_id').DataTable( {
    responsive: true
} );
</script>
<?php get_footer(); ?>