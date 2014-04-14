<?php
/*
Plugin Name: scrollup-master
Plugin URI: http://wordpress.org/plugins/scrollup-master/
Description: This plugin is for wordpress to create scroll to top button.
Version: 2.2
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
function scrollup_custom_style(){
	?><style>
		#scrollUp {
			bottom: <?php echo strlen(trim(get_option("scrollup_master_btn_bottom")))>0?trim(get_option("scrollup_master_btn_bottom")):'20px'?>;
			right: <?php echo strlen(trim(get_option("scrollup_master_btn_right")))>0?trim(get_option("scrollup_master_btn_right")):'20px'?>;
			height: <?php echo strlen(trim(get_option("scrollup_master_img_size")))>0?trim(get_option("scrollup_master_img_size")):'40px'?>;  /* Height of image */
			width: <?php echo strlen(trim(get_option("scrollup_master_img_size")))>0?trim(get_option("scrollup_master_img_size")):'40px'?>; /* Width of image */
			background-size: <?php echo strlen(trim(get_option("scrollup_master_img_size")))>0?trim(get_option("scrollup_master_img_size")):'40px'?>;
		}
	</style><?php
}
add_action('wp_head','scrollup_custom_style');

//register our settings.
function register_scrollup_settings(){
	register_setting('scrollup-master-settings-group','scrollup_master_btn_bottom');
	register_setting('scrollup-master-settings-group','scrollup_master_btn_right');
	register_setting('scrollup-master-settings-group','scrollup_master_img_size');
	register_setting('scrollup-master-settings-group','scrollup_master_tooltiptitle');
	register_setting('scrollup-master-settings-group','scrollup_master_tooltipeasingtype');
	register_setting('scrollup-master-settings-group','scrollup_master_scrollspeed');
	register_setting('scrollup-master-settings-group','scrollup_master_scrolldistance');
	register_setting('scrollup-master-settings-group','scrollup_master_animation');
}
add_action( 'admin_init', 'register_scrollup_settings' );

