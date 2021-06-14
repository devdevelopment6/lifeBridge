<?php 
/* Template Name: Appointment Template
*/ 
get_header(); 

	
// displays error messages from form submissions
if($_REQUEST['actions']=="appointmentType"){

    $newPatient=$_POST['newPatient'];
    $patientId=$_POST['patientId'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $employmentstatus=$_POST['employmentstatus'];
    $specialty=$_POST['specialty'];
    $counselor=$_POST['counselor'];
    $appointmentType=$_POST['appointmentType'];
    $dateOfSession=$_POST['dateOfSession'];
    $visitNumber=$_POST['visitNumber'];
    $billable=$_POST['billable'];

    $wpdb->insert( 
        'lb_appointment', 
        array( 
            'newPatient'     => $newPatient,
            'patientId'    => $patientId,
            'age' => $age,
            'gender'   => $gender,
            'employmentstatus'   => $employmentstatus,
            'specialty'   => $specialty,
            'counselor'   => $counselor,
            'appointmentType'   => $appointmentType,
            'dateOfSession'   => $dateOfSession,
            'visitNumber'   => $visitNumber,
            'billable'   => $billable,
            'assignBy' => is_user_logged_in
        )
    );
    $record_id = $wpdb->insert_id;
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
		/*if(!is_user_logged_in()) { */
		// show any error messages after form submission
		isigma_show_error_messages(); ?>
 
		<div class="container">
            <form class="form-horizontal" role="form" method="post">
                <h3>New Appointment Form</h3>
               
               <div class="form-group">
                    <label class="control-label col-sm-3">New Patient</label>
                    <div class="col-sm-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="">
                                    <input type="radio" name="newPatient" id="newPatient" value="ys">Yes
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="">
                                    <input type="radio" name="newPatient" id="newPatient1" value="no">No
                                </label>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="form-group">
                    <label for="lastName" class="col-sm-3 control-label">Patient Id</label>
                    <div class="col-sm-9">
                        <input type="text" name="patientId" id="patientId" placeholder="Patient Id" class="form-control" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Age </label>
                    <div class="col-sm-9">
                        <input type="text" id="age" name="age" placeholder="Age" class="form-control" required="">
                    </div>
                </div>



               <div class="form-group">
                    <label class="control-label col-sm-3">Gender</label>
                    <div class="col-sm-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="">
                                    <input type="radio" name="gender" id="gender1" value="m">Male
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="">
                                    <input type="radio" name="gender" id="gender2" value="f">Female
                                </label>
                            </div>
                        </div>
                    </div>
                </div> 

                
                <div class="form-group">
                        <label for="Height" class="col-sm-3 control-label">Employment Status* </label>
                    <div class="col-sm-9">
                       <select name="employmentstatus" class="form-control" required="">
                       	<option>--Select--</option>
                       </select>

                       <p>Color: <?php the_field('status'); ?></p>
                    </div>
                </div>
                 <div class="form-group">
                        <label for="weight" class="col-sm-3 control-label">speciality* </label>
                    <div class="col-sm-9">
                        <select name="specialty" class="form-control" required="">
                       	<option>--Select--</option>
                       </select>
                    </div>
                </div>

                 <div class="form-group">
                        <label for="weight" class="col-sm-3 control-label">Counselor* </label>
                    <div class="col-sm-9">
                        <select name="counselor" class="form-control" required="">
                       	<option>--Select--</option>
                       </select>
                    </div>
                </div>

                 <div class="form-group">
                        <label for="weight" class="col-sm-3 control-label">Appointment Type* </label>
                    <div class="col-sm-9">
                        <select name="appointmentType" class="form-control" required="">
                       	<option>--Select--</option>
                       </select>
                    </div>
                </div> 

                <div class="form-group">
                        <label for="weight" class="col-sm-3 control-label">Date Of Session* </label>
                    <div class="col-sm-9">
                        <input type="date" id="weight" placeholder="Please write your weight in kilograms" class="form-control" required="">
                    </div>
                </div>

                 <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Visit Number </label>
                    <div class="col-sm-9">
                        <input type="text" id="visitNumber" name="visitNumber" placeholder="visit Number" class="form-control" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Billable</label>
                    <div class="col-sm-9">
                        <input type="text" id="billable" name="billable" placeholder="Billable Number" class="form-control" >
                    </div>
                </div>

                <!-- /.form-group -->
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <span class="help-block">*Required fields</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                <input type="hidden" name="actions" value="appointmentType">
            </form> <!-- /form -->
        </div> <!-- ./container -->

<?php /*} else{
	echo "<h3>You need to logout to register</h3>";
}*/ ?>
		  </div>
    <!-- </div>
  </div>
  </div> -->
  
<script src="<?php echo get_template_directory_uri()?>/js/intlTelInput.js"></script>

 <script>

 var input = document.querySelector("#phone");
  window.intlTelInput(input, {
      
      utilsScript: "<?php echo get_template_directory_uri()?>/js/utils.js",
    });
</script>
<?php get_footer(); ?>