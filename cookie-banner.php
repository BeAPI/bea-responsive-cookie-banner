<?php

/*
* Plugin Name: Responsive Cookie Banner
* Version: 1.2
* Author: Lewis Gray
* Author email: limejelly386 at gmail dot com
* License: GPL2
* Description: A simple, stylish and responsive EU cookie banner plugin that will display a message asking if the viewer would like to accept cookies. All text and the 'more info' link destination can be changed in the settings menu. Compatible with all devices, languages and browsers.
*/

function loadJquery(){
// Load Jquery
	wp_enqueue_script('jquery');
}

add_action('init', 'loadJquery');

// Register the Javascript & CSS
wp_register_script( 'cookieBannerJs', plugins_url() . '/responsive-cookie-banner/js.js');
wp_register_style( 'cookieBannerCss', plugins_url( '/responsive-cookie-banner/style.css' ) );

function checkCookie(){

// Check if the cookie is set
	if(!isset($_COOKIE['cookie-law']))

// If it is not set then include the banner
		// Javascript
		wp_enqueue_script("cookieBannerJs");
		// CSS
		wp_enqueue_style('cookieBannerCss');
		//HTML
		?>

<!-- Responsive Cookie Banner Wordpress plugin -->

<div id="cookie-banner">

	<div id="cookie-banner-container">
		
		<div class="left">
			<p><?php echo get_option('cookie_banner_text', 'Our website uses cookies. By using our website and agreeing to this policy, you consent to our use of cookies.'); ?></p>
		</div>

		<div class="right">
			<p><input class="accept" name="accept" type="submit" value="<?php echo get_option('cookie_banner_accept_button_text', 'ACCEPT'); ?>" />
				<a class="more-info" target="_blank" href="<?php echo get_option('cookie_banner_more_info'); ?>"><?php echo get_option('cookie_banner_more_info_text', 'MORE INFO'); ?></a>
				<input name="new_window" id="new_window" type="hidden" value="0<?php echo get_option('cookie_banner_same_window'); ?>">
			</p>
		</div>

	</div>
</div>

<!-- End Responsive Cookie Banner Wordpress plugin -->

		<?php
}

// Call the function into the footer 
add_action('wp_footer', 'checkCookie');

/***************** Options Page *****************/

// create custom plugin settings menu
add_action('admin_menu', 'cookie_banner_menu');

function cookie_banner_menu() {
// Create new options menu
	add_options_page('Responsive Cookie Banner', 'Responsive Cookie Banner', 'administrator', __FILE__, 'cookie_banner_admin_page');

// Call register settings function
	add_action( 'admin_init', 'register_cookie_banner_settings' );
}

function register_cookie_banner_settings() {
// Add options into the settings page
	register_setting( 'cookie-banner-group', 'cookie_banner_same_window' );
	register_setting( 'cookie-banner-group', 'cookie_banner_text' );
	register_setting( 'cookie-banner-group', 'cookie_banner_accept_button_text' );
	register_setting( 'cookie-banner-group', 'cookie_banner_more_info_text' );
	register_setting( 'cookie-banner-group', 'cookie_banner_more_info' );
}

// The HTML for the settings page
function cookie_banner_admin_page() {
	?>
	<div class="cookie-banner-options">

		<h2>Responsive Cookie Banner Options</h2>

		<form method="post" name="options-form" class="options-form" action="options.php">

			<?php settings_fields( 'cookie-banner-group' ); ?>
			<?php do_settings_sections( 'cookie-banner-group' ); ?>

			<p>Message text: <textarea style="display:block;" name="cookie_banner_text" id="cookie_banner_text" cols="30" rows="10"><?php echo get_option("cookie_banner_text", 'Our website uses cookies. By using our website and agreeing to this policy, you consent to our use of cookies.'); ?></textarea></p>

			<p>'Accept' button text:<input type="text" style="width: 500px; display:block;" name="cookie_banner_accept_button_text" id="cookie_banner_accept_button_text" value="<?php echo get_option('cookie_banner_accept_button_text', 'ACCEPT'); ?>"></p>

			<p>'More info' link text:<input type="text" style="width: 500px; display:block;" name="cookie_banner_more_info_text" id="cookie_banner_more_info_text" value="<?php echo get_option('cookie_banner_more_info_text', 'MORE INFO'); ?>"></p>

			<p>'More info' link URL:<input type="text" style="width: 500px; display:block;" name="cookie_banner_more_info" id="cookie_banner_more_info" value="<?php echo get_option('cookie_banner_more_info'); ?>"></p>

			<p>Open in a new window? <input name="cookie_banner_same_window" id="cookie_banner_same_window" type="checkbox" value="1" <?php checked( '1', get_option('cookie_banner_same_window') ); ?> /></p>

			<p><?php submit_button(); ?></p>

		</form>

	</div>

	<?php
}

/***************** Removal *****************/

function cookie_banner_remove() {
// Deletes the database fields
	delete_option('cookie_banner_text', '', 'yes');
	delete_option('cookie_banner_accept_button_text', '', 'yes');
	delete_option('cookie_banner_more_info_text', '', 'yes');
	delete_option('cookie_banner_more_info', '', 'yes');
	delete_option('same_window', '', 'yes');
}

// Run the function on uninstall
register_uninstall_hook( __FILE__, 'cookie_banner_remove' );

?>