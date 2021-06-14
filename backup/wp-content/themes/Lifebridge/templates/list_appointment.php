<?php 
/* Template Name: List Appointment
*/ 
get_header(); 

  

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
             $appointment = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "appointment  ORDER BY id DESC ");
             foreach ($appointment as $key => $getVal) {
            // print_r($getVal);
              
          ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $getVal->patientId;?></td>
                <td><?php echo $getVal->dateOfSession;?></td>
                <td><?php echo $getVal->gender;?></td>
                <td><?php echo $getVal->age;?></td>
                <td><?php echo $getVal->specialty;?></td>
                <td><?php echo $getVal->employmentstatus;?></td>
                <td><?php echo $getVal->appointmentType;?></td>
                <td><?php echo $getVal->counselor;?></td>
                <td><?php echo $getVal->billable;?></td>
                
            </tr>
          <?php $i++; } ?> 
        
    </table>
  </div> 


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