// function to be run when the plugin is activated.
function scrollup_master_activation() {
	add_option('scrollup_master_btn_bottom','20px');
	add_option('scrollup_master_btn_right','20px');
	add_option('scrollup_master_img_size','40px');
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
		<h2><?php _e('Scrollup Settings') ?></h2>
		<form action="options.php" method="post">
			<?php settings_fields( 'scrollup-master-settings-group' ); ?>
			<?php do_settings_sections( 'scrollup-master-settings-group' ); ?>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">
							<label for="scrollup_master_btn_bottom"><?php _e('Button Position from Bottom') ?></label>
						</th>
						<td>
							<input type="text" name="scrollup_master_btn_bottom" id="scrollup_master_btn_bottom" value="<?php echo get_option('scrollup_master_btn_bottom'); ?>" class="" placeholder="20px">
							<p class="description"><?php _e('Set button position from bottom. Defaults position is &lsquo; 20px &lsquo;') ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="scrollup_master_btn_right"><?php _e('Button Position from Right') ?></label>
						</th>
						<td>
							<input type="text" name="scrollup_master_btn_right" id="scrollup_master_btn_right" value="<?php echo get_option('scrollup_master_btn_right'); ?>" class="" placeholder="20px">
							<p class="description"><?php _e('Set button position from right. Defaults position is &lsquo; 20px &lsquo;') ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="scrollup_master_img_size"><?php _e('Button Image Size') ?></label>
						</th>
						<td>
							<input type="text" name="scrollup_master_img_size" id="scrollup_master_img_size" value="<?php echo get_option('scrollup_master_img_size'); ?>" class="" placeholder="40px">
							<p class="description"><?php _e('Set button image height and width size. Defaults size is &lsquo; 40px &lsquo;') ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="scrollup_master_tooltiptitle"><?php _e('Scrollup Tooltip Title') ?></label>
						</th>
						<td>
							<input type="text" name="scrollup_master_tooltiptitle" id="scrollup_master_tooltiptitle" value="<?php echo get_option('scrollup_master_tooltiptitle'); ?>" class="" placeholder="Scroll to top">
							<p class="description"><?php _e('Set a custom title if required. This title will show when you put your mouse pointer on scrollup button. Defaults title is &lsquo; Scroll to top &lsquo;') ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="scrollup_master_tooltipeasingtype"><?php _e('Easing Effect Type') ?></label>
						</th>
						<td>
							<select name="scrollup_master_tooltipeasingtype" id="">
								<option value="linear" <?php if(get_option('scrollup_master_tooltipeasingtype') == "linear"){  _e('selected');}?> ><?php _e('linear') ?></option>
								<option value="easeInExpo" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInExpo"){  _e('selected');}?> ><?php _e('easeInExpo') ?></option>
								<option value="easeOutExpo" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeOutExpo"){  _e('selected');}?> ><?php _e('easeOutExpo') ?></option>
								<option value="easeInOutExpo" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInOutExpo"){  _e('selected');}?> ><?php _e('easeInOutExpo') ?></option>
								<option value="easeInQuart" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInQuart"){  _e('selected');}?> ><?php _e('easeInQuart') ?></option>
								<option value="easeOutQuart" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeOutQuart"){  _e('selected');}?> ><?php _e('easeOutQuart') ?></option>
								<option value="easeInOutQuart" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInOutQuart"){  _e('selected');}?> ><?php _e('easeInOutQuart') ?></option>
								<option value="easeInCirc" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInCirc"){  _e('selected');}?> ><?php _e('easeInCirc') ?></option>
								<option value="easeOutCirc" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeOutCirc"){  _e('selected');}?> ><?php _e('easeOutCirc') ?></option>
								<option value="easeInOutCirc" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInOutCirc"){  _e('selected');}?> ><?php _e('easeInOutCirc') ?></option>
								<option value="easeInBounce" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInBounce"){  _e('selected');}?> ><?php _e('easeInBounce') ?></option>
								<option value="easeOutBounce" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeOutBounce"){  _e('selected');}?> ><?php _e('easeOutBounce') ?></option>
								<option value="easeInOutBounce" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInOutBounce"){  _e('selected');}?> ><?php _e('easeInOutBounce') ?></option>
								<option value="easeInElastic" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInElastic"){  _e('selected');}?> ><?php _e('easeInElastic') ?></option>
								<option value="easeOutElastic" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeOutElastic"){  _e('selected');}?> ><?php _e('easeOutElastic') ?></option>
								<option value="easeInOutElastic" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInOutElastic"){  _e('selected');}?> ><?php _e('easeInOutElastic') ?></option>
								<option value="easeInBack" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInBack"){  _e('selected');}?> ><?php _e('easeInBack') ?></option>
								<option value="easeOutBack" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeOutBack"){  _e('selected');}?> ><?php _e('easeOutBack') ?></option>
								<option value="easeInOutBack" <?php if(get_option('scrollup_master_tooltipeasingtype') == "easeInOutBack"){  _e('selected');}?> ><?php _e('easeInOutBack') ?></option>
							</select>
							<p class="description"><?php _e('Select Scroll to top easing effect type. Default easing effect is linear. <a target="_blank" href="http://www.easings.net/">Easing Effect type live view</a>') ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="scrollup_master_animation"><?php _e('Scrollup Button Animations') ?></label>
						</th>
						<td>
							<select name="scrollup_master_animation" id="">
								<option value="fade" <?php if(get_option('scrollup_master_animation') == "fade"){  _e('selected');}?> ><?php _e('Fade') ?></option>
								<option value="slide" <?php if(get_option('scrollup_master_animation') == "slide"){  _e('selected');}?> ><?php _e('Slide') ?></option>
								<option value="none" <?php if(get_option('scrollup_master_animation') == "none"){  _e('selected');}?> ><?php _e('None') ?></option>
							</select>
							<p class="description"><?php _e('Select scrollup button animation type. Default animation type is &lsquo; Fade &lsquo; ') ?></a></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="scrollup_master_scrollspeed"><?php _e('Scroll Speed') ?></label>
						</th>
						<td>
							<input type="text" name="scrollup_master_scrollspeed" id="scrollup_master_scrollspeed" value="<?php echo get_option('scrollup_master_scrollspeed'); ?>" class="" placeholder="300">
							<p class="description"><?php _e('Speed back to top in millisecond. Default speed is &lsquo; 300 &lsquo; millisecond ') ?></p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="scrollup_master_scrolldistance"><?php _e('Scroll Distance') ?></label>
						</th>
						<td>
							<input type="text" name="scrollup_master_scrolldistance" id="scrollup_master_scrolldistance" value="<?php echo get_option('scrollup_master_scrolldistance'); ?>" class="" placeholder="300">
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