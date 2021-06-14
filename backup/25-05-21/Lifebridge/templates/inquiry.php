<?php 
/* Template Name: Inquiry Template
*/ 
get_header(); 

if(!is_user_logged_in()){
 echo '<script type="text/javascript">window.location.href = "login/"</script>';
}

  
date_default_timezone_set("Asia/Calcutta"); 
// displays error messages from form submissions
if($_REQUEST['actions']=="inquirey"){

    $inqueryDate=$_POST['inqueryDate'];
    $inquerytime=$_POST['inquerytime'];
    $inqueryMethod=$_POST['inqueryMethod'];
    

    $wpdb->insert( 
        'lb_inquirey', 
        array( 
            'inqueryDate'     => $inqueryDate,
            'inquerytime'    => $inquerytime,
            'inqueryMethod' => $inqueryMethod,
            'assignBy' => get_current_user_id()
        )
    );
    $record_id = $wpdb->insert_id;
    if($record_id){
     
     // echo '<meta http-equiv=Refresh content="0;url= home_url()/list-of-inquiry-form/list-of-inquiry-form/?reload=1">';  
     //echo '<script type="text/javascript">window.location.href = "list-of-inquiry-form/"</script>'; 
      $message="Inquiry Has been Submitted Sucessfully .";
    }
}
?>

<?php $inqueryDate=date('Y-m-d');
 $time = date('H:i', time());
?>

<section class="innerSec"> 
<?php 
    if(is_user_logged_in()) { 
    // show any error messages after form submission
    isigma_show_error_messages(); ?>

   
  <div class="container">  
        <div class="feildBox">
           <?php if($message!=''){?>
             
                  <p style="color: green;font-weight: bold; text-align: center;"><?php echo $message;?></p>
                  
           <?php } ?> 
          <h1><?php the_title();?></h1>
          <form  name="inquiryForm" action="" method="post">
            <div class="row">
              <div class="col-sm-3">
                <div class="dateBox">                 
                  <input placeholder="Date" class="textbox-n" type="date" name="inqueryDate" id="inqueryDate"  value="<?php echo $inqueryDate;?>" required="">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="dateBox">
                <!-- <span><img src="<?php bloginfo('template_url');?>/img/numIcon.jpg"></span> -->
                <input type="time" placeholder="Time" name="inquerytime" id="inquerytime" class="timefeild" value="<?php echo  $time;?>" required="">
                </div>
             </div>
              <div class="col-sm-6">            
                <select name="inqueryMethod" required="">
                    <option>--Select--</option>
                    <option value="1">Phone Call</option>
                    <option value="2">Text</option>
                    <option value="3">Email</option>
                </select>
            </div>            
            </div>
            
             <button type="submit" class="submtBtn">Submit</button>
                <input type="hidden" name="actions" value="inquirey">
          </form>        
          <div class="Reports">
          <h2>Reports</h2>
          <ul>
            <li><a href="<?php echo site_url();?>/list-of-inquiry-form/" class="inquiryBTn">Inquiries Report</a></li>
            <!-- <li><a href="#" class="AptmntBTn">Appointments Report</a></li> -->
          </ul>
      </div>
    </div>
  </div>
  <?php } else{
  echo "<h3>You need to logout to register</h3>";
} ?>
</section>
  

<?php get_footer(); ?>