<?php
add_action( 'wp_enqueue_scripts', 'rcb_register_assets' );
add_action( 'wp_footer', 'rcb_print_html' );

/**
 * Register the Javascript & CSS
 */
function rcb_register_assets() {
	wp_register_script( 'responsive-cookie-banner-js', RCB_URL . 'assets/js/responsive-cookie-banner.min.js', array( 'jquery' ), RCB_VERSION );
	wp_register_style( 'responsive-cookie-banner-css', RCB_URL . 'assets/css/responsive-cookie-banner.css', array(), RCB_VERSION );
}

/**
 * Build HTML with cookie message
 * 
 * @return boolean
 */
function rcb_print_html() {
	// Enqueue assets!
	wp_enqueue_script( "responsive-cookie-banner-js" );
	wp_enqueue_style( 'responsive-cookie-banner-css' );
	?>
	<!-- Responsive Cookie Banner Wordpress plugin -->
	<div id="cookie-banner">
		<div id="cookie-banner-container">
			<div class="left">
				<p><?php echo get_option( 'cookie_banner_text', 'Our website uses cookies. By using our website and agreeing to this policy, you consent to our use of cookies.' ); ?></p>
			</div>

			<div class="right">
				<p><input class="accept" name="accept" type="submit" value="<?php echo esc_attr(get_option( 'cookie_banner_accept_button_text', 'ACCEPT' )); ?>" />
					<a class="more-info" target="_blank" href="<?php echo esc_attr(get_option( 'cookie_banner_more_info' )); ?>" title="<?php echo esc_html( get_option( 'cookie_banner_more_info_title', 'More info about cookies' ) ); ?>"><?php echo esc_html(get_option( 'cookie_banner_more_info_text', 'MORE INFO' )); ?></a>
					<input name="new_window" id="new_window" type="hidden" value="0<?php echo esc_attr(get_option( 'cookie_banner_same_window' )); ?>">
				</p>
			</div>
		</div>
	</div>
	<!-- End Responsive Cookie Banner Wordpress plugin -->
	<?php
	return true;
}
