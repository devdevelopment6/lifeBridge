<?php 
/* Template Name: Inquiry Template
*/ 
get_header(); 

  
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
      $message="Inquiry Has been Submitted Sucessfully";
    }
}
?>

<style type="text/css">
  

*[role="form"] {
    max-width: 530px;
    padding: 15px;
    margin: 0 auto;
    border-radius: 0.3em;
    background-color: #f2f2f2;
}

*[role="form"] h2 { 
    font-family: 'Open Sans' , sans-serif;
    font-size: 40px;
    font-weight: 600;
    color: #000000;
    margin-top: 5%;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 4px;
}

</style>

<!------ Include the above in your HEAD tag ---------->



<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/intlTelInput.css">
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
  .iti.iti--allow-dropdown{
    width: 100%;
  }
</style>
      
<!-- <div class="inner-page faq-page">
  <div class="container">
    <div class="row"> -->
      


 
    <?php 
    if(is_user_logged_in()) { 
    // show any error messages after form submission
    isigma_show_error_messages(); ?>

    <?php if($message!=''){?>
    <div class="container">
      <div class="row">
        <p style="color: green;font-weight: bold; text-align: center;"><?php echo $message;?></p>
      </div>
    </div>  
    <?php } ?>
    <div class="container">
      <div class="col-sm-4"> 

        <div class="wow fadeInUp simdetail">
        <?php if(!is_user_logged_in() ){
          echo 'You must be <a href="/login">logged<a> in view this';
        } else {
        ?>
        <div class="left-column">
          <?php include 'page-sidebar.php'; ?>
        </div>
      <?php }?>
      </div>
      </div> 
      <div class="col-sm-8">
            <form class="form-horizontal" role="form" method="post">
              <div class="form-group"> 
                <h3>New Inquirey Form</h3>
               <hr>
              </div> 
                  <?php $inqueryDate=date('Y-m-d');
                       $time = date('H:i', time());
                  ?>
                <div class="form-group">                    
                    <div class="col-sm-4">
                        <input type="date" name="inqueryDate" id="inqueryDate" placeholder="Date *" class="form-control" value="<?php echo $inqueryDate;?>" required="">
                    </div>

                    <div class="col-sm-4">
                        <input type="text" name="inquerytime" id="inquerytime" placeholder="Time *" class="form-control" value="<?php echo  $time;?>" required="" >
                    </div>

                    <div class="col-sm-4">
                        <select name="inqueryMethod" class="form-control" required="">
                          <option>--Select--</option>
                          <option value="1">Phone Call</option>
                          <option value="2">Text</option>
                          <option value="3">Email</option>
                        </select>
                    </div>
                </div>
                

                <!-- /.form-group -->
                <div class="form-group">
                  
                    <div class="col-sm-8 col-sm-offset-3">
                        <span class="help-block">*Required fields</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                <input type="hidden" name="actions" value="inquirey">
            </form> <!-- /form -->
          </div>
        </div> <!-- ./container -->

<?php } else{
  echo "<h3>You need to logout to register</h3>";
} ?>
      </div>
    <!-- </div>
  </div>
  </div> -->
<div class="container">  
<div class="col-sm-4"> 
 </div>  
 <div class="col-sm-8"> 
  <div class="card text-center" >
  <div class="card-header">
    <h2>Reports</h2>
  </div>
  <div class="card-body">
   
    <button class="btn btn-primary" onclick="window.location = '<?php echo site_url();?>/list-of-inquiry-form/'">Inquiries Reports</button>
   <!--  <button class="btn btn-primary" onclick="window.location = '<?php echo site_url();?>/list-of-appointment/'">Appointment Reports</button> -->
  </div>
  
</div>
</div>

</div>
  
<script src="<?php echo get_template_directory_uri()?>/js/intlTelInput.js"></script>

 <script>

 var input = document.querySelector("#phone");
  window.intlTelInput(input, {
      
      utilsScript: "<?php echo get_template_directory_uri()?>/js/utils.js",
    });
</script>
<?php get_footer(); ?>