<?php 
/* Template Name: List Appointment
*/ 
get_header(); 
date_default_timezone_set("America/Chicago"); 

if(!is_user_logged_in()){
 echo '<script type="text/javascript">window.location.href = "login/"</script>';
}
 
  
  if($_REQUEST['appointmentStartDate']!=""){
  global $wpdb;  


  $inqueryFromDate=date('Y-m-d',strtotime($_REQUEST['appointmentStartDate']));
   $inqueryToDate=date('Y-m-d',strtotime($_REQUEST['appointmentToDate']));


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

    $appointment = $wpdb->get_results(" Select * from " . $wpdb->prefix . "appointment where datetime >=  '".$inqueryFromDate."' AND datetime <='".date('Y-m-d H:i:s', strtotime($inqueryToDate . ' +1 day'))."' ".$condtion."  ORDER BY id DESC limit 0,6000");
    $totalGrand = $wpdb->num_rows; 

    $appointmentmcms = $wpdb->get_results(" Select * from " . $wpdb->prefix . "appointment where  datetime >=  '".$inqueryFromDate."' AND datetime <='".date('Y-m-d H:i:s', strtotime($inqueryToDate . ' +1 day'))."' ".$condtion."  and billable='1'  ORDER BY id DESC ");
    $totalMcms = $wpdb->num_rows; 



    $appointmentSelf = $wpdb->get_results(" Select * from " . $wpdb->prefix . "appointment where  datetime >=  '".$inqueryFromDate."' AND datetime <='".date('Y-m-d H:i:s', strtotime($inqueryToDate . ' +1 day'))."' ".$condtion."  and billable='2' ");
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
  }

  if(!empty($_REQUEST['appointmentToDate'])){
  $inqueryDates=$_REQUEST['appointmentToDate'];
  }

?>

<style type="text/css">
  .error {
    color: red;
}

</style>
<section class="innerSec">  
  <div class="container">
    <div class="formBox2">
    
      <div class="formBoxinner1">
    <h1>List of Appointments</h1>
      <form  method="post" id="appointmentForm">
        <div class="DateRange">
          <label>Date Range</label>
            <div class="dateBox2">
             
              <input type="text" name="appointmentStartDate" id="appointmentStartDate" placeholder="From Date *" value="<?php echo $inqueryDate;?>" required="" class="textbox-n datepickerFrom required" readonly required >
            </div>

            <div class="dateBox2">
             
              <input type="text" name="appointmentToDate" id="appointmentToDate" class="textbox-n datepickerTo required" placeholder="To Date *" required="" value="<?php echo  $inqueryDates;?>" readonly   required>
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
                 <option value="">--App Type--</option>
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
              <option value="">--Empl Status--</option>
             <?php
                 foreach( $employmentstatuslabel as $t => $w ) { ?>
                     <option value="<?php echo $t;?>" <?php if($t==$_REQUEST['employmentstatus']){ echo 'selected=selected';}?> ><?php echo $w; ?></option>
               <?php } ?>
             </select>
        </div>

        <div class="Feildsinline">
          <select name="billable"  >
              <option value="">--Billable--</option>                         
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
          <tr style="display: none;">
                <th colspan="10">
                  Search Date : <?php echo $inqueryFromDate. ' : ' . $inqueryToDate;?>                     
                      MCMS Pay : <?php echo $totalMcms;?> 
                      Self Pay : <?php echo $totalSelf;?>
                </th>                
            </tr>

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
          if($_REQUEST['appointmentStartDate']!="" && $_REQUEST['appointmentToDate']!=""){
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
                  <td><?php echo date('m-d-Y',strtotime($getVal->dateOfSession));?></td>
                  <td><?php echo $gen;?></td>
                  <td><?php echo $getVal->age;?></td>
                  <td><?php echo $getVal->specialty;?></td>
                  <td><?php echo $getVal->employmentstatus;?></td>
                  <td><?php echo $getVal->appointmentType;?></td>
                  <td><?php echo $getVal->counselor;?></td>
                  <td><?php echo $billablePay;?></td>
                  
              </tr>
            <?php $i++; }
              }
             ?> 
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



<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
 <script type="text/javascript">
   
  $("#appointmentForm").validate({
  submitHandler: function(form) {
    form.submit();
  }
 });
 </script>
<script type="text/javascript">
  $(document).ready(function () {
        var today = new Date();
        $('.datepickerFrom').datepicker({
            format: 'yyyy-m-d',
            autoclose:true,
           /* endDate: "today",
            maxDate: today*/
        }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });


        $('.datepickerFrom').keyup(function () {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9^-]/g, '');
            }
        });
    }); 

  $(document).ready(function () {
        var today = new Date();
        $('.datepickerTo').datepicker({
            format: 'yyyy-m-d',
            autoclose:true,
           /* endDate: "today",
            maxDate: today*/
        }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });


        $('.datepickerTo').keyup(function () {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9^-]/g, '');
            }
        });
    });
</script>


<?php if($_REQUEST['appointmentStartDate']!="" && $_REQUEST['appointmentToDate']!=""){ ?>
<script type="text/javascript">
  
 $(document).ready( function () {
    $('#inquiryTabel_id').DataTable({
      dom: 'Bfrtip',
      "searching": false ,     
        buttons: [
       {
          extend: 'csv',
          "download": "download"
        } ,
        {
          extend: 'pdfHtml5',
          text: 'PDF',
         pageSize: 'A4',

          customize: function(pdfDocument) {

            pdfDocument.content[1].table.headerRows = 2;
            var firstHeaderRow = [];
            $('#inquiryTabel_id').find("thead>tr:first-child>th").each(
              function(index, element) {
                var colSpan = element.getAttribute("colSpan");
                firstHeaderRow.push({
                  text: element.innerHTML,
                  style: " width:100%",                 
                  colSpan: colSpan
                });
                for (var i = 0; i < colSpan - 1; i++) {
                  firstHeaderRow.push({});
                }
              });
            pdfDocument.content[1].table.body.unshift(firstHeaderRow);



          }
        }

      ]

    });
} );
</script>
<?php }else{ ?>
<script type="text/javascript">

$(document).ready(function(){
  $('#inquiryTabel_id').DataTable({
      'processing': true,
      'serverSide': true,
      "dom": 'Bfrtip',
      "searching": false ,  
      'serverMethod': 'post',
      buttons: [
            'csv', 'pdf'
        ],
      "order": [[ 0, 'desc' ]],  
      'ajax': {
          'url':'<?php echo get_template_directory_uri() ?>/ajax-DataTableListAppointment.php',          
      },


      'columns': [
          { data: 'id' },
          { data: 'patientId' },
          { data: 'dateOfSession' },
          { data: 'gender' },
          { data: 'age' },
          { data: 'specialty' },
          { data: 'employmentstatus' },
          { data: 'appointmentType' },
          { data: 'counselor' },
          { data: 'billable' },
      ],
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
        $("td:nth-child(1)", nRow).html(iDisplayIndex + 1);
        return nRow;
       }
  });
});

</script>

<?php } ?> 
<?php get_footer(); ?>