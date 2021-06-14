<?php 
/* Template Name: User Dashboard Template
*/ 
?>
<?php 


get_header(); 
 wp_head(); 
if(!is_user_logged_in()){
 echo '<script type="text/javascript">window.location.href = "login/"</script>';
}
global $current_user;
 $sname = $current_user->first_name.' '.$current_user->last_name;
 $ids = get_current_user_id();
 $user_meta = get_userdata($ids);
$user_roles = $user_meta->roles;



?>

<setion class="innerSec">



<div class="container">


<!-- -----------------------------------------------   ----------------------------------------------- -->
<div class="feildBoxBgcover1">
<h1> Dashboard</h1>
<div class="FeildsSize">
	<div class="profileMenu">
    <div class="Reports1" style="margin: 1px;">
          
        <div class="table-responsive">          
	      	<table id="inquiryTabel_id" class="table table-bordered">
		        <thead>
		            
		            <tr>
		            	<td>
		            	<?php if(is_user_logged_in() ){
      						 if ( in_array( 'usera', $user_roles, true ) ) {
       						?>	
		            		<a href="<?php echo site_url();?>/inquiry">Create inquiry</a>
		            	<?php }else if ( in_array( 'userb', $user_roles, true ) ) { ?> 
		            		<a href="<?php echo site_url();?>/appointment">Create Appointment</a>
		            	<?php } 
		            	}
		            	?>		
		            	</td> 
                </tr>  
                <tr>
                  <td>
                  <?php if(is_user_logged_in() ){
                   if ( in_array( 'usera', $user_roles, true ) ) {
                  ?>  
                    <a href="<?php echo site_url();?>/list-of-inquiry-form/">List inquiry</a>
                  <?php }else if ( in_array( 'userb', $user_roles, true ) ) { ?> 
                    <a href="<?php echo site_url();?>/list-of-appointment">List Appointment</a>
                  <?php } 
                  }
                  ?>    
                  </td>

		           </tr>
		           <tr>
		                <td> <a href="<?php echo site_url();?>/change-password"><span class="imgWrap"></span><span><i class="fa fa-key" aria-hidden="true"></i> Change password</span></a>
		                </td>
		            </tr>
		           <tr>
		            	<td>
		            	 <a href="<?php echo wp_logout_url( ) ?>"><span class="imgWrap"></span><span><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</span></a>
		            	</td> 
		           </tr> 	 
		        </thead>
	       	</table>
       	</div> 
        </div>
</div>






</div>
</div>
</section>
  <script type="text/javascript">
       jQuery('body').on('click', '.rowbutt', function() {
      var simid = jQuery(this).attr('data-all');
      var uid = jQuery(this).attr('data-sub');
      var alt = jQuery(this).attr('data-alt');
       //jQuery('#searchval').val("");
      //jQuery('#pagination').hide();
      //var role = '<?php echo $getrole ?>';
      if(uid != ''){
      jQuery.ajax({
    url: "<?php echo get_template_directory_uri() ?>/user-request.php",
        type: "post",
        data: {"simid" : simid , "uid": uid , "alt": alt , "utype":'sub' },

         beforeSend: function() { 
                jQuery('body').addClass("loading");  
                jQuery('body').append('<div class="modalgif">wait...</div>');
                
              },
              complete: function() { 
          jQuery('body').removeClass("loading"); 
          jQuery('.modalgif').remove();
           
        },
      success: function(result){
        console.log('hi');
        location.reload();
      }
  });
}

    });
       </script>


<?php get_footer(); ?>