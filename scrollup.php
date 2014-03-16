<?php
/*
Plugin Name: Scrollup-master
Plugin URI: http://wordpress.org/plugins/scrollup-master/
Description: This plugin is for wordpress to create scroll to top button.
Version: 1.0.0
Author: Sayful Islam
Author URI: http://sis.netai.net
License: GPLv2 or later
*/

 /* Adding Latest jQuery from Wordpress */
function scrollup_plugin_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('scrool_up_custom_scrollUp',plugins_url( '/js/jquery.scrollUp.min.js' , __FILE__ ),array( 'jquery' ));
	wp_enqueue_script('scrool_up_custom_easing',plugins_url( '/js/jquery.easing.min.js' , __FILE__ ),array( 'jquery' ));

	wp_enqueue_style('scrool_up_custom_style',plugins_url( '/css/scrollup.css' , __FILE__ ));

}
add_action('init', 'scrollup_plugin_scripts');


function scrollup_active_hook() {

	?><script type="text/javascript">
		jQuery(function () {
			jQuery.scrollUp({
		        scrollName: 'scrollUp', // Element ID
		        scrollDistance: 300, // Distance from top/bottom before showing element (px)
		        scrollFrom: 'top', // 'top' or 'bottom'
		        scrollSpeed: 700, // Speed back to top (ms)
		        easingType: 'easeInExpo', // Scroll to top easing (see http://easings.net/)
		        animation: 'fade', // Fade, slide, none
		        animationInSpeed: 200, // Animation in speed (ms)
		        animationOutSpeed: 200, // Animation out speed (ms)
		        scrollText: 'Scroll to top', // Text for element, can contain HTML
		        scrollTitle: 'Scroll to top', // Set a custom <a> title if required. Defaults to scrollText
		        scrollImg: true, // Set true to use image
		        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
		        zIndex: 2147483647 // Z-Index for the overlay
			});
		});
	</script><?php

}
add_action('wp_footer', 'scrollup_active_hook');

?>