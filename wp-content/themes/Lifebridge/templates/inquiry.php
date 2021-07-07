<?php 
/* Template Name: Inquiry Template
*/ 
get_header(); 

if(!is_user_logged_in()){
 echo '<script type="text/javascript">window.location.href = "login/"</script>';
}

  
date_default_timezone_set("America/Chicago"); 

// displays error messages from form submissions
if($_REQUEST['actions']=="inquirey"){

    $inquery=$_POST['inqueryDate'];
    $inqueryDate=$_POST['inqueryDate'];
    $intime=$_POST['inquerytime'];
    $inqueryMethod=$_POST['inqueryMethod'];

    $inqueryDate=date('Y-m-d',strtotime($inquery));
    $inquerytime=date('h:i A', strtotime($intime));
    //echo $inquerytime;die;

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

<?php 
//$inqueryDate=date('Y-m-d');
$inqueryDate=date('m/d/Y');
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
                  <input placeholder="Date" class="textbox-n datepicker" type="text" name="inqueryDate" id="inqueryDate"  value="<?php echo $inqueryDate;?>" required="">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="dateBox">
                <!-- <span><img src="<?php bloginfo('template_url');?>/img/numIcon.jpg"></span> -->
                <input type="text" placeholder="Time" name="inquerytime" id="inquerytime" class="timefeild" value="<?php echo  $time;?>" required="">
                </div>

             </div>
              <div class="col-sm-6">            
                <select name="inqueryMethod" class="required" required="">
                    <option value="">--Select--</option>
                    <option value="phonecall">Phone Call</option>
                    <option value="text">Text</option>
                    <option value="email">Email</option>
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
            <li><a href="<?php echo site_url();?>/list-of-appointment/" class="inquiryBTn">Appointment Report</a></li>
          </ul>
      </div>
    </div>
  </div>
  <?php } else{
  echo "<h3>You need to logout to register</h3>";
} ?>
</section>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <!-- <script src="https://jsfiddle.net/rdemartis/p9ezwn0n/8/embed/"></script> -->

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>

<script type="text/javascript">
  /*$("#inqueryDate").datepicker({
    maxDate: 0
});
*/

$(document).ready(function () {
   $('#inquerytime').timepicker({
       datepicker:false,
       formatTime:"h:i a",
       step:60,
       format:"h:i a"
    });
});




  $(document).ready(function () {
        var today = new Date();
        $('.datepicker').datepicker({
            format: 'yyyy-m-d',
            //minDate : 0,
            maxDate : 0,
            autoclose:true,
        }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });


        $('.datepicker').keyup(function () {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9^-]/g, '');
            }
        });
    });
</script>
  

<?php get_footer(); ?>