<?php
/**
 * Template Name: Configure Alerts
 *
 * Allow users to update their profiles from Frontend.
 *
 */
get_header();
$cid = get_current_user_id();
$uall = get_the_author_meta( 'uemailda', $cid );
$rall = get_the_author_meta( 'uemailra', $cid );
//echo "$uall";
?>
<div class="inner-banner">
      <div class="container">
            <div class="row">
              <div class="col-lg-12 wow fadeInUp" data-wow-offset="10" data-wow-duration="1.5s">
                 <h1 class="page-title"><?php the_title();?></h1>
              </div>
            </div>
                        
        </div>
  </div>
<div class="inner-page faq-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-offset="10" data-wow-duration="1.5s">
 
        <?php if(!is_user_logged_in() ){
          echo 'You must be <a href="/login">logged<a> in view this';
        } else {
        ?>
  <div class="left-column">
          <?php include 'page-sidebar.php'; ?>
        </div>
        <div class="right-column">
<h3 style="color: #072452; padding-bottom: 10px">Configure Alerts</h3>
  <p>Simshare offers email notifications as to whether you receive new connections or downloads. If you do not wish to recieve these emails then please uncheck the specific tickboxes below. </p>            
  
             <table class="my-emails">
   <thead>
  <tr>
    <th>Email Notifications Options</th>
    <th>Enabled</th>
    
  </tr>
</thead>
<tbody>

            
               <tr>
    <td>Files downloaded from your/connections' simulations</td>
    <td><input data-cid ="<?php echo $cid ?>" type="checkbox" id="downloads" name="downloads"></td>
    </tr>
  
               <tr>
    <td>When people connect to your/connections' profile</td>
    <td><input data-cid ="<?php echo $cid ?>" type="checkbox" id='requests' name="requests"></td>
    </tr> 
              
</tbody>
  
</table>
                  </div>
                <?php } ?>
                </div>
                </div>
               
              </div>
              <script type="text/javascript">

                var us = '<?php echo $uall ?>';
                 var rs = '<?php echo $rall ?>';
                console.log(us);
                if(us == 'unset'){
                 jQuery('#downloads').prop('checked', false); 
                }  else{
                 jQuery('#downloads').prop('checked', true); 
                }

                 if(rs == 'unset'){
                 jQuery('#requests').prop('checked', false); 
                }  else{
                 jQuery('#requests').prop('checked', true); 
                }

                 jQuery('body').on('change', '#downloads', function() {
                
      var cid = jQuery(this).attr('data-cid');
       var check = '';
      if (jQuery(this).is(':checked')) {
        var check = 'set';
      } else{
        var check = 'unset';
      }

     if(cid != ''){
      jQuery.ajax({
    url: "<?php echo get_template_directory_uri() ?>/user-request.php",
        type: "post",
        data: {"cid": cid , 'uallow':check,  "utype":'emaild' },
      beforeSend: function() { 
                jQuery('body').addClass("loading");  
                jQuery('body').append('<div class="modalgif">wait...</div>');
                
              },
              complete: function() { 
          jQuery('body').removeClass("loading"); 
          jQuery('.modalgif').remove();
           
        },
      success: function(result){
       console.log(result);
       
      }
  });
}

    });

                 jQuery('body').on('change', '#requests', function() {
                
      var cid = jQuery(this).attr('data-cid');
       var check = '';
      if (jQuery(this).is(':checked')) {
        var check = 'set';
      } else{
        var check = 'unset';
      }

     if(cid != ''){
      jQuery.ajax({
    url: "<?php echo get_template_directory_uri() ?>/user-request.php",
        type: "post",
        data: {"cid": cid , 'uallow':check,  "utype":'requestse' },
      beforeSend: function() { 
                jQuery('body').addClass("loading");  
                jQuery('body').append('<div class="modalgif">wait...</div>');
                
              },
              complete: function() { 
          jQuery('body').removeClass("loading"); 
          jQuery('.modalgif').remove();
           
        },
      success: function(result){
       console.log(result);
       
      }
  });
}

    });
              </script>
<?php get_footer();?>

                 
               
