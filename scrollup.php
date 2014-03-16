<?php
/*
Plugin Name: scrollup-master
Plugin URI: http://wordpress.org/plugins/scrollup-master/
Description: This plugin is for wordpress to create scroll to top button.
Version: 2.0
Author: Sayful Islam
Author URI: http://sayful1.wordpress.com
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
		        scrollDistance: <?php echo strlen(trim(get_option("scrollup_master_scrolldistance")))>0?trim(get_option("scrollup_master_scrolldistance")):'300'?>, // Distance from top/bottom before showing element (px)
		        scrollFrom: 'top', // 'top' or 'bottom'
		        scrollSpeed: <?php echo strlen(trim(get_option("scrollup_master_scrollspeed")))>0?trim(get_option("scrollup_master_scrollspeed")):'300'?>, // Speed back to top (ms)
		        easingType: '<?php echo strlen(trim(get_option("scrollup_master_tooltipeasingtype")))>0?trim(get_option("scrollup_master_tooltipeasingtype")):'linear'?>',
		        animation: '<?php echo strlen(trim(get_option("scrollup_master_animation")))>0?trim(get_option("scrollup_master_animation")):'fade'?>', // Fade, slide, none
		        animationInSpeed: 200, // Animation in speed (ms)
		        animationOutSpeed: 200, // Animation out speed (ms)
		        scrollText: 'Scroll to top', // Text for element, can contain HTML
		        scrollTitle: '<?php echo strlen(trim(get_option("scrollup_master_tooltiptitle")))>0?trim(get_option("scrollup_master_tooltiptitle")):'Scroll to top'?>',
		        scrollImg: true, // Set true to use image
		        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
		        zIndex: 2147483647 // Z-Index for the overlay
			});
		});
	</script><?php

}
add_action('wp_footer', 'scrollup_active_hook');

/*Scrollup Option Page*/
function register_scrollup_custom_option_page(){
	//create new settings menu
    add_options_page( 'Scrollup-master Settings', 'scrollup-master', 'manage_options', 'scrollup-master/admin.php', '', 6 );
}
add_action( 'admin_menu', 'register_scrollup_custom_option_page' );

//register our settings.
function register_scrollup_settings(){
	register_setting('scrollup-master-settings-group','scrollup_master_tooltiptitle');
	register_setting('scrollup-master-settings-group','scrollup_master_tooltipeasingtype');
	register_setting('scrollup-master-settings-group','scrollup_master_scrollspeed');
	register_setting('scrollup-master-settings-group','scrollup_master_scrolldistance');
	register_setting('scrollup-master-settings-group','scrollup_master_animation');
}
add_action( 'admin_init', 'register_scrollup_settings' );

// function to be run when the plugin is activated.
function scrollup_master_activation() {
	add_option('scrollup_master_tooltiptitle','Scroll to top');
	add_option('scrollup_master_tooltipeasingtype','linear');
	add_option('scrollup_master_scrollspeed',300);
	add_option('scrollup_master_scrolldistance',300);
	add_option('scrollup_master_animation','fade');
}
register_activation_hook( __FILE__, 'scrollup_master_activation' );
?>