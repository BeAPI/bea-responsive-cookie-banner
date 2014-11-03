// Cookie function
function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires=" + d.toGMTString();
	document.cookie = cname + "=" + cvalue + "; " + expires + "domain=." + document.domain + ";path=/;";
}

function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ')
			c = c.substring(1);
		if (c.indexOf(name) != -1)
			return c.substring(name.length, c.length);
	}
	return "";
}

jQuery(document).ready(function () {
	var cookie_banner = jQuery('#cookie-banner');
	if ( getCookie('cookie-law') == 'cookie-law' ) {
		cookie_banner.remove();
	} else {
		// Insert the banner after the opening <body> tag
		cookie_banner.prependTo('body');

		// Slide the cookie banner down after one second
		cookie_banner.delay(1000).slideDown('slow');

		// Set what happens when the accept button gets clicked
		jQuery('#cookie-banner .accept').click(function () {
			setCookie('cookie-law', 'cookie-law', 60);
			cookie_banner.slideUp('slow');
		})

		// Prepend http:// on to the link href if it doesn't already exist, this works for both http and https
		var linkHref = jQuery('#cookie-banner .more-info').attr('href');
		if (linkHref.indexOf('http') < 0)
		jQuery('#cookie-banner .more-info').attr("href", 'http://' + linkHref);

		// Check if the user would like the 'more info' link in the same window
		var newWindowValue = jQuery('#new_window').attr('value');
		if (newWindowValue == '0') {
			jQuery('#cookie-banner .more-info').removeAttr("target");
		}
	}
})
