<?php
/*
Plugin Name: scrollup-master
Plugin URI: http://wordpress.org/plugins/scrollup-master/
Description: This plugin is for wordpress to create scroll to top button.
Version: 2.0
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
		        scrollDistance: <?php echo strlen(trim(get_option("scrollup_master_scrolldistance")))>0?trim(get_option("scrollup_master_scrolldistance")):'300'?>,
		        scrollSpeed: <?php echo strlen(trim(get_option("scrollup_master_scrollspeed")))>0?trim(get_option("scrollup_master_scrollspeed")):'300'?>,
		        easingType: '<?php echo strlen(trim(get_option("scrollup_master_tooltipeasingtype")))>0?trim(get_option("scrollup_master_tooltipeasingtype")):'linear'?>',
		        animation: '<?php echo strlen(trim(get_option("scrollup_master_animation")))>0?trim(get_option("scrollup_master_animation")):'fade'?>',
		        scrollTitle: '<?php echo strlen(trim(get_option("scrollup_master_tooltiptitle")))>0?trim(get_option("scrollup_master_tooltiptitle")):'Scroll to top'?>',
		        scrollImg: true
			});
		});
	</script><?php

}
add_action('wp_footer', 'scrollup_active_hook');

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

//Scrollup Option Page
function register_scrollup_custom_option_page(){
	//create new settings menu
    add_options_page( 'Scrollup Settings', 'scrollup-master', 'manage_options', 'scrollup-master-plugin','scrollup_master_settings_page');
}
add_action( 'admin_menu', 'register_scrollup_custom_option_page' );


function scrollup_master_settings_page(){
	?>
<div id="wpbody">
	<div class="wrap">
		<h2>Scrollup Settings</h2>
		<form action="options.php" method="post">
			<?php settings_fields( 'scrollup-master-settings-group' ); ?>
			<?php do_settings_sections( 'scrollup-master-settings-group' ); ?>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">
							<label for="scrollup_master_tooltiptitle">Scrollup Tooltip Title</label>
						</th>
						<td>
							<input type="text" name="scrollup_master_tooltiptitle" id="scrollup_master_tooltiptitle" value="<?php echo get_option('scrollup_master_tooltiptitle'); ?>" class="">
							<p class="description">Set a custom title if required. This title will show when you put your mouse pointer on scrollup button. Defaults title is 'Scroll to top'</p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="scrollup_master_tooltipeasingtype">Easing Effect Type</label>
						</th>
						<td>
							<select name="scrollup_master_tooltipeasingtype" id="">
								<option value="linear" <?php if(get_option('scrollup_master_tooltipeasingtype') == "linear"){  _e('selected');}?> >linear</option>
								<option value="easeInExpo" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInExpo"){  _e('selected');}?> >easeInExpo</option>
								<option value="easeOutExpo" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeOutExpo"){  _e('selected');}?> >easeOutExpo</option>
								<option value="easeInOutExpo" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInOutExpo"){  _e('selected');}?> >easeInOutExpo</option>
								<option value="easeInQuart" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInQuart"){  _e('selected');}?> >easeInQuart</option>
								<option value="easeOutQuart" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeOutQuart"){  _e('selected');}?> >easeOutQuart</option>
								<option value="easeInOutQuart" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInOutQuart"){  _e('selected');}?> >easeInOutQuart</option>
								<option value="easeInCirc" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInCirc"){  _e('selected');}?> >easeInCirc</option>
								<option value="easeOutCirc" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeOutCirc"){  _e('selected');}?> >easeOutCirc</option>
								<option value="easeInOutCirc" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInOutCirc"){  _e('selected');}?> >easeInOutCirc</option>
							</select>
							<p class="description">Select Scroll to top easing effect type. Default easing effect is linear. <a target="_blank" href="http://www.easings.net/">Easing Effect type live view</a></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="scrollup_master_animation">Scrollup Button Animations</label>
						</th>
						<td>
							<select name="scrollup_master_animation" id="">
								<option value="fade" <?php if(get_option('scrollup_master_animation') == "fade"){  _e('selected');}?> >Fade</option>
								<option value="slide" <?php if(get_option('scrollup_master_animation') == "slide"){  _e('selected');}?> >Slide</option>
								<option value="none" <?php if(get_option('scrollup_master_animation') == "none"){  _e('selected');}?> >None</option>
							</select>
							<p class="description">Select scrollup button animation type. Default animation type is 'Fade' .</a></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="scrollup_master_scrollspeed">Scroll Speed</label>
						</th>
						<td>
							<input type="text" name="scrollup_master_scrollspeed" id="scrollup_master_scrollspeed" value="<?php echo get_option('scrollup_master_scrollspeed'); ?>" class="">
							<p class="description">Speed back to top in millisecond. Default speed is '300' millisecond.</p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="scrollup_master_scrolldistance">Scroll Distance</label>
						</th>
						<td>
							<input type="text" name="scrollup_master_scrolldistance" id="scrollup_master_scrolldistance" value="<?php echo get_option('scrollup_master_scrolldistance'); ?>" class="">
							<p class="description">Distance from top/bottom before showing element pixels. Default distance is '300' pixels.</p>
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