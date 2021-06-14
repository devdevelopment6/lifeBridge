<?php 
/* Template Name: List Inquiry
*/ 
get_header(); 

date_default_timezone_set("Asia/Calcutta"); 


if($_REQUEST['inqueryMethod']!=""){
  global $wpdb;    

    $inquirey = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='".$_REQUEST['inqueryMethod']."'  and assignBy='".is_user_logged_in()."'  ORDER BY id DESC ");
}else{
  global $wpdb;          
    $inquirey = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where assignBy='".is_user_logged_in()."'  ORDER BY id DESC ");
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
      <div class="col-sm-6">  
        <h2>Search List Of Inquiry Form</h2>
        <?php $inqueryDate=date('Y-m-d');
             $time = date('H:i', time());
                  ?>
        <form class="form-horizontal" role="form" method="post">
          <div class="form-group">                    
                <div class="col-sm-4">
                    <input type="date" name="inqueryDate" id="inqueryDate" placeholder="Date *" class="form-control" value="<?php echo $inqueryDate;?>" required="">
                </div>

                <div class="col-sm-4">
                    <input type="text" name="inquerytime" id="inquerytime" placeholder="Time *" class="form-control" value="<?php echo  $time;?>" >
                </div>

                <div class="col-sm-4">
                    <select name="inqueryMethod" class="form-control" required="">
                      <option>--Select--</option>
                      <option value="1" <?php if($_REQUEST['inqueryMethod']=="1"){ echo "selected=selected";}?>>Phone Call</option>
                      <option value="2" <?php if($_REQUEST['inqueryMethod']=="2"){ echo "selected=selected";}?>>Text</option>
                      <option value="3" <?php if($_REQUEST['inqueryMethod']=="3"){ echo "selected=selected";}?>>Email</option>
                    </select>
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
    /*if(!is_user_logged_in()) { */
    // show any error messages after form submission
    isigma_show_error_messages(); 
 
  global $wpdb;          
         $inquirey1 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='1'   ");
         $countPhoneCall = $wpdb->num_rows;

        
         $inquirey2 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='2'   ");
         //$countTextCall = $inquirey2->num_rows;
          $countTextCall = $wpdb->num_rows;

         $inquirey3 = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "inquirey where inqueryMethod='3'   ");
         $countEmailCall = $wpdb->num_rows;
  ?>           
  <div class="container">
    <div class="row">
      <div class="col-sm-6">  
          <h2>Total Inquiry</h2>
        <table id="" class="display" style="width:100%">
              <thead>
                  <tr>
                      <th>PHone Call</th>
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