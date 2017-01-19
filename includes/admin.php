<?php
add_action( 'admin_menu', 'rcb_add_admin_menu' );

function rcb_add_admin_menu() {
	// Create new options menu
	add_options_page( 'Responsive Cookie Banner', 'Responsive Cookie Banner', 'administrator', __FILE__, 'rcb_admin_page' );

	// Call register settings function
	add_action( 'admin_init', 'register_rcb_settings' );
}

function register_rcb_settings() {
	// Add options into the settings page
	register_setting( 'cookie-banner-group', 'cookie_banner_same_window' );
	register_setting( 'cookie-banner-group', 'cookie_banner_text' );
	register_setting( 'cookie-banner-group', 'cookie_banner_accept_button_text' );
	register_setting( 'cookie-banner-group', 'cookie_banner_more_info_text' );
	register_setting( 'cookie-banner-group', 'cookie_banner_more_info' );
	register_setting( 'cookie-banner-group', 'cookie_banner_more_info_title' );
}

// The HTML for the settings page
function rcb_admin_page() {
	?>
	<div class="cookie-banner-options">
		<h2>Responsive Cookie Banner Options</h2>

		<form method="post" name="options-form" class="options-form" action="options.php">
			<?php settings_fields( 'cookie-banner-group' ); ?>
			<?php do_settings_sections( 'cookie-banner-group' ); ?>

			<p>Message text: 
				<textarea style="display:block;" name="cookie_banner_text" id="cookie_banner_text" cols="30" rows="10"><?php echo esc_textarea(get_option( "cookie_banner_text", 'Our website uses cookies. By using our website and agreeing to this policy, you consent to our use of cookies.' )); ?></textarea>
			</p>

			<p>'Accept' button text:
				<input type="text" style="width: 500px; display:block;" name="cookie_banner_accept_button_text" id="cookie_banner_accept_button_text" value="<?php echo esc_attr(get_option( 'cookie_banner_accept_button_text', 'ACCEPT' )); ?>"></p>

			<p>'More info' link text:
				<input type="text" style="width: 500px; display:block;" name="cookie_banner_more_info_text" id="cookie_banner_more_info_text" value="<?php echo esc_attr(get_option( 'cookie_banner_more_info_text', 'MORE INFO' )); ?>">
			</p>

			<p>'More info' link title attribute:
				<input type="text" style="width: 500px; display:block;" name="cookie_banner_more_info_title" id="cookie_banner_more_info_title" value="<?php echo esc_attr( get_option( 'cookie_banner_more_info_title', 'More info about cookies' ) ); ?>">
			</p>

			<p>'More info' link URL:
				<input type="text" style="width: 500px; display:block;" name="cookie_banner_more_info" id="cookie_banner_more_info" value="<?php echo esc_attr(get_option( 'cookie_banner_more_info' )); ?>">
			</p>

			<p>Open in a new window?
				<input name="cookie_banner_same_window" id="cookie_banner_same_window" type="checkbox" value="1" <?php checked( '1', get_option( 'cookie_banner_same_window' ) ); ?> />
			</p>

			<p><?php submit_button(); ?></p>
		</form>
	</div>
	<?php
}
