<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twenty_twenty_one_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Twenty-One, use a find and replace
		 * to change 'twentytwentyone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentytwentyone', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'twentytwentyone' ),
				'footer'  => __( 'Secondary menu', 'twentytwentyone' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		$background_color = get_theme_mod( 'background_color', 'D1E4DD' );
		if ( 127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex( $background_color ) ) {
			add_theme_support( 'dark-editor-style' );
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ( $is_IE ) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style( $editor_stylesheet_path );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'twentytwentyone' ),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'twentytwentyone' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'twentytwentyone' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'twentytwentyone' ),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'twentytwentyone' ),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'twentytwentyone' ),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'twentytwentyone' ),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		// Editor color palette.
		$black     = '#000000';
		$dark_gray = '#28303D';
		$gray      = '#39414D';
		$green     = '#D1E4DD';
		$blue      = '#D1DFE4';
		$purple    = '#D1D1E4';
		$red       = '#E4D1D1';
		$orange    = '#E4DAD1';
		$yellow    = '#EEEADD';
		$white     = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Black', 'twentytwentyone' ),
					'slug'  => 'black',
					'color' => $black,
				),
				array(
					'name'  => esc_html__( 'Dark gray', 'twentytwentyone' ),
					'slug'  => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name'  => esc_html__( 'Gray', 'twentytwentyone' ),
					'slug'  => 'gray',
					'color' => $gray,
				),
				array(
					'name'  => esc_html__( 'Green', 'twentytwentyone' ),
					'slug'  => 'green',
					'color' => $green,
				),
				array(
					'name'  => esc_html__( 'Blue', 'twentytwentyone' ),
					'slug'  => 'blue',
					'color' => $blue,
				),
				array(
					'name'  => esc_html__( 'Purple', 'twentytwentyone' ),
					'slug'  => 'purple',
					'color' => $purple,
				),
				array(
					'name'  => esc_html__( 'Red', 'twentytwentyone' ),
					'slug'  => 'red',
					'color' => $red,
				),
				array(
					'name'  => esc_html__( 'Orange', 'twentytwentyone' ),
					'slug'  => 'orange',
					'color' => $orange,
				),
				array(
					'name'  => esc_html__( 'Yellow', 'twentytwentyone' ),
					'slug'  => 'yellow',
					'color' => $yellow,
				),
				array(
					'name'  => esc_html__( 'White', 'twentytwentyone' ),
					'slug'  => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => esc_html__( 'Purple to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'purple-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'yellow-to-purple',
				),
				array(
					'name'     => esc_html__( 'Green to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'green-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to green', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug'     => 'yellow-to-green',
				),
				array(
					'name'     => esc_html__( 'Red to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'red-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'yellow-to-red',
				),
				array(
					'name'     => esc_html__( 'Purple to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'purple-to-red',
				),
				array(
					'name'     => esc_html__( 'Red to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'red-to-purple',
				),
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if ( is_customize_preview() ) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', twenty_twenty_one_get_starter_content() );
		}

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );
	}
}
add_action( 'after_setup_theme', 'twenty_twenty_one_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'twentytwentyone' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twenty_twenty_one_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twenty_twenty_one_content_width', 750 );
}
add_action( 'after_setup_theme', 'twenty_twenty_one_content_width', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	// RTL styles.
	wp_style_add_data( 'twenty-twenty-one-style', 'rtl', 'replace' );

	// Print styles.
	wp_enqueue_style( 'twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script(
			'twenty-twenty-one-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array( 'twenty-twenty-one-ie11-polyfills' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}

	// Responsive embeds script.
	wp_enqueue_script(
		'twenty-twenty-one-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array( 'twenty-twenty-one-ie11-polyfills' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_scripts' );

/**
 * Enqueue block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script() {

	wp_enqueue_script( 'twentytwentyone-editor', get_theme_file_uri( '/assets/js/editor.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwentyone_block_editor_script' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix() {

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	}

	// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twenty_twenty_one_skip_link_focus_fix' );

/** Enqueue non-latin language styles
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages() {
	$custom_css = twenty_twenty_one_get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twenty-twenty-one-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages' );

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init() {
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri( '/assets/js/customize-preview.js' ),
		array( 'customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_preview_init', 'twentytwentyone_customize_preview_init' );

/**
 * Enqueue scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts() {

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts' );

/**
 * Calculate classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes() {
	$classes = apply_filters( 'twentytwentyone_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class() {
	?>
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
	<?php
}
add_action( 'wp_footer', 'twentytwentyone_add_ie_class' );




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
	echo "<h3>It looks like you are already logged in</h3>";
}
return $output;
}
add_shortcode('login_form', 'isigma_login_form');


// login form fields
function isigma_login_form_fields() {
 
ob_start(); ?>
<div class="login-form">
<h3 class="isigma_header"><?php _e('Login'); ?></h3>
 
<?php
// show any error messages after form submission
isigma_show_error_messages(); 
//global $requesting;
$requesting = $_SERVER["HTTP_REFERER"];
$sharesim = $_GET["redir"];
?>
 
<form id="isigma_login_form"  class="isigma_form" action="" method="post">
<fieldset>
<p>

<input placeholder="Username" name="isigma_user_loginu" id="isigma_user_loginu" class="required form-control" required="" type="text"/>
</p>
<p>

<input placeholder="Password" required="" name="isigma_user_passlo" id="isigma_user_passlo" class="required form-control" type="password"/>
</p>
<p>
<input type="hidden" name="requesting" value="<?php echo $_GET['redir']; ?>" />
<input type="hidden" name="isigma_login_nonce" value="<?php echo wp_create_nonce('isigma-login-nonce'); ?>"/>
<input type='hidden' name='redirect_to' value='<?php echo $_SERVER['REQUEST_URI']; ?>' />
<input id="isigma_login_submit" type="submit" value="Login"/>
</p>
</fieldset>
</form>
<p><a href='"<?php echo site_url();?>/forgot-password'>Forgot Password ?</a></p>
</div>

<?php
return ob_get_clean();
}


//log in a member in after submitting a form
function isigma_login_member() {
 
if(isset($_POST['isigma_user_loginu']) && wp_verify_nonce($_POST['isigma_login_nonce'], 'isigma-login-nonce')) {
 
// this returns the user ID and other info from the user name
$user = get_userdatabylogin($_POST['isigma_user_loginu']);
 //print_r($user);
if(!$user) {
// if the user name doesn't exist
isigma_errors()->add('empty_username', __('Invalid username'));
}
 
if(!isset($_POST['isigma_user_passlo']) || $_POST['isigma_user_passlo'] == '') {
// if no password was entered
isigma_errors()->add('empty_password', __('Please enter a password'));
}
 
// check the user's login with their password
if(!wp_check_password($_POST['isigma_user_passlo'], $user->user_pass, $user->ID)) {
// if the password is incorrect for the specified user
isigma_errors()->add('empty_password', __('Incorrect password'));
}
 
// retrieve all error messages
$errors = isigma_errors()->get_error_messages();
 $request = $_POST['requesting']; 
// echo $request; 
// only log the user in if there are no errors
 //print_r($errors);
if(empty($errors)) {
 
wp_setcookie($_POST['isigma_user_loginu'], $_POST['isigma_user_pass'], true);
wp_set_current_user($user->ID, $_POST['isigma_user_loginu']);
//do_action('wp_login', $_POST['isigma_user_login']);
 
//echo "<pre>"; print_r($user); die;
 if($request == ''){
wp_redirect(home_url().'/dashboard'); exit;
 } else{
 wp_redirect(home_url().'/share/'); exit;
}}
}
}
add_action('init', 'isigma_login_member');

if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}

// register a new user

add_action ('wp_loaded', 'my_custom_redirect');
function my_custom_redirect() {
 if (isset( $_POST["register_submit_button"] ) ) {
			//echo "hg"; exit;
		$user_login		= $_POST["isigma_user_login_reg"];	
		$user_email		= $_POST["isigma_user_email_reg"];
		$user_first 	= $_POST["isigma_user_first_reg"];
		$institution 	= $_POST["institution_reg"];
		$user_last	 	= $_POST["isigma_user_last_reg"];
		$user_pass		= $_POST["isigma_user_pass_reg"];
		$phone_reg 		= $_POST["isigma_user_phone_reg"];
		$pass_confirm 	= $_POST["isigma_user_pass_confirm_reg"];
		$register_type 	= $_POST["register_types"];
		//$register_as = $_POST['register_as'];
		//$userrole  = 'student';

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
 		//print_r($errors); exit;
		// only create the user in if there are no errors
		//print_r($errors);
		if(empty($errors)) {
 
			$new_user_id = wp_insert_user(array(
					'user_login'		=> $user_login,
					'user_pass'	 		=> $user_pass,
					'user_email'		=> $user_email,
					'first_name'		=> $user_first,
					'last_name'			=> $user_last,
					'user_registered'	=> date('Y-m-d H:i:s'),
					'role'				=> $register_type
				)
			
			);

						if($new_user_id) {
							// send an email to the admin alerting them of the registration
							//wp_new_user_notification($new_user_id);
							if(!empty($institution)){
							wp_insert_post( array(
			        'post_title'    => $institution,
			        'post_status'  	=> 'publish',
			        'post_author'   => $new_user_id,
			        'post_type'     => 'institution'
			    )
			);
						}
 				//echo $_POST['isigma_user_login_reg'];
 				//echo $_POST['isigma_user_pass_reg'];
 				//echo $new_user_id;
				update_user_meta( $new_user_id, 'contactp',  $_POST['isigma_user_phone_reg']  );
 				wp_setcookie($_POST['isigma_user_login_reg'], $_POST['isigma_user_pass_reg'], true);
				wp_set_current_user($new_user_id, $_POST['isigma_user_login_reg']);
				wp_redirect(home_url().'/dashboard/');  exit;
 				//update_user_meta( $user_id, 'userstatus', 'pending' );	
				// log the new user in
					// wp_setcookie($user_login, $user_pass, true);
					// wp_set_current_user($new_user_id, $user_login);	
					// do_action('wp_login', $user_login);
 
				// send the newly created user to the home page after logging them in
				
			}
 
		}
 
	}
	if (isset( $_POST["share_submit_button"]) || isset($_POST['share_draft_button']) )  {
    $sim_title       = $_POST["share-title"];
    $author          = $_POST["share-author"];
    $institution     = $_POST["share-institution"];
    $license         = $_POST["license"];
    $classification  = $_POST["classification"]; 
    $overview        = $_POST["overview"];
    $keywords        = $_POST["keywords"];
    $security       = $_POST["Security"];
    $urlsadd        = $_POST["urlsadd"];
    //echo "$post_status";
  
   

    if($sim_title == '') {
      // empty username
      isigma_errors()->add('sim_title', __('Please enter a username'));
    }
    if($author == '') {
      // empty username
      isigma_errors()->add('author', __('Please enter a Author name'));
    }
    if($license == '') {
      // empty username
      isigma_errors()->add('license', __('Please enter a Creative Commons License'));
    }
     if($classification == '') {
      // empty username
      isigma_errors()->add('classification', __('Please enter a Subject Classification'));
    }
     if($overview == '') {
      // empty username
      isigma_errors()->add('overview', __('Please enter something in Overview'));
    }
    $cid = get_current_user_id();

    $errors = isigma_errors()->get_error_messages();
   if(empty($errors)) {
   	if(isset($_POST["share_submit_button"])){
     $newpostid = wp_insert_post( array(
        'post_title'    => $sim_title,
        'post_author'   => $cid,
        'post_status'   => 'publish',
        'post_type'     => 'sims',
        'post_content'     => $overview,
        'meta_input'    => array(
                'author'   => $author,
                'institutions' => $institution,
                'posttitle' => $sim_title,
                'creative_commons_license' => $license,
                'subject_classifications' => $classification,
                'security' => $security,
                'files' => $urlsadd,
                'activated' => $post_status,
                'keywords' => $keywords,
                'acknowledgement' => $_POST['acknowledgement'],
                'pstudy' => $_POST['pstudy'],
                'sroles' => $_POST['sroles'],
                'staffroles' => $_POST['staffroles'],
                'dsimnarat' => $_POST['dsimnarat'],
                'loutcomes' => $_POST['loutcomes'],
                'assesment' => $_POST['assesment'],
                'resources' => $_POST['resources'],
                'ssuport' => $_POST['ssuport'],
                'stime' => $_POST['stime'],
                'pperiod' => $_POST['pperiod'],
                'sexeperience' => $_POST['sexeperience'],
                'ruse' => $_POST['ruse'],
                'reference' => $_POST['reference']
        )
    ) ); 

       } else {
				$newpostid = wp_insert_post( array(
        'post_title'    => $sim_title,
        'post_author'   => $cid,
        'post_type'     => 'sims',
        'post_status'	=> 'draft',
        'post_content'     => $overview,
        'meta_input'    => array(
                'author'   => $author,
                'institutions' => $institution,
                'posttitle' => $sim_title,
                'creative_commons_license' => $license,
                'subject_classifications' => $classification,
                'security' => $security,
                'files' => $urlsadd,
                'activated' => $post_status,
                'keywords' => $keywords,
                'acknowledgement' => $_POST['acknowledgement'],
                'pstudy' => $_POST['pstudy'],
                'sroles' => $_POST['sroles'],
                'staffroles' => $_POST['staffroles'],
                'dsimnarat' => $_POST['dsimnarat'],
                'loutcomes' => $_POST['loutcomes'],
                'assesment' => $_POST['assesment'],
                'resources' => $_POST['resources'],
                'ssuport' => $_POST['ssuport'],
                'stime' => $_POST['stime'],
                'pperiod' => $_POST['pperiod'],
                'sexeperience' => $_POST['sexeperience'],
                'ruse' => $_POST['ruse'],
                'reference' => $_POST['reference']
        )
    ) );       	
       }

 wp_redirect(home_url().'/dashboard/');  exit;
    }
   
   
 }


}     
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
		        echo '<span class="error" style="color:#000"><strong>' . $message . '</strong></span><br/>';
		    }
		echo '</div>';
	}	
}

add_filter( 'password_change_email', 'change_password_mail_message', 10, 3 );
function change_password_mail_message( 
  $pass_change_mail, 
  $user, 
  $userdata 
) {
 
  $pass_change_mail[ 'subject' ] = '[Sim Share] Password changed';
  $user_full_name = $user->user_firstname . $user->user_lastname;
  $pass_change_mail[ 'message' ] = 'Hi,'.$user_full_name.' <br><br>
This notice confirms that your password was changed on Sim Share.<br><br>If you did not change your password, please contact the Site Administrator at info@simshare.com</br></br>Regards,</br>
    Sim Share</br>';
  return $pass_change_mail;
}

function send_welcome_email_to_new_user($user_id) {
    $user = get_userdata($user_id);
    $user_roles = $user->roles;
    $Loginuser_role = array_shift($user_roles);
    $user_email = $user->user_email;
    // for simplicity, lets assume that user has typed their first and last name when they sign up
    $user_full_name = $user->user_firstname . $user->user_lastname;

    // Now we are ready to build our welcome email
    $to = $user_email;
    $subject = "Hi " . $user_full_name . ", welcome to our site!";
    $body = '
              <p>Dear ' . $user_full_name . ',</p></br></br>
              <p>Welcome to our website</p></br></br>
              <p>Thanks and Regards,</p></br>
              <p>Sim Share</p></br>
             ';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    if (wp_mail($to, $subject, $body, $headers)) {
      error_log("email has been successfully sent to user whose email is " . $user_email);
    }else{
      error_log("email failed to sent to user whose email is " . $user_email);
    }

  }

 add_action('user_register', 'send_welcome_email_to_new_user');

add_action( 'wp_ajax_file_upload', 'file_upload_callback' );
add_action( 'wp_ajax_nopriv_file_upload', 'file_upload_callback' );

function file_upload_callback() {
    $arr_img_ext = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');
 	require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );

    $files = $_FILES["file"];
   	$aarray = array();
    foreach ($files['name'] as $key => $value) {
        if ($files['name'][$key]) {
            $file = array(
                'name' => $files['name'][$key],
                'type' => $files['type'][$key],
                'tmp_name' => $files['tmp_name'][$key],
                'error' => $files['error'][$key],
                'size' => $files['size'][$key]
            );
            $_FILES = array("upload_file" => $file);
            $attachment_id = media_handle_upload("upload_file", 0);

            if (is_wp_error($attachment_id)) {
                // There was an error uploading the image.
                echo "Error adding file";
            } else {
                // The image was uploaded successfully!
                array_push($aarray, $attachment_id);
                //$attachment_id = $attachment_id.",";
                //echo wp_get_attachment_image($attachment_id, array(800, 600)) . "<br>"; //Display the uploaded image with a size you wish. In this case it is 800x600
            }
        }
    }
    //$attachment_id = rtrim($attachment_id, ',');
    echo implode(",",$aarray);
    die();
}

add_action( 'wp_ajax_file_delete', 'file_delete_callback' );
add_action( 'wp_ajax_nopriv_file_delete', 'file_delete_callback' );


  function file_delete_callback(){
     
      // echo $_FILES["upload"]["name"];
      $deletefile = $_REQUEST['id'];
     //echo "$deletefile";
      
      if(wp_delete_attachment($deletefile)){
      	echo "File deleted successfully";
      }
      //$movefile = wp_handle_upload($uploadedfile, $upload_overrides);

    // echo $movefile['url'];
    
    die();
 }
add_action('wp_logout','ps_redirect_after_logout');
function ps_redirect_after_logout(){
        wp_redirect(home_url()); 
         exit();
}
 
 add_action( 'init', 'check_api' );
function check_api() {
     //global $wp;
	
     //if(isset($_REQUEST['ssoapi'])) {

       auto_log_user_in();
       // exit;
     //}
}
 function auto_log_user_in() { 
	// If ID, user, and key are all present.
	if ( isset( $_GET['id'] ) 
	  && isset( $_GET['u'] ) 
	  && isset( $_GET['k'] ) ) {
		// Get the query string values.
		$user_id    = $_GET['id'];
		$user_login = $_GET['u'];
		$activation = $_GET['k'];
		//echo "$user_login"."<br>";
		$chk_user = get_user_by( 'id', $user_id );
	//echo "<pre>"; print_r($chk_user); die;
		// If a user is returned and it's not an admin, validate and login.
		if ( $chk_user  ) {
			
				//echo "$activation"."<br>";
				wp_set_current_user( $chk_user->ID, $user_login );
				wp_set_auth_cookie( $chk_user->ID );
				do_action( 'wp_login', $user_login , $chk_user);
				if(isset($_GET['reset'])){
					 	wp_redirect(home_url().'/change-password/'); 
				}
			
			
		}
	}
}
