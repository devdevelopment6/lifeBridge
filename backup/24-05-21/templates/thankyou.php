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
<div class="inner-banner">
      <div class="container">
            <div class="row">
              <div class="col-lg-12 wow fadeInUp" data-wow-offset="10" data-wow-duration="1.5s">
                 <h1 class="page-title"><?php the_title();?></h1>
                 <p style="color: #fff; font-size: 18px;">New Appointment has been booked successfully  against the  Patient ID <strong><span style="color: #ef081d;"><?php echo $appointment->patientId ;?></span>. Please see the booking details below:</strong></p>
              </div>
            </div>
                       
        </div>
  </div>

<div class="container">
  <div class="row">
      <table id="inquiryTabel_id" class="display" style="width:100%">
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
            global $wpdb;          
             $appointment = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "appointment where id='".$getId."' ORDER BY id DESC ");
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
        
    </table>
  </div>
  </div> 



<?php get_footer(); ?>