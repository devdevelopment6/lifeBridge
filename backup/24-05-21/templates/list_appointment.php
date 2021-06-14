<?php 
/* Template Name: List Appointment
*/ 
get_header(); 

  
  if($_REQUEST['appointmentStartDate']!=""){
  global $wpdb;  

  $cond = [];
    if(!empty($_REQUEST['specialty']))
    {
      $cond []= " specialty = '".$_REQUEST['specialty']."' ";
    }

    if(!empty($_REQUEST['gender']))
    {
      $cond []= "gender = '".$_REQUEST['gender']."' ";
    }

    if(!empty($_REQUEST['age']))
    {
      $cond []= "age = '".$_REQUEST['age']."' ";
    }

    if(!empty($_REQUEST['appointmentType']))
    {
      $cond []= "appointmentType = '".$_REQUEST['appointmentType']."' ";
    }

    if(!empty($_REQUEST['employmentstatus']))
    {
      $cond []= "employmentstatus = '".$_REQUEST['employmentstatus']."' ";
    }

    
    if(!empty($_REQUEST['billable']))
    {
      $cond []= "billable = '".$_REQUEST['billable']."' ";
    }

    if(!empty($cond)){
      $condtion="and ";
     $condtion.= implode(" and ", $cond);
     }

 /* echo " Select * from " . $wpdb->prefix . "appointment where datetime >=  '".$_REQUEST['appointmentStartDate']."' AND datetime <='".date('Y-m-d H:i:s', strtotime($_REQUEST['appointmentToDate'] . ' +1 day'))."' ".$condtion."  ORDER BY id DESC ";*/

    $appointment = $wpdb->get_results(" Select * from " . $wpdb->prefix . "appointment where datetime >=  '".$_REQUEST['appointmentStartDate']."' AND datetime <='".date('Y-m-d H:i:s', strtotime($_REQUEST['appointmentToDate'] . ' +1 day'))."' ".$condtion."  ORDER BY id DESC ");
    $totalGrand = $wpdb->num_rows; 

    $appointmentmcms = $wpdb->get_results(" Select * from " . $wpdb->prefix . "appointment where datetime >=  '".$_REQUEST['appointmentStartDate']."' AND datetime <='".date('Y-m-d H:i:s', strtotime($_REQUEST['appointmentToDate'] . ' +1 day'))."' ".$condtion."  and billable='1'  ORDER BY id DESC ");
    $totalMcms = $wpdb->num_rows; 



    $appointmentSelf = $wpdb->get_results(" Select * from " . $wpdb->prefix . "appointment where datetime >=  '".$_REQUEST['appointmentStartDate']."' AND datetime <='".date('Y-m-d H:i:s', strtotime($_REQUEST['appointmentToDate'] . ' +1 day'))."' ".$condtion."  and billable='2' ");
    $totalSelf = $wpdb->num_rows;

  }else{

   global $wpdb;  
    $appointment = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "appointment ORDER BY id DESC ");
    $totalGrand= $wpdb->num_rows;

    $appointmentmcms = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "appointment  where billable='1' ORDER BY id DESC ");

    $totalMcms= $wpdb->num_rows;

    $appointmentSelf = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "appointment  where billable='2' ORDER BY id DESC ");
    $totalSelf= $wpdb->num_rows;
  }  



  $time = date('H:i', time());

  if(!empty($_REQUEST['appointmentStartDate'])){
  $inqueryDate=$_REQUEST['appointmentStartDate'];
  }else{
  $inqueryDate=date('Y-m-d');
  }

  if(!empty($_REQUEST['appointmentToDate'])){
  $inqueryDates=$_REQUEST['appointmentToDate'];
  }else{
  $inqueryDates=date('Y-m-d');
  }


?>


