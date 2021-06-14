<?php 
/* Template Name: Appointment Template
*/ 
get_header(); 

	
// displays error messages from form submissions


if($_REQUEST['actions']=="submitAppointment"){
  if($billable=$_POST['billable']){
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


    if(!empty($patientId)){
        $wpdb->insert( 
          'lb_appointment', 
          array( 
              'newPatient'     => $newPatient,
              'patientId' => $patientId,
              'age' => $age,
              'gender'   => $gender,
              'employmentstatus'   => $employmentstatus,
              'specialty'   => $specialty,
              'counselor'   => $counselor,
              'appointmentType'   => $appointmentType,
              'dateOfSession'   => $dateOfSession,
              'visitNumber'   => $visitNumber,
              'billable'   => $billable,
              'assignBy' => get_current_user_id()
          )
        );
         $record_id = $wpdb->insert_id;
    }else{

        $wpdb->insert( 
            'lb_appointment', 
            array( 
                'newPatient'     => $newPatient,
                'age' => $age,
                'gender'   => $gender,
                'employmentstatus'   => $employmentstatus,
                'specialty'   => $specialty,
                'counselor'   => $counselor,
                'appointmentType'   => $appointmentType,
                'dateOfSession'   => $dateOfSession,
                'visitNumber'   => $visitNumber,
                'billable'   => $billable,
                'newAppointment'   => '1',
                'assignBy' => get_current_user_id()
            )
        );
        $record_id = $wpdb->insert_id;
        $pId="MCLCMSPID";
        $getPId=$pId.$record_id;
        if($record_id!=''){

            $wpdb->update( 
                'lb_appointment', 
                    array( 
                        'patientId' => $getPId
                    ), 
                    array( 'id' => $record_id )
            );
        }
         
  }

  echo '<script type="text/javascript">window.location.href = "thank-you?id='.base64_encode($record_id).'"</script>'; 

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


.select2-container .select2-selection--single{
    height:34px !important;
}
.select2-container--default .select2-selection--single{
         border: 1px solid #ccc !important; 
     border-radius: 0px !important; 

}



.select2-container--open{
  width: 100% !important
}
.select2-container--focus{
  width: 100% !important
}

.select2-container--below{
  width: 100% !important
}

.select2-hidden-accessible{
  width: 100% !important
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

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
    <?php if($message!=''){?>
    <div class="container">
      <div class="row">
        <p style="color: green;font-weight: bold; text-align: center;"><?php echo $message;?></p>
      </div>
    </div>  
    <?php } ?>
		<div class="container">
      <div class="row">
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
        <div class="col-sm-8" style="background: #fff;">
            <form class="form-horizontal"  method="post">
                <h3>New Appointment Form</h3>
               
               <div class="form-group">
                    <label class="control-label col-sm-3">New Patient</label>
                    <div class="col-sm-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="">
                                    <input type="radio" name="newPatient" id="newPatient" value="yes" onchange="funNewPatient()" checked="" >Yes
                                </label> 
                            </div>
                            <div class="col-sm-4">
                                <label class="">
                                    <input type="radio" name="newPatient" id="noNewPatient" value="no" onchange="funOldPatient()" >No
                                </label>
                            </div>
                        </div>
                    </div>
                </div> 

              
                <div class="form-group" id="divmcmsId" style="display: block;">
                    <label for="lastName" class="col-sm-3 control-label"></label>
                    <div class="col-sm-1"> 
                        <input type="checkbox" name="yes" id="mcmsChecked" class="form-control" onclick="enableAllFieldWithMCMS()">
                    </div>
                    <div class="col-sm-8">
                       If Doctor Membership Verified with MCMS?
                         <strong><a href="http://mclennancountymedicine.org/find-a-doctor" target="_blank">Click to Find a Doctor here</a></strong>
                    </div>  

                </div>


                <div class="form-group" id="divpatientId" style="display: none;">
                    <label for="lastName" class="col-sm-3 control-label">Patient Id</label>
                    <div class="col-sm-9">                      

                        <?php 
                        global $wpdb;          
                         $appointment = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "appointment where newAppointment='1'  ORDER BY id DESC ");
                        
                        ?>
                        <select name="patientId" id="patientId" class="form-control select2"  onchange="getDataBYPatientId()">
                            <option value="">--select--</option>
                            <?php
                             foreach ($appointment as $key => $getVal) { ?>
                                   <option value="<?php echo $getVal->patientId;?>"><?php echo $getVal->patientId; ?></option>
                        <?php } ?>
                       </select>

                    </div>
                </div>

              <div id="enableAfterChecked" style="display: none;">  
               <div id="getUpdateData" style="text-align: center;"> 
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Age </label>
                    <div class="col-sm-9">
                       <!--  <input type="text" id="age" name="age" placeholder="Age" class="form-control" required=""> -->

                       <?php //field_60953085daf0f
                                $ages = get_field_object( 'field_60953085daf0f' );
                                $ageslabel = $ages['choices'];
                               // print_r($employmentstatuslabel);
                        ?>
                       <select name="age" class="form-control" required="">
                        <option value="">--select--</option>
                       <?php
                             foreach( $ageslabel as $t => $w ) { ?>
                                   <option value="<?php echo $t;?>"><?php echo $w; ?></option>
                         <?php } ?>
                       </select>

                    </div>
                </div>


              
               <div class="form-group">
                    <label class="control-label col-sm-3">Gender</label>
                    <div class="col-sm-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="">
                                    <input type="radio" name="gender"  id="gender1" value="m">Male
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
                        <label for="Height" class="col-sm-3 control-label">Primary Employment Status* </label>
                    <div class="col-sm-9">
						<?php 
                                $employmentstatus = get_field_object( 'field_609513c02a5c4' );
				                $employmentstatuslabel = $employmentstatus['choices'];
                               // print_r($employmentstatuslabel);
						?>
                       <select name="employmentstatus" class="form-control"  required="">
                        <option value="">--select--</option>
                       <?php
                        	 foreach( $employmentstatuslabel as $t => $w ) { ?>
                        		   <option value="<?php echo $t;?>"><?php echo $w; ?></option>
                         <?php } ?>
                       </select>

                      
                    </div>
                </div>
                 <div class="form-group">
                        <label for="weight" class="col-sm-3 control-label">Primary Specialty* </label>
                    <div class="col-sm-9">
                        <?php 
                                $specialty = get_field_object( 'field_60952f6bc60a2' );
                                $Specialtylabel = $specialty['choices'];
                               // print_r($employmentstatuslabel);
                        ?>
                        <select name="specialty" class="form-control" required="" >
                          <option value="">--select--</option>
                       	    <?php
                             foreach( $Specialtylabel as $t => $w ) { ?>
                                   <option value="<?php echo $t;?>"><?php echo $w; ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div>

                 <div class="form-group">
                        <label for="weight" class="col-sm-3 control-label">Counselor* </label>
                    <div class="col-sm-9">
                        <?php 
                                $counselor = get_field_object( 'field_609531d3b7fc5' );
                                $counselorlabel = $counselor['choices'];
                               // print_r($employmentstatuslabel);
                        ?>
                        <select name="counselor" class="form-control" required="" >
                          <option value="">--select--</option>
                       	    <?php
                             foreach( $counselorlabel as $t => $w ) { ?>
                                   <option value="<?php echo $t;?>"><?php echo $w; ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div>

                 <div class="form-group">
                        <label for="weight" class="col-sm-3 control-label">Appointment Type* </label>
                    <div class="col-sm-9">
                        <?php 
                                $appointmentType = get_field_object( 'field_609530a8daf10' );
                                $appointmentTypelabel = $appointmentType['choices'];
                               // print_r($employmentstatuslabel);
                        ?>
                        <select name="appointmentType" class="form-control" required="" >
                          <option value="">--select--</option>
                       	    <?php
                             foreach( $appointmentTypelabel as $t => $w ) { ?>
                                   <option value="<?php echo $t;?>"><?php echo $w; ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div> 
                <?php $inqueryDate=date('Y-m-d');
                       $time = date('H:i', time());
                  ?>
                <div class="form-group">
                        <label for="weight" class="col-sm-3 control-label">Date Of Session* </label>
                    <div class="col-sm-9">
                        <input type="datetime-local" name="dateOfSession" id="dateOfSession"  class="form-control" value="<?php echo $inqueryDate;?>" required="">
                    </div>
                </div>

                 <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Visit Number </label>
                    <div class="col-sm-9">
                        <input type="text" id="visitNumber" name="visitNumber" placeholder="visit Number" class="form-control" readonly="" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Billable</label>
                    <div class="col-sm-9">                        
                       <!-- <select name="billable" class="form-control" required="">
                        <option value="1" selected="">MCMS Pay</option>
                       </select> -->
                       <input type="text" class="form-control"  name="" value="MCMS Pay" disabled="" style="background: green; color: #fff;">
                        <input type="hidden" name="billable" value="1">
                    </div>
                </div>
            </div>    
                <!-- /.form-group -->
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <span class="help-block">*Required fields</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                <input type="hidden" name="actions" value="submitAppointment"> 
            </div>    
            </form> <!-- /form -->
          </div>  
          </div>  
        </div> <!-- ./container -->

<?php /*} else{
	echo "<h3>You need to logout to register</h3>";
}*/ ?>
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
   <button class="btn btn-primary" onclick="window.location = '<?php echo site_url();?>/list-of-appointment/'">Appointment Reports</button> 
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

<script type="text/javascript">
    
function funOldPatient(){

    if (document.getElementById('noNewPatient').checked) {
        document.getElementById('divpatientId').style.display = 'block';
        document.getElementById('enableAfterChecked').style.display = 'block';
        document.getElementById('divmcmsId').style.display = 'none';
    } else {
        document.getElementById('divpatientId').style.display = 'none';
        document.getElementById('enableAfterChecked').style.display = 'none';
        document.getElementById('divmcmsId').style.display = 'block';

    }


}

function funNewPatient(){

    if (document.getElementById('newPatient').checked) {
       window.location.reload();
    }


}

function enableAllFieldWithMCMS(){

    if (document.getElementById('mcmsChecked').checked) {
       document.getElementById('enableAfterChecked').style.display = 'block';
    }else{
      document.getElementById('enableAfterChecked').style.display = 'none';
    }


}
</script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    
    function getDataBYPatientId(){
      var getPIdValue=$("#patientId").val(); 
      
      $.ajax({
        type:'post',
        url: "<?php echo get_template_directory_uri() ?>/ajax-getPatientDataBYId.php",
        data:{getPIdValue:getPIdValue},
         beforeSend: function() { 
            $("#getUpdateData").addClass("loading");  
            $("#getUpdateData").append('<div class="modalgif">wait...</div>');
            
          },
        success:function(result){
          $("#getUpdateData").removeClass("loading"); 
          $('.modalgif').remove();  
          $("#getUpdateData").html(result);
        }
    });

        //alert('sdfsf454654645');
    }
</script>
<script>
    $('.select2').select2();
</script>

<?php get_footer(); ?>