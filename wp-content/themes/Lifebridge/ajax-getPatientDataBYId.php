<?php
header("Access-Control-Allow-Origin: *");

require_once('../../../wp-config.php');
global $wpdb;
 global $current_user;

$getPIdValue=$_REQUEST['getPIdValue'];

global $wpdb;    
//echo "SELECT * FROM " . $wpdb->prefix . "appointment where patientId='".$getPIdValue."' ";     
$appointment = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "appointment where patientId='".$getPIdValue."' ");

  $visitNumber =$wpdb->num_rows;


$getyearcount = $wpdb->get_row("SELECT count(*) as total FROM lb_appointment WHERE YEAR(dateTime) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) and patientId='".$getPIdValue."'");



?>

<style type="text/css">
  .Feildsinline select {
    padding: 8px 0px;
    border: 1px solid #b1b1b1;
    margin: 10px 2px;
}
</style>
<div class="Feilds">
  <label>Age</label>
    <?php 
          $employmentstatus = get_field_object( 'field_60953085daf0f' );
          $employmentstatuslabel = $employmentstatus['choices'];
         // print_r($employmentstatuslabel);
    ?>
     <select name="age"  >
     <?php
           foreach( $employmentstatuslabel as $t => $w ) { ?>
                 <option value="<?php echo $t;?>" <?php if($t==$appointment->age){ echo "selected=selected";}?>><?php echo $w; ?></option>
       <?php } ?>
     </select>
  </div>
</div>


              
<div class="Feilds">
    <label>Gender</label>
      <ul class="radioBtns">
        <li><input type="radio"  name="gender"  id="gender1" value="m"  <?php if($appointment->gender=="m"){ echo "checked=checked";}?> >
        <span>Male</span></li>
        <li><input type="radio" name="gender" id="gender2" value="f" class="selected" <?php if($appointment->gender=="f"){ echo "checked=checked";}?>>
        <span>Female</span></li>
    </ul>
</div> 

                
<div class="Feilds">
  <label >Primary Employment Status* </label>  
<?php 
    $employmentstatus = get_field_object( 'field_609513c02a5c4' );
    $employmentstatuslabel = $employmentstatus['choices'];
?>
   <select name="employmentstatus"  >
   <?php
    	 foreach( $employmentstatuslabel as $t => $w ) { ?>
    		   <option value="<?php echo $t;?>" <?php if($t==$appointment->employmentstatus){ echo "selected=selected";}?>><?php echo $w; ?></option>
     <?php } ?>
   </select>
</div>
                
<div class="Feilds">
  <label >Primary Specialty* </label>
  <?php 
    $employmentstatus = get_field_object( 'field_60952f6bc60a2' );
    $employmentstatuslabel = $employmentstatus['choices'];
  ?>
  <select name="specialty"  >
 	    <?php
       foreach( $employmentstatuslabel as $t => $w ) { ?>
             <option value="<?php echo $t;?>" <?php if($t==$appointment->specialty){ echo "selected=selected";}?> ><?php echo $w; ?></option>
      <?php } ?>
 </select>  
</div>

<div class="Feilds">
  <label >Counselor* </label>
  <?php 
    $employmentstatus = get_field_object( 'field_609531d3b7fc5' );
    $employmentstatuslabel = $employmentstatus['choices'];
  ?>
      <select name="counselor" >
     	    <?php
           foreach( $employmentstatuslabel as $t => $w ) { ?>
                 <option value="<?php echo $t;?>"  <?php if($t==$appointment->counselor){ echo "selected=selected";}?>><?php echo $w; ?></option>
          <?php } ?>
     </select>
</div>

<div class="Feilds">
  <label>Appointment Type* </label>
  <?php 
          $employmentstatus = get_field_object( 'field_609530a8daf10' );
          $employmentstatuslabel = $employmentstatus['choices'];
  ?>
  <select name="appointmentType"  >
    <?php
   foreach( $employmentstatuslabel as $t => $w ) { ?>
         <option value="<?php echo $t;?>" <?php if($t==$appointment->appointmentType){ echo "selected=selected";}?>  ><?php echo $w; ?></option>
  <?php } ?>
 </select>
  </div>
</div> 
<?php 
 //$getDateOfSession =date('Y-m-d h:i',strtotime($appointment->dateOfSession));
 $getDateOfSession =date('m-d-Y');
?>
<div class="Feilds">
  <label >Date Of Session* </label> 
  <input type="text" class="datepicker" id="dateOfSession" name="dateOfSession"  value="<?php echo $getDateOfSession; ?>" >  
</div>

<div class="Feilds">
  <label >Visit Number </label>
    <input type="text" id="visitNumber" name="visitNumber" placeholder="visit Number" readonly=""  value="<?php echo $getyearcount->total+1; ?>"   >
</div>

<div class="Feilds">
  <label>Billable</label>  
      <?php if($getyearcount->total  >= 4){ ?>
         <!--  <option value="2" selected="">Self Pay</option> -->
         <input type="text"  name="" value="Self" disabled=""  style="background: red; color: #fff;">
         <input type="hidden" name="billable" value="2">
        <?php }else{ ?>                           
         <input type="text"   name="" value="MCMS Pay" disabled="" style="background: green; color: #fff;">
         <input type="hidden" name="billable" value="1">
        <?php } ?>
</div>

<button type="submit" class="submtBtn1">Submit</button>
 <input type="hidden" name="actions" value="submitAppointment"> 


 <!-- <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>  -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

<script type="text/javascript">
 
  $(document).ready(function () {
        var today = new Date();
        $('#dateOfSession').datepicker({
           format: 'yyyy-m-d',
           autoclose:true,
           
        })
    });
</script>