<?php
/*
Plugin Name: SIS Scroll to Top
Plugin URI: http://wordpress.org/plugins/scrollup-master/
Description: This plugin is for wordpress to create scroll to top button.
Version: 2.5
Author: Sayful Islam
Author URI: http://sis.netai.net
License: GPLv2 or later
*/

// Set up our WordPress Plugin
function sis_scrooltotop_check_WP_ver()
{
	$options_array = array(
      	'btn_bottom' => '20px',
      	'btn_right' => '20px',
      	'tooltiptitle' => 'Scroll to top',
      	'tooltipeasingtype' => 'linear',
      	'scrollspeed' => '300',
      	'scrolldistance' => '300',
      	'animation' => 'fade',
      	'btn_type' => 'image',
      	'tab_txt_color' => '#828282',
      	'tab_bg_color' => '#E6E6E6',
      	'pill_txt_color' => '#fff',
      	'pill_bg_color' => '#555',
      	'pill_bghover_color' => '#000',
    );
	if ( get_option( 'sis_scrooltotop_settings' ) !== false ) {
		// The option already exists, so we just update it.
      	update_option( 'sis_scrooltotop_settings', $options_array );
   } else{
   		// The option hasn't been added yet. We'll add it with $autoload set to 'no'.
   		add_option( 'sis_scrooltotop_settings', $options_array );
   }
}
register_activation_hook( __FILE__, 'sis_scrooltotop_check_WP_ver' );

//register settings
function sis_scrooltotop_settings_init(){
    register_setting( 'sis_scrooltotop_settings', 'sis_scrooltotop_settings' );
}
add_action( 'admin_init', 'sis_scrooltotop_settings_init' );

//Scrollup Option Page
function register_scrollup_custom_option_page(){
	//create new settings menu
    add_options_page( 'Scrollup Settings', 'Scrollup', 'manage_options', 'scrollup-master/scrollup-options.php');
}
add_action( 'admin_menu', 'register_scrollup_custom_option_page' );

 /* Adding Latest jQuery from Wordpress */
function scrollup_plugin_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('sis_scrooltotop_script',plugins_url( '/js/jquery.scrollUp.min.js' , __FILE__ ),array( 'jquery' ));
	wp_enqueue_script('sis_scrooltotop_easing',plugins_url( '/js/jquery.easing.js' , __FILE__ ),array( 'jquery' ));
}
add_action('init', 'scrollup_plugin_scripts');

function scrollup_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'scrollup_color_script', plugins_url('/js/main.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'scrollup_color_picker' );

function scrollup_active_hook() {
	$options = get_option( 'sis_scrooltotop_settings' );
	?><script type="text/javascript">
		jQuery(function () {
			jQuery.scrollUp({
		        scrollDistance: <?php echo $options['scrolldistance']; ?>,
		        scrollSpeed: <?php echo $options['scrollspeed']; ?>,
		        easingType: '<?php echo $options['tooltipeasingtype']; ?>',
		        animation: '<?php echo $options['animation']; ?>',
		        scrollTitle: '<?php echo $options['tooltiptitle']; ?>',
		        <?php if ( $options['btn_type'] == 'image' ): ?>
		        	scrollImg: true
		        <?php else: ?>
		        	scrollImg: false
		        <?php endif; ?>
			});
		});
	</script><?php

}
add_action('wp_footer', 'scrollup_active_hook');

// Include Scrollup Style
include_once('scrollup-style.php');