	<?php

	// user registration login form
function isigma_registration_form() {
 $output = '';
	// only show the registration form to non-logged-in members
	if(!is_user_logged_in()) {
 
		global $isigma_load_css;
 
		// set this to true so the CSS is loaded
		$isigma_load_css = true;
 
		// check to make sure user registration is enabled
		$registration_enabled = get_option('users_can_register');
 
		// only show the registration form if allowed
		if($registration_enabled) {
			$output = isigma_registration_form_fields();
		} else {
			$output = __('User registration is not enabled');
		}
		return $output;
	}
}
add_shortcode('register_form', 'isigma_registration_form');

// user login form
function isigma_login_form() {
 $output = '';
if(!is_user_logged_in()) {
 
global $isigma_load_css;
 
// set this to true so the CSS is loaded
$isigma_load_css = true;
 
$output = isigma_login_form_fields();
} else {
// could show some logged in user info here
// $output = 'user info here';
}
return $output;
}
add_shortcode('login_form', 'isigma_login_form');


// login form fields
function isigma_login_form_fields() {
 

// show any error messages after form submission
isigma_show_error_messages(); 
//global $requesting;
$requesting = $_SERVER["HTTP_REFERER"];
?>
 
<form id="isigma_login_form"  class="isigma_form" action="" method="post">
<fieldset>
<p>

<input placeholder="Username" name="isigma_user_login" id="isigma_user_login" class="required form-control" type="text"/>
</p>
<p>

<input placeholder="Password" name="isigma_user_pass" id="isigma_user_pass" class="required form-control" type="password"/>
</p>
<p>
<input type="hidden" name="requesting" value="<?php echo $_GET['redirecteid']; ?>" />
<input type="hidden" name="isigma_login_nonce" value="<?php echo wp_create_nonce('isigma-login-nonce'); ?>"/>
<input type='hidden' name='redirect_to' value='<?php echo $_SERVER['REQUEST_URI']; ?>' />
<input id="isigma_login_submit" type="submit" value="Login"/>
</p>
</fieldset>
</form>
<?php
}


//log in a member in after submitting a form
function isigma_login_member() {
 
if(isset($_POST['isigma_user_login']) && wp_verify_nonce($_POST['isigma_login_nonce'], 'isigma-login-nonce')) {
 
// this returns the user ID and other info from the user name
$user = get_userdatabylogin($_POST['isigma_user_login']);
 
if(!$user) {
// if the user name doesn't exist
isigma_errors()->add('empty_username', __('Invalid username'));
}
 
if(!isset($_POST['isigma_user_pass']) || $_POST['isigma_user_pass'] == '') {
// if no password was entered
isigma_errors()->add('empty_password', __('Please enter a password'));
}
 
// check the user's login with their password
if(!wp_check_password($_POST['isigma_user_pass'], $user->user_pass, $user->ID)) {
// if the password is incorrect for the specified user
isigma_errors()->add('empty_password', __('Incorrect password'));
}
 
// retrieve all error messages
$errors = isigma_errors()->get_error_messages();
 $request = $_POST['requesting']; 
// echo $request; 
// only log the user in if there are no errors
if(empty($errors)) {
 
wp_setcookie($_POST['isigma_user_login'], $_POST['isigma_user_pass'], true);
wp_set_current_user($user->ID, $_POST['isigma_user_login']);
//do_action('wp_login', $_POST['isigma_user_login']);
 
//echo "<pre>"; print_r($user); die;
 
 
}
}
}
add_action('init', 'isigma_login_member');

