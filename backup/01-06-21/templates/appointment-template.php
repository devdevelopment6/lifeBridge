<?php 
/* Template Name: Appointment Template
*/ 
get_header(); 

	
// displays error messages from form submissions
if(!is_user_logged_in()){
 echo '<script type="text/javascript">window.location.href = "login/"</script>';
}
 

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

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


<section class="innerSec">  
  <div class="container">
    <div class="formBox">
      
      <div class="formBoxinner">        
        <h1><?php the_title();?></h1>
        <p>User B will create a New Record for the Patient and will generate the
    Unique ID for the Patient.</p>
        <form method="post">
        <div class="Feilds"><label>New Patient</label>
          <ul class="radioBtns">
              <li><input type="radio" name="newPatient" id="newPatient" value="yes" onchange="funNewPatient()" checked="" >
              <span>yes</span></li>
              <li><input type="radio"  name="newPatient" id="noNewPatient" value="no" onchange="funOldPatient()" class="selected">
              <span>No</span></li>
          </ul>
        </div>

        <div class="Feilds" id="divmcmsId" style="display: block;">
          <label id="doctor"></label>
          <input type="checkbox" name="yes" id="mcmsChecked"  onclick="enableAllFieldWithMCMS()">
          If Doctor Membership Verified with MCMS?
                         <strong><a href="http://mclennancountymedicine.org/find-a-doctor" target="_blank">Click to Find a Doctor here</a></strong>
                    
        </div>

        <div class="Feilds" id="divpatientId" style="display: none;">
          <label>Patient ID</label>
          <?php 
            global $wpdb;          
             $appointment = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "appointment where newAppointment='1'  ORDER BY id DESC ");            
            ?>
            <select name="patientId" id="patientId" class="select2"  onchange="getDataBYPatientId()">
                <option value="">--select--</option>
                <?php
                 foreach ($appointment as $key => $getVal) { ?>
                       <option value="<?php echo $getVal->patientId;?>"><?php echo $getVal->patientId; ?></option>
            <?php } ?>
           </select>
        </div>

        <div id="enableAfterChecked" style="display: none;">  
        <div id="getUpdateData" >   
        <div class="Feilds">
          <label>Age *</label>
            <?php
              $ages = get_field_object( 'field_60953085daf0f' );
              $ageslabel = $ages['choices'];
            ?>
           <select name="age" required="">
            <option value="">--select--</option>
           <?php
                 foreach( $ageslabel as $t => $w ) { ?>
                       <option value="<?php echo $t;?>"><?php echo $w; ?></option>
             <?php } ?>
           </select>
        </div>

        <div class="Feilds">
          <label>Gender *</label>
            <ul class="radioBtns">
              <li><input type="radio"  name="gender"  id="gender1" value="m" >
              <span>Male</span></li>
              <li><input type="radio" name="gender" id="gender2" value="f" class="selected">
              <span>Female</span></li>
          </ul>
        </div>

        <div class="Feilds">
          <label>Primary Employment Status *</label>
          <?php 
              $employmentstatus = get_field_object( 'field_609513c02a5c4' );
              $employmentstatuslabel = $employmentstatus['choices'];
                               // print_r($employmentstatuslabel);
            ?>
              <select name="employmentstatus"  required="">
                <option value="">--select--</option>
               <?php
                   foreach( $employmentstatuslabel as $t => $w ) { ?>
                       <option value="<?php echo $t;?>"><?php echo $w; ?></option>
                 <?php } ?>
              </select>
        </div>

        <div class="Feilds">
          <label>Primary Specialty *</label>
           <?php 
              $specialty = get_field_object( 'field_60952f6bc60a2' );
              $Specialtylabel = $specialty['choices'];
              
            ?>
            <select name="specialty" required="" >
              <option value="">--select--</option>
                <?php
                 foreach( $Specialtylabel as $t => $w ) { ?>
                       <option value="<?php echo $t;?>"><?php echo $w; ?></option>
                <?php } ?>
           </select>
        </div>

        <div class="Feilds">
          <label>Counselor *</label>
          <?php 
            $counselor = get_field_object( 'field_609531d3b7fc5' );
            $counselorlabel = $counselor['choices'];            
            ?>
            <select name="counselor" required="" >
              <option value="">--select--</option>
                <?php
                 foreach( $counselorlabel as $t => $w ) { ?>
                       <option value="<?php echo $t;?>"><?php echo $w; ?></option>
                <?php } ?>
           </select>
        </div>

        <div class="Feilds">
        <label>Appointment Type *</label>
         <?php 
            $appointmentType = get_field_object( 'field_609530a8daf10' );
            $appointmentTypelabel = $appointmentType['choices'];           
          ?>
            <select name="appointmentType"  required="" >
              <option value="">--select--</option>
                <?php
                 foreach( $appointmentTypelabel as $t => $w ) { ?>
                       <option value="<?php echo $t;?>"><?php echo $w; ?></option>
                <?php } ?>
           </select>
        </div>
        <?php $inqueryDate=date('Y-m-d');
             $time = date('H:i', time());
        ?>
        <div class="Feilds">
          <label>Date of Session *</label>

          <input type="datetime-local"  name="dateOfSession" id="dateOfSession"   value="<?php echo $inqueryDate;?>" required="">
        </div>

        <div class="Feilds">
          <label>Visit Number</label>
          <input type="text" id="visitNumber" name="visitNumber" placeholder=""  readonly="" >
        </div>

        <div class="Feilds">
          <label>Billable?</label>
          <input type="text"  value="MCMS Pay" disabled="" style="background: green; color: #fff;">
          <input type="hidden" name="billable" value="1">
        </div>

        <!-- <a href="#" class="submtBtn1">Submit</a> -->
        <button type="submit" class="submtBtn1">Submit</button>
        <input type="hidden" name="actions" value="submitAppointment"> 
        </div>  
      </div>
        </form>

        <div class="Reports">
          <h2>Reports</h2>
          <ul>
            <li><a href="<?php echo site_url();?>/list-of-appointment/" class="inquiryBTn">Appointment Report</a></li>
            <!-- <li><a href="#" class="AptmntBTn">Appointments Report</a></li> -->
          </ul>
      </div>

      </div>

    </div>
  </div>
</section>



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