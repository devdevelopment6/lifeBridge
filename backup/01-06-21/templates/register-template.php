<?php 
/* Template Name: Register Template
*/ 
get_header(); 

	
// displays error messages from form submissions


?>
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
      
<div class="inner-page faq-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-offset="10" data-wow-duration="1.5s">


 
		<?php 
		if(!is_user_logged_in()) { 
		// show any error messages after form submission
		isigma_show_error_messages(); ?>
 
		<form id="isigma_registration_form" class="isigma_forms" action="" method="POST" enctype="multipart/form-data">
			<fieldset>
				<div class="row">
					<div class="col-md-6">
				<p>
					
					<input placeholder="First Name*" required="required" name="isigma_user_first_reg" id="isigma_user_first" type="text" class="form-control" />
				</p>
				</div>
				<div class="col-md-6">
				<p>
					
					<input placeholder="Last Name*" required="required" name="isigma_user_last_reg" id="isigma_user_last" type="text" class="form-control" />
				</p>
			</div>
		</div>
				<p>
				
				<p>
					
					<input placeholder="Email*" name="isigma_user_email_reg" required="required" id="isigma_user_email" class="required form-control" type="email"/>
				</p>
				<p>		
					
					<input type="tel" name="isigma_user_phone_reg" required="required" id="phone" class="required form-control" placeholder="Phone*">
				</p>
				
				

				<p>
					
					<input placeholder="Username*" name="isigma_user_login_reg" required="required" id="isigma_user_login_reg" class="required form-control" type="text"/>
				</p>
				<p>					
					<input placeholder="Password*" name="isigma_user_pass_reg" required="required" id="password" class="required form-control" type="password"/>
				</p>
				<p>
					
					<input placeholder="Confirm Password*" required="required" name="isigma_user_pass_confirm_reg" id="password_again" class="required form-control" type="password"/>
				</p>
				

				<p>
					<input type="hidden" name="isigma_register_nonce" value="<?php echo wp_create_nonce('isigma-register-nonce'); ?>"/>
					<input type="submit" id="registersub" name="register_submit_button" value="<?php _e('Register Your Account'); ?>"/>
				</p>
			</fieldset>
		</form>

<?php } else{
	echo "<h3>You need to logout to register</h3>";
} ?>
		  </div>
    </div>
  </div>
  </div>
  
<script src="<?php echo get_template_directory_uri()?>/js/intlTelInput.js"></script>

 <script>

 var input = document.querySelector("#phone");
  window.intlTelInput(input, {
      
      utilsScript: "<?php echo get_template_directory_uri()?>/js/utils.js",
    });
</script>
<?php get_footer(); ?>