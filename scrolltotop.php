<?php
/*
Plugin Name: SIS Scroll to Top
Plugin URI: http://wordpress.org/plugins/scrollup-master/
Description: This plugin is for wordpress to create scroll to top button.
Version: 2.3
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

 /* Adding Latest jQuery from Wordpress */
function scrollup_plugin_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-effects-core ');
	wp_enqueue_script('sis_scrooltotop_script',plugins_url( '/js/jquery.scrollUp.min.js' , __FILE__ ),array( 'jquery' ));
}
add_action('init', 'scrollup_plugin_scripts');


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
		        scrollImg: true
			});
		});
	</script><?php

}

add_action('wp_footer', 'scrollup_active_hook');
function scrollup_custom_style(){
	$options = get_option( 'sis_scrooltotop_settings' );
	?><style>
		#scrollUp {
			bottom: <?php echo $options['btn_bottom']; ?>;
			right: <?php echo $options['btn_right']; ?>;
			height: 50px;
			width: 50px;
			background: url(<?php echo plugins_url( '/img/back-top.png' , __FILE__ ); ?>) no-repeat;
			opacity: 0.4;
		}
		#scrollUp:hover{opacity: 1;}
	</style><?php
}
add_action('wp_head','scrollup_custom_style');


//Scrollup Option Page
function register_scrollup_custom_option_page(){
	//create new settings menu
    add_options_page( 'Scroll to Top Settings', 'Scroll to Top', 'manage_options', 'scrollup-master-plugin','scrollup_master_settings_page');
}
add_action( 'admin_menu', 'register_scrollup_custom_option_page' );


function scrollup_master_settings_page(){
	?>
<div id="wpbody">
	<div class="wrap">
		<h2><?php _e('Scroll to Top Settings') ?></h2>
		<form action="options.php" method="post">
			<?php
				settings_fields( 'sis_scrooltotop_settings' );
				$options = get_option( 'sis_scrooltotop_settings' );
			?>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">
							<label><?php _e('Button Position from Bottom') ?></label>
						</th>
						<td>
							<input type="text" name="sis_scrooltotop_settings[btn_bottom]" value="<?php esc_attr_e($options['btn_bottom']); ?>">
							<p class="description"><?php _e('Set button position from bottom. Defaults position is &lsquo; 20px &lsquo;') ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for=""><?php _e('Button Position from Right') ?></label>
						</th>
						<td>
							<input type="text" name="sis_scrooltotop_settings[btn_right]" id="" value="<?php esc_attr_e($options['btn_right']); ?>">
							<p class="description"><?php _e('Set button position from right. Defaults position is &lsquo; 20px &lsquo;') ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for=""><?php _e('Scrollup Tooltip Title') ?></label>
						</th>
						<td>
							<input type="text" name="sis_scrooltotop_settings[tooltiptitle]" id="" value="<?php esc_attr_e($options['tooltiptitle']); ?>">
							<p class="description"><?php _e('Set a custom title if required. This title will show when you put your mouse pointer on scrollup button. Defaults title is &lsquo; Scroll to top &lsquo;') ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for=""><?php _e('Easing Effect Type') ?></label>
						</th>
						<td>
							
							<input type="text" name="sis_scrooltotop_settings[tooltipeasingtype]" id="" value="<?php esc_attr_e($options['tooltipeasingtype']); ?>">
							<p class="description"><?php _e('Select Scroll to top easing effect type. Default easing effect is linear. <a target="_blank" href="http://api.jqueryui.com/easings/">Easing Effect type live view</a>') ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for=""><?php _e('Scrollup Button Animations') ?></label>
						</th>
						<td>
							<select name="sis_scrooltotop_settings[animation]" id="">
								<option value="fade" <?php selected( $options['animation'], 'fade' ); ?>>fade</option>
								<option value="slide" <?php selected( $options['animation'], 'slide' ); ?>>slide</option>
								<option value="none" <?php selected( $options['animation'], 'none' ); ?>>none</option>
							</select>
							<p class="description"><?php _e('Select scrollup button animation type. Default animation type is &lsquo; slide &lsquo; ') ?></a></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for=""><?php _e('Scroll Speed') ?></label>
						</th>
						<td>
							<input type="text" name="sis_scrooltotop_settings[scrollspeed]" id="" value="<?php esc_attr_e($options['scrollspeed']); ?>">

							<p class="description"><?php _e('Speed back to top in millisecond. Default speed is &lsquo; 300 &lsquo; millisecond ') ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for=""><?php _e('Scroll Distance') ?></label>
						</th>
						<td>
							<input type="text" name="sis_scrooltotop_settings[scrolldistance]" id="" value="<?php esc_attr_e($options['scrolldistance']); ?>">

							<p class="description"><?php _e('Distance from top/bottom before showing element pixels. Default distance is &lsquo; 300 &lsquo; pixels ') ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<p class="submit"><input type="submit" value="<?php _e('Save Changes') ?>" class="button button-primary" id="submit" name="submit"></p>
		</form>
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>
	<?php
}
?>