<section class="innerSec">  
  <div class="container">
    <div class="formBox2">
    
      <div class="formBoxinner1">
    <h1>List of Appointments</h1>
      <form  method="post">
        <div class="DateRange">
          <label>Date Range</label>
            <div class="dateBox2">
             
              <input type="date" name="appointmentStartDate" id="appointmentStartDate" placeholder="Date *" value="<?php echo $inqueryDate;?>" required="" class="textbox-n"  >
            </div>

            <div class="dateBox2">
             
              <input type="date" name="appointmentToDate" id="appointmentToDate" class="textbox-n" value="<?php echo  $inqueryDates;?>" >
            </div>
        </div>

        <div class="Feildsinline">
          <?php 
              $specialty = get_field_object( 'field_60952f6bc60a2' );
              $Specialtylabel = $specialty['choices'];
            ?>
          <select name="specialty" >
            <option value="">--Specialty--</option>
              <?php
               foreach( $Specialtylabel as $t => $w ) { ?>
                     <option value="<?php echo $t;?>" <?php if($t==$_REQUEST['specialty']){ echo 'selected=selected';}?>><?php echo $w; ?></option>
              <?php } ?>
         </select>
        </div>
        <div class="Feildsinline">
          <select name="gender"  >                            
             <option value="">--Gender--</option>
             <option value="m" <?php if($_REQUEST['gender']=='m'){ echo 'selected=selected';}?>>Male</option>
             <option value="f" <?php if($_REQUEST['gender']=='f'){ echo 'selected=selected';}?>>Female</option>             
          </select>
        </div>
        <div class="Feildsinline">
          <?php 
            $ages = get_field_object( 'field_60953085daf0f' );
            $ageslabel = $ages['choices'];
          ?>
           <select name="age"  >
             <option value="">--Age--</option>
           <?php
             foreach( $ageslabel as $t => $w ) { ?>
                <option value="<?php echo $t;?>" <?php if($t==$_REQUEST['age']){ echo 'selected=selected';}?>><?php echo $w; ?></option>
             <?php } ?>
           </select>
        </div> 
        <div class="Feildsinline">
           <?php 
              $appointmentType = get_field_object( 'field_609530a8daf10' );
              $appointmentTypelabel = $appointmentType['choices'];
            ?>
              <select name="appointmentType"  >
                 <option value="">--Appointment Type--</option>
                  <?php
                   foreach( $appointmentTypelabel as $t => $w ) { ?>
                         <option value="<?php echo $t;?>" <?php if($t==$_REQUEST['appointmentType']){ echo 'selected=selected';}?> ><?php echo $w; ?></option>
                  <?php } ?>
             </select>
        </div> 

        <div class="Feildsinline">
          <?php 
              $employmentstatus = get_field_object( 'field_609513c02a5c4' );
              $employmentstatuslabel = $employmentstatus['choices'];
           ?>
             <select name="employmentstatus"  >
              <option value="">--Employment Status--</option>
             <?php
                 foreach( $employmentstatuslabel as $t => $w ) { ?>
                     <option value="<?php echo $t;?>" <?php if($t==$_REQUEST['employmentstatus']){ echo 'selected=selected';}?> ><?php echo $w; ?></option>
               <?php } ?>
             </select>
        </div>

        <div class="Feildsinline">
          <select name="billable"  >
              <option value="">--Select--</option>                         
              <option value="2"  <?php if($_REQUEST['billable']=='2'){ echo 'selected=selected';}?> >Self Pay</option>                         
              <option value="1"  <?php if($_REQUEST['billable']=='1'){ echo 'selected=selected';}?> >MCMS Pay</option> 
          </select>
        </div>
        <!-- <a href="#" class="submtBtn2">Search</a> -->
        <button type="submit" class="submtBtn2">Search</button>
      </form>

      <!-----------------------------------reports----------------------------------- --> 
        
        <div class="Reports1">
          <h3>Total Appointment : <?php echo $totalGrand;?></h3>
          <ul>
            <li>MCMS Pay : <?php echo $totalMcms;?></li>
            <li>Self Pay: <?php echo $totalSelf;?></li>
          </ul>
        </div>
      
      <!-----------------------------------Table----------------------------------- -->
      <div class="ReportTable">
      <div class="table-responsive">          
      <table class="table-bordered" id="inquiryTabel_id">
        <thead>
            <tr>
                <th>S.N</th>
                <th>PatientID</th>
                <th>Appt Date</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Speciality</th>
                <th>Emp Status</th>
                <th>Apt Type</th>
                <th>Counselor Seen</th>
                <th>Billable</th>
                
            </tr>
        </thead>
        <tbody>
          <?php
          $i=1;
           /* global $wpdb;          
             $appointment = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "appointment ORDER BY id DESC ");*/
             foreach ($appointment as $key => $getVal) {
            // print_r($getVal);
              if($getVal->billable=='1'){
                $billablePay="MCMS Pay";
              }else{
                $billablePay="Self Pay";
              }

              if($getVal->gender=='m'){
                $gen="Male";
              }else{
                $gen="Female";
              }
          ?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $getVal->patientId;?></td>
                  <td><?php echo date('d M Y',strtotime($getVal->dateOfSession));?></td>
                  <td><?php echo $gen;?></td>
                  <td><?php echo $getVal->age;?></td>
                  <td><?php echo $getVal->specialty;?></td>
                  <td><?php echo $getVal->employmentstatus;?></td>
                  <td><?php echo $getVal->appointmentType;?></td>
                  <td><?php echo $getVal->counselor;?></td>
                  <td><?php echo $billablePay;?></td>
                  
              </tr>
            <?php $i++; } ?> 
            </tbody>
          </table>
        </div>
      </div>
      <!---------------------------------------Table-------------------------------- -->
      
        <!-- <ul class="downldBtn">
          <li>Download</li>
          <li><a href="#" class="csvBtn">CSV</a></li>
          <li><a href="#" class="pdfBtn">PDF</a></li>
        </ul> -->
      </div>
      
      


  </div>
  </div>
</div>
</section>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
 <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script> 
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script> 


 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script> 
 <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
 <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
 <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script> 
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script> 

<script src="<?php echo get_template_directory_uri()?>/js/intlTelInput.js"></script>

<script type="text/javascript">
  
  $(document).ready( function () {
    $('#inquiryTabel_id').DataTable({
      dom: 'Bfrtip',
      "searching": false , 
        buttons: [
            'csv', 'pdf'
        ]
    });
} );
</script>

 <script>

 var input = document.querySelector("#phone");
  window.intlTelInput(input, {
      
      utilsScript: "<?php echo get_template_directory_uri()?>/js/utils.js",
    });
</script>
<?php get_footer(); ?>