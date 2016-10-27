<?php
// Frontend

// Theme particulars
require_once(get_template_directory() . "/admin/defaults.php");
require_once(get_template_directory() . "/admin/options.php");

$cryout_theme_defaults = zombie_get_option_defaults();

// Dashboard
if( is_admin() ) {
	// Admin side of framework
	require_once(get_template_directory() . "/cryout/admin.php");
} // is_admin()

// Framework
require_once(get_template_directory() . "/cryout/prototypes.php");
// Set up the Theme Customizer settings and controls
// Needs to be included in both dashboard and frontend
require_once(get_template_directory() . "/cryout/customizer.php");
add_action( 'customize_register', 'cryout_customizer_extras' );
add_action( 'customize_register', array('Cryout_Customizer', 'register' ) );


// Get the theme options and make sure defaults are used if no values are set
function zombie_apocalypse_get_theme_options() {

	$options = wp_parse_args(
		get_option( 'za_options', array() ),
		zombie_get_option_defaults()
	);
	$options['id'] = "zombie_settings";
	return $options; 
} // zombie_apocalypse_get_theme_options()

// big array 
function zombie_apocalypse_get_theme_structure() {
	global $cryout_theme_options;
	return $cryout_theme_options;
} // zombie_apocalypse_get_theme_structure()

// Hooks/Filters
add_action('admin_menu', 'zombie_add_page_fn');
add_action('init', 'zombie_init');

// Add admin scripts
function zombie_admin_scripts($hook) {
	global $zombie_page;
	$extensions = array(); // used locally 
	if( $zombie_page != $hook )
        return;
	/* STYLES */
	wp_enqueue_style( 'cryout-admin-style', get_template_directory_uri() . '/admin/css/admin.css' );
	wp_enqueue_script('cryout-admin-js',get_template_directory_uri() . '/admin/js/admin.js' );
}

// Register and enqueue all scripts and styles for the init hook
function zombie_init() {
	// load text domain into the admin section
	load_theme_textdomain( 'zombie-apocalypse', get_template_directory_uri() . '/languages' );
} // zombie_init()

// Create admin subpages
function zombie_add_page_fn() {
	global $zombie_page;
	$zombie_page = add_theme_page('About Zombie Apocalypse', 'About Zombie Apocalypse', 'edit_theme_options', 'about-zombie-apocalypse', 'zombie_page_fn');
	add_action( 'admin_enqueue_scripts', 'zombie_admin_scripts' );
} // zombie_add_page_fn()

 // Display the admin options page
function zombie_page_fn() { ?>
<div id="loading-big"></div>
<div class="wrap"><!-- Admin wrap page -->


<div>
	<div id="admin_header">
		<h2 id="version">
			Zombie Apocalypse v<?php echo _THEME_VERSION; ?> by <a href="http://www.cryoutcreations.eu" target="_blank">Cryout Creations</a>
		</h2>
		<img id="logo" src="<?php echo get_template_directory_uri() . '/admin/images/zombie-logo.png' ?>" />
	</div>
	<div id="admin_links">
		<a target="_blank" href="<?php echo admin_url('customize.php')?>">Theme Settings</a>
		<a target="_blank" href="http://www.cryoutcreations.eu/zombie-apocalypse">Theme Homepage</a>
		<a target="_blank" href="http://www.cryoutcreations.eu/forum">Theme Support</a>
		<a id="special" target="_blank" href="https://wordpress.org/support/view/theme-reviews/zombie-apocalypse#postform">Rate it</a>
	</div>
	<div style="clear: both;"></div>
</div>

	<div class="postbox donate">
		<h3 class="hndle"> Coffee Break </h3>
		<div class="inside">
		<?php echo "<p>Where did the <strong>THEME SETTINGS</strong> go? Well, we killed them!!! But don't freak out, the zombie apocalypse is still in effect so their
			rotten corpses came back to life via the Customizer and you'll find them reincarnated <a href='" . admin_url('customize.php') . "'><strong>HERE</strong></a>. 
		     This is version 2.0 of your favorite B-movie styled theme and a few things have changed but they're all for the best.</p>
			<p> Apart from a couple of <strong>visual changes</strong> that mostly have to do with adding or removing extra padding, borders, indents and transparency we've also made the theme
			<strong>fully responsive</strong> (including the menu), added gallery and aside <strong>post formats</strong>, and generaly brought the theme 
			<strong>up to date</strong> with the latest WordPress version. Oh and the settings, we've moved all the settings to the <strong>customizer</strong>. 
			So what are ou waiting for? Go check them out! </p>
			<p>Oh and if you trully love the undead, consider helping them in their quest for BBRAAINSS and...</p>";?>
			<div style="display:block;float:none;margin:0 auto;text-align:center;">

			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
				<input type="hidden" name="cmd" value="_donations">
				<input type="hidden" name="business" value="KYL26KAN4PJC8">
				<input type="hidden" name="item_name" value="Cryout Creations - Zombie Apocalypse">
				<input type="hidden" name="currency_code" value="EUR">
				<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_SM.gif:NonHosted">
				<input type="image" src="<?php echo get_template_directory_uri() . '/admin/images/coffee.png' ?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>

			</div>
			<p>or socially smother, caress and embrace us:</p>
			<div style="display:table;float:none;margin:0 auto;">
				<div id="fb-root"></div><div class="fb-like" data-href="https://www.facebook.com/CryoutCreations" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
				<a href="https://twitter.com/cryoutcreations" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @cryoutcreations</a>
				<script src="https://apis.google.com/js/platform.js" async defer></script> <div class="g-plusone" data-href="https://plus.google.com/+CryoutcreationsEuCR2"  data-size="medium" data-annotation="none"></div>
			</div>

		</div><!-- inside -->
	</div><!-- donate -->

</div><!--  wrap -->

<?php } // zombie_page_fn()