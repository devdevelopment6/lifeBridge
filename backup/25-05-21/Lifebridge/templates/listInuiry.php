<?php 
/* Template Name: List Inquiry
*/ 
get_header(); 

date_default_timezone_set("Asia/Calcutta"); 

if(!is_user_logged_in()){
 echo '<script type="text/javascript">window.location.href = "login/"</script>';
}

if($_REQUEST['inqueryStartDate']!=""){
  global $wpdb;  

  
    $inquirey = $wpdb->get_results(" Select * from lb_inquirey where datetime >=  '".$_REQUEST['inqueryStartDate']."' AND datetime <='".date('Y-m-d H:i:s', strtotime($_REQUEST['inqueryToDate'] . ' +1 day'))."'  ORDER BY id DESC limit 0,6000");
    $totalGrand = $wpdb->num_rows;

      $inquirey1 = $wpdb->get_results(" Select * from lb_inquirey where datetime >=  '".$_REQUEST['inqueryStartDate']."' AND datetime <='".date('Y-m-d H:i:s', strtotime($_REQUEST['inqueryToDate'] . ' +1 day'))."' and inqueryMethod='1'  ORDER BY id DESC ");
         $countPhoneCall = $wpdb->num_rows;

        
         $inquirey2 = $wpdb->get_results(" Select * from lb_inquirey where datetime >=  '".$_REQUEST['inqueryStartDate']."' AND datetime <='".date('Y-m-d H:i:s', strtotime($_REQUEST['inqueryToDate'] . ' +1 day'))."'  and inqueryMethod='2'  ORDER BY id DESC ");
         //$countTextCall = $inquirey2->num_rows;
          $countTextCall = $wpdb->num_rows;

         $inquirey3 = $wpdb->get_results(" Select * from lb_inquirey where datetime >=  '".$_REQUEST['inqueryStartDate']."' AND datetime <='".date('Y-m-d H:i:s', strtotime($_REQUEST['inqueryToDate'] . ' +1 day'))."'  and inqueryMethod='3'  ORDER BY id DESC ");
         $countEmailCall = $wpdb->num_rows;


}else{
  global $wpdb;          
    $inquirey = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey   ORDER BY id DESC ");
   // echo "SELECT * FROM " . $wpdb->prefix . "inquirey   ORDER BY id DESC ";
    $totalGrand = $wpdb->num_rows;

    $inquirey1 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='1'   ");
         $countPhoneCall = $wpdb->num_rows;

    $inquirey2 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='2'   ");
         //$countTextCall = $inquirey2->num_rows;
          $countTextCall = $wpdb->num_rows;

         $inquirey3 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='3'  ");
         $countEmailCall = $wpdb->num_rows;
}
?>  
 <?php 

  $time = date('H:i', time());

  if(!empty($_REQUEST['inqueryStartDate'])){
    $inqueryFromDate=$_REQUEST['inqueryStartDate'];
  }else{
    $inqueryFromDate=date('Y-m-d');
  }

  if(!empty($_REQUEST['inqueryToDate'])){
    $inqueryToDates=$_REQUEST['inqueryToDate'];
  }else{
    $inqueryToDates=date('Y-m-d');
  }
?>
<section class="innerSec">  
  <div class="container">
      <div class="formBox2">
      
      <div class="formBoxinner2">
      <h1><?php the_title();?></h1>
        <form class="form-horizontal" role="form" method="post">
            <div class="row">
            <div class="col-sm-2">
            <label>Entry Date</label>
            </div>

            <div class="col-sm-6">
              <div class="feildsGrp">
              <div class="row">
                <div class="col-sm-6">
                <div class="dateBox">
                  
                  <input type="date" name="inqueryStartDate" id="inqueryStartDate" placeholder="Date *" class="textbox-n" value="<?php echo $inqueryFromDate;?>" required="">
                </div>
                </div>

                <div class="col-sm-6">
                  <div class="dateBox">
                    <input type="date" name="inqueryToDate" id="inqueryToDate" placeholder="To *" class="textbox-n" value="<?php echo  $inqueryToDates;?>" >
                  </div>
                </div>
              </div>

              <!-- <div class="">
                <select>
                  <option>Method</option>
                  <option>Method</option>
                <select>                                  
              </div> -->
              </div>
              </div>

               <div class="col-sm-4 align-self-center">
                <!-- <a href="#" class="submtBtn3">Search</a> -->
                 <button type="submit" class="submtBtn3">Search</button>
                </div>
            </form>
         </div>
        
      <!-----------------------------------reports----------------------------------- --> 
        
        <div class="Reports1">
          <h3>Total Inquiries : <?php echo $totalGrand;?></h3>
          <ul>
            <li>Phone Call : <?php echo $countPhoneCall;?></li>
            <li>Email: <?php echo $countEmailCall;?></li>
            <li>Text : <?php echo $countTextCall;?></li>
            <!-- <li>Website: </li> -->
          </ul>
        </div>
        <!-----------------------------------Table----------------------------------- -->
      <div class="ReportTable1">
      <div class="table-responsive">          
      <table id="inquiryTabel_id" class="table table-bordered">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Date</th>
                <th>Time</th>
                <th>Method</th>
                
            </tr>
        </thead>
        <?php if($_REQUEST['inqueryStartDate']!=""){
          $i=1;
            
             foreach ($inquirey as $key => $getVal) {
              
              if($getVal->inqueryMethod=='1'){
                $method='Phone Call';
              }else if($getVal->inqueryMethod=='2'){
                 $method='Text'; 
              }else if($getVal->inqueryMethod=='3'){
                 $method='Email'; 
              }
              
          ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $getVal->inqueryDate;?></td>
                <td><?php echo $getVal->inquerytime;?></td>
                <td><?php echo $method;?></td>
                
            </tr>
          <?php $i++; } 
          }
          ?> 
        
    </table>
        
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

<?php if(!$_REQUEST['inqueryStartDate']==""){ ?>
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
<?php }else{ ?>
<script type="text/javascript">

$(document).ready(function(){
  $('#inquiryTabel_id').DataTable({
      'processing': true,
      'serverSide': true,
      "searching": false ,  
      'serverMethod': 'post',
      'ajax': {
          'url':'<?php echo get_template_directory_uri() ?>/ajax-DataTableListInquiry.php'
      },
      'columns': [
          { data: 'id' },
          { data: 'inqueryDate' },
          { data: 'inquerytime' },
          { data: 'method' },
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