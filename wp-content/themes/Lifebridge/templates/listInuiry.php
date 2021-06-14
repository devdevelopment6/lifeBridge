<?php 
/* Template Name: List Inquiry
*/ 
get_header(); 

//date_default_timezone_set("Asia/Calcutta"); 
date_default_timezone_set("America/Chicago"); 
if(!is_user_logged_in()){
 echo '<script type="text/javascript">window.location.href = "login/"</script>';
}

if($_REQUEST['inqueryStartDate']!=""){
  global $wpdb;  

  
   $inqueryFromDate=date('Y-m-d',strtotime($_REQUEST['inqueryStartDate']));
   $inqueryToDate=date('Y-m-d',strtotime($_REQUEST['inqueryToDate']));

    $inquirey = $wpdb->get_results(" Select * from lb_inquirey where inqueryDate >=  '".$inqueryFromDate."' AND inqueryDate <='".date('Y-m-d H:i:s', strtotime($inqueryToDate . ' +1 day'))."'  ORDER BY inqueryDate DESC limit 0,6000");
    $totalGrand = $wpdb->num_rows;

      $inquirey1 = $wpdb->get_results(" Select * from lb_inquirey where inqueryDate >=  '".$inqueryFromDate."' AND inqueryDate <='".date('Y-m-d H:i:s', strtotime($inqueryToDate . ' +1 day'))."' and inqueryMethod='phonecall'  ORDER BY id DESC ");
         $countPhoneCall = $wpdb->num_rows;

        
         $inquirey2 = $wpdb->get_results(" Select * from lb_inquirey where inqueryDate >=  '".$inqueryFromDate."' AND inqueryDate <='".date('Y-m-d H:i:s', strtotime($inqueryToDate . ' +1 day'))."'  and inqueryMethod='text'  ORDER BY id DESC ");
         //$countTextCall = $inquirey2->num_rows;
          $countTextCall = $wpdb->num_rows;

         $inquirey3 = $wpdb->get_results(" Select * from lb_inquirey where inqueryDate >=  '".$inqueryFromDate."' AND inqueryDate <='".date('Y-m-d H:i:s', strtotime($inqueryToDate . ' +1 day'))."'  and inqueryMethod='email'  ORDER BY id DESC ");
         $countEmailCall = $wpdb->num_rows;

         $inquirey4 = $wpdb->get_results(" Select * from lb_inquirey where inqueryDate >=  '".$inqueryFromDate."' AND inqueryDate <='".date('Y-m-d H:i:s', strtotime($inqueryToDate . ' +1 day'))."'  and inqueryMethod='web'  ORDER BY id DESC ");
         $countWeb = $wpdb->num_rows;


}else{
  global $wpdb;          
    $inquirey = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey   ORDER BY datetime DESC ");
   // echo "SELECT * FROM " . $wpdb->prefix . "inquirey   ORDER BY id DESC ";
    $totalGrand = $wpdb->num_rows;

    $inquirey1 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='phonecall'   ");
         $countPhoneCall = $wpdb->num_rows;

    $inquirey2 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='text'   ");
         //$countTextCall = $inquirey2->num_rows;
          $countTextCall = $wpdb->num_rows;

         $inquirey3 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='email'  ");
         $countEmailCall = $wpdb->num_rows;

         $inquirey3 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='web'  ");
         $countWeb = $wpdb->num_rows;
}
?>  
 <?php 

  $time = date('H:i', time());

  if(!empty($_REQUEST['inqueryStartDate'])){
    $inqueryFromDate=$_REQUEST['inqueryStartDate'];
  }

  if(!empty($_REQUEST['inqueryToDate'])){
    $inqueryToDates=$_REQUEST['inqueryToDate'];
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
                  
                  <input type="text" name="inqueryStartDate" id="inqueryStartDate" placeholder="Date From *" class="textbox-n datepickerFrom" value="<?php echo $inqueryFromDate;?>" required="">
                </div>
                </div>

                <div class="col-sm-6">
                  <div class="dateBox">
                    <input type="text" name="inqueryToDate" id="inqueryToDate" placeholder="Date To *" class="textbox-n datepickerTo" value="<?php echo  $inqueryToDates;?>" >
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
            <li>Web : <?php echo $countWeb;?></li>
            <!-- <li>Website: </li> -->
          </ul>
        </div>
        <!-----------------------------------Table----------------------------------- -->
      <div class="ReportTable1">
      <div class="table-responsive">          
      <table id="inquiryTabel_id" class="table table-bordered" style="width: 100%">
        <thead>
       
             <tr style="display: none;">
                <th colspan="4">
                  Search Date : <?php echo $inqueryFromDate. ' : ' . $inqueryToDates;?> 
                  Total Inquiries : <?php echo $totalGrand;?>
                  Phone Call : <?php echo $countPhoneCall;?>
                  Text : <?php echo $countTextCall;?>                  
                  Email : <?php echo $countEmailCall;?>                  
                  Web : <?php echo $countWeb;?>                  
                </th>                
            </tr>
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
            $getInquirydate=date('m-d-Y',strtotime($getVal->inqueryDate));
          ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $getInquirydate;?></td>
                <td><?php echo $getVal->inquerytime;?></td>
                <td><?php echo ucfirst($getVal->inqueryMethod);?></td>
                
            </tr>
          <?php $i++; } 
          
          ?> 

           <tfoot  style="display: none;">
            <tr>             
                <th><?php echo $inqueryFromDate. '&nbsp;To;&nbsp;' . $inqueryToDates;?></th>
                <th>Total Inquiries : 9</th>
                <th>Phone Call : 2</th>
                <th>Text : 1</th>
                
            </tr>
        </tfoot>
        <?php } ?>
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


<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.js"></script>

<script src="<?php echo get_template_directory_uri()?>/js/intlTelInput.js"></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
        var today = new Date();
        $('.datepickerFrom').datepicker({
            format: 'yyyy-m-d',
            autoclose:true,
            endDate: "today",
            maxDate: today
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
            endDate: "today",
            maxDate: today
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


<?php if(!$_REQUEST['inqueryStartDate']==""){ ?>
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