function isigma_registration_form_fields() {
 
		// show any error messages after form submission
		isigma_show_error_messages(); ?>
 
		<form id="isigma_registration_form" class="isigma_form" action="" method="POST">
			<fieldset>
				<div class="row registration-form">
					<div class="col-md-6">
					<input placeholder="First Name" name="isigma_user_first" id="isigma_user_first" type="text" class="form-control" />
				</div>
				<div class="col-md-6">
				<input placeholder="Last Name" name="isigma_user_last" id="isigma_user_last" type="text" class="form-control" />
				

		</div>

		<div class="col-md-6">
									<input placeholder="Email" name="isigma_user_email" id="isigma_user_email" class="required form-control" type="email"/>
									</div>
				<div class="col-md-6">
					<input placeholder="Phone" name="isigma_user_phone" id="isigma_user_phone" class="required form-control" type="text"/>
			</div>
			
				<div class="col-md-6">
					
					<input placeholder="Institution" name="institution" id="institution" class="required form-control" type="text"/>
			</div>
				<div class="col-md-6">
					
					<input placeholder="Username" name="isigma_user_login" id="isigma_user_login" class="required form-control" type="text"/>
				</div>
				<div class="col-md-6">				
					<input placeholder="Password" name="isigma_user_pass" id="password" class="required form-control" type="password"/>
				</div>
				<div class="col-md-6">
					
					<input placeholder="Confirm Password" name="isigma_user_pass_confirm" id="password_again" class="required form-control" type="password"/>
				</div>
				<div class="col-md-6">
					<input type="hidden" name="isigma_register_nonce" value="<?php echo wp_create_nonce('isigma-register-nonce'); ?>"/>
				</div>

				<div class="col-md-12">
					<input type="submit" value="<?php _e('Register Your Account'); ?>"/>
				</div></div>
			</fieldset>
		</form>
	<?php
	
}


// register a new user
function isigma_add_new_member() {
  	if (isset( $_POST["isigma_user_login"] ) && wp_verify_nonce($_POST['isigma_register_nonce'], 'isigma-register-nonce')) {
		$user_login		= $_POST["isigma_user_login"];	
		$user_email		= $_POST["isigma_user_email"];
		$user_first 	= $_POST["isigma_user_first"];
		$user_last	 	= $_POST["isigma_user_last"];
		$user_pass		= $_POST["isigma_user_pass"];
		$pass_confirm 	= $_POST["isigma_user_pass_confirm"];
		$userrole  = 'student';
 
		// this is required for username checks
		
		if(username_exists($user_login)) {
			// Username already registered
			isigma_errors()->add('username_unavailable', __('Username already taken'));
		}
		if(!validate_username($user_login)) {
			// invalid username
			isigma_errors()->add('username_invalid', __('Invalid username'));
		}
		if($user_login == '') {
			// empty username
			isigma_errors()->add('username_empty', __('Please enter a username'));
		}
		if(!is_email($user_email)) {
			//invalid email
			isigma_errors()->add('email_invalid', __('Invalid email'));
		}
		if(email_exists($user_email)) {
			//Email address already registered
			isigma_errors()->add('email_used', __('Email already registered'));
		}
		if($user_pass == '') {
			// passwords do not match
			isigma_errors()->add('password_empty', __('Please enter a password'));
		}
		if($user_pass != $pass_confirm) {
			// passwords do not match
			isigma_errors()->add('password_mismatch', __('Passwords do not match'));
		}
 
		$errors = isigma_errors()->get_error_messages();
 
		// only create the user in if there are no errors
		if(empty($errors)) {
 
			$new_user_id = wp_insert_user(array(
					'user_login'		=> $user_login,
					'user_pass'	 		=> $user_pass,
					'user_email'		=> $user_email,
					'first_name'		=> $user_first,
					'last_name'			=> $user_last,
					'user_registered'	=> date('Y-m-d H:i:s'),
					'role'				=> $userrole
				)
			);
			if($new_user_id) {
				// send an email to the admin alerting them of the registration
				wp_new_user_notification($new_user_id);
 				wp_setcookie($_POST['isigma_user_login'], $_POST['isigma_user_pass'], true);
				wp_set_current_user($user->ID, $_POST['isigma_user_login']);
 				//update_user_meta( $user_id, 'userstatus', 'pending' );	
				// log the new user in
					// wp_setcookie($user_login, $user_pass, true);
					// wp_set_current_user($new_user_id, $user_login);	
					// do_action('wp_login', $user_login);
 
				// send the newly created user to the home page after logging them in
				wp_redirect(home_url()); exit;
			}
 
		}
 
	}
}
add_action('init', 'isigma_add_new_member');



// used for tracking error messages
function isigma_errors(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function isigma_show_error_messages() {
	if($codes = isigma_errors()->get_error_codes()) {
		echo '<div class="isigma_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = isigma_errors()->get_error_message($code);
		        echo '<span class="error" style="color:#fff"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		    }
		echo '</div>';
	}	
}


