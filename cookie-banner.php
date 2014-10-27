<?php

/*
* Plugin Name: Responsive Cookie Banner
* Version: 1.3
* Author: Amaury Balmer
* Author email: balmer.amaury at gmail dot com
* License: GPL2
* Description: A simple, stylish and responsive EU cookie banner plugin that will display a message asking if the viewer would like to accept cookies. All text and the 'more info' link destination can be changed in the settings menu. Compatible with all devices, languages and browsers.
* Original Author: Lewis Gray
* Original Author email: limejelly386 at gmail dot com
 *  */


// Plugin constants
define('RCB_VERSION', '1.3');
define('RCB_URL', plugin_dir_url ( __FILE__ ));
define('RCB_DIR', plugin_dir_path( __FILE__ ));

require( RCB_DIR . '/includes/base.php' );
require( RCB_DIR . '/includes/client.php' );
if ( is_admin() ) {
	require( RCB_DIR . '/includes/admin.php' );
}

// Run the function on uninstall
register_uninstall_hook( __FILE__, 'responsive_cookie_banner_uninstall' );