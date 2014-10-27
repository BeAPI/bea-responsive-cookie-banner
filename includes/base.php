<?php
/**
 * Deletes the database fields when remove the plugin
 */
function responsive_cookie_banner_uninstall() {
	delete_option( 'cookie_banner_text', '', 'yes' );
	delete_option( 'cookie_banner_accept_button_text', '', 'yes' );
	delete_option( 'cookie_banner_more_info_text', '', 'yes' );
	delete_option( 'cookie_banner_more_info', '', 'yes' );
	delete_option( 'cookie_banner_same_window', '', 'yes' );
}