<?php 
/* Template Name: List Inquiry
*/ 
get_header(); 

date_default_timezone_set("Asia/Calcutta"); 



if($_REQUEST['inqueryStartDate']!=""){
  global $wpdb;  
  //Select * from lb_inquirey where datetime BETWEEN '2021-05-01' AND '2021-05-12' ORDER BY id DESC

  // SELECT * FROM lb_inquirey WHERE datetime >= '2021-05-01' AND datetime <= '2021-05-12'
 /* echo " Select * from lb_inquirey where datetime >=  '".$_REQUEST['inqueryStartDate']."' AND datetime <='".date('Y-m-d H:i:s', strtotime($_REQUEST['inqueryToDate'] . ' +1 day'))."'  ORDER BY id DESC ";*/

    $inquirey = $wpdb->get_results(" Select * from lb_inquirey where datetime >=  '".$_REQUEST['inqueryStartDate']."' AND datetime <='".date('Y-m-d H:i:s', strtotime($_REQUEST['inqueryToDate'] . ' +1 day'))."'  ORDER BY id DESC ");
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
      <div class="col-sm-8">  
       <!--  <h2 style="text-align: center;">Search List Of Inquiry Form</h2> -->
        <?php $inqueryDate=date('Y-m-d');
             $time = date('H:i', time());
                  ?>
        <form class="form-horizontal" role="form" method="post">
          <div class="form-group">                    
                <div class="col-sm-4">
                    <input type="date" name="inqueryStartDate" id="inqueryStartDate" placeholder="Date *" class="form-control" value="<?php echo $inqueryDate;?>" required="">
                </div>

                <div class="col-sm-4">
                    <input type="date" name="inqueryToDate" id="inqueryToDate" placeholder="To *" class="form-control" value="<?php echo  $inqueryDate;?>" >
                </div>                       
            </div>
              <div class="form-group">
                <div class="col-sm-4">
                  <button type="submit" class="btn btn-primary">Search</button>
                </div>
              </div>  

          </form>
        </div> 
      </div> 
  </div> 
      


 
    <?php 
    if(is_user_logged_in()) { 
    // show any error messages after form submission
    isigma_show_error_messages(); 
 
 /* global $wpdb;          
         $inquirey1 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='1'  and assignBy='".is_user_logged_in()."'  ");
         $countPhoneCall = $wpdb->num_rows;

        
         $inquirey2 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='2' and assignBy='".is_user_logged_in()."'   ");
         //$countTextCall = $inquirey2->num_rows;
          $countTextCall = $wpdb->num_rows;

         $inquirey3 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='3' and assignBy='".is_user_logged_in()."'  ");
         $countEmailCall = $wpdb->num_rows;*/
  ?>           
  <div class="container">
    <div class="row">
      <div class="col-sm-4"> 
       </div> 
      <div class="col-sm-8">  
          <h2>Total Inquiry : <?php echo $totalGrand;?></h2>
        <table id="" class="display" style="width:100%">
              <thead>
                  <tr>
                      <th>Phone Call</th>
                      <td><?php echo $countPhoneCall;?></td>
                  </tr>

                  <tr>
                      <th>Email</th>
                      <td><?php echo $countEmailCall;?></td>
                  </tr>

                  <tr>
                      <th>Text</th>
                      <td><?php echo $countTextCall;?></td>
                  </tr>    
                     
                      
                  
              </thead>
              
              
          </table>
        </div> 
      </div> 
  </div> 

  <div class="container">
  <table id="inquiryTabel_id" class="display" style="width:100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Date</th>
                <th>Time</th>
                <th>Method</th>
                
            </tr>
        </thead>
        <tbody>
          <?php
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
          <?php $i++; } ?> 
        
    </table>
  </div> 
<?php   }  else{
  echo "Please <a href='/login?redir=sharesim'>login</a> to continue";
}
    ?>

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